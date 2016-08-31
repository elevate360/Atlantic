<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package Atlantic
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.me/support/responsive-videos/
 */
function atlantic_jetpack_setup() {
	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'atlantic_jetpack_setup' );