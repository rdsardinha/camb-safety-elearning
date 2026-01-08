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
$heading = $acf_heading ? sprintf('<%1$s class="text-block__heading text--white fade-in-top">%2$s</%1$s>', $heading_size, $acf_heading) : '';

$acf_subheading = get_field('subheading');
$subheading = $acf_subheading ? sprintf('<%1$s class="text-block__subheading text--white fade-in-top" style="--delay: 0.2s;">%2$s</%1$s>', $subheading_size, $acf_subheading) : '';

$tabs = get_field('tabs');
?>

<div class="services-block block--fullwidth block block--padded fade-in-left" style="--delay: 2;">
	<div class="container-fluid">
		<div class="row mb-3">
			<div class="col-12">
				<div class="text-block__header">
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
						foreach ($tabs as $tab):
							$active_class = $first ? 'active' : '';
							$title = $tab['tab_button'];
							$i++;
							$delay = ($i - 1) * 0.1;
							?>
							<button class="nav-link <?php echo $active_class; ?> fade-in-left"
								style="--delay: <?php echo $delay; ?>s;" id="v-pills-<?php echo $i; ?>-tab"
								data-bs-toggle="pill" data-bs-target="#v-pills-<?php echo $i; ?>" type="button" role="tab"
								aria-controls="v-pills-<?php echo $i; ?>"
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
						$i = 0;
						foreach ($tabs as $tab):
							$active_class = $first ? 'show active' : '';
							$content = $tab['content'];
							$i++;
							?>
							<div class="tab-pane fade <?php echo $active_class; ?>" id="v-pills-<?php echo $i; ?>"
								role="tabpanel" aria-labelledby="v-pills-<?php echo $i; ?>-tab">
								<div class="child-item fade-in-left">
									<?php echo $content; ?>
								</div>
							</div>
							<?php $first = false; ?>
						<?php endforeach;
						 ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>