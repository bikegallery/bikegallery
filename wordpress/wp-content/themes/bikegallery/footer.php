<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */
?>

			</section><!-- .grid_6 .content -->

			<section class="grid_3 sidebar">
				<?php if ( is_active_sidebar('primary-widget-area') ) : ?>

				<ul class="xoxo">
					<?php dynamic_sidebar('primary-widget-area'); ?>
				</ul>

				<?php endif; ?>
			</section><!-- .grid_3 .sidebar -->
		<footer class="grid_12 footer">
			<p>&copy;2012 Bike Gallery. All rights reserved.</p>
<!--			<a href="http://wordpress.org/" title="Semantic Personal Publishing Platform" rel="generator">Proudly powered by WordPress </a> -->
		</footer><!-- .grid_12 .footer -->
			<div class="clear">&nbsp;</div>
		</section><!-- .viewer -->

	</section><!-- .container -->

<?php wp_footer(); ?>

</body>
</html>
