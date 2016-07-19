<?php
/**
 * Template part for displaying social menu as icons.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NC_Template
 */

if ( has_nav_menu( 'social' ) ) {wp_nav_menu( array(
	'theme_location'  => 'social',
	'container_class' => 'navigation-social',
	'menu_id'      => 'menu-social',
	'menu_class'      => 'menu-social-items',
	'depth'           => 1,
	'link_before'     => '<span class="screen-reader-text">',
	'link_after'      => '</span>',
	'fallback_cb'     => 'false',
) );
} ?>
