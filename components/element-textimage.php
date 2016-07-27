<?php
/**
 * Element to output the Text+Image module on section pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NC_Template
 */

$image = get_sub_field( 'image' );
$size = 'full'; // (thumbnail, medium, large, full or custom size)

echo wp_get_attachment_image( $image, $size );
?>

<h2><?php the_sub_field( 'text' ); ?></h2>
