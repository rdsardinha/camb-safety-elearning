<?php
get_template_part('template-parts/partials/header/header-archive', get_post_type());
?>
<div class="container-fluid blog-archieve__container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row g-5">
                <?php
                if (have_posts()) {
                    $i = 0;
                    while (have_posts()):
                        the_post();
                        $i++;
                        $delay = ($i - 1) * 0.2;
                        echo '<div class="col-12 col-md-6 col-lg-4 fade-in-left" style="--delay: ' . $delay . 's;">';
                        get_template_part('template-parts/partials/card/card', get_post_type());
                        echo '</div>';

                    endwhile;
                    wp_reset_postdata();
                } else { ?>
                    <div class="col-12 blog-search block--margin">
                        <?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.'); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php if (have_posts()): ?>
        <div class="blog-pagination block--margin-md">
            <div class="row justify-content-center">
                <div class="col-12">
                    <?php echo do_shortcode('[facetwp facet="pagination"]'); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>