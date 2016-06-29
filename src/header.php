<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NC_Template
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

<meta name="description" content="<?php if ( is_single() ) {
				single_post_title( '', true );
		} else {
				bloginfo( 'name' ); 
				echo ' - ';
				bloginfo( 'description' );
		}
		?>" />
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'nc-template' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
				
		<?php get_template_part( 'components/logo' ); ?>

		<?php get_template_part( 'components/navigation', 'social' ); ?>

		<?php get_template_part( 'components/search', 'input' ); ?>

		<?php get_template_part( 'components/navigation', 'header' ); ?>

	</header><!-- #masthead -->
	<div id="content" class="site-content">
