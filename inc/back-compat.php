<?php
/**
 * UWC Website back compat functionality
 *
 * Prevents UWC Website from running on WordPress versions prior to 4.4,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.4.
 *
 * @package UWC Website
 */

/**
 * Prevent switching to UWC Website on old versions of WordPress.
 *
 * Switches to the default theme.
 */
function uwc_website_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );

	unset( $_GET['activated'] );

	add_action( 'admin_notices', 'uwc_website_upgrade_notice' );
}
add_action( 'after_switch_theme', 'uwc_website_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * UWC Website on WordPress versions prior to 4.4.
 *
 * @global string $wp_version WordPress version.
 */
function uwc_website_upgrade_notice() {
	$message = sprintf( __( 'UWC Website requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'uwc-website' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', esc_attr( $message ) );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.4.
 *
 * @global string $wp_version WordPress version.
 */
function uwc_website_customize() {
	wp_die(
		sprintf( esc_attr__( 'UWC Website requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'uwc-website' ), esc_attr( $GLOBALS['wp_version'] ) ), '', array(
			'back_link' => true,
		)
	);
}
add_action( 'load-customize.php', 'uwc_website_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.4.
 *
 * @global string $wp_version WordPress version.
 */
function uwc_website_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( esc_attr__( 'UWC Website requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'uwc-website' ), esc_attr( $GLOBALS['wp_version'] ) ) );
	}
}
add_action( 'template_redirect', 'uwc_website_preview' );
