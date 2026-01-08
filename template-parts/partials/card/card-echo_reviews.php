<?php

$defaults = array(
    "ID" => get_the_ID(),
    "image" => get_the_post_thumbnail_url(null, 'full'),
    "title" => get_the_title(),
    "content" => get_the_excerpt(),
    "description" => get_the_content(),
    "button" => array(
        "title" => "Read Article",
        "target" => "_self",
        "url" => get_the_permalink()
    ),
    "author" => array(
        "ID" => get_the_author_meta('ID'),
        "name" => get_the_author_meta("display_name")
    ),
    "date" => get_the_date("d M Y")
);

$args = wp_parse_args($args, $defaults);

$reviwer_name = get_field('reviwer_name', $args['ID']);
$reviwer_status = get_field('reviwer_status', get_the_ID());
$rating = get_field('star_number', get_the_ID());
?>

<article id="post-<?php echo $args["ID"] ?>" class="review-article">
    <div class="reviews-carousel__block">
        <div class="reviews-carousel__block-description"><?php echo get_the_content(); ?></div>
        <div class="reviews-carousel__block-content">
            <p class="reviews-carousel__block-title mb-0">
                <span class="reviews-carousel__block-name"><?php echo $reviwer_name; ?></span>
                <?php if ($reviwer_status): ?>
                    |
                    <span class="reviews-carousel__block-status"><?php echo $reviwer_status; ?></span>
                <?php endif; ?>
            </p>
            <span class="reviews-carousel__block-stars">
                <?php if ($rating == 4) {
                    for ($k = 0; $k < $rating; $k++) { ?>
                         <i class="icon-star"></i>
                    <?php } ?>
                    <i class="icon-star grey-out"></i>
                <?php } else {
                    for ($k = 0; $k < $rating; $k++) { ?>
                         <i class="icon-star"></i>
                    <?php }
                } ?>
            </span>
        </div>
    </div>
</article>