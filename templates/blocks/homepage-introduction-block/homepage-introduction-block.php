<?php
/**********************************************************
 *
 * File:         Text Image Block
 * Description:  Text Image Block
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     23/05/2025
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

$heading_size = get_field('heading_size_image');
$subheading_size = get_field('subheading_size_image');

$acf_heading = get_field('heading_text_image');
$heading = $acf_heading ? sprintf('<%1$s class="text-block__heading fade-in-left" style="--delay: 0.2s;">%2$s</%1$s>', $heading_size, $acf_heading) : '';

$acf_subheading = get_field('subheading_text_image');
$subheading = $acf_subheading ? sprintf('<%1$s class="text-block__subheading fade-in-left" style="--delay: 0.4s;">%2$s</%1$s>', $subheading_size, $acf_subheading) : '';

$content = get_field('content_text_image');

$acf_image = get_field('image_text_image');
$position_image = get_field('position_image_text_image');
$vertical_aligment_text_image = get_field('vertical_aligment_text_image');

$auxClass = "flex-wrap";
$auxaMargin = 'mb-0';
$auxaVertical = 'align-items-center';

if ($position_image == "right") {
	$auxClass = "flex-row-reverse";
}

if ($vertical_aligment_text_image == "top") {
	$auxaVertical = "align-items-top";
}

if ($content) {
	$auxaMargin = '';
}
?>

<div class="text-block text-image-block block block--margin">
	<div class="row justify-content-center">
		<div class="col-12 col-lg-10">
			<div class="row gx-5 <?php echo $auxaVertical . ' ' . $auxClass ?>">
				<div class="col-12 col-lg-8 order-1 order-lg-0">
					<?php if ($heading) { ?>
						<div class="text-block__header <?php $auxaMargin; ?>">
							<?php echo $heading; ?>
							<?php if ($subheading) { ?>
								<?php echo $subheading; ?>
							<?php } ?>
						</div>
					<?php } ?>
					<?php if ($content) { ?>
						<div class="fade-in-left" style="--delay: 0.6s;">
							<?php echo $content; ?>
						</div>
						<?php if (have_rows('buttons_text_image')): ?>
							<div class="block-buttons fade-in-left" style="--delay: 0.6s;">
								<?php while (have_rows('buttons_text_image')):
									the_row(); ?>
									<?php
									$link = get_sub_field('link');
									$theme = get_sub_field('theme');
									if (empty($link)) {
										break;
									}

									echo sprintf('<a class="btn btn--%1$s" href="%2$s" target="%3$s">%4$s</a>', $theme, $link['url'], $link['target'], $link['title']);

									?>
								<?php endwhile; ?>
							</div>
						<?php endif; ?>
					<?php } ?>
				</div>
				<div class="col-12 col-lg-4 order-2 order-lg-0 mt-5 mt-lg-0">
					<?php echo wp_get_attachment_image($acf_image, 'full', false, array('class' => 'homepage-introduction-block__img img-fluid fade-in-left', 'style' => '--delay: 0.8s;', 'loading' => 'lazy')) ?>
				</div>
			</div>
		</div>
	</div>

</div>