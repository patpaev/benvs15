<?php // dpm($node); ?>


<?php
// save fields to local variables
$item_hero_text = field_get_items('node', $node, 'field_hero_text');
$hero_text = field_view_value('node', $node, 'field_hero_text', $item_hero_text[0]);

// get link
$hero_link = field_get_items('node', $node, 'field_hero_link');
$link = $hero_link[0];

// get an image's URL 
$item_hero_image = field_get_items('node', $node, 'field_hero_image');
$hero_image = $item_hero_image[0]['uri'];
$hero_image_url = file_create_url($hero_image);

$item_body = field_get_items('node', $node, 'body');
$body = field_view_value('node', $node, 'body', $item_body[0]);

$pathways = field_get_items('node', $node, 'field_pathways');

$item_video_section_text = field_get_items('node', $node, 'field_video_section_text');
$video_section_text = field_view_value('node', $node, 'field_video_section_text', $item_video_section_text[0]);

// get plain text
$item_overview_video = field_get_items('node', $node, 'field_youtube_embed_url');
$overview_video = $item_overview_video[0]['value'];

$related_pages = field_get_items('node', $node, 'field_related_pages');

?>

<header class="banner" style="background-image:url(<?= $hero_image_url ?>);">
  <div class="mid-align blurred">
      <?php print render($hero_text); ?>
      <?php if($hero_link): ?>
        <a href="<?= $link['url'] ?>" class="button-hero-inverse"><?= $link['title'] ?></a>
      <?php endif; ?>
  </div>
</header>

<ul class="pathfinder-3">
  <?php 
  if ($pathways) {
    foreach($pathways as $pathway) {
      $pathnode = node_view(node_load($pathway['target_id']));
      print drupal_render($pathnode);
    }
  }
  ?>
</ul>

<?php if($item_body): ?>
  <section>
    <?php print render($body); ?>
  </section>
<?php endif; ?>

<section class="alt">
  <?php if($item_overview_video): ?>
    <div class="half">
      <section>
        <div class="video">
          <iframe allowfullscreen="" frameborder="0" height="315" src="<?= $overview_video ?>" title="video player" width="560"></iframe>
        </div>
      </section>
      <section>
        <?php print render($video_section_text); ?>
      </section>
    </div>
  <?php else: ?>
    <?php print render($video_section_text); ?>
  <?php endif; ?>
</section>

<?php if(!empty($related_pages)): ?>
  <section class="links">
    <h2 id="related-links">Related Links</h2>
    <ul>
      <?php foreach($related_pages as $related_page): ?>
        <li><a href="<?= $related_page['url'] ?>"><?= $related_page['title'] ?></a></li>
      <?php endforeach; ?>
    </ul>
  </section>
<?php endif; ?>

