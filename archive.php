<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Atlantic
 */

$setting = atlantic_setting_default();
$layout = get_theme_mod( 'blog_layout', $setting['blog_layout'] );
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="container">
				<?php
				if ( have_posts() ) : ?>

					<header class="page-header">
						<?php
							the_archive_title( '<h1 class="page-title">', '</h1>' );
							the_archive_description( '<div class="archive-description">', '</div>' );
						?>
					</header><!-- .page-header -->

					<div class="row <?php echo esc_attr( $layout );?>">
					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_format() );

					endwhile;
					?>
					</div><!-- .row -->
				<?php else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>
				<?php atlantic_posts_navigation();?>
			</div><!-- .container -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
