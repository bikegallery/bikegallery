<?php
/**
 * The template for displaying all pages.
 *
 * Template Name: Clearance Sale
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
	<link rel="stylesheet" href="/wordpress/wp-content/themes/bikegallery/css/clearance_sale_2012.css" type="text/css" media="all" />
	<img src="/wordpress/wp-content/themes/bikegallery/images/clearance_sale/clearance_sale_banner.jpg" alt="Clearance Sale Banner" class="clearance_sale_banner" />

	<section class="grid_12 content clearance_sale">

		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

			<article class="post">
				<div class="alpha grid_6">
					<?php the_content(); ?>
				</div><!-- .alpha .grid_6 -->

				<div class="grid_6 omega">
					<?php the_excerpt(); ?>
				</div><!-- .grid_6 .omega -->
				
				<div class="clear"></div>
				<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>
			</article><!-- .post -->

		<?php endwhile; ?>

	</section><!-- .grid_12 .content -->

	<div class="grid_12">
		<?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>
	</div>

<?php get_footer(); ?>
