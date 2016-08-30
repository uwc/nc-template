<?php
/**
 * Element to output the Newsfeed preview on section pages.
 * Gets the 4 most recent posts belonging to the selected categories.
 * Outputs them with markup if at least one category is set and a minimum of 4 posts exist.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package UWC_Website
 */

$taxonomies = get_field( 'newsfeed' );

$posts = get_posts(array(
	'posts_per_page' => 4,
	'category'       => $taxonomies,
	'orderby'        => 'date',
	'order'          => 'DESC',
	'post_status'    => 'publish',
));
$count = count( $posts );

if ( $taxonomies && $count >= 4 ) {
	echo '<section class="section-newsfeed">';
	$index = 1;
	foreach ( $posts as $post ) {
		$categories = array();
		$featured = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
		$featured_url = $featured[0];

		foreach ( $taxonomies as $taxonomy ) {
			if ( in_category( $taxonomy, $post->ID ) ) {
				array_push( $categories, $taxonomy );
			}
		}

		if ( has_post_thumbnail( $post->ID ) ) {
			echo '<article class="section-post post-' . intval( $index ) . ' -thumbnail"><div class="section-image" style="background-image: url(';
			echo esc_url( $featured_url );
			echo ')"></div>';
		} else {
			echo '<article class="section-post post-' . intval( $index ) . ' -no-thumbnail">';
		}
		echo '<div class="section-wrapper">';
		foreach ( $categories as $category ) {
			echo '<a href="' . esc_url( get_category_link( $category ) ) . '" class="section-category">' . esc_html( get_cat_name( $category ) ) . '</a> ';
		}
		echo '<a href="' . esc_url( get_permalink( $post->ID ) ) . '"><h2 class="section-headline">' . get_the_title( $post->ID ) . '</h2><h4 class="section-date">' . get_the_date( '', $post->ID ) . '</h4></a></div></article>';
		$index++;
	}
	echo '</section>';
}
