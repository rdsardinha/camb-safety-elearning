<?php
/**
 * The template for Services Categories
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$term = get_queried_object();

$heading = sprintf('<h1 class="text-block__heading fade-in-left" style="--delay: 0.2s;">%1$s</h1>', $term->name);
$page_img = get_field('main_image', $term) ?: 999;
$introduction_text = term_description($term->term_id, 'service_category');
$alternative_heading = get_field('alternative_heading', $term) ?: $term->name;
$image_last_block = get_field('image_last_block', $term) ?: 998;

$cta_message = get_field('cta_message', $term);

$page_content = get_field('page_content', $term);

if ($page_content) {
    $category_content = apply_filters('the_content', $page_content->post_content);
}

?>

<div class="page-header-block block block--fullwidth">
    <div class="row g-0">
        <div class="col-12 col-lg-6 page-header-block__content">
            <?php if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<div class="breadcrumbs fade-in-left" style="--delay: 0.3s;">', '</div>');
            } ?>
            <?php echo $heading; ?>

            <?php
            if (function_exists('yoast_breadcrumb')) {
                $breadcrumbs = yoast_breadcrumb('<div id="breadcrumbs">', '</div>', false);

                if ($breadcrumbs) {
                    // Extract links from breadcrumbs
                    preg_match_all('/<a[^>]+href=["\'](.*?)["\'][^>]*>(.*?)<\/a>/', $breadcrumbs, $matches);
                    $links = $matches[1];
                    $labels = $matches[2];

                    // If there are at least two breadcrumbs, go to the second-to-last
                    if (count($links) >= 1) {
                        $previous_url = $links[count($links) - 1];
                        $previous_label = $labels[count($labels) - 1];
                        echo '<a href="' . esc_url($previous_url) . '" class="page-back-button fade-in-left" style="--delay: 0.4s;"><i class="icon-back-arrow"></i> Back to ' . esc_html($previous_label) . '</a>';
                    }
                }
            }
            ?>
        </div>
        <div class="col-12 col-lg-6 page-header-block__image">
            <?php echo wp_get_attachment_image($page_img, 'full', false, array('class' => 'img-fluid', 'loading' => 'eager')) ?>
        </div>
    </div>
</div>

<?php if ($introduction_text) { ?>
    <div class="page-introduction-block block block--fullwidth block--padded-md">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 fade-in-left" style="--delay: 0.5s;">
                    <?php echo $introduction_text; ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


<?php if ($page_content) { ?>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <?php echo $category_content; ?>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($term->parent == 0) {
    $child_terms = get_terms([
        'taxonomy' => 'service_category',
        'parent' => $term->term_id,
        'hide_empty' => false,
    ]);

    $columns_per_row = 3;
    $total_terms = count($child_terms);
    $remainder = $total_terms % $columns_per_row;

    $i = 0;

    if ($child_terms && !is_wp_error($child_terms)) { ?>
        <div class="sercive-category-archieve__container">
            <div class="row justify-content-center">
                <div class="col-12">

                    <div class="text-block block block--margin-md mb-3">
                        <div class="container-fluid">
                            <div class="row align-items-center">
                                <div class="col-12 col-xl-6">
                                    <h2 class="blog-heading text-block__heading mb-0  fade-in-left" style="--delay: 0.2s;">
                                        <?php echo $alternative_heading; ?>
                                    </h2>
                                </div>
                                <!-- <div class="col-12 col-xl-6">
                                    <div class="sort-search-filters">
                                        <?php //echo do_shortcode('[facetwp facet="services_search"]'); ?>
                                    </div>
                                </div> -->
                                <div class="col-12 d-none d-md-block">
                                    <hr class="separator separator--primary">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div>
                        <?php //echo do_shortcode('[facetwp template="services_categories"]'); ?>
                    </div> -->

                    <div class="container-fluid mb-5">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="row g-5">
                                    <?php foreach ($child_terms as $child) {
                                        $thumbnail = get_field('thumbnail', 'service_category_' . $child->term_id);
                                        $main_image = get_field('main_image', 'service_category_' . $child->term_id) ?: 276;
                                        $link = get_term_link($child);

                                        $parent_term = get_term($child->parent, 'service_category');
                                        $parent_name = $parent_term ? $parent_term->name : '';

                                        $i++;
                                        $delay = ($i - 1) * 0.2;
                                        ?>

                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="sercive-category-article fade-in-left" style="--delay: <?php echo $delay; ?>s;">
                                                <a href="<?php echo esc_url($link); ?>">
                                                    <div class="blog-carousel__item carousel__item">
                                                        <div class="blog-carousel__block">
                                                            <div class="blog-img">
                                                                <?php echo wp_get_attachment_image($main_image, 'full', false, array('class' => 'img-fluid', 'loading' => 'lazy')) ?>
                                                            </div>
                                                            <div class="blog-carousel__block-content">
                                                                <p class="blog-content-category">
                                                                    <?php echo esc_html($parent_name); ?>
                                                                </p>
                                                                <p class="blog-content-title">
                                                                    <?php echo esc_html($child->name); ?>
                                                                </p>
                                                                <div class="blog-content-button-thumbnail">
                                                                    <span class="btn btn--primary btn--small">Read more</span>
                                                                    <?php echo wp_get_attachment_image($thumbnail, 'full', false, array('class' => 'img-fluid', 'loading' => 'lazy')) ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($remainder > 0): ?>
                                        <div class="col">
                                            <div class="sercive-category-article fade-in-left" style="--delay: <?php echo $delay; ?>s;">
                                                <?php echo wp_get_attachment_image($image_last_block, 'full', false, array('class' => 'placeholder-img img-fluid', 'loading' => 'lazy')) ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($cta_message) { ?>
                <div class="cta-services block--fullwidth block--padded-sm">
                    <div class="container-fluid">
                        <div class="cta-message fade-in-bottom">
                            <div class="row gx-5 align-items-center">
                                <div class="col-12 col-lg-7">
                                    <div class="cta-message__text">
                                        <?php echo $cta_message; ?>
                                    </div>
                                </div>
                                <div class="col-12 col-lg">
                                    <?php echo do_shortcode('[buttons-cta]'); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            <?php } ?>

        </div>
    <?php } ?>
<?php } ?>

<?php
get_footer();
