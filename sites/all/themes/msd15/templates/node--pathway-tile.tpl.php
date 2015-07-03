<?php
// save fields to local variables

$item_body = field_get_items('node', $node, 'body');
$body = field_view_value('node', $node, 'body', $item_body[0]);

// get plain text
$item_overview_video = field_get_items('node', $node, 'field_youtube_embed_url');
$overview_video = $item_overview_video[0]['value'];

$field_link = field_get_items('node', $node, 'field_link');
$link = $field_link[0];

?>

<li>
  <a href="<?= $link['url'] ?>">
    <strong>
      <span>
        <?= $node->title; ?>
      </span>
    </strong>
    <p><?php print render($body); ?></p>
    <span class="button-small brand"><?= $link['title'] ?></span>
  </a>
</li>
