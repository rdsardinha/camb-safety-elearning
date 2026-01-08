<?php

$categories = get_the_category(get_the_ID());
$category_name = !empty($categories) ? esc_html($categories[0]->name) : '';

$defaults = array(
    "ID" => get_the_ID(),
    "image" => get_the_post_thumbnail_url(null, 'full'),
    "title" => get_the_title(),
    "content" => get_the_excerpt(),
    "button" => array(
        "title" => "Read Article",
        "target" => "_self",
        "url" => get_the_permalink()
    ),
    "author" => array(
        "ID" => get_the_author_meta('ID'),
        "name" => get_the_author_meta("display_name")
    ),
    "date" => get_the_date("d M Y"),
    "category" => array(
        "name" => $category_name,
    )
);

$args = wp_parse_args($args, $defaults);

$read_time = get_reading_time($args['ID']);
// $content = truncate_to_lines($args['content'], 2);
$card_img = get_post_thumbnail_id($args['ID']) ?: 276;
?>

<article id="post-<?php echo $args["ID"] ?>" class="blog-article">
    <a href="<?php echo $args['button']['url']; ?>">
        <div class="blog-carousel__item carousel__item">
            <div class="blog-carousel__block">
                <div class="blog-img">
                    <?php echo wp_get_attachment_image($card_img, 'full', false, array('class' => 'blog-img img-fluid')) ?>
                </div>
                <div class="blog-carousel__block-content">
                    <p class="blog-content-category"><?php echo $args['category']['name']; ?></p>
                    <p class="blog-content-title"><?php echo $args['title']; ?></p>
                    <div>
                        <span class="blog-content-date"><?php echo $args["date"]; ?></span>
                        <span class="vertical-separator">|</span>
                        <span class="blog-content-read-time"><?php echo $read_time; ?></span>
                    </div>
                    <span class="btn btn--primary btn--small">Read more</span>
                </div>
            </div>
        </div>
    </a>
</article>