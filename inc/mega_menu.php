<?php

/**
 * Add a shortcode field
 */

function echo_menu_item_desc($item_id, $item, $depth)
{
    if ($depth !== 0) {
        return;
    }
    $menu_item_desc = get_post_meta($item_id, '_menu_item_html', true);
    ?>
    <div style="clear: both;">
        <span class="description"><?php _e("Custom HTML / shortcode", 'menu-item-desc'); ?></span><br />
        <input type="hidden" class="nav-menu-id" value="<?php echo $item_id; ?>" />
        <div class="logged-input-holder">
            <input type="text" class="widefat" name="menu_item_desc[<?php echo $item_id; ?>]"
                id="menu-item-desc-<?php echo $item_id; ?>" value="<?php echo esc_attr($menu_item_desc); ?>" />
        </div>
    </div>
    <?php
}

add_action('wp_nav_menu_item_custom_fields', 'echo_menu_item_desc', 10, 3);

/**
 * Save the shortcode 
 */

function echo_save_menu_item_html($menu_id, $menu_item_db_id)
{
    if (isset($_POST['menu_item_desc'][$menu_item_db_id])) {
        $sanitized_data = sanitize_text_field($_POST['menu_item_desc'][$menu_item_db_id]);
        update_post_meta($menu_item_db_id, '_menu_item_html', $sanitized_data);
    } else {
        delete_post_meta($menu_item_db_id, '_menu_item_html');
    }
}

add_action('wp_update_nav_menu_item', 'echo_save_menu_item_html', 10, 2);

/**
 * Add class on nav item if it has a shortcode
 */
function echo_nav_menu_css_class($atts, $menu_item, $args, $depth)
{

    if (!get_post_meta($menu_item->ID, '_menu_item_html', true)) {
        return $atts;
    }

    $atts['data-toggle'] = 'dropdown';
    $atts['data-bs-toggle'] = 'dropdown';
    $atts['data-bs-auto-close'] = 'outside';
    $atts['aria-haspopup'] = 'true';
    $atts['aria-expanded'] = 'false';


    return $atts;
}

add_filter('nav_menu_link_attributes', 'echo_nav_menu_css_class', 10, 4);

/**
 * Output the shortcode right after the closing <a> tag
 */

function echo_add_menu_popup($item_output, $item)
{

    if (!get_post_meta($item->ID, '_menu_item_html', true)) {
        return $item_output;
    }

    $popup = '<div class="dropdown-menu drop-slide-in echo-menu-shortcode w-100">';
    $popup .= do_shortcode(get_post_meta($item->ID, '_menu_item_html', true));
    $popup .= '</div>';

    return $item_output . $popup;

}

add_filter('walker_nav_menu_start_el', 'echo_add_menu_popup', 15, 2);

/**
 * Render mega menu shortcodes
 * Requires ACF Pro
 */

add_shortcode('echo_mega_menu', 'echo_mega_menu');

function echo_mega_menu($atts, $html = false)
{
    $attributes = shortcode_atts(array(
        'id' => false,
    ), $atts);

    if (!$attributes['id']) {
        return "Invalid repeater ID";
    }

    $repeater_id = (int) $attributes['id'];

    if (!$repeater_id) {
        return "Please provide a valid repeater ID";
    }

    ob_start();


    $items = get_field('theme_mega_menus', 'options');

    if (isset($items[$repeater_id - 1])) {
        get_template_part('templates/blocks/mega-menu-block/mega', 'menu', array("data" => $items[$repeater_id - 1]));
    } else {
        echo "Repater with ID \"$repeater_id\" could not be found";
    }

    return ob_get_clean();
}

