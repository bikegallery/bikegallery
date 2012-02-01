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
				<a href="/"><img src="http://www.bikegallery.com/logos/BG%20logo%20(color).gif" alt="Bike Gallery" /></a>
			</section><!-- .grid_3 .logo -->

			<section class="grid_9">
				<div class="search">
					<?php if (is_active_sidebar('header-widget-area') ) : ?>
					<ul class="xoxo">
						<?php dynamic_sidebar('header-widget-area'); ?>
					</ul>
					<?php endif; ?>
				</div><!-- .search -->
<!--				<p><?php bloginfo( 'description' ); ?></p> -->

			</section><!-- .grid_9 -->

			<div class="grid_12 location_bar">
				Bike Gallery  •  Your local, family-owned bike store since 1974  •  Six neighborhood locations in and around Portland, Oregon
			</div><!-- .grid_12 .location_bar -->

			<nav class="nav">
				<?php wp_nav_menu(); ?>
			</nav><!-- .nav -->

		</header><!-- .header -->

		<section class="viewer">

			<section class="grid_3 featured_brands">

			</section><!-- .grid_3 .featured_brands -->

			<section class="grid_6 content">

