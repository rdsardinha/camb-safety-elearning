<?php
$defaults = array(
	"ID" => get_the_ID(),
	"image" => get_the_post_thumbnail_url(null, 'full'),
	"title" => get_the_title(),
	"excerpt" => get_the_excerpt(),
	"content" => get_the_content(),
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

$card_img = get_post_thumbnail_id($args['ID']);
?>

<div class="page-header-videos-block border-top-primary">
	<div class="page-header-block__breadcrumb container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="single-product__breadbrumb">
					<?php if (function_exists('woocommerce_breadcrumb')) {
						woocommerce_breadcrumb();
					} ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="block--margin-md">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 col-lg-8 col-xl-6">
				<div class="text-block__header">
					<h1 class="text-block__heading"><?php echo $args['title']; ?></h1>
					<?php if ($args['excerpt']) { ?>
						<div class="text-block__subheading"><?php echo $args['excerpt']; ?></div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>