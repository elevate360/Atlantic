<?php
/**
 * Atlantic Theme Customizer Output
 *
 * @package Atlantic
 */

/**
 * Print inline style
 *
 * @return string
 */
function atlantic_add_inline_style(){

	$setting 				= atlantic_setting_default();

	$css_selector 			= atlantic_css_color_selector();

	$atlantic_inline_style 	= ( class_exists( 'WooCommerce' ) ) ? 'atlantic-woocommerce-style' : 'atlantic-style';

	$primary_text_color 	= get_theme_mod( 'primary_text_color', $setting['primary_text_color'] );
	$secondary_text_color 	= get_theme_mod( 'secondary_text_color', $setting['secondary_text_color'] );
	$primary_color 			= get_theme_mod( 'primary_color', $setting['primary_color'] );
	$secondary_color 		= get_theme_mod( 'secondary_color', $setting['secondary_color'] );
	$price_color 			= get_theme_mod( 'price_color', $setting['price_color'] );
	$sale_color 			= get_theme_mod( 'sale_color', $setting['sale_color'] );
	$stars_color 			= get_theme_mod( 'stars_color', $setting['stars_color'] );

	$css= '';

	if ( $primary_text_color ) {
		$css .= sprintf( '%s{ background-color: %s }', $css_selector['primary_text_color_background'], esc_attr( $primary_text_color ) );
		$css .= sprintf( '%s{ border-color: %s }', $css_selector['primary_text_color_border'], esc_attr( $primary_text_color ) );
		$css .= sprintf( '%s{ color: %s }', $css_selector['primary_text_color'], esc_attr( $primary_text_color ) );
		$css .= '@media (min-width: 768px){ .main-navigation ul.menu a{ color: '. $primary_text_color .'} }';
		$css .= '@media (min-width: 768px){ .main-navigation ul.menu > .menu-item:before{ background-color: '. $primary_text_color .' } }';
	}

	if ( $secondary_text_color ) {
		$css .= sprintf( '%s{ background-color: %s }', $css_selector['secondary_text_color_background'], esc_attr( $secondary_text_color ) );
		$css .= sprintf( '%s{ border-color: %s }', $css_selector['secondary_text_color_border'], esc_attr( $secondary_text_color ) );
		$css .= sprintf( '%s{ color: %s }', $css_selector['secondary_text_color'], esc_attr( $secondary_text_color ) );
	}

	if ( $primary_color ) {
		$css .= sprintf( '%s{ background-color: %s }', $css_selector['primary_color_background'], esc_attr( $primary_color ) );
		$css .= sprintf( '%s{ border-color: %s }', $css_selector['primary_color_border'], esc_attr( $primary_color ) );
		$css .= sprintf( '%s{ color: %s }', $css_selector['primary_color_text'], esc_attr( $primary_color ) );
		$css .= sprintf( '::selection{background-color:%1$s}::-moz-selection{background-color:%1$s}', esc_attr( $primary_color ) );
	}

	if ( $secondary_color ) {
		$css .= sprintf( '%s{ background-color: %s }', $css_selector['secondary_color_background'], esc_attr( $secondary_color ) );
		$css .= sprintf( '%s{ border-color: %s }', $css_selector['secondary_color_border'], esc_attr( $secondary_color ) );
		$css .= sprintf( '%s{ color: %s }', $css_selector['secondary_color_text'], esc_attr( $secondary_color ) );
	}

	if ( class_exists( 'WooCommerce' ) ) {
		if( $price_color ) {
			$css .= sprintf( '%s{ color: %s }', $css_selector['price_color'], esc_attr( $price_color ) );
		}
		if( $sale_color ) {
			$css .= sprintf( '%s{ background-color: %s }', $css_selector['sale_color'], esc_attr( $sale_color ) );
		}
		if( $stars_color ) {
			$css .= sprintf( '%s{ color: %s }', $css_selector['stars_color'], esc_attr( $stars_color ) );
		}
	}

	if ( get_theme_mod( 'post_date', $setting['post_date'] ) == false ) {
		$css .= '.entry-meta .posted-on{ display: none }';
	}

	if ( get_theme_mod( 'post_author', $setting['post_author'] ) == false ) {
		$css .= '.entry-meta .byline{ display: none }';
	}

	if ( get_theme_mod( 'post_cat', $setting['post_cat'] ) == false ) {
		$css .= '.entry-footer .cat-links{ display: none }';
	}

	if ( get_theme_mod( 'post_tag', $setting['post_tag'] ) == false ) {
		$css .= '.entry-footer .tags-links{ display: none }';
	}

	if ( get_theme_mod( 'post_comments', $setting['post_comments'] ) == false ) {
		$css .= '.entry-footer .comments-link{ display: none }';
	}

    $css = str_replace( array( "\n", "\t", "\r" ), '', $css );

	if ( ! empty( $css ) ) {
		wp_add_inline_style( $atlantic_inline_style, apply_filters( 'atlantic_inline_style', trim( $css ) ) );
	}

}
add_action( 'wp_enqueue_scripts', 'atlantic_add_inline_style' );

/**
 * [atlantic_customizer_style_placeholder description]
 * @return [type] [description]
 */
function atlantic_customizer_style_placeholder(){
	if ( is_customize_preview() ) {
		echo '<style id="primary-text-color"></style>';
		echo '<style id="secondary-text-color"></style>';
		echo '<style id="primary-color"></style>';
		echo '<style id="secondary-color"></style>';
		echo '<style id="price-color"></style>';
		echo '<style id="sale-color"></style>';
		echo '<style id="stars-color"></style>';
	}
}
add_action( 'wp_head', 'atlantic_customizer_style_placeholder', 15 );

/**
 * [atlantic_editor_style description]
 * @param  [type] $mceInit [description]
 * @return [type]          [description]
 */
function atlantic_editor_style( $mceInit ) {

	$setting 				= atlantic_setting_default();
	$primary_text_color 	= get_theme_mod( 'primary_text_color', $setting['primary_text_color'] );
	$secondary_text_color 	= get_theme_mod( 'secondary_text_color', $setting['secondary_text_color'] );
	$primary_color 			= get_theme_mod( 'primary_color', $setting['primary_color'] );
	$secondary_color 		= get_theme_mod( 'secondary_color', $setting['secondary_color'] );

	$styles = '';
	$styles .= '.mce-content-body { color: ' . esc_attr( $primary_text_color ) . '; }';
	$styles .= '.mce-content-body a{ color: ' . esc_attr( $primary_color ) . '; }';
	$styles .= '.mce-content-body a:hover, .mce-content-body a:focus{ color: ' . esc_attr( $secondary_color ) . '; }';
	$styles .= '.mce-content-body ::selection{ background-color: ' . esc_attr( $secondary_color ) . '; }';
	$styles .= '.mce-content-body ::-mozselection{ background-color: ' . esc_attr( $secondary_color ) . '; }';

	$styles = str_replace( array( "\n", "\t", "\r" ), '', $styles );

	if ( !isset( $mceInit['content_style'] ) ) {
		$mceInit['content_style'] = trim( $styles ) . ' ';
	} else {
		$mceInit['content_style'] .= ' ' . trim( $styles ) . ' ';
	}

	return $mceInit;

}
add_filter( 'tiny_mce_before_init', 'atlantic_editor_style' );
