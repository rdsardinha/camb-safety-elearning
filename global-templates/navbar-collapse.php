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

?>

<div class="block__main-menu block--bg-white">
	<nav class="navbar navbar-expand-xl p-0">

		<p id="main-nav-label" class="h2 screen-reader-text">
			<?php esc_html_e('Main Navigation', 'understrap'); ?>
		</p>

		<div class="<?php echo esc_attr($container); ?>">

			<!-- Your site branding in the menu -->
			<?php get_template_part('global-templates/navbar-branding'); ?>

			<?php if ( current_user_can('um_staff-members') ) { ?>
				<ul class="navbar-nav main-menu">
					<li class="d-none d-xl-block">Staff Hub</li>

					<li class="d-none d-xl-block">|</li>

					<li class="d-none d-xl-block">
						<div>
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'members-menu',
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

					<li class="d-none d-xl-block">
						<?php echo do_shortcode('[gtranslate]'); ?>
					</li>

					<li class="d-lg-block d-xl-none">
						<nav class="navbar navbar-expand-xl">

							<?php echo do_shortcode('[phone-number]'); ?>

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
											'theme_location' => 'members-menu',
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
			<?php } else { ?>
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

					<li class="d-none d-xl-block">
						<?php echo do_shortcode('[gtranslate]'); ?>
					</li>

					<li class="d-none d-xl-block">
						<?php echo do_shortcode('[buttons-cta]'); ?>
					</li>

					<li class="d-lg-block d-xl-none">
						<nav class="navbar navbar-expand-xl">

							<?php echo do_shortcode('[phone-number]'); ?>

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
			<?php } ?>
		</div><!-- .container(-fluid) -->

	</nav><!-- #main-nav -->
</div>

<div class="search-bar">
	<?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
	<?php echo do_shortcode('[phone-number]'); ?>
	<?php echo do_shortcode('[gtranslate]'); ?>
</div>
