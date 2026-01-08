<?php
/**********************************************************
 *
 * File:         Page Header
 * Description:  Page Header
 * Author:       Echo Web Solutions
 * Version:      v0.1
 * Modified:     10/06/24
 *
 **********************************************************/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$divider_colour = get_field( "divider_colour" );
?>

<div class="divider-block block">
	<div class="row">
		<div class="col-12">
			<hr class="separator separator--<?php echo $divider_colour; ?>">
		</div>
	</div>
</div>
