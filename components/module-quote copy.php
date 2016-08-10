<?php
/**
 * Element to output the Quote module on section pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NC_Template
 */

?>

<section class="section-googlemaps">
	<?php

	$location = get_sub_field( 'google_maps' );

	if ( ! empty( $location ) ) :
		?>
		<div class="acf-map">
		<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
	</div>
	<?php endif; ?>
</section>
