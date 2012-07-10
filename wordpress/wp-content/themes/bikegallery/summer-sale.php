<?php
/**
 * Template Name: Summer Sale
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>
<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale_banner.jpg" alt="Summer Sale Banner" class="summer_sale_banner" />
			<section class="grid_12 posts content">

				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

					<article class="post">
						<?php if ( has_post_thumbnail() ) {
							the_post_thumbnail();
						} ?> 

						<div class="alpha grid_7">
							<?php the_content(); ?>

						</div><!-- .alpha .grid_7 -->

						<div class="grid_5 omega">
							<?php the_excerpt(); ?>
						</div>
						
						<div class="clear"></div>

						<h3>BIKES ON SALE</h3>
						<div class="alpha grid_4">
							<h2 class="summer_sale_two_hundred_off">UP TO $200 OFF 2012 Trek Road Bikes*</h2>
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
							<a href="http://shop.bikegallery.com/product/12trek-marlin-gary-fisher-collection-94376-1.htm" alt="Trek Marlin 29er">
								<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/trek_marlin.png" alt="2012 Trek Marlin" />
							</a>
							<h2>$609.99 - 619.99</h2><br /><em>Orig (2012) $679.99 - (2013) $689.99</em>
							<strong><a href="http://shop.bikegallery.com/product/12trek-marlin-gary-fisher-collection-94376-1.htm" alt="Trek Marlin 29er">2012 or 2013 Trek Marlin</a></strong>
							Rugged hardtail mountain bike - Men and Women's models available
						</div>

						<div class="grid_3 omega bikes_on_sale">
							<a href="http://shop.bikegallery.com/product/11trek-7200-73825-1.htm" alt="Trek 7200+">
								<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/trek_7200.png" alt="Trek Ride+" />
							</a>
							<h2>$200 OFF</h2>
							<strong>Select 2012 Trek Ride+ Models</strong>
							<a href="http://shop.bikegallery.com/product/11trek-7200-73825-1.htm" alt="Trek 7200+">7200+</a>, <a href="http://shop.bikegallery.com/product/11trek-fx-73989-1.htm" alt="FX+">FX+</a>, and <a href="http://shop.bikegallery.com/product/11trek-transport-gary-fisher-collection-74181-1.htm" alt="Transport+">Transport+</a><br /><em>excludes Valencia</em>
						</div>

						<div class="clear">&nbsp;</div>

						<div class="alpha grid_3 bikes_on_sale">
							<a href="http://shop.bikegallery.com/product/12electra-verse-24d-158537-1.htm" alt="Electra Verse 24">
								<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/versa_24.png" alt="Electra Versa 24" />
							</a>
							<h2>$489.99</h2><em>Orig $539.99</em>
							<strong><a href="http://shop.bikegallery.com/product/12electra-verse-24d-158537-1.htm" alt="Electra Verse 24">2012 Electra Versa 24</a></strong>
							24-speed fitness bike infused with style
						</div>

						<div class="grid_3 bikes_on_sale">
							<a href="http://shop.bikegallery.com/product/12electra-verse-21d-158552-1.htm" alt="Electra Verse 21">
								<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/versa_21.png" alt="Electra Versa 21" />
							</a>
							<h2>$439.99</h2><em>Orig $464.99</em>
							<strong><a href="http://shop.bikegallery.com/product/12electra-verse-21d-158552-1.htm" alt="Electra Verse 21">2012 Electra Versa 21</a></strong>
							21-speed fitness bike infused with style
						</div>

						<div class="grid_3 bikes_on_sale">
							<a href="http://shop.bikegallery.com/product/12trek-girls-mt.-track-220-130306-1.htm" alt="Trek MT Track 220">
								<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/trek_mtn_track.png" alt="Trek Mountain Track" />
							</a>
							<h2>$349.99</h2><em>Orig $389.99</em>
							<strong><a href="http://shop.bikegallery.com/product/12trek-girls-mt.-track-220-130306-1.htm" alt="Trek MT Track 220">2012 Trek MT Track 220</a></strong>
							24" geared bikes. Boys and girls models available
						</div>

						<div class="grid_3 omega bikes_on_sale">
							<a href="http://shop.bikegallery.com/product/12trek-jet-16-123189-1.htm" alt="Trek Jet & Mystic">
								<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/trek_jet_mystic.png" alt="Trek Jet and Mystic" />
							</a>
							<h2>$179.99</h2><em>Orig $199.99</em>
							<strong>2012 Trek <a href="http://shop.bikegallery.com/product/12trek-jet-16-123189-1.htm" alt="Trek Jet">Jet</a> & <a href="http://shop.bikegallery.com/product/12trek-mystic-16-59855-1.htm" alt="Trek Mystic">Mystic 16</a></strong>
							Rugged 16" frame. Boys and girls models available
						</div>

						<div class="clear">&nbsp;</div>

						<h3>ACCESSORIES ON SALE</h3>

						<div class="alpha grid_3 bikes_on_sale">
							<a href="http://shop.bikegallery.com/product/bontrager-ion-1-headlight-flare-1-taillight-set-76177-1.htm" alt="Ion and Flare Lights">
								<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/ion_lights.jpg" alt="Ion and Flare Lights" />
							</a>
							<h2>$31.99</h2><em>Orig $39.99</em>
							<strong><a href="http://shop.bikegallery.com/product/bontrager-ion-1-headlight-flare-1-taillight-set-76177-1.htm" alt="Ion and Flare Lights">Bontrager Ion 1 & Flare 1 Light Set</a></strong>
						</div>

						<div class="grid_3 bikes_on_sale">
							<a href="http://shop.bikegallery.com/product/bontrager-glo-headlight-ember-taillight-combo-76175-1.htm" alt="Ember Light and Glo Lights">
								<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/ember_light.jpg" alt="Ember Light and Glo Lights" />
							</a>
							<h2>$23.99</h2><em>Orig $29.99</em>
							<strong><a href="http://shop.bikegallery.com/product/bontrager-glo-headlight-ember-taillight-combo-76175-1.htm" alt="Ember Light and Glo Lights">Bontrager Glo & Ember Light Set</a></strong>
						</div>

						<div class="grid_3 bikes_on_sale">
							<a href="http://shop.bikegallery.com/product/trek-streetwise-u-lock-w-cable-51326-1.htm" alt="Streetwise U-lock and cable">
								<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/streetwise_lock.jpg" alt="Streetwise U-lock and cable" />
							</a>
							<h2>$29.99</h2><em>Orig $35.99</em>
							<strong><a href="http://shop.bikegallery.com/product/trek-streetwise-u-lock-w-cable-51326-1.htm" alt="Streetwise U-lock and cable">Bontrager Streetwise Lock with Cable</a></strong>
						</div>

						<div class="grid_3 omega bikes_on_sale">
							<a href="http://shop.bikegallery.com/sitesearch.cfm?search=ncs+fender&goSiteSearch.x=0&goSiteSearch.y=0" alt="Bontrager Fenders">
								<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/bontrager_fenders.jpg" alt="Bontrager Fenders" />
							</a>
							<h2>20% OFF</h2>
							<strong><a href="http://shop.bikegallery.com/sitesearch.cfm?search=ncs+fender&goSiteSearch.x=0&goSiteSearch.y=0" alt="Bontrager Fenders">Bontrager NCS Fenders</a></strong>
						</div>

						<div class="clear">&nbsp;</div>

						<div class="alpha grid_3 bikes_on_sale">
							<a href="http://shop.bikegallery.com/sitesearch.cfm?search=backrack&goSiteSearch.x=0&goSiteSearch.y=0" alt="Back Racks">
								<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/bontrager_rear_rack.jpg" alt="Back Racks" />
							</a>
							<h2>$29.99 - 39.99</h2><em>Orig $39.99 - 49.99</em>
							<strong><a href="http://shop.bikegallery.com/sitesearch.cfm?search=backrack&goSiteSearch.x=0&goSiteSearch.y=0" alt="Back Racks">Bontrager Backracks - Standard and Deluxe options</a></strong>
						</div>

						<div class="grid_3 bikes_on_sale">
							<a href="http://shop.bikegallery.com/sitesearch.cfm?search=interchange&goSiteSearch.x=0&goSiteSearch.y=0" alt="Interchange Bags">
								<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/interchange_bag.jpg" alt="Interchange Bags" />
							</a>
							<h2>$59.99 - 99.99</h2><em>Orig $79.99 - 119.99</em>
							<strong><a href="http://shop.bikegallery.com/sitesearch.cfm?search=interchange&goSiteSearch.x=0&goSiteSearch.y=0" alt="Interchange Bags">Bontrager Interchange Trunk Bags - Standard/DLX/DLX+</a></strong>
						</div>

						<div class="grid_3 bikes_on_sale">
							<a href="http://shop.bikegallery.com/product/bontrager-basic-seat-pack-154549-1.htm" alt="Basic Seatbag">
								<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/basic_bag.jpg" alt="Basic Seatbag" />
							</a>
							<h2>$9.99 - 12.99</h2><em>Orig $14.99 - 19.99</em>
							<strong><a href="http://shop.bikegallery.com/product/bontrager-basic-seat-pack-154549-1.htm" alt="Basic Seatbag">Bontrager Basic Seatbag - two sizes available</a></strong>
						</div>

						<div class="grid_3 omega bikes_on_sale">
							<a href="http://shop.bikegallery.com/product/bontrager-hollow-6mm-bottle-cage-164832-1.htm" alt="Bontrager Bottle Cages">
								<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/bottle_cages.jpg" alt="Bontrager Bottle Cages" />
							</a>
							<h2>$6.99</h2><em>Orig $9.99</em>
							<strong><a href="http://shop.bikegallery.com/product/bontrager-hollow-6mm-bottle-cage-164832-1.htm" alt="Bontrager Bottle Cages">Bontrager 6mm Bottle Cages</a></strong>
						</div>

						<div class="clear">&nbsp;</div>

						<div class="alpha grid_3 bikes_on_sale">
							<a href="http://shop.bikegallery.com/sitesearch.cfm?search=aura&goSiteSearch.x=0&goSiteSearch.y=0" alt="Aura 5 Wheels">
								<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/aura_wheels.jpg" alt="Aura 5 Wheels" />
							</a>
							<h2>$999.98</h2><em>Orig $1,199.98</em>
							<strong><a href="http://shop.bikegallery.com/sitesearch.cfm?search=aura&goSiteSearch.x=0&goSiteSearch.y=0" alt="Aura 5 Wheels">Bontrager Aura 5 Wheelset - individual wheels available</a></strong>
						</div>

						<div class="grid_3 bikes_on_sale">
							<a href="http://shop.bikegallery.com/product/bontrager-gel-cork-handlebar-tape-84447-1.htm" alt="Gel Cork Handlebar Tape">
								<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/gel_cork_tape.jpg" alt="Gel Cork Handlebar Tape" />
							</a>
							<h2>$12.99</h2><em>Orig $19.99</em>
							<strong><a href="http://shop.bikegallery.com/product/bontrager-gel-cork-handlebar-tape-84447-1.htm" alt="Gel Cork Handlebar Tape">Bontrager Gel Cork Tape</a></strong>
						</div>

						<div class="grid_3 bikes_on_sale">
							<a href="http://shop.bikegallery.com/product/bontrager-replica-retro-racing-short-sleeve-jersey-155125-1.htm" alt="Replica Retro Jersey">
								<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/bontrager_jersey.jpg" alt="Replica Retro Jersey" />
							</a>
							<h2>$49.99</h2><em>Orig $79.99</em>
							<strong><a href="http://shop.bikegallery.com/product/bontrager-replica-retro-racing-short-sleeve-jersey-155125-1.htm" alt="Replica Retro Jersey">Bontrager Replica Retro Racing Short Sleeve Jersey - men's only</a></strong>
						</div>

						<div class="grid_3 omega bikes_on_sale">
							<a href="http://shop.bikegallery.com/product/bontrager-sport-gloves-155264-1.htm" alt="Bontrager Sport Gloves">
								<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/sport_gloves.jpg" alt="Bontrager Sport Gloves" />
							</a>
							<h2>$14.99</h2><em>Orig $19.99</em>
							<strong><a href="http://shop.bikegallery.com/product/bontrager-sport-gloves-155264-1.htm" alt="Bontrager Sport Gloves">Bontrager Sport Gloves</a></strong>
						</div>

						<div class="clear">&nbsp;</div>

						<div class="alpha grid_3 bikes_on_sale">
							<a href="http://shop.bikegallery.com/sitesearch.cfm?search=bontrager+socks&goSiteSearch.x=0&goSiteSearch.y=0" alt="Bontrager Socks">
								<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/bontrager_socks.jpg" alt="Bontrager Socks" />
							</a>
							<h2>20% OFF</h2>
							<strong><a href="http://shop.bikegallery.com/sitesearch.cfm?search=bontrager+socks&goSiteSearch.x=0&goSiteSearch.y=0" alt="Bontrager Socks">All Bontrager Socks</a><strong>
						</div>

						<div class="grid_3 bikes_on_sale">
							<a href="http://shop.bikegallery.com/product/bontrager-solstice-shorts-155150-1.htm" alt="Bontrager Solstice Shorts">
								<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/solstice_shorts.jpg" alt="Bontrager Solstice Shorts" />
							</a>
							<h2>$39.99</h2><em>Orig $49.99</em>
							<strong><a href="http://shop.bikegallery.com/product/bontrager-solstice-shorts-155150-1.htm" alt="Bontrager Solstice Shorts">Bontrager Solstice Shorts - men's and women's available</a></strong>
						</div>

						<div class="grid_3 bikes_on_sale">
							<a href="http://shop.bikegallery.com/sitesearch.cfm?goSiteSearch.x=0&goSiteSearch.y=0&search=shimano%20shoes&rb_ct=1212" alt="Shimano Shoes">
								<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/shimano_shoes.jpg" alt="Shimano Shoes" />
							</a>
							<h2>15% OFF</h2>
							<strong><a href="http://shop.bikegallery.com/sitesearch.cfm?goSiteSearch.x=0&goSiteSearch.y=0&search=shimano%20shoes&rb_ct=1212" alt="Shimano Shoes">All Shimano Shoes</a></strong>
						</div>

						<div class="grid_3 omega bikes_on_sale">
							<a href="http://shop.bikegallery.com/sitesearch.cfm?goSiteSearch.x=0&goSiteSearch.y=0&search=evoke&rb_ct=1084" alt="Bontrager Evoke Saddles">
								<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/evoke_saddle.jpg" alt="Bontrager Evoke Saddles" />
							</a>
							<h2>$49.99 - 74.99</h2><em>Orig $69.99 - 99.99</em>
							<strong><a href="http://shop.bikegallery.com/sitesearch.cfm?goSiteSearch.x=0&goSiteSearch.y=0&search=evoke&rb_ct=1084" alt="Bontrager Evoke Saddles">Bontrager Evoke Saddles - men's and women's options</a></strong>
						</div>

						<div class="clear">&nbsp;</div>

						<div class="alpha grid_3 bikes_on_sale">
							<a href="http://shop.bikegallery.com/product/bontrager-suburbia-fit-saddle-76225-1.htm" alt="Bontrager Comfort Saddles">
								<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/comfort_saddle.jpg" alt="Bontrager Comfort Saddles" />
							</a>
							<h2>$19.99 - 39.99</h2><em>Orig $29.99 - 49.99</em>
							<strong><a href="http://shop.bikegallery.com/product/bontrager-suburbia-fit-saddle-76225-1.htm" alt="Bontrager Comfort Saddles">Bontrager Comfort Saddles - men's and women's options</a><strong>
						</div>

						<div class="grid_3 bikes_on_sale">
							<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/saddle_cover.jpg" alt="Bontrager Saddle Covers" />
							<h2>$14.99 - 24.99</h2><em>Orig $19.99 - 29.99</em>
							<strong>Bontrager Gel Saddle Covers</strong>
						</div>

						<div class="grid_3 bikes_on_sale">
							<a href="http://shop.bikegallery.com/product/bontrager-turbocharger-51178-1.htm" alt="Bontrager Turbocharger Floor Pump">
								<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/turbocharger.jpg" alt="Bontrager Turbocharger Floor Pump" />
							</a>
							<h2>$39.99</h2><em>Orig $49.99</em>
							<strong><a href="http://shop.bikegallery.com/product/bontrager-turbocharger-51178-1.htm" alt="Bontrager Turbocharger Floor Pump">Bontrager Turbocharger Floor Pump</a></strong>
						</div>

						<div class="grid_3 omega bikes_on_sale">
							<a href="http://shop.bikegallery.com/product/bontrager-air-support-51189-1.htm" alt="Bontrager Air Support Pump">
								<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/air_support.jpg" alt="Bontrager Air Support Pump" />
							</a>
							<h2>$19.99</h2><em>Orig $24.99</em>
							<strong><a href="http://shop.bikegallery.com/product/bontrager-air-support-51189-1.htm" alt="Bontrager Air Support Pump">Bontrager Air Support Pump</a></strong>
						</div>

						<div class="clear">&nbsp;</div>

						<div class="alpha grid_3 bikes_on_sale">
							<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/assorted_tires.jpg" alt="Bontrager Assorted Tires" />
							<h2>UP TO $20 OFF</h2>
							<strong>Assorted Tires</strong>
							<strong><a href="http://shop.bikegallery.com/product/bontrager-race-all-weather-hardcase-60745-1.htm" alt="Bontrager All Race Weather Hardcase Tires">Bontrager All Weather Race Hardcase</a><strong>
							<strong class="inline_strong"><a href="http://shop.bikegallery.com/product/bontrager-t1-road-tire-27-inch-84454-1.htm" alt="Bontrager T1 Tires">T1 Tires</a></strong> / <strong class="inline_strong"><a href="http://shop.bikegallery.com/product/bontrager-r2-road-tire-70638-1.htm" alt="Bontrager R2 Tires">R2 Tires</a><strong class="inline_strong"> / <strong class="inline_strong"><a href="http://shop.bikegallery.com/product/bontrager-r3-road-tire-70642-1.htm" alt="Bontrager R3 Tires">R3 Tires</a><strong>
							<strong><a href="http://shop.bikegallery.com/product/bontrager-rl-hardcase-50905-1.htm" alt="Race Lite Hardcase">Race Lite Hardcase</a></strong>
							<strong><a href="http://shop.bikegallery.com/sitesearch.cfm?goSiteSearch.x=0&goSiteSearch.y=0&search=h2%20hardcase&rb_ct=1101" alt="H2 Hardcase Plus">H2 Hardcase Plus</a></strong>
							<strong><a href="http://shop.bikegallery.com/sitesearch.cfm?goSiteSearch.x=0&goSiteSearch.y=0&search=h2%20deluxe&rb_ct=1101" alt="H2 Deluxe">H2 Deluxe</a></strong>

							</a>
						</div>

						<div class="grid_3 bikes_on_sale">
							<a href="http://shop.bikegallery.com/product/bontrager-circuit-76153-1.htm" alt="Bontrager Circuit Helmet">
								<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/circuit_helmet.jpg" alt="Bontrager Circuit Helmet" />
							</a>
							<h2>$84.99</h2><em>Orig $99.99</em>
							<strong><a href="http://shop.bikegallery.com/product/bontrager-circuit-76153-1.htm" alt="Bontrager Circuit Helmet">Bontrager Circuit Helmets</a></strong>
						</div>

						<div class="grid_3 bikes_on_sale">
							<a href="http://shop.bikegallery.com/product/bontrager-solstice-76145-1.htm" alt="Bontrager Solstice Helmet">
								<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/solstice_helmet.jpg" alt="Bontrager Solstice Helmet" />
							</a>
							<h2>$34.99</h2><em>Orig $44.99</em>
							<strong><a href="http://shop.bikegallery.com/product/bontrager-solstice-76145-1.htm" alt="Bontrager Solstice Helmet">Bontrager Solstice Helmets - adult and youth sizes available</a></strong>
						</div>

						<div class="grid_3 omega bikes_on_sale">
							<a href="http://shop.bikegallery.com/product/bontrager-trip-5w-73753-1.htm" alt="Bontrager Trip 5 Computer">
								<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/trip5_computer.jpg" alt="Bontrager Trip 5 Computer" />
							</a>
							<h2>$49.99</h2><em>Orig $59.99</em>
							<strong><a href="http://shop.bikegallery.com/product/bontrager-trip-5w-73753-1.htm" alt="Bontrager Trip 5 Computer">Bontrager Trip 5w Computer - wireless/backlight/10 functions</a></strong>
						</div>

						<div class="clear">&nbsp;</div>

						<div class="alpha grid_3 bikes_on_sale">
							<a href="http://shop.bikegallery.com/product/bontrager-trip-4w-73750-1.htm" alt="Bontrager Trip 4W Computer">
								<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/trip4_computer.jpg" alt="Bontrager Trip 4W Computer" />
							</a>
							<h2>$39.99</h2><em>Orig $49.99</em>
							<strong><a href="http://shop.bikegallery.com/product/bontrager-trip-4w-73750-1.htm" alt="Bontrager Trip 4W Computer">Bontrager Trip 4W Computer - 9 functions including dual wheel size and auto start/stop</a></strong>
						</div>

						<div class="grid_3 bikes_on_sale">
							<a href="http://shop.bikegallery.com/product/bontrager-trip-3-73748-1.htm" alt="Bontrager Trip 3 Computer">
								<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/trip3_computer.jpg" alt="Bontrager Trip 3 Computer" />
							</a>
							<h2>$34.99</h2><em>Orig $44.99</em>
							<strong><a href="http://shop.bikegallery.com/product/bontrager-trip-3-73748-1.htm" alt="Bontrager Trip 3 Computer">Bontrager Trip 3 Computer - 11 functions including temp and cadence</a></strong>
						</div>

						<div class="grid_3 bikes_on_sale">
							<a href="http://shop.bikegallery.com/product/bontrager-node-1.1-digital-computer-167802-1.htm" alt="Bontrager Node 1.1 Computer">
								<img src="/wordpress/wp-content/themes/bikegallery/images/summer_sale/node_1_1.jpg" alt="Bontrager Node 1.1 Computer" />
							</a>
							<h2>$49.99</h2><em>Orig $69.99</em>
							<strong><a href="http://shop.bikegallery.com/product/bontrager-node-1.1-digital-computer-167802-1.htm" alt="Bontrager Node 1.1 Computer">Bontrager Node 1.1 Computer - 11 functions including temp and cadence</a></strong>
						</div>

						<?php edit_post_link( __( 'Edit', 'twentyten' ), '', '' ); ?>
					</article><!-- .post -->

				<?php endwhile; // end of the loop. ?>

			</section><!-- .grid_9 .content -->


<?php get_footer(); ?>

