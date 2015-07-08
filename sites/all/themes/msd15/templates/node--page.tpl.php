<?php // dpm($node); ?>


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

// get a photo url
// $item_student_photo = field_get_items('node', $node, 'field_student_photo');
// $student_photo = $item_student_photo[0]['uri'];
// $student_photo_url = file_create_url($student_photo);

// get a raw text value
// $item_student_quote = field_get_items('node', $node, 'field_student_quote');
// $student_quote = $item_student_quote[0]['value'];

// get a default html output value
// $item_career_outcomes = field_get_items('node', $node, 'field_career_outcomes');
// $career_outcomes = field_view_value('node', $node, 'field_career_outcomes', $item_career_outcomes[0]);

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
