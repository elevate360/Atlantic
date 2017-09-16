/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $, api ) {

	// Site title and description.
	api( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	api( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	api( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// Post Meta
	api( 'post_date', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.entry-meta .posted-on' ).css( {
					'display': 'inline-block'
				} );
			} else {
				$( '.entry-meta .posted-on' ).css( {
					'display': 'none'
				} );
			}
		} );
	} );

	api( 'post_author', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.entry-meta .byline' ).css( {
					'display': 'inline-block'
				} );
			} else {
				$( '.entry-meta .byline' ).css( {
					'display': 'none'
				} );
			}
		} );
	} );

	api( 'post_cat', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.entry-footer .cat-links' ).css( {
					'display': 'inline-block'
				} );
			} else {
				$( '.entry-footer .cat-links' ).css( {
					'display': 'none'
				} );
			}
		} );
	} );

	api( 'post_tag', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.entry-footer .tags-links' ).css( {
					'display': 'inline-block'
				} );
			} else {
				$( '.entry-footer .tags-links' ).css( {
					'display': 'none'
				} );
			}
		} );
	} );

	api( 'post_comments', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.entry-footer .comments-link' ).css( {
					'display': 'inline-block'
				} );
			} else {
				$( '.entry-footer .comments-link' ).css( {
					'display': 'none'
				} );
			}
		} );
	} );

	api( 'author_display', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.author-info' ).css( {
					'display': 'inline-block'
				} );
			} else {
				$( '.author-info' ).css( {
					'display': 'none'
				} );
			}
		} );
	} );

	api( 'primary_text_color', function( value ){
		value.bind( function( to ) {
			$( '#primary-text-color' ).text(
				AtlanticCustomizerl10n.primary_text_color_background + '{background-color:'+ to +'}' +
				AtlanticCustomizerl10n.primary_text_color_border + '{border-color:'+ to +'}' +
				AtlanticCustomizerl10n.primary_text_color + '{color:'+ to +'}' +
				'@media (min-width: 768px){ .main-navigation ul.menu a{ color: '+ to +' } }' +
				'@media (min-width: 768px){ .main-navigation ul.menu > .menu-item:before{ background-color: '+ to +' } }');
		} );
	} );

	api( 'secondary_text_color', function( value ){
		value.bind( function( to ) {
			$( '#secondary-text-color' ).text(
				AtlanticCustomizerl10n.secondary_text_color_background + '{background-color:'+ to +'}' +
				AtlanticCustomizerl10n.secondary_text_color_border + '{border-color:'+ to +'}' +
				AtlanticCustomizerl10n.secondary_text_color + '{color:'+ to +'}' );
		} );
	} );

	api( 'primary_color', function( value ){
		value.bind( function( to ) {
			$( '#primary-color' ).text(
				AtlanticCustomizerl10n.primary_color_background + '{background-color:'+ to +'}' +
				AtlanticCustomizerl10n.primary_color_border + '{border-color:'+ to +'}' +
				AtlanticCustomizerl10n.primary_color_text + '{color:'+ to +'}' );
		} );
	} );

	api( 'secondary_color', function( value ){
		value.bind( function( to ) {
			$( '#secondary-color' ).text(
				AtlanticCustomizerl10n.secondary_color_background + '{background-color:'+ to +'}' +
				AtlanticCustomizerl10n.secondary_color_border + '{border-color:'+ to +'}' +
				AtlanticCustomizerl10n.secondary_color_text + '{color:'+ to +'}' );
		} );
	} );

	api( 'price_color', function( value ){
		value.bind( function( to ) {
			$( '#price-color' ).text(
				AtlanticCustomizerl10n.price_color + '{color:'+ to +'}' );
		} );
	} );

	api( 'sale_color', function( value ){
		value.bind( function( to ) {
			$( '#sale-color' ).text(
				AtlanticCustomizerl10n.sale_color + '{background-color:'+ to +'}' );
		} );
	} );

	api( 'stars_color', function( value ){
		value.bind( function( to ) {
			$( '#stars-color' ).text(
				AtlanticCustomizerl10n.stars_color + '{color:'+ to +'}' );
		} );
	} );

	api.selectiveRefresh.bind( 'partial-content-rendered', function( placement ) {

		var container, button, menu, links, i, len;

		container = document.getElementById( 'site-navigation' );
		if ( ! container ) {
			return;
		}

		button = container.getElementsByTagName( 'button' )[0];
		if ( 'undefined' === typeof button ) {
			return;
		}

		menu = container.getElementsByTagName( 'ul' )[0];

		// Hide menu toggle button if menu is empty and return early.
		if ( 'undefined' === typeof menu ) {
			button.style.display = 'none';
			return;
		}

		menu.setAttribute( 'aria-expanded', 'false' );
		if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
			menu.className += ' nav-menu';
		}

		button.onclick = function() {
			if ( -1 !== container.className.indexOf( 'toggled' ) ) {
				container.className = container.className.replace( ' toggled', '' );
				button.setAttribute( 'aria-expanded', 'false' );
				menu.setAttribute( 'aria-expanded', 'false' );
			} else {
				container.className += ' toggled';
				button.setAttribute( 'aria-expanded', 'true' );
				menu.setAttribute( 'aria-expanded', 'true' );
			}
		};

		// Get all the link elements within the menu.
		links    = menu.getElementsByTagName( 'a' );

		// Each time a menu link is focused or blurred, toggle focus.
		for ( i = 0, len = links.length; i < len; i++ ) {
			links[i].addEventListener( 'focus', toggleFocus, true );
			links[i].addEventListener( 'blur', toggleFocus, true );
		}

		/**
		 * Sets or removes .focus class on an element.
		 */
		function toggleFocus() {
			var self = this;

			// Move up through the ancestors of the current link until we hit .nav-menu.
			while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

				// On li elements toggle the class .focus.
				if ( 'li' === self.tagName.toLowerCase() ) {
					if ( -1 !== self.className.indexOf( 'focus' ) ) {
						self.className = self.className.replace( ' focus', '' );
					} else {
						self.className += ' focus';
					}
				}

				self = self.parentElement;
			}
		}

		/**
		 * Toggles `focus` class to allow submenu access on tablets.
		 */
		( function( container ) {
			var touchStartFn, i,
				parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

			if ( 'ontouchstart' in window ) {
				touchStartFn = function( e ) {
					var menuItem = this.parentNode, i;

					if ( ! menuItem.classList.contains( 'focus' ) ) {
						e.preventDefault();
						for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
							if ( menuItem === menuItem.parentNode.children[i] ) {
								continue;
							}
							menuItem.parentNode.children[i].classList.remove( 'focus' );
						}
						menuItem.classList.add( 'focus' );
					} else {
						menuItem.classList.remove( 'focus' );
					}
				};

				for ( i = 0; i < parentLink.length; ++i ) {
					parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
				}
			}
		}( container ) );

		$( document ).ready( function() {

			$( '.main-navigation .sub-menu' ).before( '<button class="sub-menu-toggle" role="button" aria-expanded="false">' + Atlanticl10n.expandMenu + Atlanticl10n.collapseMenu + Atlanticl10n.subNav + '</button>' );
			$( '.sub-menu-toggle' ).on( 'click', function( e ) {

				e.preventDefault();

				var $this = $( this );
				$this.attr( 'aria-expanded', function( index, value ) {
					return 'false' === value ? 'true' : 'false';
				});

				// Add class to toggled menu
				$this.toggleClass( 'toggled' );
				$this.next( '.sub-menu' ).slideToggle( 0 );

			});

		});

	});

	api.selectiveRefresh.bind( 'sidebar-updated', function( sidebarPartial ) {
		var $footerWidgets = $( '.widget-area .masonry-container' );
		if ( 'sidebar-1' === sidebarPartial.sidebarId || 'sidebar-2' === sidebarPartial.sidebarId ) {
            $footerWidgets.masonry( 'reloadItems' );
            $footerWidgets.masonry( 'layout' );
		}
	});

} )( jQuery, wp.customize );
