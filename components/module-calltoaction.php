<?php
/**
 * Element to output the Call To Action module on section pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NC_Template
 */

?>

<section class="section-cta">
	<a href="<?php the_sub_field( 'cta_url' ) ?>"><?php the_sub_field( 'cta_text' ) ?></a>
</section>
