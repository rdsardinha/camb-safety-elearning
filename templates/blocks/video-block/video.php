<?php
/**********************************************************
 *
 * File:         Page Title
 * Description:  Title block banner
 * Author:       Echo Web Solutions
 * Version:      v0.2
 * Modified:     11/06/2024
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

$iframe = get_field('video');
$description = get_field('description') ?: '';

if ($iframe) {
    // Use preg_match to find iframe src.
    preg_match('/src="(.+?)"/', $iframe, $matches);
    $src = $matches[1];

    // Add extra parameters to src and replace HTML.
    $params = array(
        'controls' => 1,
        'hd' => 1,
        'autohide' => 1
    );
    $new_src = add_query_arg($params, $src);
    $iframe = str_replace($src, $new_src, $iframe);

    // Add extra attributes to iframe HTML.
    $attributes = 'frameborder="0"';
    $iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);
}


?>
<div class="video-block block--margin">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="text-center fade-in-left">
                <?php echo $description; ?>
            </div>
            <?php if ($iframe) { ?>
                <div class="video-container fade-in-bottom">
                    <?php echo $iframe; ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>