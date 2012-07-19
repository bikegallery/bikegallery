<?php
/*
Plugin Name: FT FacePress II
Plugin URI: http://knoxwebdev.com/facepress-ii
Description: This plugin publishes the title, url, and/or excerpt of your post as the status of your Facebook profile and/or Facebook page by WordPress author.
Author: Alan Knox 
Version: 2.1.0
Author URI: http://knoxwebdev.com/
*/

/*
Copyright 2010  Alan Knox Web Development

*/

$php_version = (int)phpversion();

define( 'FacepressII_Version' , '2.1.0' );
		
// Define class
if (!class_exists("FT_FacepressII")) {
	class FT_FacepressII {
		/*--------------------------------------------------------------------
		    General Functions
		  --------------------------------------------------------------------*/
		  
		// Class members		
		var $optionsName				= "ft_facepressii";
		var $facepressiiUser			= "ft_facepressiiuser";
		var $facepressiiProfile			= "ft_facepressiiprofile";
		var $facepressiiPage			= "ft_facepressiipage";
		var $facepressiiFormat			= "ft_facepressiiformat";
		var $facepressiiShortURLs		= "ft_facepressiishorturls";
		var $facepressiiCats			= "ft_facepressiicats";
		var $facepressiiAllUsers     	= "ft_facepressiiallusers";
		var $facepressiiNoPublish     	= "ft_facepressiinopublish";

		// Constructor
		function FT_FacePressII() {
			global $wp_version;
			$this->wp_version = $wp_version;
		}
		
		// Initialization function
		function init() {
//			if (!function_exists("curl_init")) {
//				deactivate_plugins(__FILE__);
//				die("This plugin needs <a href=\"http://www.php.net/curl\">PHP cURL</a> to be installed on your server.");
//			} else {	
				$this->getOptions();
//			}
		}
		
		/*--------------------------------------------------------------------
		    Administrative Functions
		  --------------------------------------------------------------------*/
	  
		// Option loader function
		function getOptions($user_login = "") {
			// Set default values for the options
			$facepressiiProfile 		= "";
			$facepressiiPage 			= "";
			$facepressiiFormat 		= "%TITLE% %URL%";
			$facepressiiShortURLs     = "";
			$facepressiiCats          = "";
			
			$options = array(
								 $this->facepressiiProfile 		=> $facepressiiProfile,
								 $this->facepressiiPage 		=> $facepressiiPage,
								 $this->facepressiiFormat 		=> $facepressiiFormat,
								 $this->facepressiiShortURLs 	=> $facepressiiShortURLs,
								 $this->facepressiiCats			=> $facepressiiCats,
								 $this->facepressiiAllUsers		=> $facepressiiAllUsers,
								 $this->facepressiiNoPublish	=> $facepressiiNoPublish
							);
								 
			if (empty($user_login)) { 
				$optionsAppend = "";
			} else {
				$optionsAppend = "_" . $user_login;
			}
			
			// Get values from the WP options table in the database, re-assign if found
			$dbOptions = get_option($this->optionsName . $optionsAppend);
			if (!empty($dbOptions)) {
				foreach ($dbOptions as $key => $option) {
					$options[$key] = $option;
				}
			}
			
			// Update the options for the panel
			update_option($this->optionsName . $optionsAppend, $options);
			return $options;
		}
		
		function printFacepressIIUsersOptionsPage($user_login = "") {
			global $current_user;
			get_currentuserinfo();
		
			$this->printFacepressIIOptionsPage($current_user->user_login);
		}
		
		// Print the admin page for the plugin
		function printFacepressIIOptionsPage($user_login = "") {
			$emptyUser = empty($user_login);
			
			// Get the user options
			$options = $this->getOptions($user_login);
										
//			print_r ($options);
			
			if (isset($_POST['update_ft_facepressii_settings'])) { 
				if (isset($_POST['ft_facepressiiprofile'])) {
					$options[$this->facepressiiProfile] = $_POST['ft_facepressiiprofile'];
				}	
				
				if (isset($_POST['ft_facepressiipage'])) {
					$options[$this->facepressiiPage] = $_POST['ft_facepressiipage'];
				}
				
				if (isset($_POST['ft_facepressiiformat'])) {
					$options[$this->facepressiiFormat] = $_POST['ft_facepressiiformat'];
				}
				
				if (isset($_POST['ft_facepressiishorturls'])) {
					$options[$this->facepressiiShortURLs] = $_POST['ft_facepressiishorturls'];
				}
				
				if (isset($_POST['ft_facepressiicats'])) {
					$options[$this->facepressiiCats] = $_POST['ft_facepressiicats'];
				}

				if ($emptyUser) { //then we're dealing with the main Admin options
					$options[$this->facepressiiAllUsers] = $_POST['ft_facepressiiallusers'];
					$options[$this->facepressiiNoPublish] = $_POST['ft_facepressiinopublish'];
					$optionsAppend = "";
				} else {
					$optionsAppend = "_" . $user_login;
				}
				
				update_option($this->optionsName . $optionsAppend, $options);
				// update settings notification below
				?>
				<div class="updated"><p><strong><?php _e("Settings Updated.", "FT_FacePressII");?></strong></p></div>
			<?php
			}
			// Display HTML form for the options below
			?>
			<div class=wrap>
					<h2>FacePress II Options for WordPress user <?php if ($emptyUser) { echo 'admin'; } else { echo $user_login; } ?></h2>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="542ZNCZYVZDYW">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

				<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
					<?php wp_nonce_field( 'test_facebook' ); ?></p>
                    <?php if ($emptyUser) { ?>
                    	<p style="font-size: 11px; margin-bottom: 0px; color: green;"><strong>NOTE:</strong> When any user publishes a WordPress post, FacePress will update the admin facebook accounts as listed below, as well as the individual user facebook accounts as set in the FacePress II User Options.</p>
                    <?php } else { ?> 
                    	<p style="font-size: 11px; margin-bottom: 0px; color: green;"><strong>NOTE:</strong> When WordPress user <?php echo $user_login; ?> publishes a WordPress post, FacePress will update the user's facebook accounts as listed below, as well as the admin facebook accounts as set in the FacePress II Admin Options.</p>
                    <?php } ?> 
					<p><div style="width=100px;"><strong>Facebook PROFILE personalized upload email address:</strong> </div><input name="ft_facepressiiprofile" id="ft_facepressiiprofile" style="width: 30%;" value="<?php _e(apply_filters('format_to_edit',$options[$this->facepressiiProfile]), 'FT_FacePressII') ?>" />
						<input type="button" class="button" name="test_ft_facepress_profile" id="test_profile" value="<?php _e('Test Facebook Connection', 'FT_FacePressII') ?>" />
					</p>
					<div class="facepressii-profile-info" style="margin-left: 50px;">
                    <p style="font-size: 11px; margin-bottom: 0px;">To find the "personalized upload email address" that Facebook associates with your PROFILE, click Account / Account Settings / Mobile / Go to Facebook Mobile. Look for the section labelled "Upload via Email". Your profile's personalized upload email address will be listed in this section.</p>
                    </div>
					<p><div style="width=100px;"><strong>Facebook PAGE personalized upload email address:</strong> </div><input name="ft_facepressiipage" id="ft_facepressiipage" style="width: 30%;" value="<?php _e(apply_filters('format_to_edit',$options[$this->facepressiiPage]), 'FT_FacePressII') ?>" /> 
						<input type="button" class="button" name="test_ft_facepress_page" id="test_page" value="<?php _e('Test Facebook Connection', 'FT_FacePressII') ?>" />
					<div class="facepressii-profile-info" style="margin-left: 50px;">
                    <p style="font-size: 11px; margin-bottom: 0px;">To find the "personalized upload email address" that Facebook associates with your PAGE, click "Edit Page" under your page's image. Then click "Edit" in the "Mobile" section. Facebook will then display the personalized upload email address for your page in the "Mobile" section.</p>
                    </div>
					<p><div style="width=100px;"><strong>Post Format:</strong> </div><input name="ft_facepressiiformat" style="width: 50%;" value="<?php _e(apply_filters('format_to_edit',$options[$this->facepressiiFormat]), 'FT_FacePressII') ?>" /></p>
                    <div class="post-format" style="margin-left: 50px;">
                    <p style="font-size: 11px; margin-bottom: 0px;">Format Options:</p>
                    <ul style="font-size: 11px;">
                    	<li>%TITLE% - Displays the Title of your post.</li>
                        <li>%URL% - Displays the URL (or shortened URL) of your post.*</li>
                        <li>%EXCERPT% - Displays the Excerpt of your post.</li>
                    </ul>
                    </div>
                    <p><div style="width=100px;"><strong>Categories to Include/Exclude:</strong> </div><input name="ft_facepressiicats" style="width: 30%;" value="<?php _e(apply_filters('format_to_edit',$options[$this->facepressiiCats]), 'FT_FacePressII') ?>" /></p>
                    <div class="facepressii-cats" style="margin-left: 50px;">
                    <p style="font-size: 11px; margin-bottom: 0px;">Display posts from several specific category IDs, e.g. 3,4,5<br />Display all posts except those from a category by prefixing its ID with a '-' (minus) sign, e.g. -3,-4,-5</p>
                    </div>
                    <p><strong>Use Shortened URLs?</strong> <input value="1" type="checkbox" name="ft_facepressiishorturls" <?php if ((int)$options[$this->facepressiiShortURLs] == 1) echo "checked"; ?> /></p>
                    <div class="facepressii-short" style="margin-left: 50px;">
                    <p style="font-size: 11px; margin-bottom: 0px;">Check this box if you want FacePress II to use a shortened version of your post's URL instead of the full URL.</p>
                    </div>
					<?php if ($emptyUser) { //then we're displaying the main Admin options ?>
                    <p><strong>Update all Facebook profiles?</strong> <input value="1" type="checkbox" name="ft_facepressiiallusers" <?php if ((int)$options[$this->facepressiiAllUsers] == 1) echo "checked"; ?> /></p>
                    <div class="facepressii-allusers" style="margin-left: 50px;">
                    <p style="font-size: 11px; margin-bottom: 0px;">Check this box if you want FacePress II to update each available author profile when any user publishes a post.</p>
                    </div>
                    <p><strong>Default to NOT publish to facebook:</strong> <input value="1" type="checkbox" name="ft_facepressiinopublish" <?php if ((int)$options[$this->facepressiiNoPublish] == 1) echo "checked"; ?> /></p>
                    <div class="facepressii-nopublish" style="margin-left: 50px;">
                    <p style="font-size: 11px; margin-bottom: 0px;">Check this box if you want FacePress II default to NOT publishing post info to facebook. A checkbox will be available in the options section of each post to override either setting.</p>
                    </div>
                    <?php } ?>
                    <p style="font-size: 11px; margin-top: 30px;">*NOTE: <a href="http://wordpress.org/extend/plugins/twitter-friendly-links/">Twitter Friendly Links Plugin</a> must be activated in Wordpress to publish shortened URLs. Otherwise, the full URL will be used for the %URL% format regardless of this setting.</p>
                    
					<div class="submit">
						<input type="submit" class="button-primary" name="update_ft_facepressii_settings" value="<?php _e('Update Settings', 'FT_FacePressII') ?>" />
					</div>
				</form>
			</div>
			<?php
		}
		
		function facepressii_meta_tags($id) {
			$awmp_edit = $_POST["ftfp_edit"];
			
			if (isset($awmp_edit) && !empty($awmp_edit)) {
				$format = $_POST["ftfp_format"];
				$exclude = $_POST["ftfp_exclude"];
				$include = $_POST["ftfp_include"];
	
				delete_post_meta($id, 'ftfp_format');
				delete_post_meta($id, 'ftfp_exclude');
				delete_post_meta($id, 'ftfp_include');
				
				if (isset($format) && !empty($format)) {
					add_post_meta($id, 'ftfp_format', $format);
				}
				
				if (isset($exclude) && !empty($exclude)) {
					add_post_meta($id, 'ftfp_exclude', $exclude);
				}

				if (isset($include) && !empty($include)) {
					add_post_meta($id, 'ftfp_include', $include);
				}
			}
		}
		
		function facepressii_add_meta_tags() {
			global $post;
			$post_id = $post;
			
			if (is_object($post_id)) {
				$post_id = $post_id->ID;
			}

			$options = get_option('ft_facepressii');
			$defaultNoPublish = $options['ft_facepressiinopublish'];
			
            $format = get_post_meta($post_id, 'ftfp_format', true);
            $exclude = get_post_meta($post_id, 'ftfp_exclude', true); 
            $include = get_post_meta($post_id, 'ftfp_include', true); ?>
	
			<?php if (substr($this->wp_version, 0, 3) >= '2.5') { ?>
                    <div id="postftfp" class="postbox">
                    <h3><?php _e('FacePress II Post Options', 'face_press') ?></h3>
                    <div class="inside">
                    <div id="postftfp">
			<?php } else { ?>
                    <div class="dbx-b-ox-wrapper">
                    <fieldset id="ftfpdiv" class="dbx-box">
                    <div class="dbx-h-andle-wrapper">
                    <h3 class="dbx-handle"><?php _e('FacePress II Post Options', 'face_press') ?></h3>
                    </div>
                    <div class="dbx-c-ontent-wrapper">
                    <div class="dbx-content">
			<?php } ?>
		
			<a target="__blank" href="http://knoxwebdev.com/facepress-ii"><?php _e('FT FacePress', 'face_press') ?></a>
			<input value="ftfp_edit" type="hidden" name="ftfp_edit" />
			<table style="margin-bottom:40px">
                <tr>
                <th style="text-align:left;" colspan="2">
                </th>
                </tr>

                <tr><th scope="row" style="text-align:right; width:150px; padding-top: 5px; padding-right:10px;">
				<?php if ((int)$defaultNoPublish == 1) { 
					_e('Publish this Post to Facebook:', 'face_press'); ?>
                    </th>
                    <td><input value="1" type="checkbox" name="ftfp_include" 
					<?php if ((int)$include == 1) echo "checked"; ?> />
				<?php }                    
				else { 
					_e('Do NOT publish this Post to Facebook:', 'face_press'); ?>
                    </th>
                    <td><input value="1" type="checkbox" name="ftfp_exclude" 
					<?php if ((int)$exclude == 1) echo "checked"; ?> />
				<?php } ?>                

                </td>
				<td>
                    <?php // Only show ReTweet button if the post is "published"
					if ($post->post_status == "publish") { ?>
                    <input style="float: right;" type="button" class="button" name="refacepress_facepress" id="refacepress_button" value="<?php _e('Re-FacePress', 'face-press') ?>" />
					<?php wp_nonce_field( 'refacepress', 'refacepress_wpnonce' ); ?>
                    <?php } ?>

				</td></tr>
                
                <tr><th scope="row" style="text-align:right; width:80px; padding-right:10px;"><?php _e('Format:', 'face_press') ?></th>
                <td><input value="<?php echo $format ?>" type="text" name="ftfp_format" size="50px"/></td></tr>

                <tr><th scope="row" style="text-align:right; width:150px; vertical-align:top; padding-top: 5px; padding-right:10px;">Format Options:</th>
                <td style="vertical-align:top;">
                	<ul>
                    	<li>%TITLE% - Displays Title of your post.</li>
                        <li>%URL% - Displays URL (or shortened URL) of your post.</li>
                        <li>%EXCERPT% - Displays Excerpt of your post.</li>
                    </ul>
            	</tr>
			</table>
			
			<?php if (substr($this->wp_version, 0, 3) >= '2.5') { ?>
			</div></div></div>
			<?php } else { ?>
			</div>
			</fieldset>
			</div>
			<?php }
		}
	}
}

