<div class="uomcontent">
  <div class="page-inner">
    <div class="page-local-history">
      <a class="root" href="/" title="Website Home"><?= $site_name ?></a>
      <span>/</span>
      <!-- <a class="last" href="" title="A sub-page">A sub-page</a> -->
      <?php print render($page['navigation']); ?>
    </div> <!-- /.page-local-history -->
    <div role="main">

      <?php if ($logged_in) : ?>    
        <?php print $messages; ?>
      <?php endif; ?>
     
      <?php print render($page['content']); ?>
      
      <?php if ($logged_in) : ?>
        <div class="drupal-tabs">
          <?php print "<ul>" . drupal_render($tabs['#primary']) . "</ul>"; ?>
          <?php print "<ul>" . drupal_render($tabs['#secondary']) . "</ul>"; ?>
        </div>
      <?php endif; ?>
    
    </div> <!-- /role="main" -->
    <div class="no-js" id="sitemap" role="navigation">
      <h2><?= $site_name ?></h2>
      <ul>
        <? 
        function print_node($node) {
          echo( '<li><a href="/'
               .  drupal_get_path_alias($node['link']['href'])
               .  '">'
               .  $node['link']['link_title']
               .  '</a>'
              );
          
          $current_level = $node['below'];
          if ( count($current_level) ) {
            echo( '<div class="inner"><ul>' );

            foreach($current_level as $item) {
              print_node($item);
            }
            echo( '</ul></div>' );
          }
          echo( '</li>' );
          return;
        }
        // skip "home"
        $home = TRUE;
        foreach($menu_tree_all_data as $root_item) {
          if($home) {
            $home = FALSE;
            continue;
          } else {
            print_node($root_item);
          }        
        }
        ?>
      </ul>
    </div> <!-- /#navigation -->
  </div> <!-- /.page-inner -->
</div> <!-- /.uomcontent -->