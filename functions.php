<?php
/**
 * Echo Theme functions and definitions
 *
 * @package EchoTheme
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

// UnderStrap's includes directory.
$echo_theme_inc_dir = 'inc';

// Array of files to include.
$echo_theme_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/cpt.php',                             // Register custom post types.
	'/wp-overrides.php',                    // Override default Wordpress functions & settings
	'/plugin-overrides.php',                // Override plugin functions & settings
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/understrap/understrap/issues/567.
	'/editor.php',                          // Load Editor functions.
	'/block-editor.php',                    // Load Block Editor functions.
	'/shortcodes.php',                      // Library of shortcodes
	'/blocks.php',                          // ACF Blocks
	'/mega_menu.php',                       // Mega Menu Shortcode
	'/learnpress-functions.php',                          // ACF Blocks
);

// Load WooCommerce functions if WooCommerce is activated.
if (class_exists('WooCommerce')) {
	$echo_theme_includes[] = '/wc-overrides.php'; // Override default WooCommerce functions & settings
	$echo_theme_includes[] = '/woocommerce.php'; // WooCommerce functions
}

// Include files.
foreach ($echo_theme_includes as $file) {
	require_once get_theme_file_path($echo_theme_inc_dir . $file);
}

/* Clickjacking protection - Add header to stop site loading in an iFrame */
add_action('send_headers', 'wc_prevent_clickjacking', 10);
function wc_prevent_clickjacking()
{
	header('X-FRAME-OPTIONS: SAMEORIGIN');
}

add_filter('wpsl_admin_marker_dir', 'custom_admin_marker_dir');

function custom_admin_marker_dir()
{

	$admin_marker_dir = get_stylesheet_directory() . '/wpsl-markers/';

	return $admin_marker_dir;
}

define('WPSL_MARKER_URI', dirname(get_bloginfo('stylesheet_url')) . '/wpsl-markers/');

// Add a new column to the Service Categories admin
add_filter('manage_edit-service_category_columns', function ($columns) {
	$new_columns = array();
	$new_columns['cb'] = $columns['cb']; // keep the checkbox
	$new_columns['thumbnail'] = 'Thumbnail'; // new column
	unset($columns['cb']); // remove original checkbox to avoid duplicates
	return array_merge($new_columns, $columns);
});

// Display the thumbnail in the new column
add_action('manage_service_category_custom_column', function ($content, $column_name, $term_id) {
	if ($column_name === 'thumbnail') {
		$image = get_field('thumbnail', 'service_category_' . $term_id);
		if ($image) {
			$content = wp_get_attachment_image($image, 'small', false, array('class' => 'img-fluid', 'loading' => 'lazy'));
		} else {
			$content = '—';
		}
	}
	return $content;
}, 10, 3);

add_filter('manage_edit-service_category_sortable_columns', function ($columns) {
	$columns['thumbnail'] = false; // not sortable, just display
	return $columns;
});

add_filter('wpseo_breadcrumb_links', function ($links) {

	global $post;

	if (is_page() && !is_front_page()) {

		$parents = get_post_ancestors($post->ID);
		if (!empty($parents)) {
			$parents = array_reverse($parents);
			$new_links = [];

			// Keep Home link (Yoast adds this first)
			$new_links[] = $links[0];

			// Add parent pages
			foreach ($parents as $parent_id) {
				$new_links[] = [
					'url' => get_permalink($parent_id),
					'text' => get_the_title($parent_id),
				];
			}

			// Add current page (last item)
			$new_links[] = end($links);

			$links = $new_links;
		}
	}

	if (is_tax('service_category')) {

		$term = get_queried_object();

		$new_links = [];
		$new_links[] = $links[0]; // Home

		// Add main Services archive
		$new_links[] = [
			'url' => get_post_type_archive_link('echo_services'),
			'text' => 'Services',
		];

		// Add parent categories (if any)
		$ancestors = get_ancestors($term->term_id, 'service_category');
		$ancestors = array_reverse($ancestors);

		foreach ($ancestors as $ancestor_id) {
			$ancestor = get_term($ancestor_id, 'service_category');
			$new_links[] = [
				'url' => get_term_link($ancestor),
				'text' => $ancestor->name,
			];
		}

		// Add current taxonomy
		$new_links[] = [
			'url' => get_term_link($term),
			'text' => $term->name,
		];

		$links = $new_links;
	}

	return $links;
});


add_filter('post_type_link', function ($post_link, $post) {
	if ($post->post_type === 'echo_services') {
		$terms = wp_get_post_terms($post->ID, 'service_category');
		if (!empty($terms) && !is_wp_error($terms)) {
			$term = $terms[0];
			$ancestors = get_ancestors($term->term_id, 'service_category');
			$ancestors = array_reverse($ancestors);

			$slug_parts = [];
			foreach ($ancestors as $ancestor) {
				$ancestor_term = get_term($ancestor, 'service_category');
				$slug_parts[] = $ancestor_term->slug;
			}
			$slug_parts[] = $term->slug;

			$taxonomy_path = implode('/', $slug_parts);
			$post_link = str_replace('%service_category%', $taxonomy_path, $post_link);
		} else {
			$post_link = str_replace('%service_category%', '', $post_link);
		}
	}
	return $post_link;
}, 10, 2);

