<?php
/**
 * Element to output the Quote module on section pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package UWC_Website
 */

?>

<section class="section-googlemaps">
	<div class="section-wrapper">
	<?php if ( have_rows( 'locations' ) ) : ?>
		<div class="acf-map">
		<?php while ( have_rows( 'locations' ) ) : the_row();

			$location = get_sub_field( 'location' );

			?>
			<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
				<h4 class="section-header"><?php the_sub_field( 'title' ); ?></h4>
				<p class="address"><?php the_sub_field( 'description' ); ?></p>
			</div>
		<?php endwhile; ?>
		</div>
	<?php endif; ?>
	</div>
</section>
