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
 * @param int $length Length of the excerpt.
 */
function nc_template_excerpt_length( $length ) {
	return 32;
}
add_filter( 'excerpt_length', 'nc_template_excerpt_length', 999 );

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function nc_template_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'nc_template_excerpt_more' );

/**
 * Filter the content to remove p tags around images.
 *
 * @param html $content The post/page content as html.
 * @return html Post/page content modified to remove p tags around images.
 */
// function nc_template_content_images( $content ){
//    return preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
// }


/**
 * Wrap the inserted image html with <figure> 
 * if the theme supports html5 and the current image has no caption:
 *
 * @param html $content The post/page content as html.
 * @return html Post/page content modified to wrap images in figure tags.
 */     
/* function nc_template_content_images ( $content )
{ 
    $content = preg_replace( 
        '/<p>\\s*?(<a rel=\"attachment.*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s', 
        '<figure>$1</figure>', 
        $content 
    ); 
    return $content; 
} */


function nc_template_content_images ( $content ) {
	$dom = new DOMDocument();
	$dom -> loadHTML( $content );
	$nodes = $dom->getElementsByTagName( 'img' );

	$items = array();
	foreach ( $nodes as $node ) {
		$parent = $node->parentNode;
		if ( $parent -> tagName == 'p' ) {
	    	$class = $node -> getAttribute( 'class' );
	    }
	}
}
// add_filter( 'the_content', 'nc_template_content_images', 99 );


// $dom = new DOMDocument();
// $dom -> loadHTML( $content );
// $nodes = $dom->getElementsByTagName( 'img' );
// $items = array();
// foreach ( $nodes as $node ) {
// 	if ( $node -> hasAttribute( 'id' ) == true ) {
//     	$items[] = $node -> getAttribute( 'id' );
//     }
// }
// if ( count( $items ) != 0 ) {
// 	echo '<nav class="navigation content-navigation">';
// 	echo '<h6 class="nav-header">Inhalt</h6>';
// 	echo '<div class="nav-links">';
// 	foreach ( $items as $item ) {
// 		echo '<a href="#', $item, '" title="', $item, '" data-scroll>', $item, ' ↓</a>';
// 	}
// 	echo '</nav>';
// }


// x. DOMDocument with $content
// x. get all img nodes
// x. Get all parent node tag names
// x. for all elements where the parent node is a p element: 
// 	x. get the img class attribute 
// 	b. remove parent node 
// 	c. output new node with figure (including class) and img tag
// 5. return $content
