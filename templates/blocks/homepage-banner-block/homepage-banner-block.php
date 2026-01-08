<?php
/**********************************************************
 *
 * File:         Page Header
 * Description:  Page Header
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     10/06/24
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

$main_image = get_field('main_image');
$secondary_image = get_field('secondary_image');
$tertiary_image = get_field('tertiary_image');
$title = get_field('title');
$content = get_field('content');
?>

<div class="homepage-banner-block block block--fullwidth bg-dark">
	<div class="row g-0">
		<div class="col-12 col-lg-4">
			<div class="homepage-banner-block__content">
				<h1 class="homepage-banner-title text--white fade-in-top" style="--delay: 0s"><?php echo $title; ?></h1>
				<?php if ($content) { ?>
					<div class="homepage-banner-content text--white fade-in-top" style="--delay: 0.2s">
						<?php echo $content; ?>
					</div>
				<?php } ?>
				<?php if (have_rows('buttons')): ?>
					<div class="block-buttons fade-in-top" style="--delay: 0.4s">
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
		<div class="col-12 col-lg-8">
			<div class="row g-0">
				<div class="col-12 col-sm-7 d-none d-sm-block fade-in-top" style="--delay: 0.1s">
					<?php echo wp_get_attachment_image($main_image, 'full', false, array('class' => 'main-image img-fluid', 'loading' => 'eager')) ?>
				</div>
				<div class="col-12 col-sm-5 d-none d-sm-block">
					<div class="row">
						<div class="col-12 fade-in-right" style="--delay: 0.2s">
							<?php echo wp_get_attachment_image($secondary_image, 'full', false, array('class' => 'secondary-image img-fluid', 'loading' => 'eager')) ?>
						</div>
						<div class="col-12 fade-in-right" style="--delay: 0.3s">
							<?php echo wp_get_attachment_image($tertiary_image, 'full', false, array('class' => 'tertiary-image img-fluid', 'loading' => 'eager')) ?>
						</div>
					</div>
				</div>

				<div class="col-12 d-block d-sm-none">
					<div class="images-carousel carousel">
						<div>
							<?php echo wp_get_attachment_image($main_image, 'full', false, array('class' => 'img-fluid', 'loading' => 'eager')) ?>
						</div>
						<div>
							<?php echo wp_get_attachment_image($secondary_image, 'full', false, array('class' => 'img-fluid', 'loading' => 'eager')) ?>
						</div>
						<div>
							<?php echo wp_get_attachment_image($tertiary_image, 'full', false, array('class' => 'img-fluid', 'loading' => 'eager')) ?>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>