<?php

$current_id = get_queried_object_id();

$loop_args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 6,
    'post__not_in' => array($current_id),
);

$query = new WP_Query($loop_args);

$post_details = array(
    "ID" => get_the_ID(),
    "image" => get_the_post_thumbnail_url(null, 'full'),
    "tag" => get_the_terms(get_the_ID(), "category"),
    "title" => get_the_title(),
    "button" => array(
        "title" => "Read Article",
        "target" => "_self",
        "url" => get_the_permalink()
    ),
    "author" => array(
        "name" => get_the_author_meta("display_name"),
    ),
    "date" => get_the_date("d M Y")
);

$read_time = get_reading_time($post_details["ID"]);

?>

<div class="page-introduction-block blog-single-header block block--fullwidth block--padded-sm">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="blog-content-header">
                    <div class="blog-content-author-date">
                        <div class="blog-content-author">
                            <?php echo wp_get_attachment_image(277, 'full', false, array('class' => 'blog-author-img img-fluid')) ?>
                            <p><?php echo $post_details["author"]["name"]; ?></p>
                        </div>

                        <div class="blog-content-date-block">
                            <span class="blog-content-date"><?php echo $post_details["date"]; ?></span>
                            <span class="vertical-separator">|</span>
                            <span class="blog-content-read-time"><?php echo $read_time; ?></span>
                        </div>
                    </div>
                    <div class="blog-content-share">
                        <a type="button" class="btn btn--share" data-bs-toggle="modal" aria-label="Open Share Model"
                            data-bs-target="#blog-slider-modal-<?php echo $post_details["ID"]; ?>">
                            <span>Share article</span> <i class="icon-share"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row justify-content-center">

        <div class="col-12">
            <?php the_content() ?>
        </div>

        <div class="col-12">
            <div class="blog-share">
                <a type="button" class="btn btn--share" data-bs-toggle="modal" aria-label="Open Share Model"
                    data-bs-target="#blog-slider-modal-<?php echo $post_details["ID"]; ?>">
                    <span>Share article</span> <i class="icon-share"></i>
                </a>
            </div>
            <div class="modal fade blog-slider-modal share-modal"
                id="blog-slider-modal-<?php echo $post_details["ID"]; ?>" tabindex="-1"
                aria-labelledby="blog-slider-modalLabel-<?php echo $post_details["ID"]; ?>" aria-hidden="true">

                <div class="modal-dialog">
                    <div class="modal-content">
                        <a class="btn-close" data-bs-dismiss="modal" aria-label="Close">Close</a>
                        <div class="modal-header">
                            <p class="h3">Share</p>
                        </div>
                        <div class="modal-body social-share">
                            <a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink($post_details["ID"])) ?>"
                                target="_blank">
                                <i class="icon-facebook"></i>
                            </a>

                            <!-- <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink($post_details["ID"])); ?>"
                                target="_blank">
                                <i class="icon-x"></i>
                            </a>

                            <a href="http://pinterest.com/pin/create/link/?url=<?php echo urlencode(get_permalink($post_details["ID"])) ?>"
                                target="_blank">
                                <i class="icon-pinterest"></i>
                            </a> -->

                            <a href="mailto:?body=<?php echo urlencode(get_permalink($post_details["ID"])) ?>"
                                title="Share by Email">
                                <i class="icon-email"></i>
                            </a>

                            <input type="hidden" id="hiddenField"
                                value="<?php echo get_permalink($post_details["ID"]) ?>">
                            <a class="btn--link-copy" onclick="copyText()"><i class="icon-copy"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="blog-slider-block block block--padded block--bg-grey block--fullwidth block--margin mb-0">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="text-block__header text-center">
                    <h2 class="text-block__heading">You may also be interested in</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-xl-12">
                <div class="blog-carousel carousel">
                    <?php if ($query->have_posts()): ?>
                        <div class="blog-carousel__carousel blog">
                            <?php while ($query->have_posts()):
                                $query->the_post(); ?>
                                <?php
                                echo '<div>';
                                get_template_part('template-parts/partials/card/card', get_post_type());
                                echo '</div>';
                                ?>
                            <?php endwhile; ?>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="block-buttons justify-content-center">
                    <?php echo sprintf('<a class="btn btn--secondary" href="/blog/">Read more articles</a>'); ?>
                </div>
            </div>
        </div>
    </div>
</div>