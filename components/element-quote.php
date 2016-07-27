<?php
/**
 * Element to output the Quote module on section pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NC_Template
 */
?>

<blockquote><?php the_sub_field( 'quote' ); ?></blockquote>
<?php if ( get_sub_field( 'citation' ) ) {
	echo '<cite>' . the_sub_field( 'citation' ) . '</cite>';
}
?>
