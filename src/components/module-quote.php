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
	<blockquote><p><?php the_sub_field( 'quote' ); ?></p>
		<?php
		if ( get_sub_field( 'citation' ) ) {
			echo '<cite>' . esc_html( get_sub_field( 'citation' ) ) . '</cite>';
		}
		?>
	</blockquote>
</section>
