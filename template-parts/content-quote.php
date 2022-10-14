<?php
/**
 * Template part for displaying quote posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Atlantic
 */

$background = get_the_post_thumbnail_url( get_the_id(), 'post-thumbnail' );
$quote_bg = ( !is_singular() && has_post_thumbnail() ) ? 'style="background-image:url('. $background .')"' : '';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if( is_singular() ) :?>
	<header class="entry-header">
		<?php
		atlantic_post_thumbnail();

		the_title( '<h1 class="entry-title">', '</h1>' );
		?>
		<div class="entry-meta">
			<?php atlantic_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'atlantic' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'atlantic' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php atlantic_entry_footer(); ?>
	</footer><!-- .entry-footer -->

<?php else : ?>
	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title screen-reader-text"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );?>
	</header>
	<div class="entry-content entry-quote" <?php echo $quote_bg;?>>
		<?php

			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'atlantic' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);

			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'atlantic' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'atlantic' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
<?php endif;?>
</article><!-- #post-<?php the_ID(); ?> -->
