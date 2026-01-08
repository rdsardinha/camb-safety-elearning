<?php
$title = get_field('title_videos', 'options') ?: 'Upcoming Events';
?>

<div class="text-block block block--margin-md mb-3">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-12 col-xl-6">
                <h1 class="blog-heading text-block__heading mb-0"><?php echo $title ?></h1>
            </div>
            <div class="col-12 col-xl-6">
                <div class="sort-search-filters">
                    <?php
                    echo do_shortcode('[facetwp facet="sorting_blog"]');
                    echo do_shortcode('[facetwp facet="blog_search"]');
                    ?>
                </div>
            </div>
            <div class="col-12">
                <hr class="separator separator--primary separator--thick">
            </div>
        </div>
    </div>
</div>