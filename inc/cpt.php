<?php
/**********************************************************
 *
 * File:         Custom Post Types
 * Description:  Register the custom post types
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

add_action('init', function () {
	// register_post_type('echo_reviews', array(
	// 	'labels' => array(
	// 		'name' => 'Reviews',
	// 		'singular_name' => 'Reviews',
	// 		'menu_name' => 'Reviews',
	// 		'all_items' => 'All Reviews',
	// 		'edit_item' => 'Edit Review',
	// 		'view_item' => 'View Review',
	// 		'view_items' => 'View Reviews',
	// 		'add_new_item' => 'Add New Review',
	// 		'new_item' => 'New Review',
	// 		'parent_item_colon' => 'Parent Review:',
	// 		'search_items' => 'Search Reviews',
	// 		'not_found' => 'No Reviews found',
	// 		'not_found_in_trash' => 'No Reviews found in the bin',
	// 		'archives' => 'Review Archives',
	// 		'attributes' => 'Review Attributes',
	// 		'insert_into_item' => 'Insert into Review',
	// 		'uploaded_to_this_item' => 'Uploaded to this Review',
	// 		'filter_items_list' => 'Filter Reviews list',
	// 		'filter_by_date' => 'Filter Reviews by date',
	// 		'items_list_navigation' => 'Reviews list navigation',
	// 		'items_list' => 'Reviews list',
	// 		'item_published' => 'Review published.',
	// 		'item_published_privately' => 'Review published privately.',
	// 		'item_reverted_to_draft' => 'Review reverted to draft.',
	// 		'item_scheduled' => 'Review scheduled.',
	// 		'item_updated' => 'Review updated.',
	// 		'item_link' => 'Review Link',
	// 		'item_link_description' => 'A link to a Review.',
	// 	),
	// 	'public' => true,
	// 	'exclude_from_search' => false,
	// 	'show_in_nav_menus' => false,
	// 	'show_in_rest' => true,
	// 	'menu_icon' => 'dashicons-star-half',
	// 	'supports' => array(
	// 		0 => 'title',
	// 		1 => 'excerpt',
	// 		2 => 'editor',
	// 		3 => 'thumbnail',
	// 	),
	// 	'has_archive' => 'reviews',
	// 	'rewrite' => array(
	// 		'slug' => 'reviews',
	// 		'with_front' => false,
	// 		'pages' => true,
	// 	),
	// 	'can_export' => false,
	// 	'delete_with_user' => false,
	// ));
});
