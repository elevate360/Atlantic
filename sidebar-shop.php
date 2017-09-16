<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Atlantic
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<div class="container">
		<div class="row masonry-container">
			<?php dynamic_sidebar( 'sidebar-2' ); ?>
		</div><!-- .row -->
	</div><!-- .container -->
</aside><!-- #secondary -->
