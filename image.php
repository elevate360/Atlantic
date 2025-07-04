<?php
/**
 * The template for displaying attachment image
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Atlantic
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="container">
				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'image' );

                                       if ( get_theme_mod( 'author_display', true ) == true ) {
                                               block_template_part( 'biography' );
                                       }
				?>
					<nav class="navigation post-navigation" role="navigation">
						<div class="nav-links">
							<div class="nav-previous">
								<?php previous_image_link( false,  __( '&larr; previous image', 'atlantic' ) ); ?>
							</div>
							<div class="nav-next">
								<?php next_image_link( false, __( 'next image &rarr;', 'atlantic' ) ); ?>
							</div>
						</div>
					</nav>
				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>
			</div><!-- .container -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
