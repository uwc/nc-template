<?php
/**
 * Template part for displaying navigation menu in the header.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NC_Template
 */

?>

<a id="menu-toggle" href="#" aria-controls="top-menu" aria-expanded="false"><?php esc_html_e( 'Top Menu', 'nc-template' ); ?></a>
<div class="navigation-header" role="navigation">
	<div class="navigation-search">
		<?php get_search_form(); ?>
	</div><?php if ( has_nav_menu( 'header' ) ) {
		wp_nav_menu( array(
			'theme_location'  => 'header',
			'depth'           => '2',
			'container'       => 'nav',
			'container_class' => 'nav-collapse closed',
			'menu_class'      => 'menu-header',
			'fallback_cb'     => 'false',
		) );
} ?></div>
