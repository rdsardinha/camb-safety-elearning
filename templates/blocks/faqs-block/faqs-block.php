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

$i = 1; 
?>


<div class="accordion-block block block--margin">
	<div class="row justify-content-center">
		<div class="col-12">
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
					$delay = ($i - 1) * 0.2;?>
					<details id="faq-id-<?php echo $i ?>" class="accordion__item fade-in-left" style="--delay: <?php echo $delay; ?>s;">
						<summary class="accordion accordion__question">
							<?php echo get_sub_field('question'); ?>
						</summary>
						<div class="accordion__answer">
							<?php echo wpautop(get_sub_field('answer')); ?>

							<?php if (have_rows('buttons')): ?>
								<div class="block-buttons">
									<?php while (have_rows('buttons')):
										the_row(); ?>
										<?php
										$link = get_sub_field('link');
										$theme = get_sub_field('theme');
										$size = get_sub_field('size');
										if (empty($link)) {
											break;
										}

										echo sprintf('<a class="btn btn--%1$s btn--%5$s" href="%2$s" target="%3$s">%4$s</a>', $theme, $link['url'], $link['target'], $link['title'], $size);

										?>
									<?php endwhile; ?>
								</div>
							<?php endif; ?>
						</div>
					</details>
					<?php $i++;
				endwhile; ?>
			</div>
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