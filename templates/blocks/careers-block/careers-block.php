<?php
/**********************************************************
 *
 * File:         Careers
 * Description:  Careers
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     23/05/2025
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

$heading_size = get_field('heading_size_faq');

$acf_heading = get_field('heading_text_faq');
$heading = $acf_heading ? sprintf('<%1$s class="text-block__heading fade-in-left" style="--delay: 0.2;">%2$s</%1$s>', $heading_size, $acf_heading) : '';

$vacancy = get_field('vacancy');

$acf_heading_form = get_field('form_heading');
$heading_form = $acf_heading_form ? sprintf('<h3 class="text-block__heading text--white fade-in-left" style="--delay: 0.2s;">%1$s</h3>', $acf_heading_form) : '';

$content_form = get_field('form_content');
$contact_form = get_field('form');
?>

<div class="careers-block block block--margin">
	<div class="row justify-content-center">
		<div class="col-12">
			<?php if ($heading) { ?>
				<div class="text-block__header mb-0">
					<?php echo $heading; ?>
					<div class="col-12">
						<hr class="separator separator--primary mb-0">
					</div>
				</div>
			<?php } ?>
			<div class="vacancy_block">
				<?php if ($vacancy):
					$i = 0; ?>
					<?php foreach ($vacancy as $indv_vacancy):
						$location = get_field('location', $indv_vacancy->ID);
						$salary = get_field('salary', $indv_vacancy->ID);
						$contract_type = get_field('contract_type', $indv_vacancy->ID);
						$posted_date = get_field('posted', $indv_vacancy->ID);
						$content = get_field('content', $indv_vacancy->ID);
						$link_to_apply = get_field('link_to_apply', $indv_vacancy->ID);

						if ($link_to_apply) {
							$url = $link_to_apply['url'];
							$target = $link_to_apply['target'];
							$url_title = $link_to_apply['title'];
						}

						$auxMargin = 'mb-0';
						$i++;
						$delay = ($i - 1) * 0.2;
						if ($content) {
							$auxMargin = '';
						}
						?>
						<div class="vacancy_block__item fade-in-left" style="--delay: <?php echo $delay; ?>s;">
							<h4><?php echo esc_html($indv_vacancy->post_title); ?></h4>

							<div class="vacancy_header <?php echo $auxMargin; ?>">
								<div>
									<p><span>Location:</span> <?php echo esc_html($location); ?></p>
									<p><span>Salary:</span> <?php echo esc_html($salary); ?></p>
								</div>
								<div>
									<p><span>Contract type:</span> <?php echo esc_html($contract_type); ?></p>
									<?php if ($posted_date) { ?>
										<p><span>Closing Date:</span> <?php echo esc_html($posted_date); ?></p>
									<?php } ?>
								</div>
								<?php if ($link_to_apply): ?>
									<a class="btn btn--secondary" href="<?php echo esc_url($url); ?>"
										target="<?php echo esc_attr($target); ?>">
										<?php echo esc_html($url_title); ?>
									</a>
								<?php endif; ?>
							</div>
							<?php if ($content): ?>
								<div class="vacancy_content">
									<?php echo $content; ?>
								</div>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<div class="vacancy_block__item">
						<p class="mb-0">No vacancies at the moment.</p>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<div class="contact-us-block block--fullwidth block block--padded">
	<div class="container-fluid">
		<div class="row g-5 justify-content-between">
			<div class="col-12">
				<?php if ($heading_form) { ?>
					<div class="text-block__header">
						<?php echo $heading_form; ?>
						<?php if ($content_form) { ?>
							<div class="text-block__subheading fade-in-left" style="--delay: 0.2s;">
								<?php echo $content_form; ?>
							</div>
						<?php } ?>
					</div>
				<?php } ?>

				<?php echo do_shortcode('[contact-form-7 id="' . $contact_form . '" title="Contact Us Form"]'); ?>
			</div>
		</div>
	</div>
</div>