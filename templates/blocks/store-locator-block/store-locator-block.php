<?php
/**********************************************************
 *
 * File:         Store Locator Block
 * Description:  Store Locator Block
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     23/05/2025
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

$heading_size = get_field('heading_size_text');
$subheading_size = get_field('subheading_size_text');

$acf_heading = get_field('heading_text');
$heading = $acf_heading ? sprintf('<%1$s class="text-block__heading text--white fade-in-left" style="--delay: 0.2s;">%2$s</%1$s>', $heading_size, $acf_heading) : '';

$acf_subheading = get_field('subheading_text');
$subheading = $acf_subheading ? sprintf('<%1$s class="text-block__subheading text--white fade-in-left" style="--delay: 0.4s;">%2$s</%1$s>', $subheading_size, $acf_subheading) : '';

$store_locator_shortcode = get_field('store_locator_shortcode');
?>

<div class="find-store block block--padded bg-find-store block--fullwidth">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<?php if ($heading) { ?>
					<div class="text-block__header">
						<?php echo $heading; ?>
						<?php if ($subheading) { ?>
							<?php echo $subheading; ?>
						<?php } ?>
					</div>
				<?php } ?>
				<div class=" fade-in-left" style="--delay: 0.6s;">
					<?php echo do_shortcode('' . $store_locator_shortcode . ''); ?>
				</div>
			</div>
		</div>
	</div>
</div>