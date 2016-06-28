<?php
/**
 * Template part for displaying social menu as icons.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NC_Template
 */

if ( has_nav_menu( 'social' ) ) {wp_nav_menu( array( 
	'theme_location' => 'social',
	'menu' => 'Social icons',
	) );
} ?>
