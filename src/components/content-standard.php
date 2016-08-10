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

	<?php
		$text = get_the_content();
		nc_template_content_navigation( $text );
	?>

	<div class="entry-content">
		<?php

			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'nc-template' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'nc-template' ),
				'after'  => '</div>',
			) );
		?>
	</div>
</article><!-- #post-## -->
