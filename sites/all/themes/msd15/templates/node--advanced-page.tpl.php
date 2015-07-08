<?php
// save fields to local variables
$item_body = field_get_items('node', $node, 'body');
$body = $item_body[0]['value'];
?>

<?php echo($body); ?>
