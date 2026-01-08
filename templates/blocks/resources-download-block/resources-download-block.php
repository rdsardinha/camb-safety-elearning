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
$subheading = $acf_subheading ? sprintf('<%1$s class="text-block__subheading fade-in-left" style="--delay: 0.2s;">%2$s</%1$s>', $subheading_size, $acf_subheading) : '';

$i = 0;
?>


<div class="resources-block block block--margin">
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
			<div class="resources_block">
				<?php while (have_rows('resources')):
					the_row('resources');
					$i++;
					$delay = ($i - 1) * 0.2; ?>
					<div class="resource_block__item fade-in-left" style="--delay: <?php echo $delay; ?>s;">
						<div class="resource_title">
							<h4><?php echo get_sub_field('title'); ?></h4>
							<?php echo wpautop(get_sub_field('content')); ?>
						</div>
						<div>
							<?php
							$link = get_sub_field('link');
							$theme = get_sub_field('theme');
							$size = get_sub_field('size');
							if (empty($link)) {
								break;
							}

							echo sprintf('<a class="btn btn--%1$s btn--%5$s" href="%2$s" target="%3$s">%4$s</a>', $theme, $link['url'], $link['target'], $link['title'], $size);

							?>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
</div>