<?php
/**
 * Header Navbar (bootstrap5)
 *
 * @package Understrap
 * @since 1.1.0
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$container = get_theme_mod('echo_container_type');

$csp_website = get_field('csp_website', 'option');

$csp_website_url = isset($csp_website['url'])
	? $csp_website['url']
	: 'https://www.cambridgesafety.co.uk/';
$csp_website_target = isset($csp_website['target'])
	? $csp_website['target']
	: '_blank';
$csp_website_title = isset($csp_website['title'])
	? $csp_website['title']
	: 'CSP Website';
?>

<div class="block__main-menu block--bg-white">
	<nav class="navbar navbar-expand-xl p-0">

		<p id="main-nav-label" class="h2 screen-reader-text">
			<?php esc_html_e('Main Navigation', 'understrap'); ?>
		</p>

		<div class="<?php echo esc_attr($container); ?>">

			<!-- Your site branding in the menu -->
			<?php get_template_part('global-templates/navbar-branding'); ?>

			<ul class="navbar-nav main-menu">
				<li class="d-none d-xl-block">
					<div>
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'container_class' => '',
								'container_id' => '',
								'menu_class' => 'navbar-nav justify-content-evenly pt-0',
								'fallback_cb' => '',
								'menu_id' => 'main-menu',
								'depth' => 2,
								'walker' => new Understrap_WP_Bootstrap_Navwalker(),
							)
						);
						?>
					</div>
				</li>

				<li class="d-none d-xl-block account-col">
					<a class="account-link" href="<?php echo site_url('my-account/') ?>">
						<i class="icon-account"></i>
					</a>
				</li>

				<li class="d-none d-xl-block">
					<div class="block-buttons">
						<a class="btn btn--secondary" href="<?php echo esc_url($csp_website_url); ?>"
							target="<?php echo esc_attr($csp_website_target); ?>">
							<?php echo esc_html($csp_website_title); ?>
						</a>
						<a class="btn btn--primary" href="<?php echo site_url('contact-us/') ?>">Contact Us</a>
					</div>
				</li>

				<li class="d-lg-block d-xl-none">
					<nav class="navbar navbar-expand-xl">

						<button class="navbar-toggler border-0 p-0" type="button" data-bs-toggle="offcanvas"
							data-bs-target="#navbarNavOffcanvas" aria-controls="navbarNavOffcanvas"
							aria-expanded="false">
							<i class="icon-menu"></i>
						</button>

						<div class="offcanvas offcanvas-end" tabindex="-1" id="navbarNavOffcanvas">

							<div class="offcanvas-body-menu">
								<button class="navbar-toggler border-0 p-0" type="button" data-bs-toggle="offcanvas"
									data-bs-target="#navbarNavOffcanvas" aria-controls="navbarNavOffcanvas"
									aria-expanded="false">
									<i class="icon-cross"></i>
								</button>
								<?php
								wp_nav_menu(
									array(
										'theme_location' => 'primary',
										'container_class' => 'offcanvas-body',
										'container_id' => '',
										'menu_class' => 'navbar-nav justify-content-evenly pt-0 flex-grow-1',
										'fallback_cb' => '',
										'menu_id' => 'menu',
										'depth' => 2,
										'walker' => new Understrap_WP_Bootstrap_Navwalker(),
									)
								);
								?>
							</div>
						</div>
					</nav>
				</li>
			</ul>
		</div><!-- .container(-fluid) -->

	</nav><!-- #main-nav -->
</div>