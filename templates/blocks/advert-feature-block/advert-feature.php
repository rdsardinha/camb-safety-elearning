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
$heading = $acf_heading ? sprintf('<%1$s class="text-block__heading text--white">%2$s</%1$s>', $title_size, $acf_heading) : '';

$description = get_field('description');

$button = get_field('button');
$button_theme = get_field('button_theme');

$images = get_field('images');
if ($images) {
	$count = count($images);
}
?>

<div class="advert-feature block block--margin">
	<div class="container-fluid">
		<div class="row g-0">
			<div class="col-12 col-lg-6 order-2 order-lg-1">
				<div class="advert-feature__content bg-dark">
					<div class="text-block__header mb-0 fade-in-top">
						<?php echo $heading; ?>
					</div>
					<?php if ($description) { ?>
						<div class="advert-feature-text text--white fade-in-left" style="--delay: 0.1">
							<?php echo $description; ?>
						</div>
					<?php } ?>
					<?php if (have_rows('buttons')): ?>
						<div class="block-buttons fade-in-bottom" style="--delay: 0.2">
							<?php while (have_rows('buttons')):
								the_row(); ?>
								<?php
								$link = get_sub_field('link');
								$theme = get_sub_field('theme');
								$size = get_sub_field('size');
								if (empty($link)) {
									break;
								}
								echo sprintf('<a class="btn btn--%1$s btn--%5$s" href="%2$s" target="%3$s">%4$s</a>', $theme, $link['url'], $link['target'], $link['title'], $size);
								?>
							<?php endwhile; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="col-12 col-lg-6 order-1 order-lg-2">
				<div class="row g-0 advert-feature__masonry">
					<?php if ($images): ?>
						<?php if ($count === 1): ?>
							<!-- Single image occupies full width -->
							<div class="col col-12">
								<?php echo wp_get_attachment_image($images[0], 'full', false, array('class' => 'single-image img-fluid', 'loading' => 'lazy')) ?>
							</div>
						<?php elseif ($count === 2): ?>
							<!-- Two images 50-50 horizontal -->
							<?php foreach ($images as $img): ?>
								<div class="col col-6">
									<?php echo wp_get_attachment_image($img, 'full', false, array('class' => 'half-image img-fluid', 'loading' => 'lazy')) ?>
								</div>
							<?php endforeach; ?>
						<?php else: ?>
							<!-- Three or more images, first big, next two stacked vertically -->
							<div class="col col-6">
								<?php echo wp_get_attachment_image($images[0], 'full', false, array('class' => 'single-image img-fluid', 'loading' => 'lazy')) ?>
							</div>
							<div class="col col-6">
								<div class="row half-content">
									<?php for ($i = 1; $i <= 2; $i++): ?>
										<div class="col-12">
											<?php if (isset($images[$i])):
												$img = $images[$i]; ?>
												<?php echo wp_get_attachment_image($img, 'full', false, array('class' => 'img-fluid', 'loading' => 'lazy')) ?>
											<?php endif; ?>
										</div>
									<?php endfor; ?>
								</div>
							</div>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>