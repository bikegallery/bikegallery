<?php
/**
 * Template Name: Summer Sale
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>

			<section class="grid_12 posts content">

				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

					<article class="post">
						<?php if ( has_post_thumbnail() ) {
							the_post_thumbnail();
						} ?> 
						<div class="post_meta">
							<h1><?php the_title(); ?></h1>
						</div><!-- .post_meta -->

						<div class="alpha grid_7">
							<?php the_content(); ?>

						</div><!-- .alpha .grid_7 -->

						<div class="grid_5 omega">
							<?php the_excerpt(); ?>
						</div>
						
						<div class="clear"></div>

						<h3>BIKES ON SALE</h3>
						<div class="alpha grid_4">
							<h2>UP TO $200 OFF 2012 Trek Road Bikes*</h2>
						</div>

						<div class="grid_4">
							<strong>$100 OFF</strong>
							2012 Trek Road
							Bikes Under $1500
						</div>

						<div class="grid_4 omega">
							<strong>$200 OFF</strong>
							2012 Trek Road
							Bikes Over $1500
						</div>

						<div class="clear">&nbsp;</div>
						
						<div class="grid_12">
							<em>*Discounts off regular price. Excludes framesets, cross bikes, 520, Speed Concept bikes, Project One bikes and 2013 road bikes.</em>
						</div>

						<div class="alpha grid_3 bikes_on_sale">
							<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/madone_5_9.png" alt="Trek Madone 5.9" />
							<h2>$3999.99</h2><em>Orig $4699.99</em>
							<strong>2012 Trek Madone 5.9</strong>
							Shimano Di2 Electronic Shifting
						</div>

						<div class="grid_3 bikes_on_sale">
							<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/dee_ricky.png" alt="2012 Mirraco Dee & Ricky" />
							<h2>$349.99</h2><em>Orig $389.99</em>
							<strong>2012 Mirraco Dee & Ricky</strong>
							Only 100 made - Bike Gallery is the exclusive dealer on the west coast.
						</div>

						<div class="grid_3 bikes_on_sale">
							<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/madone_5_9.png" alt="2012 Trek Marlin" />
							<h2>$609.99 - 619.99</h2><br /><em>Orig (2012) $679.99 - (2013) $689.99</em>
							<strong>2012 or 2013 Trek Marlin</strong>
							Rugged hardtail mountain bike - Men and Women's models available
						</div>

						<div class="grid_3 omega bikes_on_sale">
							<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/trek_7200.png" alt="Trek Ride+" />
							<h2>$200 OFF</h2>
							<strong>Select 2012 Trek Ride+ Models</strong>
							7200+, FX+, and Transport+ <br /><em>excludes Valencia</em>
						</div>

						<div class="clear">&nbsp;</div>

						<div class="alpha grid_3 bikes_on_sale">
							<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/versa_24.png" alt="Electra Versa 24" />
							<h2>$489.99</h2><em>Orig $639.99</em>
							<strong>2012 Electra Versa 24</strong>
							24-speed fitness bike infused with style
						</div>

						<div class="grid_3 bikes_on_sale">
							<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/versa_21.png" alt="Electra Versa 21" />
							<h2>$439.99</h2><em>Orig $539.99</em>
							<strong>2012 Electra Versa 21</strong>
							21-speed fitness bike infused with style
						</div>

						<div class="grid_3 bikes_on_sale">
							<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/trek_mtn_track.png" alt="Trek Mountain Track" />
							<h2>$349.99</h2><em>Orig $389.99</em>
							<strong>2012 Trek MT Track 220</strong>
							24" geared bikes. Boys and girls models available
						</div>

						<div class="grid_3 omega bikes_on_sale">
							<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/trek_jet_mystic.png" alt="Trek Jet and Mystic" />
							<h2>$179.99</h2><em>Orig $199.99</em>
							<strong>2012 Trek Jet & Mystic 16</strong>
							Rugged 16" frame. Boys and girls models available
						</div>

						<div class="clear">&nbsp;</div>

						<h3>ACCESSORIES ON SALE</h3>

						<div class="alpha grid_3 bikes_on_sale">
							<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/ion_lights.jpg" alt="Ion and Flare Lights" />
							<h2>$31.99</h2><em>Orig $39.99</em>
							<strong>Bontrager Ion 1 & Flare 1 Light Set</strong>
						</div>

						<div class="grid_3 bikes_on_sale">
							<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/ember_light.jpg" alt="Ember Light and Glo Lights" />
							<h2>$23.99</h2><em>Orig $29.99</em>
							<strong>Bontrager Glo & Ember Light Set</strong>
						</div>

						<div class="grid_3 bikes_on_sale">
							<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/streetwise_lock.jpg" alt="Streetwise U-lock and cable" />
							<h2>$29.99</h2><em>Orig $35.99</em>
							<strong>Bontrager Streetwise Lock with Cable</strong>
						</div>

						<div class="grid_3 omega bikes_on_sale">
							<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/bontrager_fenders.jpg" alt="Bontrager Fenders" />
							<h2>20% OFF</h2>
							<strong>Bontrager NCS Fenders</strong>
						</div>

						<div class="clear">&nbsp;</div>

						<div class="alpha grid_3 bikes_on_sale">
							<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/bontrager_rear_rack.jpg" alt="Rear Rack" />
							<h2>$29.99 - 39.99</h2><em>Orig $39.99 - 49.99</em>
							<strong>Bontrager Backracks - Standard and Deluxe options</strong>
						</div>

						<div class="grid_3 bikes_on_sale">
							<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/interchange_bag.jpg" alt="Interchange Bags" />
							<h2>$59.99 - 99.99</h2><em>Orig $79.99 - 119.99</em>
							<strong>Bontrager Interchange Trunk Bags - Standard/DLX/DLX+</strong>
						</div>

						<div class="grid_3 bikes_on_sale">
							<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/basic_bag.jpg" alt="Basic Seatbag" />
							<h2>$9.99 - 12.99</h2><em>Orig $14.99 - 19.99</em>
							<strong>Bontrager Basic Seatbag - two sizes available</strong>
						</div>

						<div class="grid_3 omega bikes_on_sale">
							<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/bottle_cages.jpg" alt="Bontrager Bottle Cages" />
							<h2>$6.99</h2><em>Orig $9.99</em>
							<strong>Bontrager 6mm Bottle Cages</strong>
						</div>

						<div class="clear">&nbsp;</div>

						<div class="alpha grid_3 bikes_on_sale">
							<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/aura_wheels.jpg" alt="Aura 5 Wheels" />
							<h2>$999.98</h2><em>Orig $1,199.98</em>
							<strong>Bontrager Aura 5 Wheelset - individual wheels available</strong>
						</div>

						<div class="grid_3 bikes_on_sale">
							<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/gel_cork_tape.jpg" alt="Gel Cork Handlebar Tape" />
							<h2>$12.99</h2><em>Orig $19.99</em>
							<strong>Bontrager Gel Cork Tape</strong>
						</div>

						<div class="grid_3 bikes_on_sale">
							<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/bontrager_jersey.jpg" alt="Replica Retro Jersey" />
							<h2>$49.99</h2><em>Orig $79.99</em>
							<strong>Bontrager Replica Retro Racing Short Sleeve Jersey - men's only</strong>
						</div>

						<div class="grid_3 omega bikes_on_sale">
							<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/sport_gloves.jpg" alt="Bontrager Sport Gloves" />
							<h2>$14.99</h2><em>Orig $19.99</em>
							<strong>Bontrager Sport Gloves</strong>
						</div>

						<div class="clear">&nbsp;</div>

						<div class="alpha grid_3 bikes_on_sale">
							<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/bontrager_socks.jpg" alt="Bontrager Socks" />
							<h2>20% OFF</h2>
							<strong>All Bontrager Socks<strong>
						</div>

						<div class="grid_3 bikes_on_sale">
							<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/solstice_shorts.jpg" alt="Bontrager Solstice Shorts" />
							<h2>$39.99</h2><em>Orig $49.99</em>
							<strong>Bontrager Solstice Shorts - men's and women's available</strong>
						</div>

						<div class="grid_3 bikes_on_sale">
							<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/shimano_shoes.jpg" alt="Shimano Shoes" />
							<h2>15% OFF</h2>
							<strong>All Shimano Shoes</strong>
						</div>

						<div class="grid_3 omega bikes_on_sale">
							<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/evoke_saddle.jpg" alt="Bontrager Evoke Saddles" />
							<h2>$49.99 - 74.99</h2><em>Orig $69.99 - 99.99</em>
							<strong>Bontrager Evoke Saddles - men's and women's options</strong>
						</div>

						<div class="clear">&nbsp;</div>

						<div class="alpha grid_3 bikes_on_sale">
							<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/comfort_saddle.jpg" alt="Bontrager Comfort Saddles" />
							<h2>$19.99 - 39.99</h2><em>Orig $29.99 - 49.99</em>
							<strong>Bontrager Comfort Saddles - men's and women's options<strong>
						</div>

						<div class="grid_3 bikes_on_sale">
							<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/saddle_cover.jpg" alt="Bontrager Saddle Covers" />
							<h2>$14.99 - 24.99</h2><em>Orig $19.99 - 29.99</em>
							<strong>Bontrager Gel Saddle Covers</strong>
						</div>

						<div class="grid_3 bikes_on_sale">
							<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/turbocharger.jpg" alt="Bontrager Turbocharger Floor Pump" />
							<h2>$39.99</h2><em>Orig $49.99</em>
							<strong>Bontrager Turbocharger Floor Pump</strong>
						</div>

						<div class="grid_3 omega bikes_on_sale">
							<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/air_support.jpg" alt="Bontrager Air Support Pump" />
							<h2>$19.99</h2><em>Orig $24.99</em>
							<strong>Bontrager Air Support Pump</strong>
						</div>

						<div class="clear">&nbsp;</div>

						<div class="alpha grid_3 bikes_on_sale">
							<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/assorted_tires.jpg" alt="Bontrager Assorted Tires" />
							<h2>UP TO $20 OFF</h2>
							<strong>Bontrager Tires - see store for details<strong>
						</div>

						<div class="grid_3 bikes_on_sale">
							<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/circuit_helmet.jpg" alt="Bontrager Circuit Helmet" />
							<h2>$84.99</h2><em>Orig $99.99</em>
							<strong>Bontrager Circuit Helmets</strong>
						</div>

						<div class="grid_3 bikes_on_sale">
							<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/solstice_helmet.jpg" alt="Bontrager Solstice Helmet" />
							<h2>$34.99</h2><em>Orig $44.99</em>
							<strong>Bontrager Solstice Helmets - adult and youth sizes available</strong>
						</div>

						<div class="grid_3 omega bikes_on_sale">
							<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/trip5_computer.jpg" alt="Bontrager Trip 5 Computer" />
							<h2>$49.99</h2><em>Orig $59.99</em>
							<strong>Bontrager Trip 5w Computer - wireless/backlight/10 functions</strong>
						</div>

						<div class="clear">&nbsp;</div>

						<div class="alpha grid_3 bikes_on_sale">
							<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/trip3_computer.jpg" alt="Bontrager Trip 3 Computer" />
							<h2>$34.99</h2><em>Orig $44.99</em>
							<strong>Bontrager Trip 3w Computer - 11 functions including temp and cadence</strong>
						</div>

						<div class="grid_9 omega bikes_on_sale">
							<h3>This is an area that could use some disclaimers or other info...</h3>
						</div>

						<?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>
					</article><!-- .post -->

				<?php endwhile; // end of the loop. ?>

			</section><!-- .grid_9 .content -->


<?php get_footer(); ?>

