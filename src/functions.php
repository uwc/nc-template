<?php
/**
 * NC Template functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package NC_Template
 */

/**
 * NC Template only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'nc_template_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function nc_template_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'nc-template', trailingslashit( get_template_directory() ) . 'languages' );
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		set_post_thumbnail_size( 1280, 9999, false );

		// Enable support for custom logo.
		add_theme_support( 'custom-logo', array(
			'height'      => 30,
			'width'       => 240,
			'flex-width'  => true,
			'header-text' => array( 'site-title' ),
		) );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
			'header' => esc_html__( 'Header', 'nc-template' ),
			'social' => __( 'Social', 'nc-template' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'video',
			'link',
			'gallery',
		) );

		/*
		 * Add support for Post Formats and Excerpts to pages.
		 *
		 * See: https://codex.wordpress.org/Function_Reference/add_post_type_support
		 */
		add_post_type_support( 'page', array( 'post-formats', 'excerpt' ) );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style( array( 'editor-style.css', nc_template_fonts_url() ) );
	}
endif;
add_action( 'after_setup_theme', 'nc_template_setup' );

/**
 * Sets the maximum media width for embed media in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function nc_template_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'nc_template_content_width', 1280 );
}
add_action( 'after_setup_theme', 'nc_template_content_width', 0 );

/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function nc_template_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'nc-template' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer left', 'nc-template' ),
		'id'            => 'footer-left',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer center', 'nc-template' ),
		'id'            => 'footer-center',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer right', 'nc-template' ),
		'id'            => 'footer-right',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'nc_template_widgets_init' );

if ( ! function_exists( 'nc_template_fonts_url' ) ) :
	/**
	 * Register Google fonts for NC Template.
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function nc_template_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';
		/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Source Sans Pro font: on or off', 'nc-template' ) ) {
			$fonts[] = 'Source+Sans+Pro:300,400,600';
		}
		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => implode( '|', $fonts ),
				'subset' => $subsets,
			), 'https://fonts.googleapis.com/css' );
		}
		return $fonts_url;
	}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 */
function nc_template_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>";
}
add_action( 'wp_head', 'nc_template_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 */
function nc_template_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'nc-template-fonts', nc_template_fonts_url(), array(), null );
	// Theme stylesheet.
	wp_enqueue_style( 'nc-template-style', get_stylesheet_uri() );
	// Load the html5 shiv.
	wp_enqueue_script( 'nc-template-html5', get_template_directory_uri() . '/js/html5.js' );
	wp_script_add_data( 'nc-template-html5', 'conditional', 'lt IE 9' );
	// Theme scripts.
	wp_enqueue_script( 'nc-template-script', get_template_directory_uri() . '/js/scripts.js' );
}
add_action( 'wp_enqueue_scripts', 'nc_template_scripts' );

/**
 * Register Google Maps API key to enable Google Maps embeds with Advanced Custom Fields.
 */
function nc_template_acf_init() {
	acf_update_setting( 'google_api_key', 'AIzaSyBV8fzdHyCXxCzT7kCqc1UCRKx4mROcm64' );
}
add_action( 'acf/init', 'nc_template_acf_init' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
