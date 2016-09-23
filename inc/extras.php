<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package UWC_Website
 */

/**
 * Limits the length of excerpts to 32 words.
 * See https://codex.wordpress.org/Plugin_API/Filter_Reference/excerpt_length
 *
 * @param int $length Length of the excerpt.
 */
function uwc_website_excerpt_length( $length ) {
	return 32;
}
add_filter( 'excerpt_length', 'uwc_website_excerpt_length', 999 );

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function uwc_website_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'uwc_website_excerpt_more' );

/**
 * Wrap the inserted image html with <figure> if the current image has no caption.
 *
 * @param html $content The post/page content as html.
 * @return html Post/page content modified to wrap images in figure tags.
 */
function uwc_website_content_images( $content ) {
	$content = preg_replace(
		'/<p>\\s*?(<img\\s*?class=\"(.*?)\".*?>)?\\s*<\\/p>/s',
		'<figure class="$2$3">$1</figure>',
		$content
	);
	return $content;
}
add_filter( 'the_content', 'uwc_website_content_images' );

/**
 * Replace spaces with dashes in anchor tags.
 *
 * @param html $content The post/page content as html.
 * @return html Post/page content modified to urlencode anchor ids.
 */
function uwc_website_content_anchors( $content ) {
	$content = preg_replace_callback(
		'/<a id=\"([^\"]*)\"><\/a>/iU',
		function ( $matches ) {
			return '<a id="' . urlencode( $matches[1] ) . '"></a>';
		},
		$content
	);
	return $content;
}
add_filter( 'the_content', 'uwc_website_content_anchors' );

/**
 * Output a submenu with the child pages of the current page.
 * Adapted from http://christianvarga.com/how-to-get-submenu-items-from-a-wordpress-menu-based-on-parent-or-sibling/
 *
 * @param array $sorted_menu_items The sorted menu defined in the wp_nav_menu.
 * @param array $args The arguments defined in the wp_nav_menu call.
 */
function uwc_website_wp_nav_menu_objects_sub_menu( $sorted_menu_items, $args ) {
	if ( ! isset( $args->sub_menu ) ) {
		return $sorted_menu_items;
	}
	$root_id = 0;

	// Find the current menu item.
	foreach ( $sorted_menu_items as $menu_item ) {
		if ( $menu_item->current ) {
			// Set the root id based on whether the current menu item has a parent or not.
			$root_id = ( $menu_item->menu_item_parent ) ? $menu_item->menu_item_parent : $menu_item->ID;
			break;
		}
	}

	$menu_item_parents = array();
	foreach ( $sorted_menu_items as $key => $item ) {
		  // Init menu_item_parents.
		if ( $item->ID === $root_id ) {
			$menu_item_parents[] = $item->ID;
		}
		if ( in_array( $item->menu_item_parent, $menu_item_parents ) ) {
			// Part of sub-tree: keep!
			$menu_item_parents[] = $item->ID;
		} elseif ( ! ( isset( $args->show_parent ) && in_array( $item->ID, $menu_item_parents ) ) ) {
			// Not part of sub-tree: away with it!
			unset( $sorted_menu_items[ $key ] );
		}
	}
	return $sorted_menu_items;
}
add_filter( 'wp_nav_menu_objects', 'uwc_website_wp_nav_menu_objects_sub_menu', 10, 2 );
