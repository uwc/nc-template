<?php
/**
 * The template for displaying category pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package UWC_Website
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="header -entry -no-featured">
				<div class="header-outer">
					<h1 class="header-title"><?php single_cat_title(); ?>
					<h2 class="header-summary"><?php echo category_description(); ?></h2>
				</div>
			</header>
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called element-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				$format = get_post_format() ? : 'standard';
				get_template_part( 'components/element', $format );

			endwhile;

			uwc_website_paginated();

		else :

			get_template_part( 'components/content', 'none' );

		endif; ?>

		</main>
	</div>
<?php
get_footer();
