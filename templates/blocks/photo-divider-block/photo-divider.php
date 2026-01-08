<?php
/**********************************************************
 *
 * File:         Photo Divider
 * Description:  Use image to separate contents
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     23/05/2025
 *
 **********************************************************/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$bg = get_field('image');
$add_margin = get_field('add_margin');
?>

<div class="photo-divider block--fullwidth <?php echo $add_margin; ?> fade-in-right">
	<?php echo wp_get_attachment_image( $bg, 'full', false, array('class'=>'img-fluid', 'loading' => 'lazy') ) ?>
</div>
