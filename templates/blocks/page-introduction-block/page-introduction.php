<?php
/**********************************************************
 *
 * File:         Page Title
 * Description:  Title block banner
 * Author:       Echo Web Solutions
 * Version:      v0.2
 * Modified:     23/05/2025
 *
 **********************************************************/
defined('ABSPATH') or die('No script kiddies please!');

$content = get_field('content');
?>
<div class="page-introduction-block block block--fullwidth block--padded-md">
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-12 fade-in-top">
				<?php echo $content; ?>
			</div>
		</div>
	</div>
</div>