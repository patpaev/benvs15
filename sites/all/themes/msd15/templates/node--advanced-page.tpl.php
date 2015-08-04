<?php
// save fields to local variables
$item_body = field_get_items('node', $node, 'body');
$body = $item_body[0]['value'];


$field_summary = field_view_field( 'node', $node, 'field_summary', array(
        'label' => 'hidden', 
        'type' => 'text_summary_or_trimmed', 
        'settings' => array()
      ));
// give it a big clean out 
$summary = html_entity_decode(preg_replace("/&nbsp;/i", " ", htmlentities(strip_tags($field_summary[0]['#markup']))));
$summary = preg_replace('/"/', "'", $summary);
$summary = preg_replace("/(\r?\n){2,}/", ' ', $summary);

$inline_script = ''
.'<meta property="og:title"                  content="'. drupal_get_title() .'" />'
.'<meta property="og:image"                  content="/default.jpg" />'
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

<?php echo($body); ?>
