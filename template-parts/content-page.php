<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Atlantic
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<!-- post thumbnail -->
		<?php
			if ( has_post_thumbnail() ) : // Check if thumbnail exists
				the_post_thumbnail(); // Declare pixel size you need inside the array
			endif;
		?>
		<!-- /post thumbnail -->
	</header><!-- .entry-header -->

	<div class="entry-content inner">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'atlantic' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer inner">
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'atlantic' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<p class="edit-link">',
				'</p>'
			);
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

<div class="inner">
	<?php get_template_part( 'template-parts/comments' ); ?>
</div>