<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package UWC_Website
 */

if ( ! function_exists( 'uwc_website_custom_logo' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function uwc_website_custom_logo() {
		/* Try to retrieve the Custom Logo. */
		$output = '';
		if ( function_exists( 'get_custom_logo' ) ) {
			$output = get_custom_logo();
		}

		/**
		 * Nothing in the output:
		 * Custom Logo is not supported, or there is no selected logo.
		 * In both cases we display the site's name.
		 */
		if ( empty( $output ) ) {
			$output = '<h1 class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '">' . get_bloginfo( 'name' ) . '</a></h1>';
		}

		echo $output; // WPCS: XSS ok.
	}
endif;

if ( ! function_exists( 'uwc_website_page_navigation' ) ) :
	/**
	 * Prints HTML with links to previous and next pages for the current page.
	 */
	function uwc_website_page_navigation() {
		$test = wp_get_nav_menu_items( 'header' );

		$pagelist = get_pages( array(
			'sort_column' => 'menu_order',
			'sort_order' => 'asc',
		) );
		$pages = array();
		foreach ( $pagelist as $page ) {
			$pages[] += $page->ID;
		}

		$current = array_search( get_the_ID(), $pages );
		$prev_id = $pages[ $current - 1 ];
		$next_id = $pages[ $current + 1 ];

		echo '<nav class="post-navigation">';
		echo '<h2 class="screen-reader-text">Beitragsnavigation</h2>';
		if ( ! empty( $prev_id ) ) {
			echo '<div class="nav-previous">';
			echo '<a href="', esc_url( get_permalink( $prev_id ) ), '" title="', get_the_title( $prev_id ), '">', get_the_title( $prev_id ), '</a>';
			echo '</div>';
		}
		if ( ! empty( $next_id ) ) {
			echo '<div class="nav-next">';
			echo '<a href="', esc_url( get_permalink( $next_id ) ), '" title="', get_the_title( $next_id ), '">', get_the_title( $next_id ), '</a>';
			echo '</div>';
		}
		echo '</nav>';
	}
endif;

if ( ! function_exists( 'uwc_website_paginated' ) ) :
	/**
	 * Prints HTML with links to previous and next pages for the current page.
	 */
	function uwc_website_paginated() {
		global $wp_query;
		$big = 99999;

		echo '<nav class="post-navigation">';
		echo '<h2 class="screen-reader-text">Beitragsnavigation</h2>';
		echo wp_kses( paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var( 'paged' ) ),
			'total' => $wp_query -> max_num_pages,
		) ) );
		echo '</nav>';
	}
endif;

if ( ! function_exists( 'uwc_website_content_navigation' ) ) :
	/**
	 * Adds content navigation to pages and posts that have anchor tags.
	 *
	 * @param string $text The page/post content to be parsed.
	 */
	function uwc_website_content_navigation( $text ) {

		$dom = new DOMDocument();
		$dom -> loadHTML( '<?xml encoding="utf-8" ?>' . $text );
		$nodes = $dom->getElementsByTagName( 'a' );
		$items = array();
		foreach ( $nodes as $node ) {
			if ( $node -> hasAttribute( 'id' ) == true ) {
				$id = $node -> getAttribute( 'id' );
				$items[] = html_entity_decode( $id );
			}
		}
		if ( count( $items ) != 0 ) {
			echo '<nav class="entry-navigation">';
			echo '<h6>Inhalt</h6>';
			echo '<div class="entry-links">';
			foreach ( $items as $item ) {
				echo '<a href="#', intval( $item ), '" title="', intval( $item ), '" data-scroll>', intval( $item ), '</a>';
			}
			echo '</nav>';
		}
	}
endif;

if ( ! function_exists( 'uwc_website_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function uwc_website_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

			$posted_on = sprintf(
				esc_html_x( 'Posted on %s', 'post date', 'uwc-website' ),
				'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
			);

			$byline = sprintf(
				esc_html_x( 'by %s', 'post author', 'uwc-website' ),
				'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
			);

			echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function uwc_website_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'uwc_website_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'uwc_website_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so uwc_website_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so uwc_website_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in uwc_website_categorized_blog.
 */
function uwc_website_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'uwc_website_categories' );
}
add_action( 'edit_category', 'uwc_website_category_transient_flusher' );
add_action( 'save_post',     'uwc_website_category_transient_flusher' );
