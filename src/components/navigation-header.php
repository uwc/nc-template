<?php
/**
 * Template part for displaying navigation menu in the header.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NC_Template
 */

?><div id="site-navigation" class="main-navigation" role="navigation">
	<button class="menu-toggle" aria-controls="top-menu" aria-expanded="false"><?php esc_html_e( 'Top Menu', 'nc-template' ); ?></button>
	<?php if ( has_nav_menu( 'header' ) ) {
		wp_nav_menu( array(
		'theme_location' => 'header',
		'depth' => '2',
		'container' => 'nav',
		'container_class' => 'nav-collapse',
		'fallback_cb' => 'false',
		) );
	} ?>

</div><!-- #site-navigation -->