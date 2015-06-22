<?php

/**
 * Implements hook_preprocess_html
 */
function msd15_preprocess_html(&$vars) {
  drupal_add_css('https://uom-design-system.s3.amazonaws.com/v1.0/uom.css', 'external');
  drupal_add_css(path_to_theme() . '/css/style.css');
  drupal_add_js('https://uom-design-system.s3.amazonaws.com/v1.0/uom.js', 'external');
  drupal_add_js(path_to_theme() . '/js/main.js');
}


/**
 * Preprocessor for node.tpl.php template file.
 */
function msd15_preprocess_node(&$vars) {
  if ($vars["is_front"]) {
    $vars["theme_hook_suggestions"][] = "node__front";
  }
  if ($blocks = block_get_blocks_by_region('rightcolumn')) {
    $vars['rightcolumn'] = $blocks;
  }
  // Use custom node template for news
  if(request_path() == "news") {
    $vars['theme_hook_suggestions'][] = 'node__news_list';
  }
  if(request_path() == "events") {
    $vars['theme_hook_suggestions'][] = 'node__events_list';
  }
  if(request_path() == "past-events") {
    $vars['theme_hook_suggestions'][] = 'node__past_events_list';
  }
  if(request_path() == "wunderlich-757") {
    $vars['theme_hook_suggestions'][] = 'node__wunderlich_events_list';
  }
  if(request_path() == "757-swanston-street-building") {
    $vars['theme_hook_suggestions'][] = 'node__757_swanston_events_list';
  }
}

/**
 * Preprocessor for page.tpl.php template file.
 */
function msd15_preprocess_page(&$vars, $hook) {
  
  // Get the entire main menu tree
  $main_menu_tree = menu_tree_all_data('main-menu');
  $vars['menu_tree_all_data'] = $main_menu_tree;
  // Add the rendered output to the $main_menu_expanded variable
  $vars['main_menu_expanded'] = menu_tree_output($main_menu_tree);


  if (isset($vars['node']->type)) { 
    // We don't want to apply this on taxonomy or view pages
    // Splice (2) is based on existing default suggestions. Change it if you need to.
    array_splice($vars['theme_hook_suggestions'], -1, 0, 'page__' . $vars['node']->type);
    // Get the url_alias and make each item part of an array
    $url_alias = drupal_get_path_alias($_GET['q']);
    $split_url = explode('/', $url_alias);
    // Add the full path template pages
    // Insert 2nd to last to allow page--node--[nid] to be last
    $cumulative_path = '';
    foreach ($split_url as $path) {
      $cumulative_path .= '__' . $path;
      $path_name = 'page' . $cumulative_path;
      array_splice($vars['theme_hook_suggestions'], -1, 0, str_replace('-', '_', $path_name));
    }
    // This does just the page name on its own & is considered more specific than the longest path
    // (because sometimes those get too long)
    // Also we don't want to do this if there were no paths on the URL
    // Again, add 2nd to last to preserve page--node--[nid] if we do add it in
    if (count($split_url) > 1) {
      $page_name = end($split_url);
      array_splice($vars['theme_hook_suggestions'], -1, 0, 'page__' . str_replace('-', '_', $page_name));
    }
  }

  // if (isset($vars['main_menu'])) {
  //   $vars['primary_nav'] = theme('links__system_main_menu', array(
  //     'links' => $vars['main_menu'],
  //     'attributes' => array(
  //       'class' => array('links', 'inline', 'main-menu'),
  //     ),
  //     'heading' => array(
  //       'text' => t('Main menu'),
  //       'level' => 'h2',
  //       'class' => array('element-invisible'),
  //     )
  //   ));
  // }
  // else {
  //   $vars['primary_nav'] = FALSE;
  // }
}

function msd15_menu_link__main_menu(array $variables) {
  $element = $variables['element'];
  $sub_menu = '';

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
    $element['#attributes']['class'][] = "has-sub";
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li>' . $output . $sub_menu . "</li>\n";
}

function _unimelb_menu_tree($region, $menu_name, $max_depth = null) {
  $menu_output = &drupal_static(__FUNCTION__, array());

  if (!isset($menu_output[$region])) {
    if ($max_depth == 0) {
      $max_depth = null;
    }

    $tree = menu_tree_page_data($menu_name, $max_depth);
    $menu_output[$region] = menu_tree_output($tree);
  }

  return $menu_output[$region];
}
