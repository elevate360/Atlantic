<?php
/**
 * Atlantic Theme Customizer
 *
 * @package Atlantic
 */

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function atlantic_customize_preview_js() {

	$css_selector = atlantic_css_color_selector();

	wp_enqueue_script( 'atlantic_customizer', get_template_directory_uri() . '/assets/js/customizer.min.js', array( 'customize-preview', 'customize-selective-refresh' ), '20151215', true );

	$output = array(
		'primary_text_color' 				=> $css_selector['primary_text_color'],
		'primary_text_color_background' 	=> $css_selector['primary_text_color_background'],
		'primary_text_color_border' 		=> $css_selector['primary_text_color_border'],
		'secondary_text_color' 				=> $css_selector['secondary_text_color'],
		'secondary_text_color_background' 	=> $css_selector['secondary_text_color_background'],
		'secondary_text_color_border' 		=> $css_selector['secondary_text_color_border'],
		'primary_color_text' 				=> $css_selector['primary_color_text'],
		'primary_color_background' 			=> $css_selector['primary_color_background'],
		'primary_color_border' 				=> $css_selector['primary_color_border'],
		'secondary_color_text' 				=> $css_selector['secondary_color_text'],
		'secondary_color_background' 		=> $css_selector['secondary_color_background'],
		'secondary_color_border' 			=> $css_selector['secondary_color_border'],
		'price_color' 						=> $css_selector['price_color'],
		'sale_color' 						=> $css_selector['sale_color'],
		'stars_color' 						=> $css_selector['stars_color'],
	);
	wp_localize_script( 'atlantic_customizer', 'AtlanticCustomizerl10n', $output );

}
add_action( 'customize_preview_init', 'atlantic_customize_preview_js' );

/**
 * [atlantic_setting_default description]
 * @return [type] [description]
 */
function atlantic_setting_default(){
	$settings = array(
		'primary_text_color'	=> '#404040',
		'secondary_text_color'	=> '#909090',
		'primary_color'			=> '#00bcd4',
		'secondary_color'		=> '#0097a7',
		'price_color'			=> '#77a464',
		'sale_color'			=> '#f44336',
		'stars_color'			=> '#fc0',
		'wc_columns'			=> 'col-shop-4',
		'wc_products_per_page'	=> 12,
		'post_date'				=> true,
		'post_author'			=> true,
		'post_cat'				=> true,
		'post_tag'				=> true,
		'post_comments'			=> true,
		'author_display'		=> true,
		'max_gallery'			=> 5,
		'excerpt_length'		=> 20,
		'blog_layout'			=> 'masonry-container',
		'posts_navigation'		=> 'posts_navigation',
		'return_top'			=> true,
	);

	return apply_filters( 'atlantic_setting_default', $settings );
}

/**
 * [atlantic_css_color_selector description]
 * @return [type] [description]
 */
