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
$heading = $acf_heading ? sprintf('<%1$s class="text-block__heading">%2$s</%1$s>', $heading_size, $acf_heading) : '';

$acf_subheading = get_field('subheading');
$subheading = $acf_subheading ? sprintf('<%1$s class="text-block__subheading">%2$s</%1$s>', $subheading_size, $acf_subheading) : '';

$private_patients_title = get_field('private_patients_title');
$nhs_patients_title = get_field('nhs_patients_title');

?>

<div class="patients-block block block--margin">
	<div class="row">
		<div class="col-12">
			<div class="text-block__header text-center fade-in-top">
				<?php echo $heading; ?>
				<?php if ($subheading) { ?>
					<?php echo $subheading; ?>
				<?php } ?>
			</div>
		</div>
	</div>

	<div class="row g-2">
		<div class="col-12 col-lg-6">
			<div class="private-patients block--padded-sm fade-in-left">
				<div class="heading">
					<p class="private-patients__title text--white"><?php echo $private_patients_title; ?></p>
				</div>
				<div class="row g-2">
					<?php if (have_rows('private_patients_services')): ?>
						<?php while (have_rows('private_patients_services')):
							the_row();
							$title = get_sub_field('title');
							$content = get_sub_field('content');
							$link = get_sub_field('link');
							?>
							<div class="col-12 col-md-6 col-lg-12 col-xl-6 d-flex patients_services-block">
								<div class="patients_services block--bg-white">
									<p class="patients_services__title text--primary"><?php echo $title; ?></p>
									<div class="patients_services__content"><?php echo $content; ?></div>
									<?php if (!empty($link)) {
										echo sprintf('<a class="btn btn--white mt-auto" href="%1$s" target="%2$s">%3$s</a>', $link['url'], $link['target'], $link['title']);
									} ?>
								</div>
							</div>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="col-12 col-lg-6">
			<div class="nhs-patients block--bg-nhs block--padded-sm fade-in-right">
				<div class="heading nhs-heading">
					<p class="private-patients__title text--white"><?php echo $nhs_patients_title; ?></p>
					<img src="<?php echo get_template_directory_uri(); ?>/images/nhs-blue.svg" alt="NHS logo" class="nhs-logo">
				</div>

				<div class="row g-2">
					<?php if (have_rows('nhs_patients_services')): ?>
						<?php while (have_rows('nhs_patients_services')):
							the_row();
							$title = get_sub_field('title');
							$content = get_sub_field('content');
							$link = get_sub_field('link');
							$nhs_button = get_sub_field('nhs_button');
							$auxClass = '';
							$auxClassSupport = '';

							if ($nhs_button == 'yes') {
								$auxClass = 'btn--nhs-button';
								$auxClassSupport = 'btn--nhs-button-support';
							}
							?>
							<div class="col-12 col-md-6 col-lg-12 col-xl-6 d-flex patients_services-block">
								<div class="patients_services block--bg-white">
									<p class="patients_services__title text--nhs-blue"><?php echo $title; ?></p>
									<div class="patients_services__content"><?php echo $content; ?></div>
									<?php if (!empty($link)) {
										echo sprintf('<a class="btn btn--nhs-blue mt-auto %1$s" href="%2$s" target="%3$s"><span class="%5$s"></span>%4$s</a>',$auxClassSupport, $link['url'], $link['target'], $link['title'], $auxClass);
									} ?>
								</div>
							</div>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>