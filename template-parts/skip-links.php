<?php
/**
 * Skip links
 *
 * @package Atlantic
 */
?>

<?php if( has_nav_menu( 'menu-1' ) ) :?>
	<a class="skip-link screen-reader-text" href="#site-navigation"><?php esc_html_e( 'Skip to navigation', 'atlantic' ); ?></a>
<?php endif;?>

<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'atlantic' ); ?></a>

<?php if( is_active_sidebar( 'sidebar-1' ) || is_active_sidebar( 'sidebar-2' ) ) :?>
	<a class="skip-link screen-reader-text" href="#secondary"><?php esc_html_e( 'Skip to Footer', 'atlantic' ); ?></a>
<?php endif;?>
