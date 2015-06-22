<?php

/**
 * @file
 * Admin functions and page callbacks for the Block Revisions module.
 */

/**
 * Confirmation form for reverting a revision.
 */
function block_revisions_revert_confirm($form, $form_state, $revision) {
  $form['#block_revision'] = $revision;
  $delta = $revision->bid;
  return confirm_form($form, t('Are you sure you want to revert the revision?'), "admin/structure/block/manage/block/$delta/revisions", t('This action cannot be undone.'), t('Revert'), t('Cancel'));
}

/**
 * @todo Please document this function.
 * @see http://drupal.org/node/1354
 */
function block_revisions_revert_confirm_submit($form, &$form_state) {
  global $user;
  $revision = $form['#block_revision'];
  $delta = $revision->bid;
  $vid = $revision->vid;

  $message = t('Copy of the revision from !date.', array('!date' => format_date($revision->timestamp)));
  db_update('block_custom')
  ->fields(array(
    'body' => $revision->body,
    'format' => $revision->format,
    'uid' => $user->uid,
    'timestamp' => REQUEST_TIME,
  ))
  ->condition('bid', $delta)
  ->execute();
  block_revisions_create_revision($delta, $revision->body, $revision->format, $message);

  if (db_query('SELECT COUNT(vid) FROM {boxes_revisions} WHERE bid = :bid', array(':bid' => $delta))->fetchField() > 1) {
    $form_state['redirect'] = "admin/structure/block/manage/block/$delta/revisions";
  }
  else {
    $form_state['redirect'] = "admin/structure/block/manage/block/$delta";
  }
}

/**
 * Confirmation form for revision deletion.
 */
function block_revisions_delete_confirm($form, $form_state, $revision) {
  $form['#block_revision'] = $revision;
  $delta = $revision->bid;
  return confirm_form($form, t('Are you sure you want to delete the revision?'), "admin/structure/block/manage/block/$delta/revisions", t('This action cannot be undone.'), t('Delete'), t('Cancel'));
}

/**
 * @todo Please document this function.
 * @see http://drupal.org/node/1354
 */
function block_revisions_delete_confirm_submit($form, &$form_state) {
  $revision = $form['#block_revision'];
  $delta = $revision->bid;
  $vid = $revision->vid;

  db_delete('boxes_revisions')
    ->condition('bid', $delta)
    ->condition('vid', $vid)
    ->execute();

  $title = db_query("SELECT info FROM {block_custom} WHERE bid = :bid", array(':bid' => $delta))->fetchField();

  watchdog('content', "Deleted revision %revision for custom block '%title'.", array('%title' => $title, '%revision' => $revision->vid));
  drupal_set_message(t("Revision from %revision-date of custom block '%title' has been deleted.", array('%revision-date' => format_date($revision->timestamp), '%title' => $title)));

  if (db_query('SELECT COUNT(vid) FROM {boxes_revisions} WHERE bid = :bid', array(':bid' => $delta))->fetchField() > 1) {
    $form_state['redirect'] = "admin/structure/block/manage/block/$delta/revisions";
  }
  else {
    $form_state['redirect'] = "admin/structure/block/manage/block/$delta";
  }
}

/**
 * Menu callback for the revisions overview page.
 *
 * This page lists all the revisions for a specific custom block.
 */
function block_revisions_overview($delta) {
  $output = '';

  // Fetch information about the block and the current revision from the database.
  $block = db_query('SELECT b.info, b.timestamp, b.uid FROM {block_custom} b WHERE b.bid = :bid', array(':bid' => $delta))->fetchObject();

  // Set the title for the page.
  drupal_set_title(t("Revisions for '%title' block", array('%title' => $block->info)), PASS_THROUGH);

  // Fetch a list of revisions for this custom block from the database.
  $revisions = block_revision_list($delta);
  $latest_revision = reset($revisions);

  // By comparing the timestamp of the block with the timestamp of the
  // most recent revision, we can determine if the block was altered
  // after that revision was created. If it is, warn the user that
  // the most recent revision differs from the actual block content.
  if ($block->timestamp !== $latest_revision->timestamp) {
    $account = array_shift(user_load_multiple(array($block->uid)));
    drupal_set_message(t('Warning: the block has been altered since the most recent revision. The latest, non-versioned, edit was made by !username on %timestamp.', array('!username' => theme('username', array('account' => $account)), '%timestamp' => format_date($block->timestamp))), 'warning');
  }

  $header = array(t('Revision'), array(
    'data' => t('Operations'),
    'colspan' => 2,
  ));
  $rows = array();

  foreach ($revisions as $revision) {
    $row = array();
    $operations = array();

    $row[] = array('data' => t('!date by !username', array('!date' => format_date($revision->timestamp, 'short'), '!username' => theme('username', array('account' => $revision)))) . (($revision->log != '') ? '<p class="revision-log">' . check_plain($revision->log) . '</p>' : ''));
    if ($revision->vid == 0) {
      $operations[] = array(
        'data' => drupal_placeholder(t('current revision')),
        'class' => 'revision-current',
        'colspan' => 2,
      );
      $row[0]['class'] = 'revision-current';
    }
    else {
      $operations[] = l(t('revert'), "admin/structure/block/revisions/revert/$delta/$revision->vid");
      $operations[] = l(t('delete'), "admin/structure/block/revisions/delete/$delta/$revision->vid");
    }

    $rows[] = array_merge($row, $operations);
  }

  $output .= theme('table', array('header' => $header, 'rows' => $rows));

  return $output;
}

/**
 * Return revision information for the given block.
 */
function block_revision_list($delta) {
  $revisions = array();

  $query = "SELECT br.vid, br.body, br.format, br.timestamp, br.log, u.uid, u.name FROM {boxes_revisions} br LEFT JOIN {users} u ON br.uid = u.uid WHERE br.bid = :bid ORDER BY timestamp DESC";
  $result = db_query($query, array(':bid' => $delta));
  foreach ($result as $revision) {
    $revisions[$revision->vid] = $revision;
  }

  return $revisions;
}