function atlantic_css_color_selector(){

	$atlantic_css_color_selector = array(
		'primary_text_color' => '
			body,
			button,
			input,
			select,
			optgroup,
			textarea,
			.entry-title a,
			.author-title a,
			.page-numbers,
			.comment-navigation a,
			.posts-navigation a,
			.post-navigation a,
			.comment-meta a,
			.return-to-top,
			.woocommerce .woocommerce-breadcrumb a,
			.woocommerce nav.woocommerce-pagination ul li a,
			.woocommerce nav.woocommerce-pagination ul li span,
			.woocommerce-page nav.woocommerce-pagination ul li a,
			.woocommerce-page nav.woocommerce-pagination ul li span,
			.woocommerce-error,
			.woocommerce-info,
			.woocommerce-message,
			.woocommerce .woocommerce-loop-product__link,
			.woocommerce-page .woocommerce-loop-product__link,
			.woocommerce-MyAccount-navigation a,
			.woocommerce-review__author,
			.woocommerce-MyAccount-navigation a:focus,
			.woocommerce-MyAccount-navigation a:hover
		',
		'primary_text_color_background' => '
			.single-content:not(.single-product) .entry-title:before,
			.widget-area > .container:before,
			.site-footer > .container:before
		',
		'primary_text_color_border' => '
			.return-to-top
		',

		'secondary_text_color' => '
			.site-description,
			.entry-meta a,
			.entry-footer a,
			.entry-footer .icon,
			h2.about-author,
			.comment-navigation a span,
			.posts-navigation a span,
			.post-navigation a span,
			.comment-form label,
			#secondary a,
			.social-navigation a,
			.woocommerce .woocommerce-breadcrumb,
			.woocommerce .star-rating::before,
			.woocommerce-page .star-rating::before,
			.woocommerce ul.products li.product .button,
			.woocommerce-page ul.products li.product .button,
			.woocommerce div.product .woocommerce-tabs ul.tabs li a,
			.woocommerce-page div.product .woocommerce-tabs ul.tabs li a,
			.woocommerce form .form-row label,
			.woocommerce-page form .form-row label
		',
		'secondary_text_color_background' => '
			.site-description:before,
			.site-description:after
		',
		'secondary_text_color_border' => '
			.post-edit-link,
			.site-description:before,
			.site-description:after,
			.widget_tag_cloud a,
			.widget_product_tag_cloud a,
			.instagram-follow-link a,
			.woocommerce ul.products li.product .button,
			.woocommerce-page ul.products li.product .button
		',

		'primary_color_text' => '
			a,
			.entry-meta a:hover,
			.entry-meta a:focus,
			.entry-title a:hover,
			.entry-title a:focus,
			.entry-footer a:hover,
			.entry-footer a:focus,
			.author-title a:hover,
			.author-title a:focus,
			.comment-meta a:hover,
			.comment-meta a:focus,
			.comment-navigation a:hover,
			.comment-navigation a:focus,
			.posts-navigation a:hover,
			.posts-navigation a:focus,
			.post-navigation a:hover,
			.post-navigation a:focus,
			.page-numbers.current,
			.page-numbers:hover:not(.current),
			.page-numbers:focus:not(.current),
			.social-navigation a:hover,
			.social-navigation a:focus,
			#secondary a:hover,
			#secondary a:focus,
			.woocommerce .woocommerce-breadcrumb a:focus,
			.woocommerce .woocommerce-breadcrumb a:hover,
			.woocommerce .woocommerce-loop-product__link:focus,
			.woocommerce .woocommerce-loop-product__link:hover,
			.woocommerce-page .woocommerce-loop-product__link:focus,
			.woocommerce-page .woocommerce-loop-product__link:hover,
			.woocommerce nav.woocommerce-pagination ul li a:focus,
			.woocommerce nav.woocommerce-pagination ul li a:hover,
			.woocommerce-page nav.woocommerce-pagination ul li a:focus,
			.woocommerce-page nav.woocommerce-pagination ul li a:hover,
			.woocommerce nav.woocommerce-pagination ul li span.current,
			.woocommerce-page nav.woocommerce-pagination ul li span.current
		',
		'primary_color_background' => '
			button,
			input[type="button"],
			input[type="reset"],
			input[type="submit"],
			.screen-reader-text:focus,
			.post-edit-link:hover,
			.post-edit-link:focus,
			.comment-body > .reply a:hover,
			.comment-body > .reply a:focus,
			#cancel-comment-reply-link:hover,
			#cancel-comment-reply-link:focus,
			.widget_tag_cloud a:hover,
			.widget_tag_cloud a:focus,
			.widget_product_tag_cloud a:hover,
			.widget_product_tag_cloud a:focus,
			.instagram-follow-link a:hover,
			.instagram-follow-link a:focus,
			.return-to-top:hover,
			.return-to-top:focus,
			.woocommerce ul.products li.product .button:focus,
			.woocommerce ul.products li.product .button:hover,
			.woocommerce-page ul.products li.product .button:focus,
			.woocommerce-page ul.products li.product .button:hover,
			.woocommerce #respond input#submit.alt,
			.woocommerce a.button.alt,
			.woocommerce button.button.alt,
			.woocommerce input.button.alt,
			.woocommerce-page #respond input#submit.alt,
			.woocommerce-page a.button.alt,
			.woocommerce-page button.button.alt,
			.woocommerce-page input.button.alt,
			.woocommerce #respond input#submit,
			.woocommerce a.button,
			.woocommerce button.button,
			.woocommerce input.button,
			.woocommerce-page #respond input#submit,
			.woocommerce-page a.button,
			.woocommerce-page button.button,
			.woocommerce-page input.button,
			.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
			.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
			.woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle,
			.woocommerce-page .widget_price_filter .ui-slider .ui-slider-range
		',
		'primary_color_border' => '
			button,
			input[type="button"],
			input[type="reset"],
			input[type="submit"],
			input[type="text"]:focus,
			input[type="email"]:focus,
			input[type="url"]:focus,
			input[type="password"]:focus,
			input[type="search"]:focus,
			input[type="number"]:focus,
			input[type="tel"]:focus,
			input[type="range"]:focus,
			input[type="date"]:focus,
			input[type="month"]:focus,
			input[type="week"]:focus,
			input[type="time"]:focus,
			input[type="datetime"]:focus,
			input[type="datetime-local"]:focus,
			input[type="color"]:focus,
			textarea:focus,
			.post-edit-link:hover,
			.post-edit-link:focus,
			.comment-body > .reply a:hover,
			.comment-body > .reply a:focus,
			.page-numbers:hover:not(.current),
			.page-numbers:focus:not(.current),
			.widget_tag_cloud a:hover,
			.widget_tag_cloud a:focus,
			.widget_product_tag_cloud a:hover,
			.widget_product_tag_cloud a:focus,
			.instagram-follow-link a:hover,
			.instagram-follow-link a:focus,
			.return-to-top:hover,
			.return-to-top:focus,
			.woocommerce ul.products li.product .button:focus,
			.woocommerce ul.products li.product .button:hover,
			.woocommerce-page ul.products li.product .button:focus,
			.woocommerce-page ul.products li.product .button:hover,
			.woocommerce #respond input#submit.alt,
			.woocommerce a.button.alt,
			.woocommerce button.button.alt,
			.woocommerce input.button.alt,
			.woocommerce-page #respond input#submit.alt,
			.woocommerce-page a.button.alt,
			.woocommerce-page button.button.alt,
			.woocommerce-page input.button.alt,
			.woocommerce #respond input#submit,
			.woocommerce a.button,
			.woocommerce button.button,
			.woocommerce input.button,
			.woocommerce-page #respond input#submit,
			.woocommerce-page a.button,
			.woocommerce-page button.button,
			.woocommerce-page input.button,
			.woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
			.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active a,
			.woocommerce-MyAccount-navigation li.is-active a
		',

		'secondary_color_background' => '
			button:hover,
			button:active,
			button:focus,
			input[type="button"]:hover,
			input[type="button"]:active,
			input[type="button"]:focus,
			input[type="reset"]:hover,
			input[type="reset"]:active,
			input[type="reset"]:focus,
			input[type="submit"]:hover,
			input[type="submit"]:active,
			input[type="submit"]:focus,
			.woocommerce #respond input#submit.alt:focus,
			.woocommerce #respond input#submit.alt:hover,
			.woocommerce a.button.alt:focus,
			.woocommerce a.button.alt:hover,
			.woocommerce button.button.alt:focus,
			.woocommerce button.button.alt:hover,
			.woocommerce input.button.alt:focus,
			.woocommerce input.button.alt:hover,
			.woocommerce-page #respond input#submit.alt:focus,
			.woocommerce-page #respond input#submit.alt:hover,
			.woocommerce-page a.button.alt:focus,
			.woocommerce-page a.button.alt:hover,
			.woocommerce-page button.button.alt:focus,
			.woocommerce-page button.button.alt:hover,
			.woocommerce-page input.button.alt:focus,
			.woocommerce-page input.button.alt:hover,
			.woocommerce #respond input#submit:focus,
			.woocommerce #respond input#submit:hover,
			.woocommerce a.button:focus,
			.woocommerce a.button:hover,
			.woocommerce button.button:focus,
			.woocommerce button.button:hover,
			.woocommerce input.button:focus,
			.woocommerce input.button:hover,
			.woocommerce-page #respond input#submit:focus,
			.woocommerce-page #respond input#submit:hover,
			.woocommerce-page a.button:focus,
			.woocommerce-page a.button:hover,
			.woocommerce-page button.button:focus,
			.woocommerce-page button.button:hover,
			.woocommerce-page input.button:focus,
			.woocommerce-page input.button:hover,
			.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,
			.woocommerce-page .widget_price_filter .price_slider_wrapper .ui-widget-content
		',
		'secondary_color_border' => '
			button:hover,
			button:active,
			button:focus,
			input[type="button"]:hover,
			input[type="button"]:active,
			input[type="button"]:focus,
			input[type="reset"]:hover,
			input[type="reset"]:active,
			input[type="reset"]:focus,
			input[type="submit"]:hover,
			input[type="submit"]:active,
			input[type="submit"]:focus,
			.woocommerce #respond input#submit.alt:focus,
			.woocommerce #respond input#submit.alt:hover,
			.woocommerce a.button.alt:focus,
			.woocommerce a.button.alt:hover,
			.woocommerce button.button.alt:focus,
			.woocommerce button.button.alt:hover,
			.woocommerce input.button.alt:focus,
			.woocommerce input.button.alt:hover,
			.woocommerce-page #respond input#submit.alt:focus,
			.woocommerce-page #respond input#submit.alt:hover,
			.woocommerce-page a.button.alt:focus,
			.woocommerce-page a.button.alt:hover,
			.woocommerce-page button.button.alt:focus,
			.woocommerce-page button.button.alt:hover,
			.woocommerce-page input.button.alt:focus,
			.woocommerce-page input.button.alt:hover,
			.woocommerce #respond input#submit:focus,
			.woocommerce #respond input#submit:hover,
			.woocommerce a.button:focus,
			.woocommerce a.button:hover,
			.woocommerce button.button:focus,
			.woocommerce button.button:hover,
			.woocommerce input.button:focus,
			.woocommerce input.button:hover,
			.woocommerce-page #respond input#submit:focus,
			.woocommerce-page #respond input#submit:hover,
			.woocommerce-page a.button:focus,
			.woocommerce-page a.button:hover,
			.woocommerce-page button.button:focus,
			.woocommerce-page button.button:hover,
			.woocommerce-page input.button:focus,
			.woocommerce-page input.button:hover
		',
		'secondary_color_text' => '
			a:hover,
			a:focus
		',

		'price_color'	=> '
			.woocommerce ul.products li.product .price,
			.woocommerce div.product p.price,
			.woocommerce div.product span.price,
			.woocommerce div.product p.price ins,
			.woocommerce div.product span.price ins
		',

		'sale_color'	=> '
			.woocommerce span.onsale,
			.woocommerce ul.products li.product .onsale,
			.woocommerce-page span.onsale,
			.woocommerce-page ul.products li.product .onsale
		',

		'stars_color'	=> '
			.woocommerce .star-rating,
			.woocommerce p.stars a,
			.woocommerce-page .star-rating,
			.woocommerce-page p.stars a
		',

	);

	return apply_filters( 'atlantic_css_color_selector', $atlantic_css_color_selector );
}

/**
 * Load Customizer Setting.
 */
require get_template_directory() . '/inc/customizer/sanitization-callbacks.php';
require get_template_directory() . '/inc/customizer/settings.php';
require get_template_directory() . '/inc/customizer/output.php';
