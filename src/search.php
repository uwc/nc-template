<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package UWC_Website
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="search-header">
				<div class="search-wrapper">
					<?php get_search_form(); ?>
				</div>
				<h1 class="search-title"><?php printf( esc_html__( 'Search results for &#x201c;%s&#x201d;:', 'uwc-website' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header>
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'components/content', 'search' );

			endwhile;

			uwc_website_paginated();

		else :

			get_template_part( 'components/content', 'none' );

		endif; ?>

		</main>
	</section>
<?php
get_footer();
