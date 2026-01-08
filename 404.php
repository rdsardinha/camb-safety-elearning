<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

?>

<main class="site-main" id="main">
	<div class="container-fluid" id="content" tabindex="-1">
		<div class="row">
			<div class="col-12 content-area" id="primary">
				<div class="block block--margin text-center">
					<header>
						<h1 class="page-title"><span class="font-size--xl">404</span> <br>Page not found</h1>
					</header><!-- .page-header -->
					<div class="page-content">

						<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'understrap' ); ?></p>
					</div><!-- .page-content -->
				</div>
			</div><!-- #primary -->
		</div><!-- .row -->
	</div><!-- #content -->
</main>

<?php
get_footer();
