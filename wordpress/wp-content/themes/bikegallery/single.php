<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>

			<section class="grid_8 content">

				<div class="posts">

					<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

						<div class="post_nav">
							<div class="float_left"><?php previous_post_link( '%link', '' . _x( '&larr;', 'Previous post link', 'twentyten' ) . ' %title' ); ?></div>
							<div class="float_right"><?php next_post_link( '%link', '%title ' . _x( '&rarr;', 'Next post link', 'twentyten' ) . '' ); ?></div>
							<div class="clear">&nbsp;</div>
						</div><!-- .post_nav -->

						<article class="post">
							<h1><?php the_title(); ?></h1>

							<?php twentyten_posted_on(); ?>

							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>

						<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>

							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyten_author_bio_avatar_size', 60 ) ); ?>
							<h2><?php printf( esc_attr__( 'About %s', 'twentyten' ), get_the_author() ); ?></h2>
							<?php the_author_meta( 'description' ); ?>
							<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
								<?php printf( __( 'View all posts by %s &rarr;', 'twentyten' ), get_the_author() ); ?>
							</a>

						<?php endif; ?>

							<?php twentyten_posted_in(); ?>
							<?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>
						</article><!-- .post -->

						<div class="post_nav">
							<div class="float_left"><?php previous_post_link( '%link', '' . _x( '&larr;', 'Previous post link', 'twentyten' ) . ' %title' ); ?></div>
							<div class="float_right"><?php next_post_link( '%link', '%title ' . _x( '&rarr;', 'Next post link', 'twentyten' ) . '' ); ?></div>
							<div class="clear">&nbsp;</div>
						</div><!-- .post_nav -->

						<?php comments_template( '', true ); ?>

					<?php endwhile; // end of the loop. ?>

			</section><!-- .grid_8 .content -->

			<section class="grid_2 right_sidebar">
				<?php if ( is_active_sidebar( 'right-sidebar-widget-area' ) ) : ?>
					<ul class="xoxo">
						<?php dynamic_sidebar( 'right-sidebar-widget-area' ); ?>
					</ul>
				<?php endif; ?>
			</section><!-- .grid_2 .right_sidebar -->

<?php get_footer(); ?>
