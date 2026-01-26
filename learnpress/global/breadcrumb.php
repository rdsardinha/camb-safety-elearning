<?php
/**
 * Template for displaying archive courses breadcrumb.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/global/breadcrumb.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.1
 */

defined('ABSPATH') || exit();

// Prevent default breadcrumb location on single course pages
if (function_exists('learn_press_is_course') && learn_press_is_course()) {

	// Only allow breadcrumb when explicitly hooked
	if (!doing_action('learn-press/course-content-summary')) {
		return;
	}
}

// Remove course category from breadcrumb
if (!empty($breadcrumb) && is_array($breadcrumb)) {

	foreach ($breadcrumb as $key => $crumb) {
		if (!empty($crumb[1]) && strpos($crumb[1], 'course-category') !== false) {
			unset($breadcrumb[$key]);
		}
	}

	$breadcrumb = array_values($breadcrumb);
}

if (empty($breadcrumb)) {
	return;
}
echo wp_kses_post($wrap_before);

foreach ($breadcrumb as $key => $crumb) {

	echo wp_kses_post($before);

	echo '<li>';

	if (!empty($crumb[1]) && sizeof($breadcrumb) !== $key + 1) {
		echo '<a href="' . esc_url_raw($crumb[1]) . '"><span>' . esc_html($crumb[0]) . '</span></a>';
	} else {
		if (isset($_GET['c_search'])) {
			$text = sprintf(
				'%s %s',
				__('Search results for: ', 'learnpress'),
				esc_html($_GET['c_search'])
			);
			echo '<span>' . esc_html($text) . '</span>';
		} else {
			echo '<span>' . esc_html($crumb[0]) . '</span>';
		}
	}

	echo '</li>';

	echo wp_kses_post($after);

	if (sizeof($breadcrumb) !== $key + 1) {
		echo wp_kses_post($delimiter);
	}
}

echo wp_kses_post($wrap_after);
