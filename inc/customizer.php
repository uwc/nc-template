<?php
/**
 * UWC Website Theme Customizer.
 *
 * @package UWC_Website
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function uwc_website_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->add_setting( 'comments', array(
		'default' => false,
		'sanitize_callback' => 'esc_html',
	) );
	$wp_customize->add_section( 'uwc_website_theme_options' , array(
		'title'       => __( 'Theme Options', 'uwc-website' ),
		'priority'    => 30,
	) );
	$wp_customize->add_control(
		'comments',
		array(
		'label'       => __( 'Disable comments', 'uwc-website' ),
		'section'     => 'uwc_website_theme_options',
		'settings'    => 'comments',
		'type'        => 'checkbox',
		'description' => __( 'Check the box to hide comments on the frontend. Comments are NOT deleted and can thus be unhidden at any time.', 'uwc-website' ),
		)
	);
}
add_action( 'customize_register', 'uwc_website_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function uwc_website_customize_preview_js() {
	wp_enqueue_script( 'uwc_website_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'jquery', 'customize-preview' ), true );
}
add_action( 'customize_preview_init', 'uwc_website_customize_preview_js' );
