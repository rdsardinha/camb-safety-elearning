<?php
/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$leave_review_button = get_field('leave_review_button', 'options') ?: '#';
?>

<?php
get_template_part('template-parts/partials/header/header-archive', get_post_type());
?>
<div class="container-fluid blog-archieve__container">
	<div class="row justify-content-center">
		<div class="col-12">
			<div class="row g-4">
				<?php
				if (have_posts()) {
					$i = 0;
					while (have_posts()):
						the_post();
						$i++;
						$delay = ($i - 1) * 0.2;
						echo '<div class="col-12 col-md-6 col-lg-4 fade-in-left" style="--delay: ' . $delay . 's;">';
						get_template_part('template-parts/partials/card/card', get_post_type());
						echo '</div>';

					endwhile;
					wp_reset_postdata();
				} else { ?>
					<div class="col-12 blog-search block--margin">
						<?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.'); ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php if (have_posts()): ?>
		<div class="reviews-pagination block--margin-md">
			<div class="row justify-content-between">
				<div class="col-12 reviews-pagination__pagination">
					<?php echo do_shortcode('[facetwp facet="pagination"]'); ?>
				</div>

				<!-- <div class="col-12 col-lg-3 text-lg-end">
					<a href="<?php echo $leave_review_button ?>" target="_blank" class="btn btn--primary btn--small">Leave a review</a>
				</div> -->
			</div>
		</div>
	<?php endif; ?>
</div>

<?php
get_footer();
