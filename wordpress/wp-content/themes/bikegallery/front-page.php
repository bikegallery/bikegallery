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
	<section class="grid_7 content front_page">

		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

			<article class="post">
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>
				<?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>
			</article><!-- .post -->

		<?php endwhile; ?>

	</section><!-- .grid_7 .content -->

	<aside class="grid_3 front_page_right_sidebar">
			<h3>Recent Blog Posts</h3>
			<ul><?php wp_get_archives('type=postbypost&format=html&limit=10'); ?></ul>
			<h3>Recent Flickr</h3>
			<?php echo do_shortcode('[slickr-flickr search="sets" set="72157630284645846" photos_per_row="2" type="slideshow" autoplay="on"]'); ?>
	</aside>
<?php get_footer(); ?>
