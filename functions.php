<?php
/**
 * Atlantic functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Atlantic
 */

/**
 * Atlantic only works in WordPress 6.0 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '6.0', '<' ) ) {
	require get_template_directory() . '/inc/back-compact.php';
	return;
}

if ( ! function_exists( 'atlantic_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function atlantic_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Atlantic, use a find and replace
	 * to change 'atlantic' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'atlantic', trailingslashit( WP_LANG_DIR ) . 'themes/' );
	load_theme_textdomain( 'atlantic', get_stylesheet_directory() . '/languages' );
	load_theme_textdomain( 'atlantic', get_template_directory() . '/languages' );

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

	set_post_thumbnail_size( 1140, 1140, false );

	// Set the default content width.
	$GLOBALS['content_width'] = 540;

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'video',
		'gallery',
		'audio',
		'quote',
		'link'
	) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'atlantic' ),
		'menu-2' => esc_html__( 'Social Link', 'atlantic' ),
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

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'atlantic_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 250,
		'width'       => 250,
		'flex-width'  => true,
		'flex-height' => true,
	) );

       /*
        * Load styles for the editor so that the content
        * within the block and classic editors matches the
        * theme's frontend appearance.
        */
       add_theme_support( 'editor-styles' );
       add_editor_style( array( atlantic_fonts_url(), 'assets/css/editor-style.min.css' ) );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	// Default block styles
	add_theme_support( 'wp-block-styles' );

	// Block color Palettes
	add_theme_support( 'editor-color-palette', array(
		array(
				'name'  => esc_attr__( 'strong magenta', 'atlantic' ),
				'slug'  => 'strong-magenta',
				'color' => '#a156b4',
		),
		array(
				'name'  => esc_attr__( 'light grayish magenta', 'atlantic' ),
				'slug'  => 'light-grayish-magenta',
				'color' => '#d0a5db',
		),
		array(
				'name'  => esc_attr__( 'very light gray', 'atlantic' ),
				'slug'  => 'very-light-gray',
				'color' => '#eee',
		),
		array(
				'name'  => esc_attr__( 'very dark gray', 'atlantic' ),
				'slug'  => 'very-dark-gray',
				'color' => '#444',
		),
	));

	// Block gradient presets
	add_theme_support(
    'editor-gradient-presets',
    array(
        array(
            'name'     => esc_attr__( 'Vivid cyan blue to vivid purple', 'atlantic' ),
            'gradient' => 'linear-gradient(135deg,rgba(6,147,227,1) 0%,rgb(155,81,224) 100%)',
            'slug'     => 'vivid-cyan-blue-to-vivid-purple'
        ),
        array(
            'name'     => esc_attr__( 'Vivid green cyan to vivid cyan blue', 'atlantic' ),
            'gradient' => 'linear-gradient(135deg,rgba(0,208,132,1) 0%,rgba(6,147,227,1) 100%)',
            'slug'     =>  'vivid-green-cyan-to-vivid-cyan-blue',
        ),
        array(
            'name'     => esc_attr__( 'Light green cyan to vivid green cyan', 'atlantic' ),
            'gradient' => 'linear-gradient(135deg,rgb(122,220,180) 0%,rgb(0,208,130) 100%)',
            'slug'     => 'light-green-cyan-to-vivid-green-cyan',
        ),
        array(
            'name'     => esc_attr__( 'Luminous vivid amber to luminous vivid orange', 'atlantic' ),
            'gradient' => 'linear-gradient(135deg,rgba(252,185,0,1) 0%,rgba(255,105,0,1) 100%)',
            'slug'     => 'luminous-vivid-amber-to-luminous-vivid-orange',
        ),
        array(
            'name'     => esc_attr__( 'Luminous vivid orange to vivid red', 'atlantic' ),
            'gradient' => 'linear-gradient(135deg,rgba(255,105,0,1) 0%,rgb(207,46,46) 100%)',
            'slug'     => 'luminous-vivid-orange-to-vivid-red',
        ),
    )
	);

	// Block font sizes
	add_theme_support( 'editor-font-sizes', array(
    array(
        'name' => esc_attr__( 'Small', 'atlantic' ),
        'size' => 12,
        'slug' => 'small'
    ),
    array(
        'name' => esc_attr__( 'Regular', 'atlantic' ),
        'size' => 16,
        'slug' => 'regular'
    ),
    array(
        'name' => esc_attr__( 'Large', 'atlantic' ),
        'size' => 36,
        'slug' => 'large'
    ),
    array(
        'name' => esc_attr__( 'Huge', 'atlantic' ),
        'size' => 50,
        'slug' => 'huge'
    )
) );

	// Block based template parts
	add_theme_support( 'block-template-parts' );

	// register_block_style 
	register_block_style(
		'core/quote',
		array(
			'name'         => 'blue-quote',
			'label'        => __( 'Blue Quote', 'atlantic' ),
			'is_default'   => true,
			'inline_style' => '.wp-block-quote.is-style-blue-quote { color: blue; }',
		)
	);

        // Register theme block patterns.
        register_block_pattern(
                'atlantic/hero-banner',
                require get_template_directory() . '/patterns/hero-banner.php'
        );

        register_block_pattern(
                'atlantic/cta-block',
                require get_template_directory() . '/patterns/cta-block.php'
        );

	add_theme_support( "responsive-embeds" );
	add_theme_support( "align-wide" );

}
endif;
add_action( 'after_setup_theme', 'atlantic_setup' );

