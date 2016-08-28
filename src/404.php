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
				<header class="entry-header">
					<div class="header-outer">
						<h1 class="entry-title"><?php esc_html_e( '404 Oh crumbs.', 'uwc-website' ); ?></h1>
					</div>

				</header>

				<div class="entry-content">
					<p><?php
						$url = 'http://www.ibo.org/en/programmes/diploma-programme/curriculum/theory-of-knowledge/what-is-tok/';
						$link = sprintf( wp_kses( __( 'Looks like something has gone terribly wrong somewhere in the Internet. As a result, the page you requested isn&rsquo;t available. Or maybe it doesn&rsquo;t exist. Maybe it never existed. Maybe this page is a figment of your imagination. Maybe you are a figment of your own imagination. Did we just blow your mind? Find out more about the <a href="%s">theory of knowledge course</a> at UWC or simply use the search bar below to find what you are looking for.', 'uwc-website' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( $url ) );
					echo $link; // WPCS: XSS ok.
					?></p>

					<?php get_search_form(); ?>

					</div>

				</div>
			</section>
		</main>
	</div>
<?php
get_footer();
