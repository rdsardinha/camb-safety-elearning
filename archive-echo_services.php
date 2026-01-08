<?php
/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$leave_review_button = get_field('leave_review_button', 'options') ?: '#';
?>

<?php

$title_blog = get_field('title_services', 'options');
$title = sprintf('<h1 class="text-block__heading fade-in-left" style="--delay: 0.2s;">%1$s</h1>', $title_blog);

$main_image = get_field('main_image_services', 'options');
$introduction_text = get_field('introduction_text_services', 'options');


$heading_size = get_field('heading_size_services_block', 'options');
$subheading_size = get_field('subheading_size_services_block', 'options');

$acf_heading = get_field('heading_services_block', 'options');
$heading = $acf_heading ? sprintf('<%1$s class="text-block__heading text--white fade-in-left" style="--delay: 0.2s;">%2$s</%1$s>', $heading_size, $acf_heading) : '';

$acf_subheading = get_field('subheading_services_block', 'options');
$subheading = $acf_subheading ? sprintf('<%1$s class="text-block__subheading text--white fade-in-left" style="--delay: 0.3s;">%2$s</%1$s>', $subheading_size, $acf_subheading) : '';

$cta_message = get_field('cta_message_services_block', 'options');

$selected_terms = get_field('services_selector_services_block', 'options');

$parents = [];
$children = [];

foreach ($selected_terms as $term_id) {
	$term = get_term($term_id, 'service_category');
	if ($term->parent == 0) {
		$parents[$term->term_id] = $term; // parent
	} else {
		$children[$term->parent][] = $term; // child grouped by parent
	}
}

// Automatically include all children if none selected for a parent
foreach ($parents as $parent_id => $parent) {
	if (empty($children[$parent_id])) {
		$all_children = get_terms([
			'taxonomy' => 'service_category',
			'hide_empty' => false,
			'parent' => $parent_id,
		]);
		if ($all_children && !is_wp_error($all_children)) {
			$children[$parent_id] = $all_children;
		}
	}
}


?>

<div class="page-header-block block block--fullwidth">
	<div class="row g-0">
		<div class="col-12 col-lg-6 page-header-block__content">
			<?php if (function_exists('yoast_breadcrumb')) {
				yoast_breadcrumb('<div class="breadcrumbs fade-in-left" style="--delay: 0.3s;">', '</div>');
			} ?>
			<?php echo $title; ?>

			<?php
			if (function_exists('yoast_breadcrumb')) {
				$breadcrumbs = yoast_breadcrumb('<div id="breadcrumbs">', '</div>', false);

				if ($breadcrumbs) {
					// Extract links from breadcrumbs
					preg_match_all('/<a[^>]+href=["\'](.*?)["\'][^>]*>(.*?)<\/a>/', $breadcrumbs, $matches);
					$links = $matches[1];
					$labels = $matches[2];

					// If there are at least two breadcrumbs, go to the second-to-last
					if (count($links) >= 1) {
						$previous_url = $links[count($links) - 1];
						$previous_label = $labels[count($labels) - 1];
						echo '<a href="' . esc_url($previous_url) . '" class="page-back-button fade-in-left" style="--delay: 0.4s;"><i class="icon-back-arrow"></i> Back to ' . esc_html($previous_label) . '</a>';
					}
				}
			}
			?>
		</div>
		<div class="col-12 col-lg-6 page-header-block__image">
			<?php echo wp_get_attachment_image($main_image, 'full', false, array('class' => 'img-fluid', 'loading' => 'eager')) ?>
		</div>
	</div>
</div>

<?php if ($introduction_text) { ?>
	<div class="page-introduction-block block block--fullwidth block--padded-md">
		<div class="container-fluid">
			<div class="row justify-content-center">
				<div class="col-12 fade-in-left" style="--delay: 0.5s;">
					<?php echo $introduction_text; ?>
				</div>
			</div>
		</div>
	</div>
<?php } ?>

