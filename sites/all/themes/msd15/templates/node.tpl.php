<?
if (isset($node) && is_object($node)) {

	$node = node_load($node->nid);
	$item = field_get_items('node', $node, 'field_image');
	if(is_array($item)) {
		$image = field_view_value('node', $node, 'field_image', $item[0], 
			array(
		        'type' => 'image',
		        'settings' => array(
		        )
			)
		);
	?>
	<div class="content-banner">
	 	<? print render($image); ?>
	</div>  
	<? 	
	}
} 
?>

<?php if ($title): ?>
    <header><h1><?php print $title; ?></h1></header>
<?php endif; ?>

<section>
  <?php print render($content); ?>
</section>

<?
$item = field_get_items('node', $node, 'field_right_column');
if(is_array($item)):
	$field_right_column = field_view_value('node', $node, 'field_right_column', $item[0]);
	if($field_right_column && is_array($field_right_column)): ?>
		<div class='right-column'>
			<? print render($field_right_column); ?>
		</div>
  <? endif; ?>
<? endif; ?>

