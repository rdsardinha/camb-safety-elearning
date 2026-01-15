<?php
/**********************************************************
 *
 * File:         Photo Collage
 * Description:  Image Gallery
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     23/05/2025
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

$images = get_field('gallery');
$add_margin = get_field('add_margin');

$i = 0;
?>

<div class="photo-collage block <?php echo $add_margin; ?>">
	<div class="row">
		<div class="col-12">
			<ul class="photo-collage__gallery">
				<?php
				if ($images):
					foreach ($images as $image):
						$i++;
						$delay = ($i - 1) * 0.2; ?>
						<li>
							<?php echo wp_get_attachment_image($image, 'full', false, array('class' => 'img-fluid fade-in-left', 'style' => '--delay: ' . $delay . 's;', 'loading' => 'lazy')) ?>
						</li>
						<?php
					endforeach;
				endif;
				?>
			</ul>
		</div>
	</div>
</div>