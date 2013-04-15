<?php
/**
 *
 *
 * @package Tuesday
 * @since Tuesday 1.0
 */

if ( ! function_exists( 'tuesday_setup' ) ):

	function tuesday_setup() {

		require get_template_directory() . '/inc/template-tags.php';

		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 * If you're building a theme based on Tuesday, use a find and replace
		 * to change 'tuesday' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'tuesday', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		// Add post thumbnails
		add_theme_support( 'post-thumbnails' );

		//Add header image support
		add_theme_support( 'custom-header', array(
			'width'  => 1140,
			'height'   => 260,
			'flex-width' => false,
			'flex-height' => true,
			'uploads' => true,
			'header-text' => false,
		) );
		
		// Add custom background support
		add_theme_support( 'custom-background' );

		// Add menu areas
		 register_nav_menus( array(
				'sidebar' => __( 'Sidebar Menu', 'tuesday' ),
		) );
		register_nav_menus( array(
				'top' => __( 'Top Menu', 'tuesday' ),
		) );
		register_nav_menus( array(
				'bottom' => __( 'Bottom Menu', 'tuesday' ),
		) );

		// Add support for Post Formats
		add_theme_support( 'post-formats', array(
				'aside',
				'gallery',
				'link',
				'image',
				'quote',
				'status',
				'video',
				'audio',
				'chat',
		) );
	}
endif;
add_action( 'after_setup_theme', 'tuesday_setup' );

// Fixing rel validator errors
// Thanks Fredrik Hugås - http://www.webdevcorner.net/articles/make-wordpress-validate-for-html5-by-getting-rid-of-relcategory-tag
add_filter('the_category', 'fix_cat');
function fix_cat($text) {
	return str_replace('rel="category"', '', $text);
}

// Required : Maximum allowed width for any content in the theme, like oEmbeds and images added to posts.
if ( ! isset( $content_width ) )
	$content_width = 855;

/**
 * Register widgetized areas and update sidebar with default widgets
 *
 * @since Tuesday 1.0
 */
add_action( 'widgets_init', 'tuesday_widgets_init' );
function tuesday_widgets_init() {
	register_sidebar( array(
			'name' => __( 'Sidebar', 'tuesday' ),
			'id' => 'sidebar',
			'description' => __('Main widget area','tuesday'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1>',
		) );
	register_sidebar( array(
			'name' => __( 'Footer-Left', 'tuesday' ),
			'id' => 'footer-1',
			'description' => __('Footer widget area','tuesday'),
			'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h1 class="footer-widget-title">',
			'after_title' => '</h1>',
		) );
	register_sidebar( array(
			'name' => __( 'Footer-Center', 'tuesday' ),
			'id' => 'footer-2',
			'description' => __('Footer widget area','tuesday'),
			'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h1 class="footer-widget-title">',
			'after_title' => '</h1>',
		) );
	register_sidebar( array(
			'name' => __( 'Footer-Right', 'tuesday' ),
			'id' => 'footer-3',
			'description' => __('Footer widget area','tuesday'),
			'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h1 class="footer-widget-title">',
			'after_title' => '</h1>',
		) );
}

// Add theme specific widgets
require get_template_directory() . '/widgets.php';

// Add theme customization settings
require get_template_directory() . '/theme-options/theme-customize.php';

function tuesday_scripts() {

	// Register web font stylesheet
	if ( get_theme_mod( 'font-subset' ) ) {
		$add_subset = '&subset=latin,'.get_theme_mod( 'font-subset' ).'';
	} else {
		$add_subset = '';
	}
	wp_register_style( 'webfont', '//fonts.googleapis.com/css?family='.get_theme_mod('font', 'Open Sans').':300,400,600'. $add_subset .'');

	// Register custom layouts
	wp_register_style( 'sidebar-left', get_template_directory_uri().'/layouts/sidebar-left.css');
	wp_register_style( 'sidebar-right', get_template_directory_uri().'/layouts/sidebar-right.css');
	wp_register_style( 'one-column', get_template_directory_uri().'/layouts/one-column.css');
	
	// Get chosen web font
	wp_enqueue_style('webfont');

	// Get custom-layouts setting and links the stylesheet 
	wp_enqueue_style( get_theme_mod('custom-layouts','sidebar-left') );

	// Get main stylesheet and javascript
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array( 'jquery' ) );
	
	// Include FastClick library for eliminating the 300ms delay between a physical tap and the firing of a click event on mobile browsers.
	// https://github.com/ftlabs/fastclick
	wp_enqueue_script('fastclick', get_template_directory_uri() . '/js/fastclick.min.js');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	// Social media share buttons minified in one file
	if ( is_singular() ) {
		wp_enqueue_script( 'social-media-script', get_template_directory_uri().'/js/social.min.js', $ver = false, true );
	}
}
add_action( 'wp_enqueue_scripts', 'tuesday_scripts' );