<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the wordpress construct of pages
 * and that other 'pages' on your wordpress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage bikegallery
 */

get_header(); ?>
	<section class="grid_12 content">

		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

			<article class="post">
				<h1>
					<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
						<?php the_title(); ?>
					</a>
				</h1>
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>
			</article><!-- .post -->

		<?php endwhile; ?>

	</section><!-- .grid_12 .content -->

	<div class="grid_12">
		<?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>
	</div>

<?php get_footer(); ?>
