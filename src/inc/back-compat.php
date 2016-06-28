<?php
/**
 * NC Template back compat functionality
 *
 * Prevents NC Template from running on WordPress versions prior to 4.4,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.4.
 *
 * @package NC Template
 */

/**
 * Prevent switching to NC Template on old versions of WordPress.
 *
 * Switches to the default theme.
 */
function nc_template_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );

	unset( $_GET['activated'] );

	add_action( 'admin_notices', 'nc_template_upgrade_notice' );
}
add_action( 'after_switch_theme', 'nc_template_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * NC Template on WordPress versions prior to 4.4.
 *
 * @global string $wp_version WordPress version.
 */
function nc_template_upgrade_notice() {
	$message = sprintf( __( 'NC Template requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'nc-template' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', esc_attr( $message ) );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.4.
 *
 * @global string $wp_version WordPress version.
 */
function nc_template_customize() {
	wp_die( sprintf( esc_attr__( 'NC Template requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'nc-template' ), esc_attr( $GLOBALS['wp_version'] ) ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'nc_template_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.4.
 *
 * @global string $wp_version WordPress version.
 */
function nc_template_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( esc_attr__( 'NC Template requires at least WordPress version 4.4. You are running version %s. Please upgrade and try again.', 'nc-template' ), esc_attr( $GLOBALS['wp_version'] ) ) );
	}
}
add_action( 'template_redirect', 'nc_template_preview' );
