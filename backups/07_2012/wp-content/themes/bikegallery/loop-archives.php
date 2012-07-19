<?php
/**
 * The loop for search results
 *
 * @package WordPress
 * @subpackage Bikegallery
 * @since Bikegallery 0.1
 */

	if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

	<article class="post guide_archives">

			<h2><a href="<?php the_permalink();  ?>"><?php the_title(); ?></a></h2>

			<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>
			<?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>

	</article><!-- .post -->

	<?php endwhile; ?>
