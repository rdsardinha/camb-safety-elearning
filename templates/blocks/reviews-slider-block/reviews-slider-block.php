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

$heading_size = get_field('heading_size_reviews');
$subheading_size = get_field('subheading_size_reviews');

$acf_heading = get_field('heading_text_reviews');
$heading = $acf_heading ? sprintf('<%1$s class="text-block__heading text--white">%2$s</%1$s>', $heading_size, $acf_heading) : '';

$acf_subheading = get_field('subheading_reviews');
$subheading = $acf_subheading ? sprintf('<%1$s class="text-block__subheading text--white">%2$s</%1$s>', $subheading_size, $acf_subheading) : '';

$background_image = get_field('background_image');

$link_1 = get_field('link_1');
$link_2 = get_field('link_2');
$reviews = get_field('reviews') ?: array();

$loop_args = array(
	'post_type' => 'echo_reviews',
	'post_status' => 'publish',
	'posts_per_page' => 6,
	'orderby' => 'date',
	'order' => 'DESC',
);

if (!empty($reviews)) {
	$loop_args['post__in'] = $reviews;
}

$loop = new WP_Query($loop_args);

$i = 0;
?>

<div class="reviews-slider__head block block--fullwidth">
	<div class="row g-0">
		<div class="col-12 col-lg-6 reviews-slider__header">
			<div class="text-block__header fade-in-top">
				<?php echo $heading; ?>
				<?php if ($subheading) { ?>
					<?php echo $subheading; ?>
				<?php } ?>
				<i class="icon-stars"></i>
			</div>
		</div>
		<div class="col-12 col-lg-6 d-none d-lg-block reviews-slider__header__image fade-in-top">
			<?php echo wp_get_attachment_image($background_image, 'full', false, array('class' => 'img-fluid', 'loading' => 'eager')) ?>
		</div>
	</div>
</div>

<div class="reviews-slider-block block block--padded block--fullwidth block--bg-grey pt-0">
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-12 col-md-10 col-xl-12">
				<div class="reviews-carousel carousel">
					<?php if ($loop->have_posts()): ?>
						<div class="reviews-carousel__carousel reviews">
							<?php while ($loop->have_posts()):
								$loop->the_post();
								$reviwer_name = get_field('reviwer_name', get_the_ID());
								$reviwer_status = get_field('reviwer_status', get_the_ID()) ?: '';
								$rating = get_field('star_number', get_the_ID());
								$i++;
								$delay = ($i - 1) * 0.2;
								?>
								<div class="reviews-carousel__item carousel__item fade-in-left"
									style="--delay: <?php echo $delay; ?>s;">
									<div class="reviews-carousel__block">
										<div class="reviews-carousel__block-description"><?php echo get_the_content(); ?></div>
										<div class="reviews-carousel__block-content">
											<p class="reviews-carousel__block-title mb-0">
												<span class="reviews-carousel__block-name"><?php echo $reviwer_name; ?></span>
												<?php if ($reviwer_status): ?>
													|
													<span
														class="reviews-carousel__block-status"><?php echo $reviwer_status; ?></span>
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
								</div>
							<?php endwhile; ?>
							<?php wp_reset_postdata(); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="col-12">
				<div class="reviews-slider__link fade-in-bottom">
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