// Instantiate the class
if (class_exists("FT_FacePressII")) {
	$dl_pluginFTFacePressII = new FT_FacePressII();
}

// Initialize the admin panel if the plugin has been activated
if (!function_exists("FT_FacePressII_ap")) {
	function FT_FacePressII_ap() {
		global $dl_pluginFTFacePressII;
		
		if (!isset($dl_pluginFTFacePressII)) {
			return;
		}
		
		if (function_exists('add_options_page')) {
			add_options_page('FacePress II Admin Options', 'FacePress II Admin Options', 9, basename(__FILE__), array(&$dl_pluginFTFacePressII, 'printFacepressIIOptionsPage'));
			add_submenu_page('users.php', 'FacePress II User Options', 'FacePress II User Options', 2, basename(__FILE__), array(&$dl_pluginFTFacePressII, 'printFacepressIIUsersOptionsPage'));
		}
		
		if (function_exists('add_option')) {
			add_option('ftfp_format', '', 'FacePress II Meta Tags Format', 'yes');
			add_option('ftfp_exclude', '', 'FacePress II Meta Tags Exclude', 'yes');
			add_option('ftfp_include', '', 'FacePress II Meta Tags Include', 'yes');
		}
	}	
}


// Example followed from http://codex.wordpress.org/AJAX_in_Plugins
if (!function_exists("facepress_js")) {
	function facepress_js() {
	?>
	<script type="text/javascript" >
	jQuery(document).ready(function($) {
		$('input#test_profile').click(function() {
			var emailAddr = $('input#ft_facepressiiprofile').val();
			if (emailAddr == "") {
				$('input#ft_facepressiiprofile').focus();
				return false;
			}
		
			var data = {
				action: 'test_facebook',
				email: emailAddr,
				_wpnonce: $('input#_wpnonce').val()
			};
			
			send_facepress(data);
		});
		
		$('input#test_page').click(function() {
			var emailAddr = $('input#ft_facepressiipage').val();
			if (emailAddr == "") {
				$('input#ft_facepressiipage').focus();
				return false;
			}
		
			var data = {
				action: 'test_facebook',
				email: emailAddr,
				_wpnonce: $('input#_wpnonce').val()
			};
			
			send_facepress(data);
		});
		
		$('input#refacepress_button').click(function() {
			var data = {
				action: 	'refacepress',
				id:  		$('input#post_ID').val(),
				_wpnonce: 	$('input#refacepress_wpnonce').val()
			};
			
			send_facepress(data);
		});

       function send_facepress(data) {
			var style = "position: fixed; " +
						"display: none; " +
						"z-index: 1000; " +
						"top: 50%; " +
						"left: 50%; " +
						"background-color: #E8E8E8; " +
						"border: 1px solid #555; " +
						"padding: 15px; " +
						"width: 350px; " +
						"min-height: 80px; " +
						"margin-left: -175px; " + 
						"margin-top: -40px;" +
						"text-align: center;" +
						"vertical-align: middle;";
			$('body').append("<div id='test_results' style='" + style + "'></div>");
			$('#test_results').html("<p>Sending update to Facebook</p>" +
									"<p><img src='/wp-includes/js/thickbox/loadingAnimation.gif' /></p>");
			$('#test_results').show();
			
			// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
			jQuery.post(ajaxurl, data, function(response) {
				$('#test_results').html('<p>' + response + '</p>' +
										'<input type="button" class="button" name="results_ok_button" id="results_ok_button" value="OK" />');
				$('#results_ok_button').click(remove_results);
			});
			
		}
		
		function remove_results() {
			jQuery("#results_ok_button").unbind("click");
			jQuery("#test_results").remove();
			if (typeof document.body.style.maxHeight == "undefined") {//if IE 6
				jQuery("body","html").css({height: "auto", width: "auto"});
				jQuery("html").css("overflow","");
			}
			document.onkeydown = "";
			document.onkeyup = "";
			return false;
		}
	});
	</script>
	
	<?php
	}
}


