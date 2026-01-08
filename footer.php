<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$container = get_theme_mod('echo_container_type');

$images = get_field('gallery_footer', 'options');
$add_margin = get_field('add_margin_footer', 'options');

$i = 0;
?>

<div class="photo-collage block block--fullwidth <?php echo $add_margin; ?>">
	<ul class="photo-collage__gallery">
		<?php
		if ($images):
			foreach ($images as $image):
				$i++;
				$delay = ($i - 1) * 0.1; ?>
				<li>
					<?php echo wp_get_attachment_image($image, 'full', false, array('class' => 'img-fluid fade-in-left', 'style' => '--delay: ' . $delay . 's;', 'loading' => 'lazy')) ?>
				</li>
				<?php
			endforeach;
		endif;
		?>
	</ul>
</div>

<footer class="site-footer block" id="site-footer">

	<div class="site-footer__primary block--padded-md">
		<div class="<?php echo esc_attr($container); ?>">
			<div class="row gy-5">
				<div class="site-footer__logo col-12 col-md-6 col-xl-4">
					<?php dynamic_sidebar('footer-col-1'); ?>
				</div>
				<?php if (current_user_can('um_staff-members')) { ?>
					<div class="site-footer__menu site-footer__menu-first col-12 col-md-6 col-xl">
						<?php dynamic_sidebar('footer-col-8'); ?>
					</div>
				<?php } else { ?>
					<div class="site-footer__menu site-footer__menu-first col-12 col-md-6 col-xl">
						<?php dynamic_sidebar('footer-col-2'); ?>
						<?php dynamic_sidebar('footer-col-5'); ?>
					</div>
					<div class="site-footer__menu col-12 col-md-6 col-xl ">
						<?php dynamic_sidebar('footer-col-3'); ?>
						<?php dynamic_sidebar('footer-col-6'); ?>
					</div>
					<div class="site-footer__menu col-12 col-md-6 col-xl">
						<?php dynamic_sidebar('footer-col-4'); ?>
						<?php dynamic_sidebar('footer-col-7'); ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>

	<div class="site-footer__disclaimer block--bg-secondary text--white block--padded-sm">
		<div class="<?php echo esc_attr($container); ?>">
			<div class="row text-center site-footer__disclaimer-row">
				<?php dynamic_sidebar('footer-disclaimer'); ?>
			</div>
		</div>
	</div>
</footer><!-- #wrapper-footer -->

<div class="text-resize-controls" aria-label="Text size controls">
	<button class="text-size-btn" data-size="small">A</button>
	<button class="text-size-btn" data-size="medium">A</button>
	<button class="text-size-btn" data-size="large">A</button>
</div>

<div class="buttons-cta d-flex d-xl-none justify-content-center">
	<?php echo do_shortcode('[buttons-cta]'); ?>
</div>

<?php // Closing div#page from header.php. ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>