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
                    height: 300px;
                    display: flex;
                    align-items: center;
                }
            </style>
        <?php endif;
    }
});

/* Change Breadcrumb Location */
add_action('learn-press/course-content-summary', 'learn_press_breadcrumb', 20);

/* Add custom icon to Lessons */
add_filter(
    'learn-press/course/html-course-item',
    function ($components, $courseModel, $userModel, $item, $section_item) {

        if (empty($item->item_id)) {
            return $components;
        }

        $acf_icon = get_field('lesson_icon', $item->item_id);

        if (!$acf_icon) {
            return $components;
        }

        // Override the icon HTML
        $components['icon'] = sprintf(
            '<span class="course-item-ico icon-%s"></span>',
            esc_attr($acf_icon)
        );

        return $components;
    },
    10,
    5
);

/* Lesson Materials */
add_shortcode('lesson_materials', function () {

    global $post;
    if (!$post)
        return '';

    if (!class_exists('LP_Lesson') || !class_exists('LP_Material_Files_DB')) {
        return '';
    }

    $lesson = LP_Lesson::get_lesson($post->ID);
    if (!$lesson)
        return '';

    $course = $lesson->get_course();
    if (!$course)
        return '';

    $course_id = $course->get_id();
    $lesson_id = $lesson->get_id();

    $material_db = LP_Material_Files_DB::getInstance();

    $lesson_materials = $material_db->get_material_by_item_id($lesson_id, -1, 0, false);
    $course_materials = $material_db->get_material_by_item_id($course_id, -1, 0, false);

    /**
     * 1. Merge + deduplicate materials
     */
    $unique = [];

    foreach (array_merge($course_materials, $lesson_materials) as $m) {
        $key = $m->material_id ?? md5($m->file_path);
        $unique[$key] = $m;
    }

    if (empty($unique))
        return '';

    /**
     * 2. Group by item_id
     */
    $grouped = [];
    foreach ($unique as $m) {
        $grouped[$m->item_id][] = $m;
    }

    /**
     * 3. Alphabetically sort accordion sections
     */
    uksort($grouped, function ($a, $b) {
        return strcasecmp(
            get_the_title($a),
            get_the_title($b)
        );
    });

    /**
     * 4. Output
     */
    $html = "<h3 class='text-block__heading mt-5'>Lesson Materials</h3>";

    foreach ($grouped as $item_id => $materials) {
        $item_title = get_the_title($item_id);

        $acf_icon = get_field('lesson_icon', $item_id);
        if ($acf_icon) {
            $item_title =
                '<span class="course-item-ico icon-' . esc_attr($acf_icon) . '"></span> ' .
                esc_html($item_title);
        } else {
            $item_title = esc_html($item_title);
        }

        $html .= "<details class='accordion__item__materials'>";
        $html .= "<summary class='accordion accordion__question'>{$item_title}</summary>";
        $html .= "<div class='accordion__answer'>";

        foreach ($materials as $m) {
            $file_name = esc_html($m->file_name ?: '');
            $file_url = esc_url($m->file_path ?: '');

            $html .= "<p>{$file_name} - <a href='{$file_url}' target='_blank'>Open/Download</a></p>";
        }

        $html .= "</div></details>";
    }

    return $html;
});


/* Enhance materials */
add_action('wp_ajax_lp_save_material_progress', function () {
    check_ajax_referer('lp_material_progress', 'nonce');

    if (!is_user_logged_in())
        wp_send_json_error();

    $user_id = get_current_user_id();
    $lesson_id = absint($_POST['lesson_id']);
    $progress = json_decode(stripslashes($_POST['progress']), true);

    $all = get_user_meta($user_id, 'lp_material_progress', true);
    if (!is_array($all))
        $all = [];

    $all[$lesson_id] = $progress;

    update_user_meta($user_id, 'lp_material_progress', $all);

    wp_send_json_success();
});

add_action('wp_ajax_lp_get_material_progress', function () {
    check_ajax_referer('lp_material_progress', 'nonce');

    if (!is_user_logged_in())
        wp_send_json_error();

    $user_id = get_current_user_id();
    $lesson_id = absint($_POST['lesson_id']);

    $all = get_user_meta($user_id, 'lp_material_progress', true);
    $lesson = $all[$lesson_id] ?: [];

    wp_send_json_success($lesson);
});

