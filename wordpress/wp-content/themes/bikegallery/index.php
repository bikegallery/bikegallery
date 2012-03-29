<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query. 
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>

			<section class="grid_9 content">

				<div class="posts list_of_posts">
					<?php
					/* Run the loop to output the posts.
					 * If you want to overload this in a child theme then include a file
					 * called loop-index.php and that will be used instead.
					 */
					 get_template_part( 'loop', 'post' );
					?>
				</div><!-- .posts -->

			</section><!-- .grid_9 .content -->

			<section class="grid_3 right_sidebar">
				<?php if ( is_active_sidebar( 'right-sidebar-widget-area' ) ) : ?>
					<ul class="xoxo">
						<?php dynamic_sidebar( 'right-sidebar-widget-area' ); ?>
					</ul>
				<?php endif; ?>
			</section><!-- .grid_3 .right_sidebar -->

<?php get_footer(); ?>
