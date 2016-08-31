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
		<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;
		?>

		<!-- post thumbnail -->
		<?php
			if ( has_post_thumbnail() && is_single() ) : // Check if thumbnail exists
				the_post_thumbnail(); // Declare pixel size you need inside the array
			elseif ( has_post_thumbnail() ) :
		?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail(); // Declare pixel size you need inside the array ?>
			</a>
		<?php endif; ?>
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

		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<span class="date"><?php esc_html_e( 'Posted on', 'atlantic' ); ?> <?php the_time('F j, Y'); ?></span>
				<span class="author"><?php esc_html_e( 'by', 'atlantic' ); ?> <?php the_author_posts_link(); ?>,</span>
				<span class="comments"><?php if (comments_open( get_the_ID() ) ) comments_popup_link( __( 'Leave your thoughts', 'atlantic' ), __( '1 Comment', 'atlantic' ), __( '% Comments', 'atlantic' )); ?></span>
				<hr>
				<span class="categories"><?php esc_html_e( 'Categoriesed in: ', 'atlantic' ); the_category(', '); ?></span>
				<span class="tags"><?php the_tags( __( 'Tags: ', 'atlantic' ), ', ', ''); ?></span>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->