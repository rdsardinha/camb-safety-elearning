<?php
/**********************************************************
 *
 * File:         Advert Feature
 * Description:  Advert feature
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     23/05/2025
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

$title_size = get_field('title_size');

$acf_heading = get_field('title');
$heading = $acf_heading ? sprintf('<%1$s class="text-block__heading text--white fade-in-left">%2$s</%1$s>', $title_size, $acf_heading) : '';

$description = get_field('description');

$link = get_field('link');

$image = get_field('image');

?>

<div class="advert-feature block block--margin">
	<div class="container-fluid">
		<div class="row g-0">
			<div class="col-12 col-lg-6">
				<div class="advert-feature__content bg-dark">
					<div class="text-block__header mb-0">
						<?php echo $heading; ?>
					</div>
					<?php if ($description) { ?>
						<div class="advert-feature-text text--white">
							<?php echo $description; ?>
						</div>
					<?php } ?>
					<?php if ($link): ?>
						<div class="block-buttons">
							<?php echo sprintf('<a class="btn btn--primary btn--location" href="%1$s" target="%2$s"><i class="icon-location"></i>%3$s</a>', $link['url'], $link['target'], $link['title']); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="col-12 col-lg-6">
				<?php if ($link): ?>
					<a href="<?php echo $link['url'] ?>">
					<?php endif; ?>
					<?php echo wp_get_attachment_image($image, 'full', false, array('class' => 'map-image img-fluid', 'loading' => 'lazy')) ?>
					<?php if ($link): ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>