<div class="services-block block--fullwidth block block--padded">
	<div class="container-fluid">
		<div class="row justify-content-center mb-3">
			<div class="col-12 col-lg-10">
				<div class="text-block__header text-center">
					<?php echo $heading; ?>
					<?php if ($subheading) { ?>
						<?php echo $subheading; ?>
					<?php } ?>
				</div>
			</div>
		</div>

		<div class="row mb-3">
			<div class="services-tab">
				<div class="col-12 col-lg-4">
					<!-- Nav pills -->
					<div class="nav flex-column nav-pills me-2" id="v-pills-tab" role="tablist"
						aria-orientation="vertical">
						<?php $first = true;
						$i = 0;
						foreach ($parents as $parent):
							$active_class = $first ? 'active' : '';
							$title = $parent->name;
							$slug = $parent->slug;
							$i++;
							$delay = ($i - 1) * 0.1
								?>
							<button class="nav-link <?php echo $active_class; ?> fade-in-left"
								style="--delay: <?php echo $delay; ?>s;" id="v-pills-<?php echo $slug; ?>-tab"
								data-bs-toggle="pill" data-bs-target="#v-pills-<?php echo $slug; ?>" type="button"
								role="tab" aria-controls="v-pills-<?php echo $slug; ?>"
								aria-selected="<?php echo $first ? 'true' : 'false'; ?>">
								<?php echo $title; ?>
							</button>
							<?php $first = false; ?>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="col-12 col-lg-8 h-100">
					<!-- Tab content -->
					<div class="tab-content" id="v-pills-tabContent">
						<?php $first = true;
						$f = 0.1;
						foreach ($parents as $parent):
							$active_class = $first ? 'show active' : '';
							$parent_children = isset($children[$parent->term_id]) ? $children[$parent->term_id] : [];
							$slug = $parent->slug;

							// Split into left/right columns with minimum 5 in right
							$left_col = [];
							$right_col = [];

							$total = count($parent_children);

							$left_count = 5; // minimum left
							$right_count = $total - $left_count;

							if ($total > 10) {
								// More than 10 items: give extra to left first
								$left_count = ceil($total / 2); // left gets the bigger half
								$right_count = $total - $left_count;
							}

							// Slice arrays
							$left_col = array_slice($parent_children, 0, $left_count);
							$right_col = array_slice($parent_children, $left_count, $right_count);
							?>
							<div class="tab-pane fade <?php echo $active_class; ?>" id="v-pills-<?php echo $slug; ?>"
								role="tabpanel" aria-labelledby="v-pills-<?php echo $slug; ?>-tab">
								<div class="row">
									<div class="col-12 col-md-6">
										<?php foreach ($left_col as $child):
											$f = $f + 0.1;
											$delay = 0.1 + $f;
											$delay2 = 0.3 + $f; ?>
											<div class="child-item">
												<a href="<?php echo get_term_link($child); ?>" class="child-item__link">
													<?php echo wp_get_attachment_image(get_field('thumbnail', $child), 'full', false, ['class' => 'img-fluid fade-in-left', 'style' => '--delay: ' . $delay . 's;', 'loading' => 'lazy']); ?>
													<p class="fade-in-left" style="--delay: <?php echo $delay2; ?>s;"><?php echo esc_html($child->name); ?></p>
												</a>

											</div>
										<?php endforeach; ?>
									</div>
									<div class="col-12 col-md-6">
										<?php foreach ($right_col as $child):
											$f = $f + 0.1;
											$delay = 0.1 + $f;
											$delay2 = 0.3 + $f; ?>
											<div class="child-item">
												<a href="<?php echo get_term_link($child); ?>" class="child-item__link">
													<?php echo wp_get_attachment_image(get_field('thumbnail', $child), 'full', false, ['class' => 'img-fluid fade-in-left', 'style' => '--delay: ' . $delay . 's;', 'loading' => 'lazy']); ?>
													<p class="fade-in-left" style="--delay: <?php echo $delay2; ?>s;"><?php echo esc_html($child->name); ?></p>
												</a>
											</div>
										<?php endforeach; ?>
									</div>
								</div>
							</div>
							<?php $first = false;
							$f = 0.1; ?>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>

		<?php if ($cta_message) { ?>
			<div class="cta-message">
				<div class="row gx-5 align-items-center">
					<div class="col-12 col-lg-7">
						<div class="cta-message__text">
							<?php echo $cta_message; ?>
						</div>
					</div>
					<div class="col-12 col-lg">

						<?php echo do_shortcode('[buttons-cta]'); ?>
						<?php /* if (have_rows('buttons')): ?>
						<div class="block-buttons">
							<?php while (have_rows('buttons')):
								the_row();
								$link = get_sub_field('link');
								$theme = get_sub_field('theme');
								$size = get_sub_field('size');
								$nhs_button = get_sub_field('nhs_button');
								if (empty($link)) {
									break;
								}

								$auxSpan = '';
								$auxClassSupport = '';

								if ($nhs_button == 'yes') {
									$theme = 'nhs-blue';
									$auxClassSupport = 'btn--nhs-button-support';
									$auxSpan = '<span class="btn--nhs-button"></span>';
								}

								echo sprintf('<a class="btn btn--%1$s btn--%5$s %6$s" href="%2$s" target="%3$s">%7$s%4$s</a>', $theme, $link['url'], $link['target'], $link['title'], $size, $auxClassSupport, $auxSpan);
								?>
							<?php endwhile; ?>
						</div>
					<?php endif; */ ?>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>

<?php
get_footer();
