<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage bikegallery
 */

get_header(); ?>

			<section class="grid_9 content">

				<div class="posts search_results">
					<?php if ( have_posts() ) : ?>

							<?php
							/* Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called loop-search.php and that will be used instead.
							 */
							 get_template_part( 'loop', 'post' );
							?>

					<?php else : ?>

						<article class="post">
							<h2><?php _e( 'Nothing Found', 'twentyten' ); ?></h2>
							<p><?php _e( 'Well that\'s embarassing. We don\'t seem to have what you are looking for. Why not try searching?', 'twentyten' ); ?></p>
							<?php get_search_form(); ?>
						</article><!-- .post -->

					<?php endif; ?>
				</div><!-- .posts -->

			</section><!-- .grid_9 .content -->

<?php get_footer(); ?>
