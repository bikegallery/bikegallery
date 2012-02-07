<?php
/**
 *
 * The Header for our theme.
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

	<section class="container_12">
		<header class="header">
			<section class="grid_3 logo">
				<a href="/"><img src="http://www.bikegallery.com/logos/bikegallery_logo_thin_border.png" alt="Bike Gallery" /></a>
			</section><!-- .grid_3 .logo -->

			<section class="grid_9">

			</section><!-- .grid_9 -->

			<div class="grid_12 location_bar">
				<p><?php bloginfo( 'description' ); ?></p>
				<!-- Bike Gallery  •  Your local, family-owned bike store since 1974  •  Six neighborhood locations in and around Portland, Oregon -->
			</div><!-- .grid_12 .location_bar -->

			<nav class="grid_12 nav">
				<?php wp_nav_menu(); ?>
			</nav><!-- .grid_12 .nav -->

			<div class="clear">&nbsp;</div>
		</header><!-- .header -->

		<section class="viewer">

			<section class="grid_3 featured_brands">
				<div class="search">
					<?php if (is_active_sidebar('left-sidebar-widget-area') ) : ?>
					<ul class="xoxo">
						<?php dynamic_sidebar('left-sidebar-widget-area'); ?>
					</ul>
					<?php endif; ?>
				</div><!-- .search -->

				<img src="http://bikegallery.com/images/accolades.png" alt="Accolades" title="Bike Gallery Accolades" />
			</section><!-- .grid_3 .featured_brands -->

			<section class="grid_6 content">

