<?php
/**********************************************************
 *
 * File:         Blog and Event Slider
 * Description:  Blog and Event Slider
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     23/05/2025
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

$heading_size = get_field('heading_size');
$subheading_size = get_field('subheading_size');

$acf_heading = get_field('heading_text');
$heading = $acf_heading ? sprintf('<%1$s class="text-block__heading fade-in-left" style="--delay: 0.2s;">%2$s</%1$s>', $heading_size, $acf_heading) : '';

$acf_subheading = get_field('subheading');
$subheading = $acf_subheading ? sprintf('<%1$s class="text-block__subheading fade-in-left" style="--delay: 0.4s;">%2$s</%1$s>', $subheading_size, $acf_subheading) : '';

$link_1 = get_field('link_1');
$posts = get_field('blog_news_case_studies_feed') ?: array();

$loop_args = array(
	'post_type' => 'post',
	'post_status' => 'publish',
	'posts_per_page' => 6,
	'orderby' => 'date',
	'order' => 'DESC',
);

if (!empty($posts)) {
	$loop_args['post__in'] = $posts;
}

$query = new WP_Query($loop_args);

$i = 0;
?>

<div class="blog-slider-block block block--margin">
	<div class="row">
		<div class="col-12">
			<div class="text-block__header text-center">
				<?php echo $heading; ?>
				<?php if ($subheading) { ?>
					<?php echo $subheading; ?>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-12 col-md-10 col-xl-12">
			<div class="blog-carousel carousel">
				<?php if ($query->have_posts()): ?>
					<div class="blog-carousel__carousel blog">
						<?php while ($query->have_posts()):
							$query->the_post();
							$i++;
							$delay = ($i - 1) * 0.2; ?>
							<?php
							echo '<div class=" fade-in-left" "style="--delay: ' . $delay . 's;">';
							get_template_part('template-parts/partials/card/card', get_post_type());
							echo '</div>';
							?>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					</div>
				<?php endif; ?>
			</div>
			<div class="block-buttons justify-content-center">
				<?php if ($link_1) {
					echo sprintf('<a class="btn btn--secondary fade-in-bottom" href="%1$s" target="%2$s">%3$s</a>', $link_1['url'], $link_1['target'], $link_1['title']);
				} ?>
			</div>
		</div>
	</div>
</div>