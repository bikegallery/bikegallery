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

		</section><!-- .viewer -->

		<div class="clear">&nbsp;</div>

		<footer class="footer">

			<div class="prefix_1 grid_2">
				<?php if ( is_active_sidebar( 'first-footer-widget-area' ) ) : ?>
					<ul class="xoxo">
						<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
					</ul>
				<?php endif; ?>
			</div><!-- .grid_3 -->

			<div class="grid_2">
				<?php if ( is_active_sidebar( 'second-footer-widget-area' ) ) : ?>
					<ul class="xoxo">
						<?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
					</ul>
				<?php endif; ?>
			</div><!-- .grid_2 -->


			<div class="grid_2">
				<?php if ( is_active_sidebar( 'third-footer-widget-area' ) ) : ?>
					<ul class="xoxo">
						<?php dynamic_sidebar( 'third-footer-widget-area' ); ?>
					</ul>
				<?php endif; ?>
			</div><!-- .grid_2 -->

			<div class="grid_2">
				<?php if ( is_active_sidebar( 'fourth-footer-widget-area' ) ) : ?>
					<ul class="xoxo">
						<?php dynamic_sidebar( 'fourth-footer-widget-area' ); ?>
					</ul>
				<?php endif; ?>
			</div><!-- .grid_2 -->

			<div class="grid_2 suffix_1 copyright">
				<?php if ( is_active_sidebar( 'fifth-footer-widget-area' ) ) : ?>
					<ul class="xoxo">
						<?php dynamic_sidebar( 'fifth-footer-widget-area' ); ?>
					</ul>
				<?php endif; ?>
			</div><!-- .grid_3 .suffix_1 .copyright -->

			<div class="clear">&nbsp;</div>

		</footer><!-- .footer -->
		<div class="clear">&nbsp;</div>

	</section><!-- .container -->

<?php wp_footer(); ?>

</body>
</html>
