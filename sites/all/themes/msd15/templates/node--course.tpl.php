<?php // dpm($node); ?>


<?php
// save fields to local variables

// get default HTML output of a field
$item_overview = field_get_items('node', $node, 'field_overview');
$overview = field_view_value('node', $node, 'field_overview', $item_overview[0]);

$item_degree_title = field_get_items('node', $node, 'field_degree_title');
$degree_title = $item_degree_title[0]['value'];

// get plain text
$item_degree_details = field_get_items('node', $node, 'field_degree_details');
$degree_details = $item_degree_details[0]['value'];

// get plain text
$item_overview_video = field_get_items('node', $node, 'field_overview_video');
$overview_video = $item_overview_video[0]['value'];

$item_body = field_get_items('node', $node, 'body');
$body = field_view_value('node', $node, 'body', $item_body[0]);
$course_description = $body; // alias 

$item_degree_structure = field_get_items('node', $node, 'field_degree_structure');
$degree_structure = field_view_value('node', $node, 'field_degree_structure', $item_degree_structure[0]);

$item_course_structure = field_get_items('node', $node, 'field_course_structure');
$course_structure = field_view_value('node', $node, 'field_course_structure', $item_course_structure[0]);

$item_entry_requirements = field_get_items('node', $node, 'field_entry_requirements');
$entry_requirements = field_view_value('node', $node, 'field_entry_requirements', $item_entry_requirements[0]);

$item_entry_requirements_sidebar = field_get_items('node', $node, 'field_entry_requirements_sidebar');
$entry_requirements_sidebar = field_view_value('node', $node, 'field_entry_requirements_sidebar', $item_entry_requirements_sidebar[0]);

$item_fees_and_scholarships = field_get_items('node', $node, 'field_fees_and_scholarships');
$fees_and_scholarships = field_view_value('node', $node, 'field_fees_and_scholarships', $item_fees_and_scholarships[0]);

$item_fees_and_scholarships_side = field_get_items('node', $node, 'field_fees_and_scholarships_side');
$fees_and_scholarships_side = field_view_value('node', $node, 'field_fees_and_scholarships_side', $item_fees_and_scholarships_side[0]);
$fees_and_scholarships_sidebar = $fees_and_scholarships_side; // alias 

$item_apply_now_section = field_get_items('node', $node, 'field_apply_now_section');
$apply_now_section = field_view_value('node', $node, 'field_apply_now_section', $item_apply_now_section[0]);

// Load the related items
$application_checklist = array();
if(array_key_exists("field_application_checklist", $content)) 
  $application_checklist = $content["field_application_checklist"]["#items"];

// get an image's URL 
$item_hero_image = field_get_items('node', $node, 'field_hero_image');
$hero_image = $item_hero_image[0]['uri'];
$hero_image_url = file_create_url($hero_image);

?>

<header class="banner" style="background-image:url(<?= $hero_image_url ?>);">
  <div class="bottom-align-flat">
    <form action="" class="course-select" data-view-visitor-select-form="" method="get">
      <div class="left">
        <h2><?= $degree_title; ?></h2>
        <p><?= $degree_details; ?></p>
      </div>
    </form>
  </div>
</header>

<div class="tabbed-course" data-tabbed="" id="nav">
  <div class="full-width">
    <nav class="desktop-nav active" role="tablist">
      <a href="#overview" role="tab" data-current="">Overview</a>
      <a href="#course-structure" role="tab">Course Structure</a>
      <a href="#requirements" role="tab">Entry Requirements</a>
      <a href="#fees" role="tab">Fees &amp; Scholarships</a>
      <a href="#apply" role="tab">Apply now</a>
    </nav>
  </div>

  <div class="tab" id="overview" role="tabpanel" data-current="">
    <div class="alt">
      <div class="half">
        <section>
          <div class="video">
            <iframe allowfullscreen="" frameborder="0" height="315" src="<?= $overview_video ?>" title="video player" width="560"></iframe>
          </div>
        </section>
        <section>
          <div>
            <?php print render($overview); ?>
          </div>
        </section>
      </div> <!-- /.half -->
    </div> <!-- /.alt -->

    <section>
      <h2 class="title">Course Description</h2>

      <?php print render($course_description); ?>

      <p class="center">
        <a class="button-hero" data-tab="2" href="#degree">Next : See which subjects you&#8217;ll be studying</a>
      </p>
    </section>
  </div>

  <div class="tab" id="course-structure" role="tabpanel">
    <div class="with-aside left">
      <div>
        <aside>
          <h2 class="subtitle">Degree Structure</h2>
          <?php print render($degree_structure); ?>
        </aside>

        <div class="bside">
          <div class="degree-plan current">
            <?php print render($course_structure); ?>
            <p class="center"><a class="button-hero" data-tab="3" href="#requirements">Next : Entry requirements</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="tab" id="requirements" role="tabpanel">
    <div class="with-aside left">
      <div>
        <aside>
          <?php print render($entry_requirements_sidebar); ?>
        </aside>
        <div class="bside">
          <section>
            <?php print render($entry_requirements); ?>
            <p><a class="button-hero" data-tab="4" href="#fees">Next : Fees &amp; scholarships</a></p>
          </section>
        </div>
      </div>
    </div>
  </div>

  <div class="tab" id="fees" role="tabpanel">
    <?php if($item_fees_and_scholarships_side): ?>
      <div class="with-aside">
        <div>
          <div class="bside">
            <?php print render($fees_and_scholarships); ?>
            <p class="center"><a class="button-hero" data-tab="5" href="#apply">Next : Apply now</a></p>
          </div>

          <aside>
            <?php print render($fees_and_scholarships_sidebar); ?>
          </aside>
        </div>
      </div>
    <?php else: ?>
      <section>
        <?php print render($fees_and_scholarships); ?>
        <p class="center"><a class="button-hero" data-tab="5" href="#apply">Next : Apply now</a></p>
      </section>
    <?php endif; ?>
  </div>

  <div class="tab" id="apply" role="tabpanel">
    <section>
      <?php print render($apply_now_section); ?>
    </section>      
  </div>
</div>
