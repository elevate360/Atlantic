<?php
/**
 * WooCommerce compatibility file
 *
 * @package Atlantic
 */

if( ! function_exists( 'atlantic_woocommerce_setup' ) ) :
/**
 * [atlantic_woocommerce_setup description]
 * @return [type] [description]
 */
function atlantic_woocommerce_setup(){

	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

}
endif;
add_action( 'after_setup_theme', 'atlantic_woocommerce_setup' );

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper',     10 );
remove_action( 'woocommerce_after_main_content',  'woocommerce_output_content_wrapper_end', 10 );

/**
 * [atlantic_products_markup_open description]
 * @return [type] [description]
 */
function atlantic_products_markup_open(){
	echo '<div id="primary" class="content-area">';
		echo '<main id="main" class="site-main" role="main">';
			echo '<div class="container">';
}
add_action( 'woocommerce_before_main_content', 'atlantic_products_markup_open' );

/**
 * [atlantic_products_markup_close description]
 * @return [type] [description]
 */
function atlantic_products_markup_close(){
			echo '</div><!-- .container -->';
		echo '</main><!-- #main -->';
	echo '</div><!-- #primary -->';
}
add_action( 'woocommerce_after_main_content', 'atlantic_products_markup_close' );

/**
 * [atlantic_loop_shop_per_page description]
 * @param  [type] $cols [description]
 * @return [type]       [description]
 */
function atlantic_loop_shop_per_page( $cols ) {
	$cols = get_theme_mod( 'wc_products_per_page', 12 );
	return $cols;
}
add_filter( 'loop_shop_per_page', 'atlantic_loop_shop_per_page', 20 );
