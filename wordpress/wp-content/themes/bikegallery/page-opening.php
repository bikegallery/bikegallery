<?php
/**
 *
 * Template Name: Store Opening Page
 *
 *
 * @package WordPress
 * @subpackage epictrishop
 * @since epictrishop 0.1
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
		wp_head();
	?>
</head>

<body <?php body_class(); ?>>

	<section class="container">
		<header class="header row">
			<section class="threecol">
				<a href="/" class="header_logo"><img src="/wordpress/wp-content/themes/epictrishop/images/epictrishop_logo.png" alt="Epic Tri Shop" /></a>
			</section><!-- .threecol -->
			<section class="ninecol opening last">
				<div class="store_info">
					<ul>
						<li>Mon&nbsp;&ndash;&nbsp;Sat: 10 to 6</li>
						<li>Sun: Noon to 5</li>

						<li>|</li>

						<li><address>12345 SW Canyon Blvd Beaverton, OR 97005</address></li>
						<li><a href="http://g.co/maps/a9xxq" title="Google Map" target="_blank">Map</a></li>
						<li>(503)828-3027</li>
					</ul>
					
				</div>
				<h1>
					Grand Opening January 25th 7&mdash;9pm
				</h1>
<!--				<p><?php bloginfo( 'description' ); ?></p> -->

			</section><!-- .twelvecol -->
		</header><!-- .row -->

		<section class="row">

			<section class="threecol content">

				<div class="featured_brands">
					<a href="http://trekbikes.com/us/en/" title="Trek Bikes" target="_blank"><img src="/wordpress/wp-content/themes/epictrishop/images/trek_logo.png" alt="Trek Logo" /></a>
					<a href="http://feltbicycles.com" title="Felt Bicycles" target="_blank"><img src="/wordpress/wp-content/themes/epictrishop/images/felt_logo.png" alt="Felt Logo" /></a>
					<a href="http://bontrager.com" title="Bontrager" target="_blank"><img src="/wordpress/wp-content/themes/epictrishop/images/bontrager_logo.png" alt="Bontrager Logo" /></a>
					<a href="http://specialized.com/us/en/bc/home.jsp" title="Specialized" target="_blank"><img src="/wordpress/wp-content/themes/epictrishop/images/specialized_logo.png" alt="Specialized Logo" /></a>
				</div>
			</section><!-- .threecol .content -->

			<section class="sixcol content last">

				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>


					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>
					<?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>


				<?php endwhile; ?>

<?php get_footer(); ?>
