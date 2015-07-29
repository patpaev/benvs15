<?php
/**
 * @file
 * Default theme implementation to wrap menu blocks.
 *
 * Available variables:
 * - $content: The renderable array containing the menu.
 * - $classes: A string containing the CSS classes for the DIV tag. Includes:
 *   menu-block-DELTA, menu-name-NAME, parent-mlid-MLID, and menu-level-LEVEL.
 * - $classes_array: An array containing each of the CSS classes.
 *
 * The following variables are provided for contextual information.
 * - $delta: (string) The menu_block's block delta.
 * - $config: An array of the block's configuration settings. Includes
 *   menu_name, parent_mlid, title_link, admin_title, level, follow, depth,
 *   expanded, and sort.
 *
 * @see template_preprocess_menu_block_wrapper()
 */
?>

<?php
switch ($config['depth']) {
  case 1:
    // children
    echo( "<section class='navigation-block-listing'><ul class=''>");
    foreach($content as $menu_item) {
      if(isset($menu_item['#title'])) {
        $nid = (int) str_replace("node/", "", $menu_item['#href']);
        $delta = 0;
        $language = 'und';
        $entity = entity_load('node', array($nid));
        if(isset($entity[$nid])) {
          $node_curr = $entity[$nid];
          $item_summary = field_get_items('node', $node_curr, 'field_summary');
          if ($item_summary) {
            $node_curr_summary = field_view_value('node', $node_curr, 'field_summary', $item_summary[0]);  
          } else {
            $node_curr_summary = field_view_field( 'node', $node_curr, 'body', array(
              'label' => 'hidden', 
              'type' => 'text_summary_or_trimmed', 
              'settings' => array('trim_length' => 150)
            ));
          }
          echo( '<li><a href="/'
           .  drupal_get_path_alias($menu_item['#href'])
           .  '">'
           .  "<h3>" . $menu_item['#title'] . "</h3>" 
           );
          print render($node_curr_summary); 
          echo( '</a></li>' );
        }
      }
    }
    echo("</ul></section>");
    break;
  case 2:
    // grandchildren
    echo( "<section class='navigation-block-listing'><ul class='narrow'>");
    foreach($content as $menu_item) {
      if(isset($menu_item['#title'])) {
        echo( '<li><a href="/'
         .  drupal_get_path_alias($menu_item['#href'])
         .  '">'
         .  "<h3>" . $menu_item['#title'] . "</h3>" 
         );
        echo( '</a>' ); 
        // if menu has children 
        if(sizeof($menu_item['#below']) > 0){
          echo( '<ul>' );
          foreach($menu_item['#below'] as $submenu_item) {
            if(isset($submenu_item['#title'])) {
              echo( '<li><a href="/'
               .  drupal_get_path_alias($submenu_item['#href'])
               .  '">'
               .  $submenu_item['#title'] 
               .  '</a></li>' 
               );
            }
          }
          echo( '</ul>' );
        }
        echo( '</li>' );
      }
    }
    echo("</ul></section>");
    break;
  default:
    echo("<div class='"); 
    print $classes;
    echo('">');
    print render($content);
    echo("</div>");
}
?>


