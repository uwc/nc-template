<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NC_Template
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<header class="entry-header featured-image">
			<div class="entry-photo">
				<?php the_post_thumbnail(); ?>
			</div>
			<div class="header-outer">
				<div class="header-inner">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					<h2 class="entry-summary"><?php the_excerpt(); ?></h2>
				</div>
			</div>
		</header>
	<?php else : ?>
		<header class="entry-header">
			<div class="header-outer">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<h2 class="entry-summary"><?php the_excerpt(); ?></h2>
			</div>
		</header>
	<?php endif; ?>

	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'nc-template' ),
				'after'  => '</div>',
			) );
		?>
	</div>
	<footer class="entry-footer">
		<!-- Prev and next links -->
	</footer>
</article><!-- #post-## -->
