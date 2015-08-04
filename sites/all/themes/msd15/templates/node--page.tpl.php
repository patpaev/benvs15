<?php
// save fields to local variables

// get an image's URL 
$item_hero_image = field_get_items('node', $node, 'field_hero_image');
$hero_image = $item_hero_image[0]['uri'];
$hero_image_url = file_create_url($hero_image);

// get a default html output value
$item_tagline = field_get_items('node', $node, 'field_tagline');
$tagline = field_view_value('node', $node, 'field_tagline', $item_tagline[0]);

$item_body = field_get_items('node', $node, 'body');
$body = field_view_value('node', $node, 'body', $item_body[0]);

$item_jumpnav = field_get_items('node', $node, 'field_jumpnav');
$jumpnav = $item_jumpnav[0]['value'];

$item_show_children = field_get_items('node', $node, 'field_show_children');
$show_children = $item_show_children[0]['value'];

$related_pages = field_get_items('node', $node, 'field_related_pages');

// FB:OG
if ($item_hero_image)
  $main_image = $hero_image_url;
else
  $main_image = '/default.jpg';

$field_summary = field_view_field( 'node', $node, 'body', array(
        'label' => 'hidden', 
        'type' => 'text_summary_or_trimmed', 
        'settings' => array()
      ));
// give it a big clean out 
if (isset($field_summary[0]))
  $summary = html_entity_decode(preg_replace("/&nbsp;/i", " ", htmlentities(strip_tags($field_summary[0]['#markup']))));
else 
  $summary = drupal_get_title() . ', ' . variable_get('site_name', '') . ', ' . 'The University of Melbourne.';
$summary = preg_replace('/"/', "'", $summary);
$summary = preg_replace("/(\r?\n){2,}/", ' ', $summary);

$inline_script = ''
.'<meta property="og:title"                  content="'. drupal_get_title() .'" />'
.'<meta property="og:image"                  content="'. $main_image .'" />'
.'<meta property="og:description"            content="'. trim($summary) .'" />'
.'<meta name="twitter:card"                  content="summary" />'
.'<meta name="twitter:site"                  content="@msdsocial" />'
.'<meta name="twitter:creator"               content="@msdsocial" />'
.'';
$element = array(
  '#type' => 'markup',
  '#markup' => $inline_script,
);
drupal_add_html_head($element, 'fb ogs');

?>

<?php if ($item_hero_image): ?>

  <header class="image" style="background-image:url(<?= $hero_image_url ?>);">
    <div class="mid-align blurred">
      <h1>
        <?= drupal_get_title(); ?>
      </h1>
        <?php if($item_tagline) print render($tagline); ?>
    </div>
  </header>

<?php else: ?>

    <header>
      <h1>
        <?= drupal_get_title(); ?>
      </h1>
      <?php if($item_tagline) print render($tagline); ?>
    </header>

<?php endif; ?>

<?php if ($jumpnav == "yes"): ?> 
  <div class="jumpnav"></div> 
<?php endif; ?>

<section>
  <?php print render($body); ?>
</section>

<?php
switch ($show_children) {
  case "children":
    print render($region['child_pages']);
    break;
  case "grandchildren":
    print render($region['grandchild_pages']);
    break;
}
?>

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
