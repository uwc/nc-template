<?php // ==== FUNCTIONS ==== //
/**
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
**/


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

  // Enable support for custom logo.
  add_theme_support( 'custom-logo', array(
    'height'      => 30,
    'width'       => 360,
    'flex-width' => true,
    'header-text' => array( 'site-title', 'site-description' ),
  ) );

  /*
   * Enable support for Post Thumbnails on posts and pages.
   *
   * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
   */
  add_theme_support( 'post-thumbnails' );
  set_post_thumbnail_size( 1440, 9999 );

  // Register header menu
  register_nav_menu( 'navigation', __( 'Navigation bar', 'nc-template' ) );

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
    'aside',
    'image',
    'video',
    'quote',
    'link',
    'gallery',
  ) );

  /*
   * This theme styles the visual editor to resemble the theme style,
   * specifically font, colors, icons, and column width.
   */
  add_editor_style( array( 'css/editor-style.css', nc_template_fonts_url() ) );

}
endif; // nc_template_setup
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
  if ( 'off' !== _x( 'on', 'PT Sans font: on or off', 'nc-template' ) ) {
    $fonts[] = 'PT+Sans:400,700';
  }

  /* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
  if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'nc-template' ) ) {
    $fonts[] = 'Montserrat:400,700';
  }

  if ( $fonts ) {
    $fonts_url = add_query_arg( array(
      'family' => urlencode( implode( '|', $fonts ) ),
      'subset' => urlencode( $subsets ),
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
  echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'nc_template_javascript_detection', 0 );



/**
 * Enqueues scripts and styles.
 */
function nc_template_scripts() {
  // Add custom fonts, used in the main stylesheet.
  wp_enqueue_style( 'nc-template-fonts', nc_template_fonts_url(), array(), null );

  // Theme stylesheet.
  wp_enqueue_style( 'style', get_stylesheet_uri() );

  // Load the html5 shiv.
  // wp_enqueue_script( 'nc-template-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
  // wp_script_add_data( 'nc-template-html5', 'conditional', 'lt IE 9' );

  // wp_enqueue_script( 'nc-template-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160412', true );

  wp_enqueue_script( 'nc-template-script', get_template_directory_uri() . '/js/core.js' );
}
add_action( 'wp_enqueue_scripts', 'nc_template_scripts' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';


/**
 * Customizer additions.
 */
// require get_template_directory() . '/inc/customizer.php';


// Prevents jQuery from being included in the frontend.
// It is not needed and would only increase the time to load the page.

add_filter( 'wp_enqueue_scripts', 'change_default_jquery', PHP_INT_MAX );

function change_default_jquery( ){
    wp_dequeue_script( 'jquery');
    wp_deregister_script( 'jquery');   
}