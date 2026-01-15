<?php
/**
 * Wordpress Shortcodes
 */
defined('ABSPATH') or die('No script kiddies please!');

/**
 * Current year shortcode
 *
 * Print out the current year
 */
add_shortcode('current-year', 'current_year_shortcode');
function current_year_shortcode()
{
	return date('Y');
}

/**
 * Website by Echo shortcode
 *
 * Credit Echo with creating the website
 */
add_shortcode('by-ews', 'by_ews_shortcode');
function by_ews_shortcode()
{
	return '<a class="by-ews" href="https://www.echowebsolutions.co.uk/web-design-peterborough/" target="_blank" rel="noopener">Website by <span class="visually-hidden">Echo</span> <img class="by-ews__logo" alt="Echo Logo" loading="lazy" width="30" height="10" src="' . get_stylesheet_directory_uri() . '/images/echo-logo-white.svg"></a>';
}

// /**************************************/
// /* !- Address [shortcode]        */
// /**************************************/
// add_shortcode('company-address', 'company_address_shortcode');
// function company_address_shortcode()
// {
// 	$address = get_field('options_address', 'option');
// 	$output = '<div class="address"><i class="icon-location-icon"></i><div>' . $address . '</div></div>';
// 	return $output;
// }

// /**************************************/
// /* !- Directions [shortcode]          */
// /**************************************/
// add_shortcode('get-directions', 'get_directions_shortcode');
// function get_directions_shortcode()
// {
// 	$directions = get_field('options_map_link', 'option');
// 	$output = '<p class="map-link"><a class="" href="' . $directions . '" target="_blank">Get directions</a></p>';
// 	return $output;
// }

// /**************************************/
// /* !- Opening Times [shortcode]        */
// /**************************************/
// add_shortcode('opening-times', 'opening_times_shortcode');
// function opening_times_shortcode()
// {
// 	$times = get_field('options_opening_times', 'option');
// 	$output = '<div class="opening-times"><i class="icon-opening-times"></i><div>' . $times . '</div></div>';
// 	return $output;
// }

/**************************************/
/* !- Email Address [shortcode]       */
/**************************************/

add_shortcode('email-address', 'email_address_shortcode');
function email_address_shortcode()
{
	$email_address = get_field('options_email_address', 'option') ?: '';
	$output = '<div class="global-email"><a class="" href="mailto:' . $email_address . '"><i class="icon-message"></i><span>' . $email_address . '</span></a></div>';
	return $output;
}

/**************************************/
/* !- Phone Number [shortcode]        */
/**************************************/

add_shortcode('phone-number', 'phone_number_shortcode');
function phone_number_shortcode()
{
	$phone_number = get_field('options_phone_number', 'option') ?: '';
	$output = '<div class="global-phone"><a class="" href="tel:+44' . str_replace(' ', '', $phone_number) . '"><i class="icon-phone"></i><span>' . $phone_number . '</span></a></div>';
	return $output;
}

/**************************************/
/* !- Social Media [shortcode]        */
/**************************************/
// add_shortcode('social-media', 'social_media_shortcode');
// function social_media_shortcode()
// {
// 	ob_start();

// 	get_template_part('templates/shortcodes/social-media-block', null);

// 	$output = ob_get_contents();
// 	ob_end_clean();

// 	return $output;
// }

/**************************************/
/* !- Button CTA [shortcode]        */
/**************************************/
// add_shortcode('buttons-cta', 'buttons_cta_shortcode');
// function buttons_cta_shortcode()
// {
// 	$patience_link = get_field('patience_link', 'option') ?: '#';
// 	$nhs_link = get_field('nhs_link', 'option') ?: '#';

// 	$output = '
// 	<div class="block-buttons">
// 		<a class="btn btn--primary btn--small" href="' . esc_url($patience_link) . '">Private Care</a>
// 		<!-- <a class="btn btn--nhs-blue btn--small btn--nhs-button-support" href="' . esc_url($nhs_link) . '" target="_blank">
// 			<span class="btn--nhs-button"></span>Referrals
// 		</a> -->
// 	</div>';

// 	return $output;
// }