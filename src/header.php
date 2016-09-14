<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package UWC_Website
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php
if ( is_singular() && ! get_theme_mod( 'comments' ) ) {
	wp_enqueue_script( 'comment-reply' );
}
wp_head();
?>

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
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'uwc-website' ); ?></a>

	<header id="js-navigation" class="navigation -loaded" role="banner">
		<div class="navigation-upper">

			<?php if ( has_nav_menu( 'social' ) ) {
				wp_nav_menu( array(
					'theme_location'  => 'social',
					'container_class' => 'navigation-social',
					'menu_id'         => 'menu-social',
					'menu_class'      => 'menu-social-items',
					'depth'           => 1,
					'link_before'     => '<span class="screen-reader-text">',
					'link_after'      => '</span>',
					'fallback_cb'     => 'false',
				) );
			} ?>

			<div class="navigation-logo">
				<?php get_template_part( 'components/site', 'logo' ); ?>
			</div>

			<div class="navigation-search">
				<button id="js-search" class="navigation-button"><span class="screen-reader-text"><?php esc_attr_e( 'Contact us', 'uwc-website' ) ?></span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg></button>
				<div class="navigation-searchform">
					<?php get_search_form(); ?>
				</div>
			</div>

			<button id="menu-toggle"><?php esc_html_e( 'Menu', 'uwc-website' ); ?></button>

		</div>

		<div class="navigation-lower" role="navigation">

			<?php if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu( array(
					'theme_location'  => 'primary',
					'depth'           => '2',
					'container'       => 'nav',
					'container_class' => 'nav-collapse closed',
					'fallback_cb'     => 'false',
				) );
		} ?>

		</div>

	</header>
	<div id="content" class="site-content">
