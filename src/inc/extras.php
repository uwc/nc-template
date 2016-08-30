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
	if ( 'header' == $args -> theme_location ) {
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
 * @return html Post/page content modified to replace .
 */
function uwc_website_content_anchors( $content ) {
	$content = preg_replace(
		'/<p>\\s*?<a\\s*?id=\"(.*?)\">?\\s*<\\/p>/s',
		'Forth-tag',
		$content
	);
	return $content;
}
add_filter( 'the_content', 'uwc_website_content_anchors' );

/**
 * Synchronize the page hierarchy when the menu structure is changed.
 * From https://www.wp-code.com/wordpress-snippets/synchronize-a-menu-with-your-page-hierarchy/
 *
 * @param integer $menu_id The id of the menu to be kept in sync.
 * @param array   $menu_data Array with data of the menu to be kept in sync.
 */
function uwc_website_hierarchy_from_menu( $menu_id, $menu_data = null ) {

	$term = get_term_by( 'name', 'Header', 'nav_menu' );
	$sync_menu_id = $term->term_id;

	if ( $sync_menu_id != $menu_id ) {  // You should update this integer to the id of the menu you want to keep in sync.
		return; }
	if ( null !== $menu_data ) { // If $menu_data !== null, this means the action was fired in nav-menu.php, BEFORE the menu items have been updated, and we should ignore it.
		return; }
	$menu_details = get_term_by( 'id', $menu_id, 'nav_menu' );
	if ( $items = wp_get_nav_menu_items( $menu_details->term_id ) ) {
		// Create an index of menu item IDs, so we can find parents easily.
		foreach ( $items as $key => $item ) {
			$item_index[ $item->ID ] = $key; }
		// Loop through each menu item.
		foreach ( $items as $item ) {
			// Only proceed if we're dealing with a page.
			if ( 'page' == $item->object ) {
				// Get the details of the page.
				$post = get_post( $item->object_id, ARRAY_A );
				if ( 0 != $item->menu_item_parent ) {
					// This is not top-level menu items, so we need to find the parent page.
					if ( 'page' != $items[ $item_index[ $item->menu_item_parent ] ]->object ) {
						// The parent isn't a page. Queue an error message.
						global $messages;
						$messages[] = '<div id="message" class="error"><p>' . sprintf( __( 'The parent of <strong>%1$1s</strong> is <strong>%2$2s</strong>, which is not a page, which means that this part of the menu cannot sync with your page hierarchy.', 'uwc-website' ), $item->title, $items[ $item_index[ $item->menu_item_parent ] ]->title ) . '</p></div>';
						$new_post['post_parent'] = new WP_Error;
					} else { 					// Get the new parent page from the index.
						$new_post['post_parent'] = $items[ $item_index[ $item->menu_item_parent ] ]->object_id;
					}
				} else { 				$new_post['post_parent'] = 0; // Top-level menu item, so the new parent page is 0.
				}			if ( ! is_wp_error( $new_post['post_parent'] ) ) {
						$new_post['ID'] = $post['ID'];
						$new_post['menu_order'] = $item->menu_order;
					if ( $new_post['menu_order'] !== $post['menu_order'] || $new_post['post_parent'] !== $post['post_parent'] ) {
						// Only update the page if something has changed.
						wp_update_post( $new_post ); }
				}
			}
		}
	}
}
add_action( 'wp_update_nav_menu', 'uwc_website_hierarchy_from_menu', 10, 2 );
