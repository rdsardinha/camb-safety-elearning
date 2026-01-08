<?php
/**********************************************************
 *
 * File:         Logo slider
 * Description:  Logo slider
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     23/05/2025
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

$heading_size = get_field('heading_size');
$subheading_size = get_field('subheading_size');

$acf_heading = get_field('heading_logo');
$heading = $acf_heading ? sprintf('<%1$s class="text-block__heading">%2$s</%1$s>', $heading_size, $acf_heading) : '';

$acf_subheading = get_field('description_logo');
$subheading = $acf_subheading ? sprintf('<%1$s class="text-block__subheading">%2$s</%1$s>', $subheading_size, $acf_subheading) : '';

$images = get_field('logos');
$i = 0;
?>

<div class="logo-block block block--margin">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<?php if ($heading) { ?>
					<div class="text-block__header text-center fade-in-top">
						<?php echo $heading; ?>
						<?php if ($subheading) { ?>
							<?php echo $subheading; ?>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
			<div class="col-12 logo-carousel">
				<?php if ($images) { ?>
					<div class="logo-carousel__carousel">
						<?php foreach ($images as $image):
							$i++;
							$delay = ($i - 1) * 0.1; ?>
							<div class="logo-carousel__item carousel__item fade-in-left" style="--delay: <?php echo $delay; ?>s;">
								<?php echo wp_get_attachment_image($image, 'full', false, array('class' => 'logo-img img-fluid', 'loading' => 'lazy')) ?>
							</div>
						<?php endforeach; ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>