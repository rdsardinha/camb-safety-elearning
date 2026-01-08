<?php
$defaults = array(
	"ID" => get_the_ID(),
	"image" => get_the_post_thumbnail_url(null, 'full'),
	"title" => get_the_title(),
	"excerpt" => get_the_excerpt(),
	"content" => get_the_content(),
	"button" => array(
		"title" => "Read Article",
		"target" => "_self",
		"url" => get_the_permalink()
	),
	"author" => array(
		"ID" => get_the_author_meta('ID'),
		"name" => get_the_author_meta("display_name")
	),
	"date" => get_the_date("d M Y")
);

$args = wp_parse_args($args, $defaults);

$heading = sprintf('<h1 class="text-block__heading fade-in-left" style="--delay: 0.2s;">%1$s</h1>', $args['title']);
$card_img = get_post_thumbnail_id($args['ID']) ?: $main_image = get_field('main_image', 'options');
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
			<?php echo wp_get_attachment_image($card_img, 'full', false, array('class' => 'img-fluid', 'loading' => 'eager')) ?>
		</div>
	</div>
</div>