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
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php
if ( is_singular() ) {
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
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'nc-template' ); ?></a>

	<header id="navigation" class="navigation" role="banner">
		<div class="navigation-ctnr">
			
			<?php get_template_part( 'components/logo' ); ?>

			<?php get_template_part( 'components/navigation', 'social' ); ?>

			<div class="navigation-search">
				<?php get_search_form(); ?>
			</div>

			<?php get_template_part( 'components/navigation', 'header' ); ?>

		</div>

	</header>
	<div id="content" class="site-content">
