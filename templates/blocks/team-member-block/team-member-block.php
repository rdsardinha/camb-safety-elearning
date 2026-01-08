<?php
/**********************************************************
 *
 * File:         Text block
 * Description:  Text block
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     23/05/2025
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

$heading_size = get_field('heading_size');
$subheading_size = get_field('subheading_size');

$acf_heading = get_field('heading');
$heading = $acf_heading ? sprintf('<%1$s class="text-block__heading fade-in-left" style="--delay: 0.2s;">%2$s</%1$s>', $heading_size, $acf_heading) : '';

$acf_subheading = get_field('subheading');
$subheading = $acf_subheading ? sprintf('<%1$s class="text-block__subheading fade-in-left" style="--delay: 0.4s;">%2$s</%1$s>', $subheading_size, $acf_subheading) : '';

$team_members = get_field('team_members') ?: array();
$add_filters = get_field('add_filters');

$loop_args = array(
	'post_type' => 'echo_teams',
	'post_status' => 'publish',
	'post__in' => $team_members,
	'posts_per_page' => -1,
	'orderby' => 'post__in',
);

$loop = new WP_Query($loop_args);
?>
<div class="team-member-block block block--margin">
	<div class="row g-2">
		<div class="col-12">
			<?php if ($heading) { ?>
				<div class="text-block__header text-center">
					<?php echo $heading; ?>
					<?php if ($subheading) { ?>
						<?php echo $subheading; ?>
					<?php } ?>
				</div>
			<?php } ?>
			<?php /*if ($add_filters) { ?>
<?php echo do_shortcode('[facetwp facet="services_required"]'); ?>
<?php echo do_shortcode('[facetwp facet="team_search"]'); ?>
<?php }*/ ?>
		</div>
		<div class="col-12 facetwp-template">
			<div class="row g-5">

				<?php if ($loop->have_posts()):
					$i = 0; ?>
					<?php while ($loop->have_posts()):
						$loop->the_post();
						$member_position = get_field('member_position', get_the_ID());
						$i++;
						$delay = ($i - 1) * 0.2;
						?>
						<div class="col-12 col-sm-6 col-lg-3">
							<div class="team-member__information fade-in-left" style="--delay: <?php echo $delay; ?>s;">
								<?php if (!empty(get_the_post_thumbnail(get_the_ID()))) { ?>
									<?php echo get_the_post_thumbnail(get_the_ID(), 'full', false, array('class' => 'img-fluid', 'loading' => 'lazy')) ?>
								<?php } else { ?>
									<?php echo wp_get_attachment_image(278, 'full', false, array('class' => 'map-image img-fluid', 'loading' => 'lazy')) ?>
								<?php } ?>

								<p class="team_member-name"><?php echo get_the_title(); ?></p>
								<p class="team_member-position"><?php echo $member_position; ?></p>
								<a type="button" class="btn btn--primary" data-bs-toggle="modal"
									aria-label="Open Biography Modal" data-bs-target="#team-member-<?php echo get_the_ID(); ?>">
									<span>Read my biography</span>
								</a>
							</div>
						</div>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<?php if ($loop->have_posts()): ?>
	<?php while ($loop->have_posts()):
		$loop->the_post();
		$member_position = get_field('member_position', get_the_ID());
		?>

		<!-- Modal -->
		<div class="modal fade" id="team-member-<?php echo get_the_ID() ?>" tabindex="-1"
			aria-labelledby="team-member-<?php echo get_the_ID() ?>-label" aria-hidden="true">
			<div class="modal-dialog">
				<div class="row">
					<div class="col-12 col-lg-4">
						<div class="team-member__information">
							<?php if (!empty(get_the_post_thumbnail(get_the_ID()))) { ?>
								<?php echo get_the_post_thumbnail(get_the_ID(), 'full', false, array('class' => 'img-fluid', 'loading' => 'lazy')) ?>
							<?php } else { ?>
								<?php echo wp_get_attachment_image(278, 'full', false, array('class' => 'map-image img-fluid', 'loading' => 'lazy')) ?>
							<?php } ?>
							<p class="team_member-name text--white"><?php echo get_the_title(); ?></p>
							<p class="team_member-position text--white"><?php echo $member_position; ?></p>
						</div>
					</div>
					<div class="col-12 col-lg-8">
						<div class="modal-content">
							<a class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span>Close</span></a>
							<div class="modal-header">
								<p class="h4">Biography</p>
							</div>
							<div class="modal-body">
								<?php echo get_the_content(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endwhile; ?>
	<?php wp_reset_postdata(); ?>
<?php endif; ?>