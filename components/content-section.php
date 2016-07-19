<?php
/**
 * Template part for displaying section pages.
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
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'nc-template' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );		?>
	</div>
</article><!-- #post-## -->
