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
$heading = $acf_heading ? sprintf('<%1$s class="text-block__heading fade-in-left" style="--delay: 0.2s;">%2$s</%1$s>', $heading_size, $acf_heading) : '';

$acf_subheading = get_field('subheading_text_faq');
$subheading = $acf_subheading ? sprintf('<%1$s class="text-block__subheading fade-in-left" style="--delay: 0.4s;">%2$s</%1$s>', $subheading_size, $acf_subheading) : '';

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
	$auxCol = 'col-12 col-lg-8 order-1 order-lg-0';
}

$i = 1;
?>


<div class="accordion-block block block--margin">
	<div class="row gx-5 justify-content-center <?php echo $auxaVertical . ' ' . $auxClass ?>">
		<?php if ($image) { ?>
			<div class="col-12 col-lg-4 order-2 order-lg-0 mt-5 mt-lg-0">
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
			<div class="faq">
				<?php while (have_rows('questions')):
					the_row('questions');
					$i++;
					$delay = ($i - 1) * 0.2; ?>
					<details id="faq-id-<?php echo $i ?>" class="accordion__item fade-in-left"
						style="--delay: <?php echo $delay; ?>s;">
						<summary class="accordion accordion__question">
							<?php echo get_sub_field('question'); ?>
						</summary>
						<div class="accordion__answer">
							<?php echo wpautop(get_sub_field('answer')); ?>
						</div>
					</details>
					<?php $i++;
				endwhile; ?>
			</div>
			<?php if (have_rows('buttons')): ?>
				<div class="block-buttons">
					<?php while (have_rows('buttons')):
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
		</div>
	</div>

	<?php if (have_rows('questions')): ?>
		<?php
		$count = get_field('questions');
		$i = 1;
		?>
		<script type="application/ld+json">
							{
								"@context": "https://schema.org",
								"@type": "FAQPage",
								"mainEntity": [
									<?php while (have_rows('questions')):
										the_row('questions'); ?>
																			{
																				"@type": "Question",
																				"name": "<?php echo get_sub_field('question'); ?>",
																					"acceptedAnswer": {
																					"@type": "Answer",
																					"text": "<?php echo esc_attr(wp_strip_all_tags(get_sub_field('answer'))); ?>"
																				}
																			}
																			<?php if ($i < count($count)) {
																				echo ',';
																				$i++;
																			} ?>
									<?php endwhile; ?>
								]
							}
						</script>
	<?php endif; ?>
</div>