/**
 * Register custom block patterns located in the patterns folder.
 */
function atlantic_register_block_patterns() {
       $patterns_dir = get_template_directory() . '/patterns';

       if ( ! is_dir( $patterns_dir ) ) {
               return;
       }

       foreach ( glob( $patterns_dir . '/*.{php,json}', GLOB_BRACE ) as $file ) {
               $slug   = 'atlantic/' . basename( $file, '.' . pathinfo( $file, PATHINFO_EXTENSION ) );
               $pattern = array();

               if ( 'json' === pathinfo( $file, PATHINFO_EXTENSION ) ) {
                       $pattern = json_decode( file_get_contents( $file ), true );
               } else {
                       $pattern = require $file;
               }

               if ( is_array( $pattern ) ) {
                       register_block_pattern( $slug, $pattern );
               }
       }
}
add_action( 'init', 'atlantic_register_block_patterns' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function atlantic_content_width() {
	$content_width = $GLOBALS['content_width'];

	// Check if is single post and there is no sidebar.
	if ( is_singular() ) {
		$content_width = 1110;
	}

	/**
	 * Filter Atlantic content width of the theme.
	 */
	$GLOBALS['content_width'] = apply_filters( 'atlantic_content_width', $content_width );
}
add_action( 'template_redirect', 'atlantic_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function atlantic_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'atlantic' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'atlantic' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	if( class_exists( 'WooCommerce' ) ){
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar Shop', 'atlantic' ),
			'id'            => 'sidebar-2',
			'description'   => esc_html__( 'Add widgets here.', 'atlantic' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}
}
add_action( 'widgets_init', 'atlantic_widgets_init' );

/**
 * Register custom fonts.
 */
function atlantic_fonts_url() {
	$fonts_url = '';

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Source Code Pro, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$montserrat = _x( 'on', 'Source Code Pro font: on or off', 'atlantic' );

	if ( 'off' !== $montserrat ) {
		$font_families = array();

		$font_families[] = 'Source Code Pro:400,700,900';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function atlantic_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'atlantic-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'atlantic_resource_hints', 10, 2 );

/**
 * Enqueue scripts and styles.
 */
function atlantic_scripts() {

	wp_dequeue_style( 'contact-form-7' );

	// Add custom fonts, used in the main stylesheet.
	if ( ! class_exists( 'Easy_Google_Fonts' ) ) {
		wp_enqueue_style( 'atlantic-fonts', atlantic_fonts_url(), array(), null );
	}

	wp_enqueue_style( 'atlantic-style', get_stylesheet_uri() );

	if ( class_exists( 'WooCommerce' ) ) {
		wp_enqueue_style( 'atlantic-woocommerce-style', get_theme_file_uri( '/assets/css/woocommerce.min.css' ) );
	}

	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/vendor/js/html5.js' ), array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'respond', get_theme_file_uri( '/assets/vendor/js/respond.js' ), array(), '1.4.2' );
	wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'nwmatcher', get_theme_file_uri( '/assets/vendor/js/nwmatcher.js' ), array(), '1.4.1' );
	wp_script_add_data( 'nwmatcher', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'selectivizr', get_theme_file_uri( '/assets/vendor/js/selectivizr.js' ), array(), '1.0.2' );
	wp_script_add_data( 'selectivizr', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'jquery-fitvids', get_template_directory_uri() . '/assets/js/fitvids/jquery.fitvids.min.js', array( 'jquery' ), '1.2.0', true );
	wp_enqueue_script( 'jquery-slick', get_template_directory_uri() . '/assets/js/slick/slick.min.js', array( 'jquery' ), '1.7.1', true );
	wp_enqueue_script( 'atlantic-script', get_template_directory_uri() . '/assets/js/atlantic.min.js', array( 'jquery', 'jquery-masonry' ), '20151215', true );

	$output = array(
		'expandMenu' 	=> atlantic_get_svg( array( 'icon' => 'expand' ) ),
		'collapseMenu' 	=> atlantic_get_svg( array( 'icon' => 'collapse' ) ),
		'subNav' 		=> '<span class="screen-reader-text">' . __( 'Sub Navigation', 'atlantic' ) . '</span>'
	);
	wp_localize_script( 'atlantic-script', 'Atlanticl10n', $output );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'atlantic_scripts' );

/**
 * Handles JavaScript detection.
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 */
function atlantic_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'atlantic_javascript_detection', 0 );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/utility.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/vendor/vendor.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * SVG icons functions and filters.
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Additional features to allow styling of the templates.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Widgets.
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load WooCommerce compatibility file.
 */
require get_template_directory() . '/inc/woocommerce.php';
