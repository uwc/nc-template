<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package NC_Template
 */

if ( ! function_exists( 'nc_template_custom_logo' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function nc_template_custom_logo() {
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

if ( ! function_exists( 'nc_template_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function nc_template_posted_on() {
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
		esc_html_x( 'Posted on %s', 'post date', 'nc-template' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'nc-template' ),
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
function nc_template_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'nc_template_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'nc_template_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so nc_template_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so nc_template_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in nc_template_categorized_blog.
 */
function nc_template_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'nc_template_categories' );
}
add_action( 'edit_category', 'nc_template_category_transient_flusher' );
add_action( 'save_post',     'nc_template_category_transient_flusher' );
