<?php
/**
 * Template part for displaying the author attribution.
 *
 * @link https://codex.wordpress.org/Theme_Logo
 *
 * @package NC_Template
 */

?><div class="site-info">
	<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'nc-template' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'nc-template' ), 'WordPress' ); ?></a>
	<span class="sep"> | </span>
	<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'nc-template' ), 'NC Template', '<a href="http://connorbaer.io/" rel="designer">Connor B&#228;r</a>' ); ?>
</div><!-- .site-info -->
