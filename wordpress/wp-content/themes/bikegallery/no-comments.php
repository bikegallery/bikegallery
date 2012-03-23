
<?php
/**
 * Template Name: No Comments
 *
 * A custom page template without sidebar.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the wordpress construct of pages
 * and that other 'pages' on your wordpress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>

				<div class="posts">
					<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

						<article class="post">
							<?php if ( is_front_page() ) { ?>
								<h2><?php the_title(); ?></h2>
							<?php } else { ?>	
								<h1><?php the_title(); ?></h1>
							<?php } ?>				

								<?php the_content(); ?>
								<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>
								<?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>
						</article><!-- .post -->

					<?php endwhile; ?>
				</div><!-- .posts -->
			</section><!-- .grid_9 .content -->
<?php get_footer(); ?>
