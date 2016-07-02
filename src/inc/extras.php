<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package NC_Template
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function nc_template_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'nc_template_body_classes' );

/**
 * Adds the search icon to the navigation menu on desktop.
 * From https://wordpress.stackexchange.com/questions/15455/how-to-hard-code-custom-menu-items
 *
 * @param array $items List elements in the menu.
 * @param array $args Menu arguments for theme location.
 */
function nc_template_nav_menu_items( $items, $args ) {
	if ( 'header' == $args -> theme_location ) {
		$addmenu = '<li id="menu-item-search" class="menu-item"><a href=""><span class="screen-reader-text">' . __( 'Search', 'nc-template' ) . '</span></a></li>';
		return $items.$addmenu;
	} else {
		return $items;
	}
}
add_filter( 'wp_nav_menu_items','nc_template_nav_menu_items', 10, 2 );

/**
 * Limits the length of excerpts to 32 words.
 * See https://codex.wordpress.org/Plugin_API/Filter_Reference/excerpt_length
 *
 * @param $length Length of the excerpt.
 */
function nc_template_excerpt_length( $length ) {
	return 32;
}
add_filter( 'excerpt_length', 'nc_template_excerpt_length', 999 );
