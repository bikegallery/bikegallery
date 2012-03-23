<?php
/**
 * Template Name: Front Page
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>

	<section class="grid_10 content">

		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

			<article class="post">
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>
				<?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>
			</article><!-- .post -->

		<?php endwhile; ?>

	</section><!-- .grid_10 .content -->

<?php get_footer(); ?>
