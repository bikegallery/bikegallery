<?php
/**
 * Template Name: Service Menu
 *
 * This is the template that displays all pages by default.
 * Please note that this is the wordpress construct of pages
 * and that other 'pages' on your wordpress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>
			<section class="grid_10 content">

				<div class="posts">
					<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

						<article class="post">
<table cellpadding="0" cellspacing="0" border="0" height="100%" width="100%" class="service_menu">
<tbody>
<tr>
<td valign="top">
<h2>Full Bike Overhaul</h2>

$275

Get that well-worn machine looking and riding like a brand new bike
<div class="service_price">
$275
</div>
Bike is disassembled, cleaned & waxed
Headset, hubs and bottom bracket overhauled
Cables changed if needed
Complete tune-up and drivetrain cleaning
Handlebars taped/grips changed
</td>
</tr>
<tr>
<td valign="top">
Deluxe Tune-Up

$125

Complete tune-up plus drivetrain clean

Adjust brakes front and rear
Adjust derailleur front and rear (lube pulleys)
True wheels front and rear
Adjust all bearings
Lube chain and cables
Clean cranks, chain, cassette and derailleurs
</td>
</tr>
<tr>
<td valign="top">
Complete Tune-Up

$85

Get your bike finely tuned and lubricated

Adjust brakes front and rear
Adjust derailleur front and rear (lube pulleys)
True wheels front and rear
Adjust all bearings
Lube chain and cables
Light cleaning
</td>
</tr>
<tr>
<td valign="top">
Quick Tune

$45

Great for getting bikes that are already in good shape prepared for that weekend ride

Check bicycle for functionality/safety
Air tires, lube chain/pivot points, minor adjustments
Adjust barrel tweaks, touch-true wheels
Quick lube
</td>
</tr>
<tr>
<td valign="top">
A-la-Carte Service Menu
Install Tube and/or Tire (front or rear) $10
Adjust Derailleur, front $15
Adjust Derailleur, rear $20
Replace Derailleur cable front $23
Replace Derailleur cable rear $25
Adjust Brake cable (front or rear) $20
Replace Brake cable $22
Minor Wheel true $17
Standard Wheel true $25
Major Wheel true (includes spoke replacement) $30
Wheel Build, Custom $70-80
Package Bike for Shipping (includes standard box) $80
Install Chain $12
Install/Remove Cassette $7
Clean Drivetrain $50
Install Fenders $35
Install Fenders, Custom $60
Install or Remove pedals $6
Install Cleats (fitting not included) $12
Install Saddle $5
Lube / Supply / Environmental fee $5
</td>
</tr>
</tbody>
</table>
						</article><!-- .post -->

					<?php endwhile; ?>
				</div><!-- .posts -->

			</section><!-- .grid_10 .content -->

<?php get_footer(); ?>
