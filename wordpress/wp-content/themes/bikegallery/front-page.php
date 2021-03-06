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
 * @subpackage bikegallery
 */

get_header(); ?>
	<section class="grid_7 content front_page">
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

			<article class="post">
				<div class="post_meta">
					<h1><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
					<a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>&nbsp;|&nbsp;<a href=""><?php comments_number(); ?></a>&nbsp;|&nbsp;posted by <?php the_author_posts_link();?>&nbsp;|&nbsp;<?php the_category(', '); ?>
				</div><!-- .post_meta -->

				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>
				<?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>
			</article><!-- .post -->
		<?php endwhile; ?> <!-- end loop -->

			<section class="post_navigation">
				<?php posts_nav_link(); ?>
			</section>

	</section><!-- .grid_7 .content -->

	<aside class="grid_3 right_sidebar">
		<?php if (is_active_sidebar('right-sidebar-widget-area') ) : ?>
		<ul class="xoxo">
			<?php dynamic_sidebar('right-sidebar-widget-area'); ?>
		</ul>
		<?php endif; ?>
	</aside>
<?php get_footer(); ?>
