<?php
/**
 * Template part for displaying navigation menu in the header.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NC_Template
 */

?><nav id="site-navigation" class="main-navigation" role="navigation">
	<button class="menu-toggle" aria-controls="top-menu" aria-expanded="false"><?php esc_html_e( 'Top Menu', 'nc-template' ); ?></button>
	<?php if ( has_nav_menu( 'header' ) ) {
		wp_nav_menu( array(
		'theme_location' => 'header',
		'depth' => '2',
		) );
	} ?>

</nav><!-- #site-navigation -->

<!-- <nav class="nav-collapse">
	<ul>
		<li><a href="#">Home</a></li>
		<li><a href="#">About</a></li>
		<li><a href="#">Projects</a></li>
		<li><a href="#">Contact</a></li>
	</ul>
</nav> -->
