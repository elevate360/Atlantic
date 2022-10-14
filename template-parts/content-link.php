<?php
/**
 * Template part for displaying link posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Atlantic
 */
$entry_link = ( !is_singular() ) ? 'entry-link' : '';
$background = get_the_post_thumbnail_url( get_the_id(), 'post-thumbnail' );
$link_bg = ( !is_singular() && has_post_thumbnail() ) ? 'style="background-image:url('. $background .')"' : '';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php if( is_singular() ) :?>
	<header class="entry-header">
		<?php
		atlantic_post_thumbnail();

		the_title( '<h1 class="entry-title">', '</h1>' );

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php atlantic_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
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

<header class="entry-header <?php echo $entry_link;?>" <?php echo $link_bg;?>>
	<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( atlantic_get_link_url() ) . '" rel="bookmark">', '</a></h2>' );?>
	<div class="entry-meta">
		<?php atlantic_posted_on(); ?>
	</div><!-- .entry-meta -->
	<div class="external-link">
		<?php echo sprintf( '<a href="%1$s">%1$s %2$s</a>', esc_url( atlantic_get_link_url() ), atlantic_get_svg( array( 'icon' => 'external' ) ) );?>
	</div>
</header>
<?php endif;?>
</article><!-- #post-<?php the_ID(); ?> -->
