<?php
/**
 * Element to output the Text+Image module on section pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NC_Template
 */

?>

<section class="section-textimage">
	<div class="section-image" style="background-image: url(<?php the_sub_field( 'image' ); ?>)"></div>
	<div class="section-card">
		<h2 class="section-headline"><?php the_sub_field( 'headline' ); ?></h2>
		<p class="section-text"><?php the_sub_field( 'text' ); ?></p>

		<a href="<?php the_sub_field( 'link_url' ); ?>" class="section-link"><?php the_sub_field( 'link_text' ); ?></a>
	</div>
</section>
