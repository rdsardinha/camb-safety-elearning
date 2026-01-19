<?php

defined('ABSPATH') || exit;

add_filter(
    'learn-press/override-templates',
    function () {
        return true;
    }
);

add_filter('body_class', function ($classes) {

    if (is_singular('lp_course')) {
        $bg = get_field('courses_background_image');
        if ($bg) {
            $classes[] = 'lp-has-custom-header';
        }
    }

    return $classes;
});

add_action('wp_head', function () {

    if (function_exists('learn_press_is_course') && learn_press_is_course()) {

        $bg = get_field('courses_background_image', get_queried_object_id());

        if ($bg): ?>
            <style>
                body.lp-has-custom-header .course-detail-info {
                    background-image: url('<?php echo esc_url($bg); ?>');
                    background-size: cover;
                    background-position: center;
                    background-repeat: no-repeat;
                }
            </style>
        <?php endif;
    }

});

