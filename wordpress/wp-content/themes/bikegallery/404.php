<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage bikegallery 
 */

get_header(); ?>


	<section class="grid_9 content">

		<h1><?php _e( 'Not Found', 'twentyten' ); ?></h1>
		<p><?php _e( 'Well that\'s embarassing. We don\'t seem to have what you are looking for. Why not try searching?', 'twentyten' ); ?></p>

		<script type="text/javascript">
			// focus on search field after it has loaded
			document.getElementById('s') && document.getElementById('s').focus();
		</script>

	</section><!-- .grid_9 .content -->

<?php get_footer(); ?>
