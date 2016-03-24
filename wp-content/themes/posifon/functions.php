<?php

//header('Access-Control-Allow-Origin: http://*.posifonomsorg.se');
header('Access-Control-Allow-Origin: *'); //Temp, only under PosifonOmsorg-development phase.
//header("Content-Security-Policy: default-src 'self'; img-src 'self'; script-src 'self' https://*.posifonomsorg.se http://ajax.googleapis.com ");

function posifon_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on posifon, use a find and replace
	 * to change 'posifon' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'posifon', get_template_directory() . '/languages' );

    // Clean up the <head>
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'wp_generator');

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
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'main_nav' => __( 'Main Nav Menu', 'posifon' ),
		'footer_menu1'  => __( 'Footer Menu1', 'posifon' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

//    Add custom header support for changing the front page background
    $defaults = array(
      'default-image'          => get_template_directory_uri() . "/img/utsikt_stad.jpg",
      'width'                  => 0,
      'height'                 => 0,
      'flex-height'            => false,
      'flex-width'             => false,
      'uploads'                => true,
      'random-default'         => false,
      'header-text'            => false,
      'default-text-color'     => '',
      'wp-head-callback'       => '',
      'admin-head-callback'    => '',
      'admin-preview-callback' => '',
    );
    add_theme_support( 'custom-header', $defaults );
  
	/*
	 * Enable support for Post Formats.
	 * See: https://codex.wordpress.org/Post_Formats
	 */
/*	add_theme_support( 'post-formats', array(
*		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
*	) );
*/

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
//	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', posifon_fonts_url() ) );
}
// posifon_setup
add_action( 'after_setup_theme', 'posifon_setup' );

/**
 * Enqueue scripts and styles.
 *
 * @since posifon 2.0
 */

function posifon_scripts() {

    // Load our main stylesheet.
    wp_enqueue_style( 'posifon-style', get_stylesheet_uri(), false, '20160324' );

    // Load the Internet Explorer 8 specific stylesheet.
	 wp_enqueue_style( 'posifon-ie8', get_template_directory_uri() . '/css/style-ie8.css', false, '20160324' );
	 wp_style_add_data( 'posifon-ie8', 'conditional', 'lt IE 9' );

    // Load the Internet Explorer 9 specific stylesheet.
	 wp_enqueue_style( 'posifon-ie9', get_template_directory_uri() . '/css/style-ie9.css', false, '20160324' );
	 wp_style_add_data( 'posifon-ie9', 'conditional', 'gt IE 8' );

    // Load comments on single post views
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

    // Load bestall-script for selectively hiding some elements of the form
    if ( is_page_template( 'template-bestall.php' )) {
      wp_enqueue_script( 'posifon-bestall', get_template_directory_uri() . '/js/bestall.js', array( 'jquery' ), '20160324', true );
    }

    wp_enqueue_script( 'modernizr-script', get_template_directory_uri() . '/js/modernizr.min.js', array( 'jquery' ), '20150726', false);

	wp_enqueue_script( 'posifon-script', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), '20160324', true );
}
add_action( 'wp_enqueue_scripts', 'posifon_scripts' );


/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override twentyten_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since posifon 1.0
 * @uses register_sidebar
 */
function posifon_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Standard Sidebar', 'posifon' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'posifon' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Area 3, located on template-omoss.
	register_sidebar( array(
		'name' => __( 'Om Oss Sidebar', 'posifon' ),
		'id' => 'third-widget-area',
		'description' => __( 'Widget area shown on the "om" page template', 'posifon' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

  	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Footer Widget Area 1', 'posifon' ),
		'id' => 'footer-widget-area-1',
		'description' => __( 'Footer column 1', 'posifon' ),
		'before_widget' => '<div id="%1$s" class="footer-widget-1 %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

  	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Footer Widget Area 2', 'posifon' ),
		'id' => 'footer-widget-area-2',
		'description' => __( 'Footer column 2', 'posifon' ),
		'before_widget' => '<div id="%1$s" class="footer-widget-2 %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Footer Widget Area 3', 'posifon' ),
		'id' => 'footer-widget-area-3',
		'description' => __( 'Footer column 3', 'posifon' ),
		'before_widget' => '<div id="%1$s" class="footer-widget-3 %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 7, located in the footer at the bottom of the page. Empty by default.
	register_sidebar( array(
		'name' => __( 'Footer bottom area', 'posifon' ),
		'id' => 'footer-widget-area-4',
		'description' => __( 'Full span bottom area', 'posifon' ),
		'before_widget' => '<div id="%1$s" class="footer-widget-4 %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}

/** Register sidebars by running posifon_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'posifon_widgets_init' );

// Shortens the excerpt
function new_excerpt_length($length) {
	return 30;
}
add_filter('excerpt_length', 'new_excerpt_length');

function is_subpage()
{
	global $post, $wpdb;

	if ( is_page() AND isset( $post->post_parent ) != 0 )
	{
		$aParent = $wpdb->get_row( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE ID = %d AND post_type = 'page' LIMIT 1", $post->post_parent ) );
		if ( $aParent->ID ) return true; else return false;
	}
	else
	{
		return false;
	}
}

if (function_exists('register_nav_menus')) {
	register_nav_menus(
		array(
			'main_nav' => 'Main Navigation Menu'
			)
	);
}

/**
 * wpi_stylesheet_dir_uri
 * overwrite theme stylesheet directory uri
 * filter stylesheet_directory_uri
 * @see get_stylesheet_directory_uri()
 */
function wpi_stylesheet_dir_uri($stylesheet_dir_uri, $theme_name){
	$subdir = '/css';
	return $stylesheet_dir_uri.$subdir;
}
add_filter('stylesheet_directory_uri','wpi_stylesheet_dir_uri',10,2);

/**
 * Disable the emoji's
 */
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param    array  $plugins  
 * @return   array             Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}