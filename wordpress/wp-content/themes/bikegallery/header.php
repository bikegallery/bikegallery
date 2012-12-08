<?php
/**
 *
 * The Header-Left for Bike Gallery
 *
 *
 * @package WordPress
 * @subpackage bikegallery
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta name="keywords" content="bicycles, bikes, bike shop, bicycle shop, bicycle rentals, bicycle repair, bicycle fitting, tandem, tandems, women, kids, kids bikes, family, families, Portland, Trek, Kona, Co-Motion, Felt, Foundry, VanMoof, Madone, Domane, Remedy, Cronus" />

	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<!--[if IE 7]>
	<link rel="stylesheet" type="text/css" media="all" href="/wordpress/wp-content/themes/bikegallery/css/ie7.css" />
<![endif]-->

<!--[if IE 8]>
	<link rel="stylesheet" type="text/css" media="all" href="/wordpress/wp-content/themes/bikegallery/css/ie8.css" />
<![endif]-->

<!--[if IE 9]>
	<link rel="stylesheet" type="text/css" media="all" href="/wordpress/wp-content/themes/bikegallery/css/ie9.css" />
<![endif]-->

<!--	<link rel="stylesheet" href="http://f.fontdeck.com/s/css/E7uOHrgs0nw2MqW6o/fP2Vg4IGg/bikegallery/17942.css" type="text/css" /> -->
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

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-4299979-1']);
  _gaq.push(['_setDomainName', 'bikegallery.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</head>

<body <?php body_class(); ?>>
	<section class="container_12 top_bar">

		<section class="grid_12 site_alerts">
			<?php if (is_active_sidebar('alert-widget-area') ) : ?>
			<ul class="xoxo">
				<?php dynamic_sidebar('alert-widget-area'); ?>
			</ul>
			<?php endif; ?>
		</section><!-- .grid_12 .site_alerts -->
		
		<div class="clear">&nbsp;</div>

		<section class="grid_2 logo">
			<a href="/"><img src="/wordpress/wp-content/themes/bikegallery/images/outlined_logo.png" alt="Bike Gallery" /></a>
		</section><!-- .grid_2 .logo -->

		<section class="grid_10 locations">
			<ul>
				<li>
					<a href="/locations/downtown">
						Downtown<br />
						1001 SW 10th Ave<br />
						(503) 222-3821
					</a>
				</li>

				<li>
					<a href="/locations/hollywood">
						Hollywood<br />
						5329 NE Sandy Blvd<br />
						(503) 281-9800
					</a>
				</li>

				<li>
					<a href="/locations/woodstock">
						Woodstock<br />
						4235 SE Woodstock Blvd<br />
						(503) 774-3531
					</a>
				</li>

				<li>
					<a href="/locations/division">
						Clackamas<br />
						9347 SE 82nd Ave<br />
						(503) 254-2663
					</a>
				</li>

				<li>
					<a href="/locations/lake-oswego">
						Lake Oswego<br />
						200 B Ave<br />
						(503) 636-1600
					</a>
				</li>

				<li>
					<a href="/locations/beaverton">
						Beaverton<br />
						12345 SW Canyon Rd<br />
						(503) 641-2580
					</a>
				</li>
			</ul>
			
			<div class="tagline">
				Your local, family-owned bike store since 1974 &mdash; More people on bikes more often
			</div><!-- tagline -->
		</section><!-- .grid_10 .locations -->
	</section><!-- .container_12 .top_bar -->
	
	<div class="clear">&nbsp;</div>

	<section class="container_12 container">
		<header class="header">

			<div class="clear">&nbsp;</div>

			<nav class="nav_social">
				<div class="alpha grid_10 nav">
					<?php wp_nav_menu(); ?>
				</div><!-- .nav -->

				<div class="grid_2 omega social_icons">
					<a href="http://visitor.r20.constantcontact.com/d.jsp?llr=kpajcwbab&p=oi&m=1101325959658" target="_blank"><img src="/wordpress/wp-content/themes/bikegallery/images/mail_list_icon.png" alt="Bike Gallery Mailing List" title="Mailing List" /></a>
					<a href="https://www.facebook.com/bikegallery" target="_blank"><img src="/wordpress/wp-content/themes/bikegallery/images/facebook_icon.png" alt="Bike Gallery Facebook" title="Facebook" /></a>
					<a href="https://twitter.com/#!/bikegallerypdx" target="_blank"><img src="/wordpress/wp-content/themes/bikegallery/images/twitter_icon.png" alt="Bike Gallery Twitter" title="Twitter" /></a>
				</div><!-- .social_icons -->
			</nav><!-- .nav_social -->

			<div class="clear">&nbsp;</div>

			<?php if ( is_front_page() ) { ?>
				<?php echo do_shortcode('[nivoslider slug="front-page"]'); ?>
			<?php } ?>				

		</header><!-- .header -->

		<?php if ( is_front_page() ) { ?>
			<section class="grid_12 front_page_intro">
				<h1>Our mission since 1974: More people on bikes more often.</h1>
				<h2>If you can't tell, we're passionate about bikes. But it's not just the latest cycling gizmo that gets us excited. It's about getting to be part of real people reaching their cycling goals, whether it's two miles, a century (that's a hundred miles), or a two-month tour.</h2>
			</section><!-- .grid_12 -->
		<?php } ?>				

		<section class="viewer">
			<?php if ( is_front_page() ) { ?>
				<section class="grid_2 left_sidebar">
					<?php if (is_active_sidebar('event-widget-area') ) : ?>
					<ul class="xoxo">
						<?php dynamic_sidebar('event-widget-area'); ?>
					</ul>
					<?php endif; ?>
				</section><!-- .grid_2 .left_sidebar -->
			<?php } else { ?>
				<div class="page_utility">
					<div class="grid_9 breadcrumbs">
					    <?php if(function_exists('bcn_display'))
					    {
						bcn_display();
					    }?>
					</div><!-- .grid_9 .breadcrumbs -->

					<div class="grid_3 widget_search">
						<?php get_search_form(); ?>
					</div><!-- .grid_3 .widget_search -->
				</div>
			<?php } ?>

