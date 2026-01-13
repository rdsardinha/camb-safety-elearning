<?php

$defaults = array(
    "data" => array()
);

$args = wp_parse_args($args, $defaults);

$data = $args['data'];

$mobile_menu_name = $data['mobile_menu_name'];

?>

<div class="echo-mega-menu menu-body postion-relative">
    <div class="menu_style_1">
        <div class="row d-block d-xl-none">
            <div class="col-12">
                <div class="text-end">
                    <button class="navbar-toggler border-0 p-0" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#navbarNavOffcanvas" aria-controls="navbarNavOffcanvas" aria-expanded="false">
                        <i class="icon-cross"></i>
                    </button>
                </div>
                <div class="offcanvas-header p-0">
                    <!-- <span class="title"><?php //echo $mobile_menu_name ?></span> -->
                    <button class="btn-close-mega p-0" type="button" data-bs-dismiss="dropdown"
                        aria-label="<?php esc_attr_e('Close menu', 'understrap'); ?>">
                        Back <i class="icon-arrow"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="row g-0 align-items-center">
            <?php
            $courses = $data['courses_menu'];
            ?>
            <div class="col-9">
                <div class="menu-content">
                    <?php if ($courses['menus_1']): ?>
                        <div class="row align-items-center">
                            <div class="col-2 d-none d-xl-block">
                                <?php echo wp_get_attachment_image($data['courses_menu']['logo'], 'full', false, array('class' => 'mega-menu-logo img-fluid', 'loading' => 'lazy')) ?>
                            </div>
                            <?php foreach ($courses['menus_1'] as $courses_menu): ?>
                                <div class="col-12 col-xl-10 header-menu">
                                    <p><?php echo esc_html($courses_menu['title']); ?></p>
                                    <?php
                                    wp_nav_menu(array(
                                        'menu' => $courses_menu['menu_to_show_courses'],
                                        'container' => false,
                                        'menu_class' => 'acf-menu',
                                        'fallback_cb' => false
                                    ));
                                    ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-3 d-none d-xl-block">
                <?php echo wp_get_attachment_image($data['courses_menu']['main_image'], 'full', false, array('class' => 'mega-menu-image img-fluid', 'loading' => 'lazy')) ?>
            </div>
        </div>
    </div>
</div>

<script>
    jQuery(".btn-close-mega").click(function () {
        jQuery('.offcanvas-body .echo-menu-shortcode').removeClass("show");
    });
</script>