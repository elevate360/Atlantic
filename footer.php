<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Atlantic
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="container">
			<div class="row">
				<?php if( has_nav_menu( 'menu-2' ) ) :?>
				<div class="primary-footer-info">
					<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'atlantic' ); ?>">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'menu-2',
								'menu_class'     => 'social-links-menu',
								'depth'          => 1,
								'link_before'    => '<span class="screen-reader-text">',
								'link_after'     => '</span>' . atlantic_get_svg( array( 'icon' => 'share' ) ),
							) );
						?>
					</nav><!-- .social-navigation -->
				</div>
				<?php endif;?>
				<div class="secondary-footer-info">
					<?php atlantic_do_footer_copyright();?>
				</div>
			</div><!-- .row -->
		</div><!-- .container -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php
atlantic_return_to_top();
wp_footer(); ?>

</body>
</html>
