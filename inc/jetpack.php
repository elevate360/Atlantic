<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package Atlantic
 */

/**
 * Jetpack setup function.
 */
function atlantic_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'atlantic_infinite_scroll_render',
		'footer'    => 'page',
	) );

	/**
	 * Add theme support for Portfolio Custom Post Type.
	 */
	add_theme_support( 'jetpack-portfolio', array(
		'title'          => true,
		'content'        => true,
		'featured-image' => false,
	) );

}
add_action( 'after_setup_theme', 'atlantic_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function atlantic_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content', 'search' );
		else :
			get_template_part( 'template-parts/content', get_post_format() );
		endif;
	}
}
