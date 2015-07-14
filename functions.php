<?php
/**
 * Wp One Page functions and definitions
 *
 * @package Wp One Page
 */

/**
 * Define Constants.
 * @since 1.0.0
 */
define( 'THEME_DIR',        get_template_directory()     ); // Theme directory path
define( 'THEME_URL',        get_template_directory_uri() ); // Theme url
define( 'THEME_ASSETS_DIR', THEME_DIR . '/assets'        ); // Assets Directory path
define( 'THEME_ASSETS_URL', THEME_URL . '/assets'        ); // Assets url
define( 'THEME_CSS_DIR',    THEME_ASSETS_DIR . '/css'    ); // Theme css directory path
define( 'THEME_CSS_URL',    THEME_ASSETS_URL . '/css'    ); // Theme css directory url
define( 'THEME_JS_DIR',     THEME_ASSETS_DIR . '/js'     ); // Theme js directory path
define( 'THEME_JS_URL',     THEME_ASSETS_URL . '/js'     ); // Theme js directory url
define( 'THEME_IMG_DIR',    THEME_ASSETS_DIR . '/img'    ); // Theme image directory path
define( 'THEME_IMG_URL',    THEME_ASSETS_URL . '/img'    ); // Theme image directory url

if ( ! function_exists( 'op_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function op_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Wp One Page, use a find and replace
	 * to change 'op' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'op', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'op' ),
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
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'op_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	add_image_size( 'benefit_size', 360, 240 );
}
endif; // op_setup
add_action( 'after_setup_theme', 'op_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function op_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'op_content_width', 640 );
}
add_action( 'after_setup_theme', 'op_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function op_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'op' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'op_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function op_scripts() {

	wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js', array(), '', true);
    wp_enqueue_script( 'jquery' );

    wp_enqueue_style( 'op-font', 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800', array(), '20150512' );
    wp_enqueue_style( 'op-fonts', 'http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic', array(), '20150512' );
	wp_enqueue_style( 'op-style', THEME_CSS_URL . '/main.min.css', array(), '1.0.2' );
    wp_enqueue_script( 'op-script', THEME_JS_URL . '/main.min.js', array(), '1.0.1', true );
}
add_action( 'wp_enqueue_scripts', 'op_scripts' );

/**
 * Add scripts to admin page.
 *
 * @since  1.0.0
 *
 * @return void.
 */
function op_admin_scripts() {	
    wp_enqueue_media();
	wp_enqueue_style( 'op-admin', THEME_CSS_URL . '/admin.css', array(), '1.0.0' );
}
add_action('admin_enqueue_scripts', 'op_admin_scripts');

add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

require get_template_directory() . '/inc/init.php';

require get_template_directory() . '/inc/options.php';

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
//require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
//require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
//require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
//require get_template_directory() . '/inc/jetpack.php';
