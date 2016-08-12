<?php
/**
 * Template part for displaying posts and pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NC_Template
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php if ( has_post_thumbnail() ) : ?>
	<header class="header -entry -featured" style="background-image: url(<?php the_post_thumbnail_url( 'large' ); ?>)">
<?php else : ?>
	<header class="header -entry -no-featured">
<?php endif; ?>
		<div class="header-outer">
			<div class="header-inner">
				<?php
				if ( is_page() || is_single() ) {
					the_title( '<h1 class="header-title">', '</h1>' );
				} else {
					the_title( '<h2 class="header-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				} ?>
				<h2 class="header-summary"><?php the_excerpt(); ?></h2>
			</div>
		</div>
	</header>

	<div class="entry-content">
		<?php echo '<p><a href="' . esc_url( get_field( 'link_url' ) ) . '" rel="bookmark" target="_blank">' . esc_html__( 'Continue reading', 'nc-template' ) . '...</a></p>'; ?>
	</div>
</article><!-- #post-## -->
