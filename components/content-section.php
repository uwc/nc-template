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

	<?php if ( is_front_page() && has_post_thumbnail() ) : ?>
		<header class="entry-header featured-image">
			<div class="entry-photo">
				<?php the_post_thumbnail(); ?>
			</div>
			<div class="header-outer">
				<div class="header-inner">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					<h2>
						<?php the_excerpt(); ?>
					</h2>
					<a href="<?php the_field( 'cta_url' ) ?>" class="button"><?php the_field( 'cta_text' ) ?></a>

				</div>
			</div>
		</header>
	<?php elseif ( ! is_front_page() && has_post_thumbnail() ) : ?>
		<header class="entry-header featured-image">
			<div class="entry-photo">
				<?php the_post_thumbnail(); ?>
			</div>
			<div class="header-outer">
				<div class="header-inner">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					<?php wp_list_pages( array(
						'child_of'    => $post->ID,
						'depth'       => 1,
						'title_li'    => '',
						'link_after'  => ' →',
					) ); ?>
				</div>
			</div>
		</header>
	<?php else : ?>
		<header class="entry-header">
			<div class="header-outer">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<?php wp_list_pages( array(
					'child_of'    => $post->ID,
					'depth'       => 1,
					'title_li'    => '',
					'link_after'  => ' →',
				) ); ?>
			</div>
		</header>
	<?php endif; ?>

	<div class="section-content">

		<?php
			// check if the flexible content field has rows of data
		if ( have_rows( 'modules' ) ) :

			// loop through the rows of data
			while ( have_rows( 'modules' ) ) : the_row();

				if ( get_row_layout() == 'text_image' ) :
					get_template_part( 'components/element', 'textimage' );

				elseif ( get_row_layout() == 'quote' ) :

					get_template_part( 'components/element', 'quote' );

				elseif ( get_row_layout() == 'call_to_action' ) :

					get_template_part( 'components/element', 'calltoaction' );

				elseif ( get_row_layout() == 'video' ) :

					get_template_part( 'components/element', 'video' );

				endif;

				endwhile;

			else :

				get_template_part( 'components/content', 'none' );

			endif;
		?>

		<?php get_template_part( 'components/element', 'newsfeed' ); ?>
	</div>
</article><!-- #post-## -->
