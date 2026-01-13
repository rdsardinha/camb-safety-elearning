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

?>

<footer class="site-footer block" id="site-footer">

	<div class="site-footer__primary block--padded-md">
		<div class="<?php echo esc_attr($container); ?>">
			<div class="row g-5">
				<div class="site-footer__logo col-12 col-md-6 col-xl-4">
					<?php dynamic_sidebar('footer-col-1'); ?>
				</div>
				<div class="site-footer__menu column-menu col-12 col-md-6 col-xl">
					<?php dynamic_sidebar('footer-col-2'); ?>
				</div>
				<div class="site-footer__menu col-12 col-md-6 col-xl-2">
					<?php dynamic_sidebar('footer-col-3'); ?>
				</div>
				<div class="site-footer__menu col-12 col-md-6 col-xl-2">
					<?php dynamic_sidebar('footer-col-4'); ?>
				</div>
			</div>
		</div>
	</div>

	<div class="site-footer__disclaimer block--bg-black text--white">
		<div class="<?php echo esc_attr($container); ?>">
			<div class="row">
				<?php dynamic_sidebar('footer-disclaimer'); ?>
			</div>
		</div>
	</div>
</footer><!-- #wrapper-footer -->

<?php // Closing div#page from header.php. ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>