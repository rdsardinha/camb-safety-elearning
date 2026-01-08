<?php
/**********************************************************
 *
 * File:         Advert CTA
 * Description:  Call to action
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     23/05/2025
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

$acf_heading = get_field('title');
$heading = $acf_heading ? sprintf('<%1$s class="text-block__heading">%2$s</%1$s>', 'h3', $acf_heading) : '';

$image_cta = get_field('image_cta');
$content = get_field('content');

$link = get_field('link');
$theme = get_field('theme');
$size = get_field('size');

$phone = get_field('options_phone_number', 'options');

$cta_style = get_field('cta_style');
$auxBg = "block--margin";
$auxCol1 = "col-12 text-center";

if ($cta_style == "complete") {
	$auxCol1 = "col-12 col-lg-7";
	$auxBg = "bg-cta-advert-complete block--padded block--bg";
}

?>

<div class="advert-cta block block--fullwidth <?php echo $auxBg; ?>">
	<?php if ($cta_style == "complete") {
		echo wp_get_attachment_image($image_cta, 'full', false, array('class' => 'img-fluid block__bg', 'loading' => 'lazy'));
	} ?>
	<div class="container-fluid block--fg  fade-in-top">
		<div class="row justify-content-center">
			<div class="<?php echo $auxCol1 ?>">
				<?php echo $heading; ?>
				<?php if ($cta_style == "simple") { ?>
					<div class="block-buttons align-items-center justify-content-center">
						<?php if (!empty($link)) {
							echo sprintf('<a class="btn btn--%1$s btn--%5$s" href="%2$s" target="%3$s">%4$s</a>', $theme, $link['url'], $link['target'], $link['title'], $size);
						} ?>
						<p class="number m-0">
							or call us on
							<a class="" href="tel:+44<?php echo str_replace(' ', '', $phone) ?>">
								<?php echo $phone; ?>
							</a>
						</p>
					</div>
				<?php } ?>
				<?php if ($cta_style == "complete") { ?>
					<div class="advert-cta__content">
						<?php echo $content; ?>
					</div>
				<?php } ?>
			</div>
			<?php if ($cta_style == "complete") { ?>
				<div class="col-12 col-lg-3 d-flex align-items-center justify-content-center">
					<?php if (!empty($link)) {
						echo sprintf('<a class="btn btn--%1$s btn--%5$s" href="%2$s" target="%3$s">%4$s</a>', $theme, $link['url'], $link['target'], $link['title'], $size);
					} ?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>