<?php
/**
 * Atlantic back compat functionality
 *
 * Prevents Atlantic from running on WordPress versions prior to 6.0,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 6.0.
 *
 * @package Atlantic
 */

/**
 * Prevent switching to Atlantic on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since Atlantic 1.0.0
 */
function atlantic_switch_theme() {
	switch_theme( WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'atlantic_upgrade_notice' );
}
add_action( 'after_switch_theme', 'atlantic_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Atlantic on WordPress versions prior to 6.0.
 *
 * @since Atlantic 1.0.0
 *
 * @global string $wp_version WordPress version.
 */
function atlantic_upgrade_notice() {
       $message = sprintf( __( 'Atlantic requires at least WordPress version 6.0. You are running version %s. Please upgrade and try again.', 'atlantic' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 6.0.
 *
 * @since Atlantic 1.0.0
 *
 * @global string $wp_version WordPress version.
 */
function atlantic_customize() {
       wp_die( sprintf( __( 'Atlantic requires at least WordPress version 6.0. You are running version %s. Please upgrade and try again.', 'atlantic' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'atlantic_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 6.0.
 *
 * @since Atlantic 1.0.0
 *
 * @global string $wp_version WordPress version.
 */
function atlantic_preview() {
	if ( isset( $_GET['preview'] ) ) {
               wp_die( sprintf( __( 'Atlantic requires at least WordPress version 6.0. You are running version %s. Please upgrade and try again.', 'atlantic' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'atlantic_preview' );
