<?php
/**
 * Element to output the Google Maps module on section pages.
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
			<div class="marker" data-lat="<?php echo esc_html( $location['lat'] ); ?>" data-lng="<?php echo esc_html( $location['lng'] ); ?>">
				<?php
				if ( get_sub_field( 'link_url' ) ) {
					echo '<a href="' . esc_url( get_sub_field( 'link_url' ) ) . '"><h4 class="section-header">' . esc_html( get_sub_field( 'title' ) ) . '</h4></a>';
				} else {
					echo '<h4 class="section-header">' . esc_html( get_sub_field( 'title' ) ) . '</h4>';
				}
				?>
				<p class="address"><?php the_sub_field( 'description' ); ?></p>
			</div>
		<?php endwhile; ?>
		</div>
	<?php endif; ?>
	</div>
</section>
