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

			</section><!-- .sixcol .content -->

			<section class="threecol last sidebar">
				<?php if ( is_active_sidebar('primary-widget-area') ) : ?>

				<ul class="xoxo">
					<?php dynamic_sidebar('primary-widget-area'); ?>
				</ul>

				<?php endif; ?>
			</section><!-- .threecol .last -->
		</section><!-- .row .general_body -->

		<footer class="row footer">
			<p>Part of the <a href="http://bikegallery.com" class="bikegallery_link" title="Bike Gallery">Bike Gallery</a> family</p>
<!--			<a href="http://wordpress.org/" title="Semantic Personal Publishing Platform" rel="generator">Proudly powered by WordPress </a> -->
		</footer><!-- .row -->
	</section><!-- .container -->

<?php wp_footer(); ?>

</body>
</html>
