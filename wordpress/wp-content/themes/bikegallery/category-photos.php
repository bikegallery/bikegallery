<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>

			<section class="grid_9 content">

				<div class="posts search_results">
					<?php
						$category_description = category_description();
						if ( ! empty( $category_description ) )
							echo '' . $category_description . '';

					/* Run the loop for the category page to output the posts.
					 * If you want to overload this in a child theme then include a file
					 * called loop-category.php and that will be used instead.
					 */
					get_template_part( 'loop', 'photos' );
					?>
			</section><!-- .grid_9 .content -->

			<section class="grid_3 right_sidebar">
				<?php if ( is_active_sidebar( 'right-sidebar-widget-area' ) ) : ?>
					<ul class="xoxo">
						<?php dynamic_sidebar( 'right-sidebar-widget-area' ); ?>
					</ul>
				<?php endif; ?>
			</section><!-- .grid_3 .right_sidebar -->

<?php get_footer(); ?>
