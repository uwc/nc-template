<?php
/**
 * Element to output the newsfeed preview on section pages.
 * Gets the 4 most recent posts belonging to the selected categories.
 * Outputs them with markup if at least one category is set and a minimum of 4 posts exist.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NC_Template
 */

$categories = get_field( 'newsfeed' );

$posts = get_posts(array(
	'posts_per_page' => 4,
	'category'    => $categories,
	'orderby'     => 'date',
	'order'       => 'DESC',
	'post_status' => 'publish',
));
$count = count( $posts );

if ( $categories && $count >= 4 ) {
	echo '<ul>';

	foreach ( $posts as $post ) {
		echo '<li>' . the_post_thumbnail( $post->ID ) . '<a href="' . get_permalink( $post->ID ) . '">' . get_the_title( $post->ID ) . '</a></li>';
	}
	echo '</ul>';
}

?>
