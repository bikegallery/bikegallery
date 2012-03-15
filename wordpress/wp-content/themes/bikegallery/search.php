<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>

			<section class="grid_10 content">

				<div class="posts search_results">
					<?php if ( have_posts() ) : ?>

						<h1><?php printf( __( 'Search Results for: %s', 'twentyten' ), '' . get_search_query() . '' ); ?></h1>
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
							<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentyten' ); ?></p>
							<?php get_search_form(); ?>
						</article><!-- .post -->

					<?php endif; ?>
				</div><!-- .posts -->

			</section><!-- .grid_10 .content -->

<?php get_footer(); ?>
