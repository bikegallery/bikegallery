<?php
/*
	Plugin Name: WP To Top
	Plugin URI: http://htmlblog.net
	Version: 0.1
	Author: Asvin Balloo
	Author URI: http://htmlblog.net
	Description: Add a "back to top" link to your posts
	*/

	/*
	Copyright 2009  Asvin Balloo  (http://htmlblog.net/wp-to-top/)
	
	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details: http://www.gnu.org/licenses/gpl.txt
	*/

	/**
	 * Checks the validity of a hex color
	 * @param $color String
	 * @return boolean
	 */
	function validHex($color){
		if(preg_match('/^#[a-f0-9]{6}$/i', $color))
 			return true;
 		else
 			return false;
	}

	/**
	 * Outputs the necessary code to implement the scrolling mechanism
	 */
	function addScrollingMechanism(){
		// YUI library
		echo '<script type="text/javascript" src="http://yui.yahooapis.com/combo?2.7.0/build/yahoo-dom-event/yahoo-dom-event.js&2.7.0/build/animation/animation-min.js"></script>';
		// our js file located in the js folder
		wp_enqueue_script('wp-to-top', '/wp-content/plugins/wp-to-top/js/wp-to-top.js');
		// our CSS file located in the css folder
		echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('wpurl').'/wp-content/plugins/wp-to-top/css/wp-to-top.css" />';

		// for stupid IE6
		echo '<!--[if lte IE 6]>';
		echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('wpurl').'/wp-content/plugins/wp-to-top/css/wp-to-topie6.css" />';
		echo '<![endif]-->';
	}
	
	/**
	 * For the header.
	 */
	function headerWpToTop(){
		if(get_option('wpToTopShowPost')){
			if(is_single()){
				addScrollingMechanism();
			}
		}
		else{
			addScrollingMechanism();
		}
	}

	/**
	 * For the footer. It contains the HTML markup for the floating area
	 */
	function footerWpToTop(){
		if(get_option('wpToTopShowPost')){
			if(is_single()){
				echo '<div id="takeMeUpContainer" style="display:none;'.get_option('wpToTopPosition').':5px;background-color:'.get_option('wpToTopBgColor').'"><span id="takeMeUp" style="color:'.get_option('wpToTopFgColor').';">'.get_option('wpToTopText').'</span></div>';
			}
		}
		else{
			echo '<div id="takeMeUpContainer" style="display:none;'.get_option('wpToTopPosition').':5px;background-color:'.get_option('wpToTopBgColor').'"><span id="takeMeUp" style="color:'.get_option('wpToTopFgColor').';">'.get_option('wpToTopText').'</span></div>';
		}
	}
	
	/**
	 * Called upon activation of the plugin. Sets some options.
	 */
	function initWpToTop(){
		add_option('wpToTopText', 'Back to top'); // the text
		add_option('wpToTopBgColor', '#EA2F7E'); // the background color
		add_option('wpToTopFgColor', '#FFFFFF'); // the foreground color
		add_option('wpToTopPosition', 'right'); // position
		add_option('wpToTopShowPost', true); // whether to show in posts only
	}

	/**
	 * Called upon deactivation of the plugin. Cleans our mess.
	 */
	function destroyWpToTop(){
		delete_option('wpToTopText');
		delete_option('wpToTopBgColor');
		delete_option('wpToTopFgColor');
		delete_option('wpToTopPosition');
		delete_option('wpToTopShowPost');
	}
	
	/**
	 * Outputs the HTML form for the admin area. Also updates the options.
	 */
	function adminFormWpToTop(){
		if($_POST['action'] == 'save'){
			$ok = false;
			
			if($_POST['wpToTopText']){
				update_option('wpToTopText', $_POST['wpToTopText']);
				$ok = true;
			}
			
			if($_POST['wpToTopBgColor']){
				if(validHex($_POST['wpToTopBgColor'])){
					update_option('wpToTopBgColor', $_POST['wpToTopBgColor']);
					$ok = true;
				}
			}
			
			if($_POST['wpToTopFgColor']){
				if(validHex($_POST['wpToTopFgColor'])){
					update_option('wpToTopFgColor', $_POST['wpToTopFgColor']);
					$ok = true;
				}
			}
			
			if($_POST['wpToTopPosition']){
				update_option('wpToTopPosition', $_POST['wpToTopPosition']);
				$ok = true;
			}
			
			if($_POST['wpToTopShowPost'] == 1){
				update_option('wpToTopShowPost', true);
			}
			else{
				update_option('wpToTopShowPost', false);
			}
			
			if($ok){
				?>
				<div id="message" class="updated fade">
					<p>Changes have been saved</p>
				</div>
				<?php 
			}
			else{
				?>
				<div id="message" class="error fade">
					<p>An error has occurred</p>
				</div>
				<?php 
			}
		}
		
		// get the options values
		$wpToTopText = get_option('wpToTopText');
		$wpToTopBgColor = get_option('wpToTopBgColor');
		$wpToTopFgColor = get_option('wpToTopFgColor');
		$wpToTopPosition = get_option('wpToTopPosition');
		$wpToTopShowPost = get_option('wpToTopShowPost');
		?>
		<div class="wrap">
			<div id="icon-options-general" class="icon32"><br /></div>
			<h2>WP To Top Settings</h2>
			<form method="post">
				<table class="form-table">
					<tr valign="top">
						<th scope="row">
							<label for="wpToTopText">Text to show</label>
						</th>
						<td>
							<input name="wpToTopText" type="text" id="wpToTopText" value="<?php echo $wpToTopText ;?>" class="regular-text code" />
							<span class="setting-description">Default is <code>Back to top</code></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="wpToTopBgColor">Background color</label>
						</th>
						<td>
							<input name="wpToTopBgColor" type="text" id="wpToTopBgColor" value="<?php echo $wpToTopBgColor ;?>" class="regular-text code" />
							<span class="setting-description">Default is <code>#EA2F7E</code></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="wpToTopFgColor">Foreground color</label>
						</th>
						<td>
							<input name="wpToTopFgColor" type="text" id="wpToTopFgColor" value="<?php echo $wpToTopFgColor ;?>" class="regular-text code" />
							<span class="setting-description">Default is <code>#FFFFFF</code></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row">
							<label for="wpToTopPosition">Position</label>
						</th>
						<td>
							<select name="wpToTopPosition" id="wpToTopPosition">
								<option value="left" <?php if($wpToTopPosition == 'left'){ echo 'selected="true"'; } ?>>left</option>
								<option value="right" <?php if($wpToTopPosition == 'right'){ echo 'selected="true"'; } ?>>right</option>
							</select>
							<span class="setting-description">Default is <code>right</code></span>
						</td>
					</tr>
					
					<tr>
						<th scope="row" class="th-full" colspan="2">
							<label for="wpToTopShowPost">
								<input type="checkbox" id="wpToTopShowPost" name="wpToTopShowPost" value="1" <?php if($wpToTopShowPost){ echo 'checked="checked"'; } ?> />
								Show only in posts, not all pages
							</label>
						</th>
					</tr>
				</table>
				<p class="submit">
					<input type="hidden" name="action" value="save" />
					<input type="submit" name="Submit" class="button-primary" value="Save Changes" />
				</p>
			</form>
		</div>
		<?php 
	}
	
	/**
	 * Adds the sub menu in the admin panel
	 */
	function adminMenuWpToTop(){
		add_options_page('WP To Top Administration', 'WP To Top', 'manage_options', __FILE__, 'adminFormWpToTop');
	}

	// upon activation of the plugin, calls the initWpToTop function
	register_activation_hook(__FILE__, 'initWpToTop');
	// upon deactivation of the plugin, calls the destroyWpToTop function
	register_deactivation_hook(__FILE__, 'destroyWpToTop');
	
	// what to add in the header, calls the headerWpToTop function
	add_action('wp_head', headerWpToTop, 1);
	// what to add in the footer, calls the footerWpToTop function
	add_action('wp_footer', footerWpToTop, 1);
	// ads the submenu in the admin menu
	add_action('admin_menu', 'adminMenuWpToTop');
?>