if (!function_exists("test_facebook_ajax")) {
	function test_facebook_ajax() {
		check_ajax_referer('test_facebook');
		
		$emailAddr = $_POST['email'];
		$status = 'Testing FacePress II WordPress Plugin ( http://knoxwebdev.com/facepress-ii ) at ' . get_bloginfo('url');
		$result = ft_publish_status($emailAddr, $status);
		
		if ($result == 200) {
			die("Successfully sent your status to Facebook.<br>Don't forget to save your settings.");
		} else {
			die($result);
		}
	}
}

if (!function_exists("refacepress_ajax")) {
	function refacepress_ajax() {
		check_ajax_referer('refacepress');
		
		$id = $_POST['id'];
		$result = ft_publish_to_facebook($id);
		
		if ($result == 200) {
			die("Successfully sent your status to Facebook.<br>Don't forget to save your settings.");
		} else {
			die($result);
		}
	}
}


									
// Add function to pubslih to facebook
if (!function_exists("ft_publish_to_facebook")) {
	function ft_publish_to_facebook($postID) {
		global $wpdb;
	    $post = get_post($postID);
		$maxLen = 1000;

		$authorID = $post->post_author;
		$authorLogin = get_the_author_meta('user_login', $authorID);

//		global $current_user;
//		get_currentuserinfo();

		if ($post->post_type == 'post') {
			$options = get_option('ft_facepressii');
			$defaultNoPublish = $options['ft_facepressiinopublish'];

			$exclude = get_post_meta($postID, 'ftfp_exclude', true);
			$include = get_post_meta($postID, 'ftfp_include', true);
			if ((int)$defaultNoPublish == 1 and (int)$include != 1) return;
			if ((int)$defaultNoPublish != 1 and (int)$exclude == 1) return;
			
			if ($options['ft_facepressiiallusers']) {
				$user_ids = $wpdb->get_col($wpdb->prepare( "SELECT user_login 
															FROM $wpdb->users" ));
			} else {
				$user_ids[] = $authorLogin;
			}

			$user_ids[] = "";
			
			foreach ($user_ids as $user_id) {
				if (empty($user_id)) {
					$optionsAppend = "";
				} else {
					$optionsAppend = "_" . $user_id;
				}
			
				$options = get_option('ft_facepressii' . $optionsAppend);
				
				if(!empty($options)) {
					
					$continue = FALSE;
					if (!empty($options['ft_facepressiicats'])) {
						$cats = split(",", $options['ft_facepressiicats']);
						foreach ($cats as $cat) {
							if (preg_match('/^-\d+/', $cat)) {
								$cat = preg_replace('/^-/', '', $cat);
								if (in_category( (int)$cat, $post )) {
									return; // if in an exluded category, return.
								} else  {
									$continue = TRUE; // if not, than we can continue -- thanks Webmaster HC at hablacentro.com :)
								}
							} else if (preg_match('/\d+/', $cat)) {
								if (in_category( (int)$cat, $post )) {
									$continue = TRUE; // if  in an included category, set continue = TRUE.
								}
							}
						}
					} else { // If no includes or excludes are defined, then continue
						$continue = TRUE;
					}
					
					if (!$continue) return; // if not in an included category, return.
					
					$format = htmlspecialchars(stripcslashes(get_post_meta($postID, 'ftfp_format', true)));
					
					if (!isset($format) || empty($format)) {
						$format = $options['ft_facepressiiformat'];
					}
					
					$ftstatus = $format;
					
					if (preg_match('%URL%', $ftstatus)) {
						$plugins = get_option('active_plugins');
						$required_plugin = 'twitter-friendly-links/twitter-friendly-links.php';
						//check to see if Twitter Friendly Links plugin is activated			
						
						if ($options['ft_facepressiishorturls']) {
							if ( in_array( $required_plugin , $plugins ) ) {
								$url = permalink_to_twitter_link(get_permalink($postID)); // if yes, we want to use that for our URL shortening service.
							} else {
								$url = get_permalink($postID); 
							}
						}
						else {
							$url = get_permalink($postID);
						}
						
						$ftstatus = str_ireplace("%URL%", $url, $ftstatus);
					}
					
					if (preg_match('%TITLE%', $ftstatus)) {
						$title = $post->post_title;
						$ftstatus = str_ireplace("%TITLE%", $title, $ftstatus);
					}
					
					if (preg_match('%EXCERPT%',$ftstatus))
					{
						$postExcerpt = $post->post_excerpt;
						$ftstatus = str_ireplace("%EXCERPT%", $postExcerpt, $ftstatus);
					}

				}

				if (!empty($options['ft_facepressiiprofile']) || !empty($options['ft_facepressiipage'])) {

					$subject = $ftstatus;

					if (!empty($options['ft_facepressiiprofile'])) {
						$to = $options['ft_facepressiiprofile'];
						ft_publish_status($to, $subject);
					}

					if (!empty($options['ft_facepressiipage'])) {
						$to = $options['ft_facepressiipage'];
						ft_publish_status($to, $subject);
					}
				
				}

			}
		}
		
		$wpdb->flush();
	}	
}

if (!function_exists("ft_publish_status")) {
	function ft_publish_status($emailAddr, $status) { 

		$message = '-';
		$headers = 'From: '. get_bloginfo('admin_email') . "\r\n" .
		    'Reply-To: '. get_bloginfo('admin_email') . "\r\n" .
		    'X-Mailer: PHP/' . phpversion();
		wp_mail($emailAddr, $status, $message, $headers);
		
		if (is_wp_error($result)) {
			return $result->get_error_message();
		} else if (isset($result["response"]["code"])) {
			return $result["response"]["code"];
		} else {
			return false;	}
	}
}


// From PHP_Compat-1.6.0a2 Compat/Function/str_ireplace.php for PHP4 Compatibility
if(!function_exists('str_ireplace')){
	function str_ireplace($search,$replace,$subject){
		// Sanity check
		if (is_string($search) && is_array($replace)) {
			user_error('Array to string conversion', E_USER_NOTICE);
			$replace = (string) $replace;
		}
	
		// If search isn't an array, make it one
		$search = (array) $search;
		$length_search = count($search);
	
		// build the replace array
		$replace = is_array($replace)
		? array_pad($replace, $length_search, '')
		: array_pad(array(), $length_search, $replace);
	
		// If subject is not an array, make it one
		$was_string = false;
		if (is_string($subject)) {
			$was_string = true;
			$subject = array ($subject);
		}
	
		// Prepare the search array
		foreach ($search as $search_key => $search_value) {
			$search[$search_key] = '/' . preg_quote($search_value, '/') . '/i';
		}
		
		// Prepare the replace array (escape backreferences)
		$replace = str_replace(array('\\', '$'), array('\\\\', '\$'), $replace);
	
		$result = preg_replace($search, $replace, $subject);
		return $was_string ? $result[0] : $result;
	}
}

// Actions and filters	
if (isset($dl_pluginFTFacePressII)) {
	/*--------------------------------------------------------------------
	    Actions
	  --------------------------------------------------------------------*/
	  
	// Add the admin menu
	add_action('admin_menu', 'FT_FacePressII_ap');
	// Initialize options on plugin activation
	add_action("activate_ft-facepressii/ft-facepressii.php",  array(&$dl_pluginFTFacePressII, 'init'));
	
	if (substr($dl_pluginFTFacePressII->wp_version, 0, 3) >= '2.5') {
		add_action('edit_form_advanced', array($dl_pluginFTFacePressII, 'facepressii_add_meta_tags'));
		add_action('edit_page_form', array($dl_pluginFTFacePressII, 'facepressii_add_meta_tags'));
	} else {
		add_action('dbx_post_advanced', array($dl_pluginFTFacePressII, 'facepressii_add_meta_tags'));
		add_action('dbx_page_advanced', array($dl_pluginFTFacePressII, 'facepressii_add_meta_tags'));
	}
	
	add_action('edit_post', array($dl_pluginFTFacePressII, 'facepressii_meta_tags'));
	add_action('publish_post', array($dl_pluginFTFacePressII, 'facepressii_meta_tags'));
	add_action('save_post', array($dl_pluginFTFacePressII, 'facepressii_meta_tags'));
	add_action('edit_page_form', array($dl_pluginFTFacePressII, 'facepressii_meta_tags'));
	
	// Whenever you publish a post, post to facebook
	add_action('future_to_publish', 'ft_publish_to_facebook');
	add_action('new_to_publish', 'ft_publish_to_facebook');
	add_action('draft_to_publish', 'ft_publish_to_facebook');
	
	add_action('admin_head', 'facepress_js');
	add_action('wp_ajax_test_facebook', 'test_facebook_ajax');
	add_action('wp_ajax_refacepress', 'refacepress_ajax');

}
?>