<?php
/**
 * UWC Website functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package UWC_Website
 */

/**
 * UWC Website has only been tested in WordPress 4.4 and later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'uwc_website_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function uwc_website_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'uwc-website', trailingslashit( get_template_directory() ) . 'languages' );
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

		// Enable support for custom logo.
		add_theme_support( 'custom-logo', array(
			'height'      => 28,
			'width'       => 220,
			'flex-width'  => true,
			'header-text' => array( 'site-title' ),
		) );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'uwc-website' ),
			'social' => __( 'Social Links Menu', 'uwc-website' ),
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
		add_editor_style( array( 'editor-style.css', uwc_website_fonts_url() ) );
	}
endif;
add_action( 'after_setup_theme', 'uwc_website_setup' );

/**
 * Sets the maximum media width for embed media in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function uwc_website_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'uwc_website_content_width', 1280 );
}
add_action( 'after_setup_theme', 'uwc_website_content_width', 0 );

/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function uwc_website_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'uwc-website' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer left', 'uwc-website' ),
		'id'            => 'footer-left',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer center', 'uwc-website' ),
		'id'            => 'footer-center',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer right', 'uwc-website' ),
		'id'            => 'footer-right',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'uwc_website_widgets_init' );

if ( ! function_exists( 'uwc_website_fonts_url' ) ) :
	/**
	 * Register Google fonts for UWC Website.
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function uwc_website_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';
		/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Source Sans Pro font: on or off', 'uwc-website' ) ) {
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
function uwc_website_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>";
}
add_action( 'wp_head', 'uwc_website_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 */
function uwc_website_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'uwc-website-fonts', uwc_website_fonts_url(), array( 'jquery' ) );
	// Add Google Maps scripts, used in the main stylesheet.
	wp_enqueue_script( 'uwc-website-googlemaps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBV8fzdHyCXxCzT7kCqc1UCRKx4mROcm64', array(), null, true );
	// Theme stylesheet.
	wp_enqueue_style( 'uwc-website-style', get_stylesheet_uri() );
	// Load the html5 shiv.
	wp_enqueue_script( 'uwc-website-html5', get_template_directory_uri() . '/js/html5.js' );
	wp_script_add_data( 'uwc-website-html5', 'conditional', 'lt IE 9' );
	// Theme scripts.
	wp_enqueue_script( 'uwc-website-script', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ) );
}
add_action( 'wp_enqueue_scripts', 'uwc_website_scripts' );

/**
 * Register Google Maps API key to enable Google Maps embeds with Advanced Custom Fields.
 */
function uwc_website_acf_init() {
	acf_update_setting( 'google_api_key', 'AIzaSyBV8fzdHyCXxCzT7kCqc1UCRKx4mROcm64' );
}
add_action( 'acf/init', 'uwc_website_acf_init' );

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
