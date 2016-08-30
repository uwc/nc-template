<?php
/**
 * Element to output the Text+Image module on section pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package UWC_Website
 */

?>

<section class="section-textimage">
	<div class="section-image" style="background-image: url(<?php

	$image = get_sub_field( 'image' );
	$size = 'medium'; // (thumbnail, medium, large, full or custom size)
	$url = wp_get_attachment_image_src( $image, $size );

	if ( $image ) {

		echo esc_url( $url[0] );

	}

?>)"></div>
	<div class="section-card">
		<h2 class="section-headline"><?php the_sub_field( 'headline' ); ?></h2>
		<p class="section-text"><?php the_sub_field( 'text' ); ?></p>

		<a href="<?php the_sub_field( 'link_url' ); ?>" class="section-link"><?php the_sub_field( 'link_text' ); ?></a>
	</div>
</section>
