<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package UWC_Website
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="header -entry -no-featured">
					<div class="header-outer">
						<h1 class="header-title"><?php esc_html_e( '404: Page not found.', 'uwc-website' ); ?></h1>
						<h2 class="header-summary"><p><?php
							echo __( 'Sorry, the page you’re looking for doesn’t exist. Check the URL for errors or try searching for it below.', 'uwc-website' );
						?></p></h2>
					</div>
				</header>

				<div class="entry-content">

					<?php get_search_form(); ?>

				</div>
			</section>
		</main>
	</div>
<?php
get_footer();
