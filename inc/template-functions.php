<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Atlantic
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function atlantic_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( is_singular() ) {
		$classes[] = 'single-content';
	}

	if ( class_exists( 'WooCommerce' ) ) {
		if ( get_theme_mod( 'wc_columns', 'col-shop-4' ) ) {
			$classes[] = get_theme_mod( 'wc_columns', 'col-shop-4' );
		}
	}

	return $classes;
}
add_filter( 'body_class', 'atlantic_body_classes' );

/**
 * Removes hentry class from the array of post classes.
 * Currently, having the class on pages is not correct use of hentry.
 * hentry requires more properties than pages typically have.
 * Core is not likely to remove class because of backward compatibility.
 * See: https://core.trac.wordpress.org/ticket/28482
 *
 * @param array $classes Classes for the post element.
 * @return array
 */
function atlantic_post_classes( $classes ) {
	if ( 'page' === get_post_type() ) {
		$classes = array_diff( $classes, array( 'hentry' ) );
	}
	$classes[] = 'entry';
	return $classes;
}
add_filter( 'post_class', 'atlantic_post_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function atlantic_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'atlantic_pingback_header' );

/**
 * [atlantic_comment_form description]
 * @param  [type] $fields [description]
 * @return [type]         [description]
 */
function atlantic_comment_form( $fields ) {

	$fields['cancel_reply_link'] = sprintf( '%s <span class="screen-reader-text">%s</span>',
		atlantic_get_svg( array( 'icon' => 'close' ) ),
		__( 'Cancel reply', 'atlantic' ) );

	return $fields;
}
add_filter( 'comment_form_defaults', 'atlantic_comment_form', 10, 5 );

if ( ! function_exists( 'atlantic_hook_more_filters' ) ) :
/**
 * Hook filters to the front-end only.
 */
function atlantic_hook_more_filters() {

	if ( is_home() || is_category() || is_tag() || is_author() || is_date() || is_search() ) {
		add_filter( 'the_title', 'atlantic_untitled_post' );
		add_filter( 'excerpt_length', 'atlantic_excerpt_length', 999 );
		add_filter( 'excerpt_more', 'atlantic_excerpt_more' );
		add_filter( 'the_content_more_link', 'atlantic_excerpt_more', 10, 2 );
		add_filter( 'embed_defaults', 'atlantic_default_embed_size' );
		add_filter( 'embed_oembed_html', 'atlantic_mixcloud_oembed_parameter', 10, 3 );
	}

	if ( is_singular() ) {
		add_filter( 'the_title', 'atlantic_untitled_post' );
		add_filter( 'embed_defaults', 'atlantic_default_embed_size' );
		add_filter( 'embed_oembed_html', 'atlantic_mixcloud_oembed_parameter', 10, 3 );
	}

}
endif;
add_action( 'wp', 'atlantic_hook_more_filters' );

/**
 * Fix embed height
 * @return [type] [description]
 */
function atlantic_default_embed_size(){
	return array( 'width' => 720, 'height' => 120 );
}

/**
 * [olesya_mixcloud_oembed_parameter description]
 * @param  [type] $html [description]
 * @param  [type] $url  [description]
 * @param  [type] $args [description]
 * @return [type]       [description]
 */
function atlantic_mixcloud_oembed_parameter( $html, $url, $args ) {
	return str_replace( 'hide_cover=1', 'hide_cover=1&hide_tracklist=1&light=1', $html );
}

/**
 * Add (Untitled) for post who doesn't have title
 * @param  string  $title
 * @return string
 */
function atlantic_untitled_post( $title ) {

	// Translators: Used as a placeholder for untitled posts on non-singular views.
	if ( ! $title && ! is_singular() && in_the_loop() && ! is_admin() )
		$title = esc_html__( '(Untitled)', 'atlantic' );

	return $title;
}

/**
 * Filter the except length to 20 characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function atlantic_excerpt_length( $length ) {
	$setting = atlantic_setting_default();
	if ( get_theme_mod( 'excerpt_length', $setting['excerpt_length'] ) !== '' ) {
		return (int)get_theme_mod( 'excerpt_length', $setting['excerpt_length'] );
	} else {
		return 20;
	}
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function atlantic_excerpt_more() {
	$link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span> &rarr;', 'atlantic' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
