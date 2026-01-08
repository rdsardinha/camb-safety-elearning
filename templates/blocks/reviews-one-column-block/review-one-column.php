<?php
/**********************************************************
 *
 * File:         Reviews Slider
 * Description:  Reviews slider
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     23/05/2025
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

$link_1 = get_field('link_1');
$link_2 = get_field('link_2');
$review_one_column = get_field('review_one_column') ?: array();

$loop_args = array(
	'post_type' => 'echo_reviews',
	'post_status' => 'publish',
	'posts_per_page' => -1,
	'post__in' => $review_one_column,
);

$loop = new WP_Query($loop_args);

?>

<?php if ($loop->have_posts()): ?>
	<div class="reviews-slider-block reviews-one-column block block--padded block--fullwidth block--bg-grey">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 fade-in-right">
					<?php while ($loop->have_posts()):
						$loop->the_post();
						$reviwer_name = get_field('reviwer_name', get_the_ID());
						$reviwer_status = get_field('reviwer_status', get_the_ID());
						$rating = get_field('star_number', get_the_ID());
						?>

						<div class="reviews-carousel__block">
							<div class="reviews-carousel__block-description"><?php echo get_the_content(); ?></div>
							<div class="reviews-carousel__block-content">
								<p class="reviews-carousel__block-title mb-0">
									<span class="reviews-carousel__block-name"><?php echo $reviwer_name; ?></span>
									<?php if ($reviwer_status): ?>
										|
										<span class="reviews-carousel__block-status"><?php echo $reviwer_status; ?></span>
									<?php endif; ?>
								</p>
								<span class="reviews-carousel__block-stars">
									<?php if ($rating == 4) {
										for ($k = 0; $k < $rating; $k++) { ?>
											<i class="icon-star"></i>
										<?php } ?>
										<i class="icon-star grey-out"></i>
									<?php } else {
										for ($k = 0; $k < $rating; $k++) { ?>
											<i class="icon-star"></i>
										<?php }
									} ?>
								</span>
							</div>
						</div>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				</div>
				<div class="col-12">
					<div class="reviews-slider__link">
						<div class="block-buttons justify-content-center">
							<?php if ($link_1) {
								echo sprintf('<a class="btn btn--primary" href="%1$s" target="%2$s">%3$s</a>', $link_1['url'], $link_1['target'], $link_1['title']);
							} ?>
							<?php if ($link_2) {
								echo sprintf('<a class="btn btn--secondary" href="%1$s" target="%2$s">%3$s</a>', $link_2['url'], $link_2['target'], $link_2['title']);
							} ?>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>