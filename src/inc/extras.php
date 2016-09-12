<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package UWC_Website
 */

/**
 * Adds the search icon to the navigation menu on desktop.
 * From https://wordpress.stackexchange.com/questions/15455/how-to-hard-code-custom-menu-items
 *
 * @param array $items List elements in the menu.
 * @param array $args Menu arguments for theme location.
 */
function uwc_website_nav_menu_items( $items, $args ) {
	if ( 'menu-header' == $args -> menu_class ) {
		$addmenu = '<li id="menu-item-search" class="menu-item"><a id="js-searchOpen" href="#"><span class="screen-reader-text">' . __( 'Search', 'uwc-website' ) . '</span></a></li>';
		return $items . $addmenu;
	} else {
		return $items;
	}
}
add_filter( 'wp_nav_menu_items','uwc_website_nav_menu_items', 10, 2 );

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
 * From https://stackoverflow.com/questions/18875400/display-current-parent-and-its-sub-menu-only-wordpress
 *
 * @param array $sorted_menu_items The sorted menu defined in the wp_nav_menu.
 * @param array $args The arguments defined in the wp_nav_menu call.
 */
function uwc_website_wp_nav_menu_objects_sub_menu( $sorted_menu_items, $args ) {
	if ( isset( $args->sub_menu ) ) {
		$root_id = 0;
		// Find the current menu item.
		foreach ( $sorted_menu_items as $menu_item ) {
			if ( $menu_item->current ) {
			// Set the root id based on whether the current menu item has a parent or not.
			$root_id = ( $menu_item->menu_item_parent ) ? $menu_item->menu_item_parent : $menu_item->ID;
			break;
		}
	}

	// Find the top level parent.
	if ( ! isset( $args->direct_parent ) ) {
		$prev_root_id = $root_id;
		while ( 0 != $prev_root_id ) {
			foreach ( $sorted_menu_items as $menu_item ) {
				if ( $menu_item->ID == $prev_root_id ) {
					$prev_root_id = $menu_item->menu_item_parent;
					// Don't set the root_id to 0 if we've reached the top of the menu.
					if ( 0 != $prev_root_id ) $root_id = $menu_item->menu_item_parent;
					break;
					}
				}
			}
		}

		$menu_item_parents = array();
		foreach ( $sorted_menu_items as $key => $item ) {
			// Init menu_item_parents.
			if ( $item->ID == $root_id ) $menu_item_parents[] = $item->ID;

				if ( in_array( $item->menu_item_parent, $menu_item_parents ) ) {
					// Part of sub-tree: keep!
					$menu_item_parents[] = $item->ID;
				} else if ( ! ( isset( $args->show_parent ) && in_array( $item->ID, $menu_item_parents ) ) ) {
					// Not part of sub-tree: away with it!
					unset( $sorted_menu_items[ $key ] );
				}
			}
			return $sorted_menu_items;
		} else {
		return $sorted_menu_items;
	}
}
add_filter( 'wp_nav_menu_objects', 'uwc_website_wp_nav_menu_objects_sub_menu', 10, 2 );
