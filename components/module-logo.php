<?php
/**
 * Element to output the Logo module on section pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package UWC_Website
 */

?>

<section class="section-logos">

<?php
$headline = get_sub_field( 'lo_headline' );

if ( ! empty( $headline ) ) :
?>

	<h2 class="section-headline"><?php the_sub_field( 'lo_headline' ); ?></h2>

<?php endif; ?>

	<div class="section-logoWrapper">

	<?php
	while ( have_rows( 'lo_logos' ) ) :
		the_row();

		$image = get_sub_field( 'lo_logo' );

		if ( ! empty( $image ) ) :
		?>

			<a class="section-link" href="<?php echo esc_url( the_sub_field( 'lo_url' ) ); ?>" title="<?php echo esc_attr( $image['alt'] ); ?>">

				<img class="section-logo" src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />

			</a>

		<?php endif; ?>

	<?php endwhile; ?>

	</div>
</section>
