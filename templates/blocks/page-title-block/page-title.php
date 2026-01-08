<?php
/**********************************************************
 *
 * File:         Page Title
 * Description:  Title block banner
 * Author:       Echo Web Solutions
 * Version:      v0.2
 * Modified:     23/05/2025
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

$acf_heading = get_field('heading_text') ?: get_the_title();
$heading = sprintf('<h1 class="text-block__heading fade-in-left">%1$s</h1>', $acf_heading);

$page_img = get_field('background_image');
?>
<div class="page-header-block block block--fullwidth">
	<div class="row g-0">
		<div class="col-12 col-lg-6 page-header-block__content">
			<?php if (function_exists('yoast_breadcrumb')) {
				yoast_breadcrumb('<div class="breadcrumbs fade-in-left">', '</div>');
			} ?>
			<?php echo $heading; ?>

			<?php
			if (function_exists('yoast_breadcrumb')) {
				$breadcrumbs = yoast_breadcrumb('<div class="breadcrumbs">', '</div>', false);

				if ($breadcrumbs) {
					// Extract links from breadcrumbs
					preg_match_all('/<a[^>]+href=["\'](.*?)["\'][^>]*>(.*?)<\/a>/', $breadcrumbs, $matches);
					$links = $matches[1];
					$labels = $matches[2];

					// If there are at least two breadcrumbs, go to the second-to-last
					if (count($links) >= 1) {
						$previous_url = $links[count($links) - 1];
						$previous_label = $labels[count($labels) - 1];
						echo '<a href="' . esc_url($previous_url) . '" class="page-back-button fade-in-left"><i class="icon-back-arrow"></i> Back to ' . esc_html($previous_label) . '</a>';
					}
				}
			}
			?>
		</div>
		<div class="col-12 col-lg-6 page-header-block__image">
			<?php echo wp_get_attachment_image($page_img, 'full', false, array('class' => 'img-fluid', 'loading' => 'eager')) ?>
		</div>
	</div>
</div>