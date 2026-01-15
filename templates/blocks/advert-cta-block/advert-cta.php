<?php
/**********************************************************
 *
 * File:         Advert CTA
 * Description:  Call to action
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     23/05/2025
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

$acf_heading = get_field('title');
$heading = $acf_heading ? sprintf('<%1$s class="text-block__heading m-0 text--white">%2$s</%1$s>', 'h3', $acf_heading) : '';

$link = get_field('link');
$theme = get_field('theme');
?>

<div class="advert-cta block block--margin fade-in-top">
	<?php echo $heading; ?>
	<div class="block-buttons align-items-center justify-content-center m-0">
		<?php if (!empty($link)) {
			echo sprintf('<a class="btn btn--%1$s" href="%2$s" target="%3$s">%4$s</a>', $theme, $link['url'], $link['target'], $link['title']);
		} ?>
	</div>
</div>