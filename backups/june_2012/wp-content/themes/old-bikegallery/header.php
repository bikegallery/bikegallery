<?php
/**
 *
 * The Header-Left for Bike Gallery
 *
 *
 * @package WordPress
 * @subpackage bikegallery
 * @since bikegallery 0.1
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="stylesheet" type="text/css" media="all" href="/wordpress/wp-content/themes/bikegallery/style-left.css" />
	<link href='http://fonts.googleapis.com/css?family=Economica:700,700italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Telex' rel='stylesheet' type='text/css'>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
		wp_head();
	?>

<script type="text/javascript">'article aside canvas figcaption figure footer header hgroup nav section time'.replace(/\w+/g,function(n){document.createElement(n)})</script>

<script type='text/javascript' src="/wordpress/wp-content/themes/bikegallery/js/jquery.js"></script>
<script type='text/javascript' src="/wordpress/wp-content/themes/bikegallery/js/clear_input.js"></script>
<script type='text/javascript' src="/wordpress/wp-content/themes/bikegallery/js/jquery.bxSlider.js"></script>
<script type='text/javascript' src="/wordpress/wp-content/themes/bikegallery/js/jquery.easing.js"></script>

<script type='text/javascript'>

	$j=jQuery.noConflict();
 
	$j(document).ready(function(){

		//Clears inputs when focused
		$j('input').clearInput();
		
	});

	$j(function() {
            $j('.page_sublinks a').bind('click',function(event){
                var $janchor = $j(this);
                
                $j('html, body').stop().animate({
                    scrollTop: $j($janchor.attr('href')).offset().top
                }, 1500,'easeInOutExpo');
                /*
                if you don't want to use the easing effects:
                $('html, body').stop().animate({
                    scrollTop: $($anchor.attr('href')).offset().top
                }, 1000);
                */
                event.preventDefault();
            });
        });

</script>

<script language="javascript" type="text/javascript">
        function limitText(limitField, limitCount, limitNum) {
            if (limitField.value.length > limitNum) {
                limitField.value = limitField.value.substring(0, limitNum);
            } else {
                limitCount.value = limitNum - limitField.value.length;
            }
        }
</script>

</head>

<body <?php body_class(); ?>>

	<section class="container_12">
		<header class="header">

			<section class="grid_3 logo">
				<a href="/"><img src="/wordpress/wp-content/themes/bikegallery/images/outlined_logo.png" alt="Bike Gallery" /></a>
			</section><!-- .grid_3 .logo -->

			<section class="grid_9">
				<ul class="locations">
					<li>
						Downtown<br />
						1001 SW 10th Ave<br />
						(503)222-3821
					</li>

					<li>
						Hollywood<br />
						5329 NE Sandy Blvd<br />
						(503)281-9800
					</li>

					<li>
						Woodstock<br />
						4235 SE Woodstock Blvd<br />
						(503)774-3531
					</li>

					<li>
						Division<br />
						10950 SE Division St<br />
						(503)254-2663
					</li>

					<li>
						Lake Oswego<br />
						200 B Ave<br />
						(503)636-1600
					</li>

					<li>
						Beaverton<br />
						12345 SW Canyon Rd<br />
						(503)641-2580
					</li>
				</ul>
				
				<div class="tagline">
					Your local, family-owned bike store since 1974 &bull; Six neighborhood locations in and around Portland, Oregon
				</div><!-- tagline -->
			</section><!-- .grid_9 .locations -->

			<div class="clear">&nbsp;</div>

			<div class="photo_credit">
				<a href="http://www.flickr.com/photos/brujo/collections/">photo by Jose Sandoval</a>
			</div><!-- .photo_credit -->

		</header><!-- .header -->

		<section class="nav_social">
			<nav class="alpha grid_11 nav">
				<?php wp_nav_menu(); ?>
			</nav><!-- .nav -->

			<div class="grid_1 omega social_icons">
				<a href=""><img src="/wordpress/wp-content/themes/bikegallery/images/facebook_icon.png" alt="Bike Gallery Facebook" title="Facebook" /></a>
				<a href=""><img src="/wordpress/wp-content/themes/bikegallery/images/twitter_icon.png" alt="Bike Gallery Twitter" title="Twitter" /></a>
			</div><!-- .social_icons -->
		</section><!-- .nav_social -->

		<section class="site_alerts">
			<?php if (is_active_sidebar('alert-widget-area') ) : ?>
			<ul class="xoxo">
				<?php dynamic_sidebar('alert-widget-area'); ?>
			</ul>
			<?php endif; ?>
		</section><!-- .site_alerts -->

		<section class="viewer">

			<section class="grid_3 left_sidebar">
				<div class="search">
					<?php if (is_active_sidebar('left-sidebar-widget-area') ) : ?>
					<ul class="xoxo">
						<?php dynamic_sidebar('left-sidebar-widget-area'); ?>
					</ul>
					<?php endif; ?>
				</div><!-- .search -->
			</section><!-- .grid_3 .left_sidebar -->

