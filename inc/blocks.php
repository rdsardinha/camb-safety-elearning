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
		'advert-cta-block',
		'page-title-block',
		'photo-gallery-block',
		'photo-divider-block',
		'faqs-block',
		'text-block',
		'text-image-block',
		'divider-block',
		'homepage-introduction-block',
		'courses-grid-block',
		'contact-us-block',
	);

	foreach ($blocks as $block) {
		register_block_type(get_stylesheet_directory() . '/templates/blocks/' . $block . '/block.json');
	}
}
