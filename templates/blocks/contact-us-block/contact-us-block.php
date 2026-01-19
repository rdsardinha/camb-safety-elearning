<?php
/**********************************************************
 *
 * File:         FAQ Accordion
 * Description:  FAQ Accordion
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     23/05/2025
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

$heading_size = get_field('heading_size_faq');
$subheading_size = get_field('subheading_size_faq');

$acf_heading = get_field('heading_text_faq');
$heading = $acf_heading ? sprintf('<%1$s class="text-block__heading fade-in-left text--primary" style="--delay: 0.2s;">%2$s</%1$s>', $heading_size, $acf_heading) : '';

$acf_subheading = get_field('subheading_text_faq');
$subheading = $acf_subheading ? sprintf('<%1$s class="text-block__subheading fade-in-left text--primary" style="--delay: 0.4s;">%2$s</%1$s>', $subheading_size, $acf_subheading) : '';

$position_image = get_field('position_image_text_image');
$vertical_aligment_text_image = get_field('vertical_aligment_text_image');

$image = '';
$auxCol = 'col-10';

$auxClass = "flex-wrap";
$auxaVertical = 'align-items-center';

if ($position_image == "right") {
	$auxClass = "flex-row-reverse";
}

if ($vertical_aligment_text_image == "top") {
	$auxaVertical = "align-items-top";
}

if (get_field('add_image') && $image = get_field('image_faq')) {
	$image = get_field('image_faq');
	$auxCol = 'col-11 col-lg-6 order-1 order-lg-0';
}

$i = 1;
?>


<div class="contact-us-block block block--padded block--fullwidth">
	<div class="row gx-5 justify-content-center <?php echo $auxaVertical . ' ' . $auxClass ?>">
		<?php if ($image) { ?>
			<div class="col-11 col-lg-4 order-2 order-lg-0 mt-5 mt-lg-0">
				<?php echo wp_get_attachment_image($image, 'full', false, array('class' => 'img-fluid fade-in-left', 'style' => '--delay: 0.2s;', 'loading' => 'lazy')) ?>
			</div>
		<?php } ?>
		<div class="<?php echo $auxCol ?>">
			<?php if ($heading) { ?>
				<div class="text-block__header">
					<?php echo $heading; ?>
					<?php if ($subheading) { ?>
						<?php echo $subheading; ?>
					<?php } ?>
				</div>
			<?php } ?>
			<div class="contact-line">
				<?php while (have_rows('contact_information')):
					the_row('contact_information');
					$i++;
					$delay = ($i - 1) * 0.2;

					$icon = get_sub_field('icon');
					$content = get_sub_field('contact_line'); ?>

					<div class="contact-line__item fade-in-left" style="--delay: <?php echo $delay; ?>s;">
						<div class="icon">
							<i class="icon-<?php echo $icon; ?>"></i>
						</div>
						<div>
							<?php echo $content; ?>
						</div>
					</div>

					<?php $i++;
				endwhile; ?>
			</div>
		</div>
	</div>
</div>