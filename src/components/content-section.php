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
	<header class="header -section -featured" style="background-image: url(<?php the_post_thumbnail_url(); ?>)">
<?php else : ?>
	<header class="header -section -no-featured">
<?php endif; ?>
		<div class="header-outer">
			<div class="header-inner">
				<?php the_title( '<h1 class="header-title">', '</h1>' ); ?>
				<?php if ( is_front_page() ) : ?>
					<h2 class="header-summary">
						<?php the_excerpt(); ?>
					</h2>
					<a href="<?php the_field( 'cta_url' ) ?>" class="header-button"><?php the_field( 'cta_text' ) ?> →</a>
				<?php else : ?>
					<nav class="header-navigation">
						<ul class="header-links">
							<?php wp_list_pages( array(
								'child_of'    => $post->ID,
								'depth'       => 1,
								'title_li'    => '',
								'link_after'  => ' →',
								'sort_column' => 'menu_order',
							) ); ?>
						</ul>
					</nav>
				<?php endif; ?>
			</div>
		</div>
	</header>

	<div class="section-content">

		<?php
			// Check if the flexible content field has rows of data.
		if ( have_rows( 'modules' ) ) :

			// Loop through the rows of data.
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
