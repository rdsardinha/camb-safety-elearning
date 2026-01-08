<?php
/**********************************************************
 *
 * File:         Blocks
 * Description:  ACF blocks function call
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     23/01/24
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

// register blocks
add_action('init', 'register_acf_blocks');
function register_acf_blocks()
{
	$blocks = array(
		'homepage-banner-block',
		'store-locator-block',
		'usp-block',
		'advert-cta-block',
		'page-title-block',
		'photo-gallery-block',
		'advert-feature-block',
		'photo-divider-block',
		'faqs-block',
		'text-block',
		'text-image-block',
		'reviews-slider-block',
		'reviews-one-column-block',
		'contact-us-block',
		'blog-slider-feed-block',
		'logo-block',
		'careers-block',
		'divider-block',
		'patients-block',
		'services-block',
		'page-introduction-block',
		'resources-download-block',
		'team-member-block',
		'map-location-block',
		'tabs-block',
	);

	foreach ($blocks as $block) {
		register_block_type(get_stylesheet_directory() . '/templates/blocks/' . $block . '/block.json');
	}
}
