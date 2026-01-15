<?php
/**********************************************************
 *
 * File:         Advert CTA
 * Description:  Call to action
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     23/05/2025
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

$courses = get_field('course_grid');

?>

<div class="courses-block block block--margin fade-in-top">
	<div class="row justify-content-center">
		<div class="col-12 col-lg-9">
			<?php if ($courses): ?>
				<div class="row g-3">
					<?php foreach ($courses as $course): ?>
						<?php setup_postdata($course); ?>
						<div class="col-12 col-md-6 col-lg-4">
							<article class="course-card">
								<a href="<?php echo get_permalink($course); ?>" class="text-decoration-none">
									<?php if (has_post_thumbnail($course->ID)): ?>
										<div class="course-image">
											<?php echo get_the_post_thumbnail($course->ID, 'full', ['class' => 'img-fluid', 'loading' => 'lazy']); ?>
											<span class="image-overlay"></span>
										</div>
									<?php endif; ?>

									<?php
									$categories = get_the_terms($course->ID, 'course_category');
									if (!empty($categories) && !is_wp_error($categories)):
										?>
										<span class="course-badge">
											<?php echo esc_html($categories[0]->name); ?>
										</span>
									<?php endif; ?>

									<div class="course-title">
										<p>
											<?php echo get_the_title($course); ?>
										</p>
									</div>
								</a>
							</article>
						</div>
					<?php endforeach; ?>
				</div>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
		</div>
	</div>
</div>