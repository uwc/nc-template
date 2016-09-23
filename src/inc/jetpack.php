<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package UWC_Website
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.me/support/infinite-scroll/
 * See: https://jetpack.me/support/responsive-videos/
 */
function uwc_website_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'uwc_website_infinite_scroll_render',
		'footer'    => 'page',
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Social Menus.
	add_theme_support( 'jetpack-social-menu' );

	// Add theme support for site logos.
	add_image_size( 'uwc-website-logo', 200, 200 );
	add_theme_support( 'site-logo', array( 'size' => 'uwc-website-logo' ) );
}
add_action( 'after_setup_theme', 'uwc_website_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function uwc_website_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) {
			get_template_part( 'components/post/content', 'search' );
			return;
		}
		get_template_part( 'components/post/content', get_post_format() );
	}
}

/**
 * Return early if Site Logo is not available.
 */
function uwc_website_the_site_logo() {
	if ( ! function_exists( 'jetpack_the_site_logo' ) ) {
		return;
	}
	jetpack_the_site_logo();
}

/**
 * Return early if Social Menu is not available.
 */
function uwc_website_social_menu() {
	if ( ! function_exists( 'jetpack_social_menu' ) ) {
		return;
	}
	jetpack_social_menu();
}
