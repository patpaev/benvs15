<?php // dpm($node); ?>


<?php
// save fields to local variables

$item_body = field_get_items('node', $node, 'body');
$body = field_view_value('node', $node, 'body', $item_body[0]);

$item_student_photo = field_get_items('node', $node, 'field_student_photo');
$student_photo = $item_student_photo[0]['uri'];
$student_photo_url = file_create_url($student_photo);

$item_student_quote = field_get_items('node', $node, 'field_student_quote');
$student_quote = $item_student_quote[0]['value'];

$item_student_quote_caption = field_get_items('node', $node, 'field_student_quote_caption');
$student_quote_caption = $item_student_quote_caption[0]['value'];

$item_career_outcomes = field_get_items('node', $node, 'field_career_outcomes');
$career_outcomes = field_view_value('node', $node, 'field_career_outcomes', $item_career_outcomes[0]);

$item_career_outcomes_photo = field_get_items('node', $node, 'field_career_outcomes_photo');
$career_outcomes_photo = $item_career_outcomes_photo[0]['uri'];
$career_outcomes_photo_url = file_create_url($career_outcomes_photo);

$item_video_title = field_get_items('node', $node, 'field_video_title');
$video_title = $item_video_title[0]['value'];

$item_youtube_embed_url = field_get_items('node', $node, 'field_youtube_embed_url');
$youtube_embed_url = $item_youtube_embed_url[0]['value'];

$item_sample_course_plan = field_get_items('node', $node, 'field_sample_course_plan');
$sample_course_plan = field_view_value('node', $node, 'field_sample_course_plan', $item_sample_course_plan[0]);

$item_show_legend = field_get_items('node', $node, 'field_show_legend');
$show_legend = $item_show_legend[0]['value'];

$has_student_quote = ( $item_student_photo && $item_student_quote && $item_student_quote_caption );

?>

<header>
  <h1>
    Environments majors: <strong><?= drupal_get_title(); ?></strong>
  </h1>
</header>

<?php if ($has_student_quote): ?>
  <div class="half">
    <section> <!-- left half -->
      <?php print render($body); ?>
    </section> <!-- /left half -->
    <section> <!-- right half -->

      <div class="fullwidth" style="background-image:url(<?= $student_photo_url ?>); background-position: 40% 100%;">
        <section>
          <blockquote>
            <?= $student_quote; ?>
          </blockquote>
          <p>
            <?= $student_quote_caption; ?>
          </p>
        </section>
      </div> <!-- /.fullwidth.construction -->
    </section> <!-- /right half -->
  </div> <!-- /.half -->
<?php else: ?>
  <section>
    <?php print render($body); ?>
  </section> 
<?php endif; ?>

<header class="career-outcomes with-box" style="background-image: url('<?= $career_outcomes_photo_url; ?>');">
  <div class="box">
    <h1>
      Career outcomes
    </h1>
    <?php print render($career_outcomes); ?>
  </div>
</header>

<?php if($item_youtube_embed_url): ?>
  <section>
    <?php if($item_video_title) echo('<h2 class="title">' . $video_title . '</h2>'); ?>
    <section class="video">
      <iframe allowfullscreen="true" frameborder="0" height="315" src="<?= $youtube_embed_url; ?>" title="video player" width="420"></iframe>
    </section>   
  </section>
<? endif; ?>

<?php if($item_sample_course_plan): ?>
  <section class="course-plan">
    <h2 class="title">Sample Course Plan</h2>
    <?php print render($sample_course_plan); ?>
    <?php if($show_legend): ?>
      <div class="legend">
        <div><span class="circle category-a"></span><span class="label">First-year subjects</span></div>
        <div><span class="circle category-e"></span><span class="label">Enabling subjects</span></div>
        <div><span class="circle category-c"></span><span class="label">Major subject</span></div>
        <div><span class="circle category-b"></span><span class="label">Elective subject</span></div>
        <div><span class="circle category-f"></span><span class="label">Breadth subject</span></div>
        <div><span class="circle category-g"></span><span class="label">Free points</span></div>
    </div>
    <?php endif; ?>
  </section>
<?php endif; ?>
  
<!--         bottom of page content -->
<div class="half">
  <section class="center">
    <a class="button-hero-reverse" href="/majors">All majors</a>
  </section>
  <section class="center">
    <a class="button-hero" href="/course/#requirements">Apply now</a>
  </section>
</div>
