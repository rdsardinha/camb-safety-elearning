<?php

$title_blog = get_field('title_reviews', 'options');
$heading = sprintf('<h1 class="text-block__heading fade-in-left" style="--delay: 0.2s;">%1$s</h1>', $title_blog);

$main_image = get_field('main_image_reviews', 'options');
$introduction_text = get_field('introduction_text_reviews', 'options');
$content_area_title = get_field('content_area_title_reviews', 'options') ?: 'Latest reviews';
?>

<div class="page-header-block block block--fullwidth">
	<div class="row g-0">
		<div class="col-12 col-lg-6 page-header-block__content">
			<?php if (function_exists('yoast_breadcrumb')) {
				yoast_breadcrumb('<div class="breadcrumbs fade-in-left" style="--delay: 0.3s;">', '</div>');
			} ?>
			<?php echo $heading; ?>

			<?php
			if (function_exists('yoast_breadcrumb')) {
				$breadcrumbs = yoast_breadcrumb('<div id="breadcrumbs">', '</div>', false);

				if ($breadcrumbs) {
					// Extract links from breadcrumbs
					preg_match_all('/<a[^>]+href=["\'](.*?)["\'][^>]*>(.*?)<\/a>/', $breadcrumbs, $matches);
					$links = $matches[1];
					$labels = $matches[2];

					// If there are at least two breadcrumbs, go to the second-to-last
					if (count($links) >= 1) {
						$previous_url = $links[count($links) - 1];
						$previous_label = $labels[count($labels) - 1];
						echo '<a href="' . esc_url($previous_url) . '" class="page-back-button fade-in-left" style="--delay: 0.4s;"><i class="icon-back-arrow"></i> Back to ' . esc_html($previous_label) . '</a>';
					}
				}
			}
			?>
		</div>
		<div class="col-12 col-lg-6 page-header-block__image">
			<?php echo wp_get_attachment_image($main_image, 'full', false, array('class' => 'img-fluid', 'loading' => 'eager')) ?>
		</div>
	</div>
</div>

<?php if ($introduction_text) { ?>
	<div class="page-introduction-block block block--fullwidth block--padded-md">
		<div class="container-fluid">
			<div class="row justify-content-center">
				<div class="col-12 fade-in-left" style="--delay: 0.5s;">
					<?php echo $introduction_text; ?>
				</div>
			</div>
		</div>
	</div>
<?php } ?>

<div class="text-block block block--margin-md mb-3 fade-in-left" style="--delay: 0.2s;">
	<div class="container-fluid">
		<div class="row align-items-center">
			<div class="col-12">
				<h2 class="blog-heading text-block__heading mb-0"><?php echo $content_area_title ?></h2>
			</div>
			<!-- <div class="col-12 col-xl-6">
				<div class="sort-search-filters">
					<?php
					// echo do_shortcode('[facetwp facet="blog_category_sort"]');
					// echo do_shortcode('[facetwp facet="blog_search"]');
					?>
				</div>
			</div> -->
			<div class="col-12 d-none d-md-block">
				<hr class="separator separator--primary">
			</div>
		</div>
	</div>
</div>