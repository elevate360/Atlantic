<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Atlantic
 */

?>

		</div><!-- #content -->
	</div><!-- #page -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="inner site-info">
			<?php printf( esc_html__( '%1$s by %2$s', 'atlantic' ), 'atlantic', '<a href="https://elevate360.com.au/" rel="designer">elevate</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>