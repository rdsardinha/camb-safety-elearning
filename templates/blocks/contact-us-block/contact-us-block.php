<?php
/**********************************************************
 *
 * File:         Contact Us
 * Description:  Contact Us
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     23/05/2025
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

$heading_size = get_field('heading_size_contact');

$acf_heading = get_field('heading_contact');
$heading = $acf_heading ? sprintf('<%1$s class="text-block__heading text--white fade-in-left" style="--delay: 0.2s;">%2$s</%1$s>', $heading_size, $acf_heading) : '';

$content = get_field('content_contact');
$contact_form = get_field('form_contact');
?>

<div class="contact-us-block block--fullwidth block block--padded">
	<div class="container-fluid">
		<div class="row g-5 justify-content-between">
			<div class="col-12">
				<?php if ($heading) { ?>
					<div class="text-block__header">
						<?php echo $heading; ?>
						<?php if ($content) { ?>
							<div class="text-block__subheading fade-in-left" style="--delay: 0.4s;">
								<?php echo $content; ?>
							</div>
						<?php } ?>
					</div>
				<?php } ?>

				<?php echo do_shortcode('[contact-form-7 id="' . $contact_form . '" title="Contact Us Form"]'); ?>
			</div>
		</div>
	</div>
</div>