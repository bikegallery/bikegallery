<?php
/**
 * Template Name: Overhaul Special
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
	<section class="grid_12 content">

		<img src="http://www.bikegallery.com/wordpress/wp-content/themes/bikegallery/images/overhaul_special_banner.jpg" alt="Overhaul Special" title="Overhaul Special" class="overhaul_fit_banner" />

		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

			<article class="post overhaul_special">
				<section class="alpha grid_7">
					<?php the_content(); ?>
				</section>
				<section class="grid_5 omega coupons">
					<?php the_excerpt(); ?>
				</section>
				<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>
			</article><!-- .post -->

		<?php endwhile; ?>

	</section><!-- .grid_12 .content -->

	<div class="grid_12">
		<?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>
	</div>

<?php get_footer(); ?>
