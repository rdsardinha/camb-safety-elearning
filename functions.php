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

/* Prevent link sharing work */
add_action('init', function () {

    // Rewrite rule for /media/{filename}
    add_rewrite_rule(
        '^media/([^/]+)$',
        'index.php?secure_media_slug=$matches[1]',
        'top'
    );

});

add_filter('query_vars', function ($vars) {
    $vars[] = 'secure_media_slug';
    return $vars;
});

add_action('template_redirect', function () {

    $slug = get_query_var('secure_media_slug');
    if (!$slug)
        return;

    if (!is_user_logged_in()) {
        $redirect = home_url('/my-account/?redirect_to=' . urlencode($_SERVER['REQUEST_URI']));
        wp_safe_redirect($redirect);
        exit;
    }

    // Find attachment by filename (without path)
    global $wpdb;
    $attachment_id = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT ID FROM $wpdb->posts WHERE post_type='attachment' AND guid LIKE %s LIMIT 1",
            '%' . $wpdb->esc_like($slug)
        )
    );

    if (!$attachment_id) {
        wp_die('File not found', 'Error', ['response' => 404]);
    }

    $file = get_attached_file($attachment_id);

    if (!$file || !file_exists($file)) {
        wp_die('File not found', 'Error', ['response' => 404]);
    }

    $allowed_mimes = [
        'application/pdf' => 'inline',
        'application/msword' => 'attachment',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'attachment',
    ];

    $mime = get_post_mime_type($attachment_id);

    if (!isset($allowed_mimes[$mime])) {
        wp_die('File type not allowed', 'Error', ['response' => 403]);
    }

    $filename = basename($file);

    header('Content-Type: ' . $mime);
    header('Content-Disposition: ' . $allowed_mimes[$mime] . '; filename="' . $filename . '"');
    header('Content-Length: ' . filesize($file));
    header('Cache-Control: private, no-store');

    readfile($file);
    exit;

});

add_filter('wp_get_attachment_url', function ($url, $attachment_id) {

    $allowed_mimes = [
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    ];

    if (!in_array(get_post_mime_type($attachment_id), $allowed_mimes, true)) {
        return $url;
    }

    $filename = basename(get_attached_file($attachment_id));
    return home_url('/media/' . $filename);

}, 10, 2);
