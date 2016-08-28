<?php
/**
 * Template part for displaying posts and pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package UWC_Website
 */

?>

<section class="section-video">
	<?php the_field( 'video_url' ); ?>
</section>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'category-post' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
			<a class="category-image" style="background-image: url(<?php the_post_thumbnail_url( 'medium' ); ?>)" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"></a>
	<?php endif; ?>
	<div class="category-text">
		<header class="header -category">
		<?php the_title( '<h2 class="category-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		</header>
		<p class="category-body"><?php the_excerpt(); ?></p>

		<?php echo '<a class="category-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . esc_html__( 'Weiter lesen', 'uwc-website' ) . '</a>'; ?>
	</div>
</article> <!-- // post-## -->

