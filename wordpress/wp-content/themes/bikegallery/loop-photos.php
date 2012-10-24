<?php
/**
 * The loop for photo category
 *
 * @package WordPress
 * @subpackage bikegallery
 */

	if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

	<article class="post photos_category">
			<div class="post_meta">
				<h1><a href="<?php the_permalink();  ?>"><?php the_title(); ?></a></h1>
				<a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>&nbsp;|&nbsp;<a href=""><?php comments_number(); ?></a>&nbsp;|&nbsp;posted by <?php the_author_posts_link();?>&nbsp;|&nbsp;<?php the_category(', '); ?>
			</div><!-- .post_meta -->

			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>
			<?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>
	</article><!-- .post -->

	<?php endwhile; ?>
