<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Atlantic
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="container">
				<?php
				if ( have_posts() ) : ?>

					<header class="page-header">
						<div class="author-info">

							<figure class="author-avatar">
								<?php
								/**
								 * Filter the Atlantic author bio avatar size.
								 *
								 * @param int $size The avatar height and width size in pixels.
								 */
								$author_bio_avatar_size = apply_filters( 'atlantic_author_bio_avatar_size', 96 );

								echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
								?>
							</figure><!-- .author-avatar -->

							<div class="author-detail">

								<h1 class="author-title">
									<?php echo get_the_author(); ?>
								</h1>

								<div class="author-description">

									<p class="author-bio">
										<?php the_author_meta( 'description' ); ?>
									</p><!-- .author-bio -->

								</div><!-- .author-description -->

							</div><!-- .author-detail -->

						</div><!-- .author-info -->
					</header><!-- .page-header -->

					<div class="row masonry-container">
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
			</div><!-- .container -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
