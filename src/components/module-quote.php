<?php
/**
 * Element to output the Quote module on section pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package UWC_Website
 */

?>

<section class="section-quote">
	<blockquote><p><?php the_sub_field( 'quote' ); ?></p></blockquote>
	<?php
	if ( get_sub_field( 'citation' ) ) {
		echo '<cite>' . get_sub_field( 'citation' ) . '</cite>';
	}
	?>
</section>
