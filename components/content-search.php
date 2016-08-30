<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package UWC_Website
 */

?>


<article id="post-<?php the_ID(); ?>" <?php post_class( 'search-result' ); ?>>
	<a href="<?php esc_url( the_permalink() ); ?>" rel="bookmark">
		<?php the_title( '<h2 class="result-title">', '</h2>' ); ?>
		<p class="result-link"><?php the_permalink(); ?></p>
		<div class="result-summary">
			<?php the_excerpt(); ?>
		</div>
	</a>
</article>
