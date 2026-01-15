<?php
/**********************************************************
 *
 * File:         Page Title
 * Description:  Title block banner
 * Author:       Echo Web Solutions
 * Version:      v0.2
 * Modified:     23/05/2025
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

$acf_heading = get_field('heading_text') ?: get_the_title();
$heading = sprintf('<h1 class="text-block__heading text--secondary fade-in-left">%1$s</h1>', $acf_heading);

$page_img = get_field('background_image');
?>
<div class="page-header-block block--fullwidth block block--bg">
	<div class="block--bg page-header-block__header fade-in-left">
		<?php echo wp_get_attachment_image($page_img, 'full', false, array('class' => 'banner-image img-fluid block__bg', 'loading' => 'eager')) ?>
		<div class="block--fg block--padded-sm block--margin">
			<div class="row justify-content-center">
				<div class="col-12 col-lg-6 col-xl-5">
					<div class="text-block__header">
						<?php echo $heading; ?>
						<?php if (have_rows('buttons_text')): ?>
							<div class="block-buttons">
								<?php while (have_rows('buttons_text')):
									the_row(); ?>
									<?php
									$link = get_sub_field('link');
									$theme = get_sub_field('theme');
									if (empty($link)) {
										break;
									}

									echo sprintf('<a class="btn btn--%1$s" href="%2$s" target="%3$s">%4$s</a>', $theme, $link['url'], $link['target'], $link['title']);

									?>
								<?php endwhile; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<div class="col-lg-4 col-xl-5 d-none d-lg-block"></div>
			</div>
		</div>
	</div>
</div>