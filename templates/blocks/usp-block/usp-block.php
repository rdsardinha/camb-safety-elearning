<?php
/**********************************************************
 *
 * File:         USP Block
 * Description:  USP block
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     23/05/2025
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

$layout = get_field('layout');

$auxClass = "block--padded-sm block--bg-grey carousel-usp-block";
$heading = '';
$auxCol = 'col-12 col-lg-10';

if ($layout == 'feature') {
	$auxClass = "block--margin feature-usp-block";
	$auxCol = 'col-12';

	$heading_size = get_field('heading_size_usp');
	$acf_heading = get_field('heading_usp');
	$heading = $acf_heading ? sprintf('<%1$s class="text-block__heading">%2$s</%1$s>', $heading_size, $acf_heading) : '';
}

$i = 0;
?>


<div class="usp-block block block--fullwidth <?php echo $auxClass; ?>">
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-12">
				<?php if ($heading) { ?>
					<div class="text-block__header text-center fade-in-top">
						<?php echo $heading; ?>
					</div>
				<?php } ?>
			</div>
			<div class="<?php echo $auxCol; ?>">
				<div class="usp-carousel carousel">
					<div class="row justify-content-between m-auto usp-carousel__carousel">
						<?php while (have_rows('usp', 'options')):
							the_row();
							$icon = get_sub_field('icon');
							$title = get_sub_field('title');
							$description = get_sub_field('description');
							$i++;
							$delay = ($i - 1) * 0.2;
							?>
							<div class="col-12 col-lg-2 usp__item carousel__item">
								<?php echo wp_get_attachment_image($icon, 'full', false, array('class' => 'usp__img img-fluid fade-in-left', 'style' => '--delay: '. $delay .'s;', 'loading' => 'lazy')) ?>
								<div class="usp__content">
									<p class="usp__title text--title mb-0 fade-in-left" style="--delay: <?php echo $delay; ?>s;"><?php echo $title ?></p>
									<?php if ($layout == 'feature') { ?>
										<?php if ($description) { ?>
										<p class="usp__description fade-in-left" style="--delay: <?php echo $delay; ?>s;"><?php echo $description ?></p>
									<?php } ?>
									<?php } ?>
								</div>
							</div>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>