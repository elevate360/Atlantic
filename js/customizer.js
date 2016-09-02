/**
 * customizer.js
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	
	// Site title and description
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Body bg color
	wp.customize( 'atlantic_bg_color', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( {
				'background-color': to
			} );
		} );
	} );
	// Headings color
	wp.customize( 'atlantic_heading_color', function( value ) {
		value.bind( function( to ) {
			$( 'h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, h1 a:visited, h2 a:visited, h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited' ).css( {
				'color': to
			} );
		} );
	} );
	// Navigation color
	wp.customize( 'atlantic_navigation_color', function( value ) {
		value.bind( function( to ) {
			$( '.main-navigation a, .main-navigation a:visited' ).css( {
				'color': to
			} );
		} );
	} );
	// Font color
	wp.customize( 'atlantic_font_color', function( value ) {
		value.bind( function( to ) {
			$( 'body, button, input, select, textarea' ).css( {
				'color': to
			} );
		} );
	} );
	// Links color
	wp.customize( 'atlantic_link_color', function( value ) {
		value.bind( function( to ) {
			$( 'a, a:visited' ).css( {
				'color': to
			} );
		} );
	} );

	// Website width
	wp.customize( 'atlantic_width', function( value ) {
		value.bind( function( to ) {
			$( '.inner' ).css( {
				'max-width': to + 'px'
			} );
		} );
	} );
	// Content width
	wp.customize( 'atlantic_content_width', function( value ) {
		value.bind( function( to ) {
			$( '.inner .inner' ).css( {
				'max-width': to + 'px'
			} );
		} );
	} );

	// Content font
	wp.customize( 'atlantic_font', function( value ) {
		value.bind( function( to ) {
			if ( '' === to ) {
				$( 'body, button, input, select, textarea' ).css( {
					'font-family': "'Source Code Pro', 'Courier New', Helvetica, Arial, sans-serif"
				} );
			} else {
				$('body').append("<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=" + to +"' type='text/css' media='all' />");

				$( 'body, button, input, select, textarea' ).css( {
					'font-family': "'" + to + "', 'Courier New', Helvetica, Arial, sans-serif"
				} );
			}
		} );
	} );
	// Content heading font
	wp.customize( 'atlantic_heading_font', function( value ) {
		value.bind( function( to ) {
			if ( '' === to ) {
				$( 'h1, h2, h3, h4, h5, h6' ).css( {
					'font-family': "'Source Code Pro', 'Courier New', Helvetica, Arial, sans-serif"
				} );
			} else {
				$('body').append("<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=" + escape(to) +"' type='text/css' media='all' />");

				$( 'h1, h2, h3, h4, h5, h6' ).css( {
					'font-family': "'" + to + "', 'Courier New', Helvetica, Arial, sans-serif"
				} );
			}
		} );
	} );
	
	wp.customize('atlantic_font_base_size', function( value ){
		value.bind( function ( value ){
			int_val = parseFloat(value);
			html_rems = (62.5 * int_val) + '%';
			$('html').css('font-size', html_rems);
		});
		
	});
	
	
} )( jQuery );
