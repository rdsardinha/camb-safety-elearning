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

global $wp_query;
$total_posts = $wp_query->found_posts;
?>

<?php
get_template_part('template-parts/partials/header/header-archive', get_post_type());
?>
<div class="container-fluid blog-archieve__container">
	<div class="row justify-content-center">
		<div class="col-12">
			<div class="row g-5">
				<?php
				if (have_posts()) {				
					while (have_posts()):
						the_post();
						echo '<div class="col-12 col-md-6 col-lg-4">';
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
		<div class="blog-pagination block--margin-md mt-4">
			<?php if ($total_posts > 3): ?>
			<div class="row justify-content-center">
				<div class="col-12">
					<hr class="separator separator--primary separator--thick">
				</div>
				<div class="col-12">
					 <?php echo do_shortcode('[facetwp facet="pagination"]'); ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</div>

<?php
get_footer();
