<?php
/**
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
				<div class="service_price"><strong>$275</strong></div>
				<h2>Full Bike Overhaul</h2>
				<em>Get that well-worn machine looking and riding like a brand new bike</em>
				<ul class="service_pacakges">
					<li>
						Bike is disassembled, cleaned & waxed
					</li>
					<li>
						Headset, hubs and bottom bracket overhauled
					</li>
					<li>
						Cables changed if needed
					</li>
					<li>
						Complete tune-up and drivetrain cleaning
					</li>
					<li>
						Handlebars taped/grips changed
					</li>
				</ul>
			</td>
		</tr>
		<tr>
			<td valign="top">
				<div class="service_price"><strong>$125</strong></div>
				<h2>Deluxe Tune-Up</h2>
				<em>Complete tune-up plus drivetrain clean</em>
				<ul class="service_pacakges">
					<li>
						Adjust brakes front and rear
					</li>
					<li>
						Adjust derailleur front and rear (lube pulleys)
					</li>
					<li>
						True wheels front and rear
					</li>
					<li>
						Adjust all bearings
					</li>
					<li>
						Lube chain and cables
					</li>
					<li>
						Clean cranks, chain, cassette and derailleurs
					</li>
				</ul>
			</td>
		</tr>
		<tr>
			<td valign="top">
				<div class="service_price"><strong>$85</strong></div>
				<h2>Complete Tune-Up</h2>
				<em>Get your bike finely tuned and lubricated</em>

				<ul class="service_pacakges">
					<li>
						Adjust brakes front and rear
					</li>
					<li>
						Adjust derailleur front and rear (lube pulleys)
					</li>
					<li>
						True wheels front and rear
					</li>
					<li>
						Adjust all bearings
					</li>
					<li>
						Lube chain and cables
					</li>
					<li>
						Light cleaning
					</li>
				</ul>
			</td>
		</tr>
		<tr>
			<td valign="top">
				<div class="service_price"><strong>$45</strong></div>
				<h2>Quick Tune</h2>
				<em>Great for getting bikes that are already in good shape prepared for that weekend ride</em>

				<ul class="service_pacakges">
					<li>
						Check bicycle for functionality/safety
					</li>
					<li>
						Air tires, lube chain/pivot points, minor adjustments
					</li>
					<li>
						Adjust barrel tweaks, touch-true wheels
					</li>
					<li>
						Quick lube
					</li>
				</ul>
			</td>
		</tr>
	</tbody>
</table>
<h1>A-la-Carte Service Menu</h1>
<table cellpadding="0" cellspacing="0" border="0" height="100%" width="100%" class="a_la_carte_menu">
	<tbody>
		<tr>
			<td>
				Install Tube and/or Tire (front or rear)
			</td>
			<td>
				$10
			</td>
		</tr>
		<tr class="even_row">
			<td>
				Adjust Derailleur, front
			</td>
			<td>
				$15
			</td>
		</tr>
		<tr>
			<td>
				Adjust Derailleur, rear
			</td>
			<td>
				$20
			</td>
		</tr>
		<tr class="even_row">
			<td>
				Replace Derailleur cable front
			</td>
			<td>
				$23
			</td>
		</tr>
		<tr>
			<td>
				Replace Derailleur cable rear
			</td>
			<td>
				$25
			</td>
		</tr>
		<tr class="even_row">
			<td>
				Adjust Brake cable (front or rear)
			</td>
			<td>
				$20
			</td>
		</tr>
		<tr>
			<td>
				Replace Brake cable
			</td>
			<td>
				$22
			</td>
		</tr>
		<tr class="even_row">
			<td>
				Minor Wheel true
			</td>
			<td>
				$17
			</td>
		</tr>
		<tr>
			<td>
				Standard Wheel true
			</td>
			<td>
				$25
			</td>
		</tr>
		<tr class="even_row">
			<td>
				Major Wheel true (includes spoke replacement)
			</td>
			<td>
				$30
			</td>
		</tr>
		<tr>
			<td>
				Wheel Build, Custom
			</td>
			<td>
				$70-80
			</td>
		</tr>
		<tr class="even_row">
			<td>
				Package Bike for Shipping (includes standard box)
			</td>
			<td>
				$80
			</td>
		</tr>
		<tr>
			<td>
				Install Chain
			</td>
			<td>
				$12
			</td>
		</tr>
		<tr class="even_row">
			<td>
				Install/Remove Cassette
			</td>
			<td>
				$7
			</td>
		</tr>
		<tr>
			<td>
				Clean Drivetrain
			</td>
			<td>
				$50
			</td>
		</tr>
		<tr class="even_row">
			<td>
				Install Fenders
			</td>
			<td>
				$35
			</td>
		</tr>
		<tr>
			<td>
				Install Fenders, Custom
			</td>
			<td>
				$60
			</td>
		</tr>
		<tr class="even_row">
			<td>
				Install or Remove pedals
			</td>
			<td>
				$6
			</td>
		</tr>
		<tr>
			<td>
				Install Cleats (fitting not included)
			</td>
			<td>
				$12
			</td>
		</tr>
		<tr class="even_row">
			<td>
				Install Saddle
			</td>
			<td>
				$5
			</td>
		</tr>
		<tr>
			<td>
				Lube / Supply / Environmental fee
			</td>
			<td>
				$5
			</td>
		</tr>
	</tbody>
</table>
						</article><!-- .post -->

					<?php endwhile; ?>
				</div><!-- .posts -->

			</section><!-- .grid_10 .content -->

<?php get_footer(); ?>
