<?php
/**
 * Template Name: Ride Guide
 *
 * @package WordPress
 * @subpackage bikegallery
 */

get_header(); ?>

			<section class="grid_12 posts content">

				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

					<article class="post">
						<?php if ( has_post_thumbnail() ) {
							the_post_thumbnail();
						} ?> 
						<div class="post_meta">
							<h1><?php the_title(); ?></h1>
						</div><!-- .post_meta -->

						<div class="alpha grid_7">
							<?php the_content(); ?>

							<div class="clear">&nbsp;</div>

							<div><?php comments_template( '', true ); ?></div>
						</div><!-- .alpha .grid_7 -->

						<div class="grid_5 omega">
							<div class="gray_block guide_sidebar">
								<?php the_excerpt(); ?>
							</div><!-- .gray_block -->
						</div>

						<?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>
					</article><!-- .post -->

				<?php endwhile; // end of the loop. ?>

			</section><!-- .grid_9 .content -->


<?php get_footer(); ?>
