<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Atlantic
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
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
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'atlantic' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

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