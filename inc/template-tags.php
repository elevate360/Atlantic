<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Atlantic
 */

if ( ! function_exists( 'atlantic_breadcrumb' ) ) :
/**
 * Display breadcrumb compatibility
 * @return void
 */
function atlantic_breadcrumb(){

	$breadcrumb_markup_open = '<div id="breadcrumb" typeof="BreadcrumbList" vocab="http://schema.org/"><div class="wrap">';
	$breadcrumb_markup_close = '</div></div>';

	if ( function_exists( 'bcn_display' ) ) {
		echo $breadcrumb_markup_open;
		bcn_display();
		echo $breadcrumb_markup_close;
	}
	elseif ( function_exists( 'breadcrumbs' ) ) {
		breadcrumbs();
	}
	elseif ( function_exists( 'crumbs' ) ) {
		crumbs();
	}
	elseif ( class_exists( 'WPSEO_Breadcrumbs' ) ) {
		yoast_breadcrumb( $breadcrumb_markup_open, $breadcrumb_markup_close );
	}
	elseif( function_exists( 'yoast_breadcrumb' ) && ! class_exists( 'WPSEO_Breadcrumbs' ) ) {
		yoast_breadcrumb( $breadcrumb_markup_open, $breadcrumb_markup_close );
	}

}
endif;

if ( ! function_exists( 'atlantic_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function atlantic_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x( 'by %s', 'post author', 'atlantic' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	edit_post_link(
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Edit <span class="screen-reader-text">%s</span>', 'atlantic' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		),
		'<span class="edit-link">',
		'</span>'
	);

}
endif;

if ( ! function_exists( 'atlantic_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function atlantic_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'atlantic' ) );
		if ( $categories_list ) {
			/* translators: 1: list of categories. */
			printf( '<span class="cat-links">%s <span class="screen-reader-text">' . esc_html__( 'Posted in', 'atlantic' ) . '</span> %s</span>',
			atlantic_get_svg( array( 'icon' => 'category' ) ),
			$categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'atlantic' ) );
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			printf( '<span class="tags-links">%s <span class="screen-reader-text">' . esc_html__( 'Tagged', 'atlantic' ) . '</span> %s</span>',
			atlantic_get_svg( array( 'icon' => 'tag' ) ),
			$tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		echo atlantic_get_svg( array( 'icon' => 'comment' ) );
		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'atlantic' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);
		echo '</span>';
	}

}
endif;

if ( ! function_exists( 'atlantic_post_thumbnail' ) ) :
/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index
 * views, or a div element when on single views.
 */
function atlantic_post_thumbnail( $size = 'post-thumbnail') {

	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( ! is_singular() ) {
		echo '<div class="post-thumbnail">';
			echo '<a href="'. get_permalink( get_the_id() ) .'">';
				the_post_thumbnail( $size );
			echo '</a>';
		echo '</div>';
	} else {
		echo '<div class="post-thumbnail">';
			the_post_thumbnail( $size );
		echo '</div>';
	}

}
endif;

if ( !function_exists( 'atlantic_posts_navigation' ) ) :
/**
 * [atlantic_posts_navigation description]
 * @return [type] [description]
 */
function atlantic_posts_navigation(){

	if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) {
		return;
	}

	if ( get_theme_mod( 'posts_navigation', 'posts_navigation' ) == 'posts_navigation' ) {
		the_posts_navigation( array(
            'prev_text'          => __( '&larr; Older posts', 'atlantic' ),
            'next_text'          => __( 'Newer posts &rarr;', 'atlantic' ),
		) );
	} else {
		the_posts_pagination( array(
			'prev_text'          => sprintf( '%s <span class="screen-reader-text">%s</span>', atlantic_get_svg( array( 'icon' => 'previous' ) ), __( 'Previous Page', 'atlantic' ) ),
			'next_text'          => sprintf( '%s <span class="screen-reader-text">%s</span>', atlantic_get_svg( array( 'icon' => 'next' ) ), __( 'Next Page', 'atlantic' ) ),
			'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'atlantic' ) . ' </span>',
		) );
	}

}
endif;

if( ! function_exists( 'atlantic_get_footer_copyright' ) ) :
/**
 * [atlantic_get_footer_copyright description]
 * @return [type] [description]
 */
function atlantic_get_footer_copyright(){
	$default_footer_copyright =	sprintf( __( 'Copyright &copy; %1$s %2$s. Proudly powered by %3$s.', 'atlantic' ),
		date_i18n( __('Y', 'atlantic' ) ),
		'<a href="'. esc_url( home_url() ) .'">'. esc_attr( get_bloginfo( 'name' ) ) .'</a>',
		'<a href="'. esc_url( 'https://wordpress.org/' ) .'">WordPress</a>' );

	apply_filters( 'atlantic_get_footer_copyright', $default_footer_copyright );

	$footer_copyright = get_theme_mod( 'footer_copyright', $default_footer_copyright );

	if ( !empty( $footer_copyright ) ) {
		$footer_copyright = str_replace( '[YEAR]', date_i18n( __('Y', 'atlantic' ) ), $footer_copyright );
		$footer_copyright = str_replace( '[SITE]', '<a href="'. esc_url( home_url() ) .'">'. esc_attr( get_bloginfo( 'name' ) ) .'</a>', $footer_copyright );
		return htmlspecialchars_decode( esc_attr( $footer_copyright ) );
	} else {
		return $default_footer_copyright;
	}

}
endif;

if( ! function_exists( 'atlantic_do_footer_copyright' ) ) :
/**
 * [atlantic_do_footer_copyright description]
 * @return [type] [description]
 */
function atlantic_do_footer_copyright(){

	echo '<div class="site-info">'. atlantic_get_footer_copyright() . '</div>';
	echo '<div class="site-designer">'. sprintf( __( 'Theme design by %s.', 'atlantic' ), '<a href="'. esc_url( 'https://cockatoo.com.au/' ) .'">Cockatoo</a>' ) .'</div>';

}
endif;

if ( ! function_exists( 'atlantic_return_to_top' ) ) :
/**
 * [atlantic_return_to_top description]
 * @return string
 */
function atlantic_return_to_top(){
	if( get_theme_mod( 'return_top', true ) ) {
		echo '<a href="#page" class="return-to-top">'. atlantic_get_svg( array( 'icon' => 'top' ) ) .'</a>';
	}
}
endif;
