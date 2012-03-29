<?php
/**
 * Template Name: Front Page
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
	<section class="grid_10 content">

		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

			<article class="post">
				<h1 class="bottom_border"><?php the_title(); ?></h1>
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>
				<?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>
			</article><!-- .post -->

		<?php endwhile; ?>

	</section><!-- .grid_10 .content -->

<?php get_footer(); ?>
