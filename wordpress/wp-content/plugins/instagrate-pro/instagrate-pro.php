<?php
/*  
Plugin Name: Instagrate Pro
Plugin URI: http://www.instagrate.co.uk/  
Description: Instagrate Pro is a powerful WordPress plugin that allows you to integrate Instagram images into your WordPress site. You can connect multiple Instagram accounts and automatically post your images, feed images or all hashtagged images everytime someone visits your site or on a schedule.
Author: polevaultweb 
Version: 0.2.2
Author URI: http://www.polevaultweb.com/

Copyright 2012  polevaultweb  (email : info@polevaultweb.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

//plugin version
define( 'IGP_PVW_PLUGIN_VERSION', '0.2.2');
//plugin name
define( 'IGP_PVW_PLUGIN_NAME', 'Instagrate Pro');
//plugin shortcode
define( 'IGP_PVW_PLUGIN_SHORTCODE', 'igp');

//plugin text domain
define( 'IGP_PVW_PLUGIN_SETTINGS', str_replace(" ","",strtolower(IGP_PVW_PLUGIN_NAME)));
//plugin linking
define( 'IGP_PVW_PLUGIN_LINK',  str_replace(" ","-",strtolower(IGP_PVW_PLUGIN_NAME)));
//plugin class
define( 'IGP_PVW_PLUGIN_CLASS',  str_replace(" ","_",strtolower(IGP_PVW_PLUGIN_NAME)));

//helpful paths
define( 'IGP_PVW_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'IGP_PVW_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'IGP_PVW_PLUGIN_BASE', plugin_basename( __FILE__ ) );
define( 'IGP_PVW_PLUGIN_DIR',dirname( plugin_basename( __FILE__ ) ));

define( 'IGP_PVW_PLUGIN_WEB','http://www.instagrate.co.uk/');

define( 'IGP_PVW_RETURN_URI', strtolower(site_url('/').'wp-admin/options-general.php?page='.IGP_PVW_PLUGIN_SETTINGS));


//require ADMIN file for plugin settings
require_once IGP_PVW_PLUGIN_PATH.'lib/admin/admin-page.php';

//require OPTIONS file for plugin settings
require_once IGP_PVW_PLUGIN_PATH.'lib/admin/admin-options.php';

//require ACCOUNT OPTIONS file for plugin settings
require_once IGP_PVW_PLUGIN_PATH.'lib/admin/account-options.php';

//require other php files for API handlers etc
require_once IGP_PVW_PLUGIN_PATH.'lib/api/instagram.php';

//require core file
require_once IGP_PVW_PLUGIN_PATH.'lib/core/instagrate.php';

//require core controller
require_once IGP_PVW_PLUGIN_PATH.'lib/core/controller.php';

if (!class_exists(IGP_PVW_PLUGIN_CLASS)) {

class instagrate_pro {

		//BEGIN - FUNCTIONS FOR PLUGIN FRAMEWORK //
		//---------------------------------------------------------------------------------------------------------------------------------------------------//
		
		/* Plugin loading method */
		public static function load_plugin() {
			
			// -- BEGIN PLUGIN FRAMEWORK ---------------------------------------------------------------------------------------- //
			
			//language support
			add_action('init', get_class()  . '::load_language_support');
			
			//settings menu
			add_action('admin_menu',get_class()  . '::register_settings_menu' );
			
			//settings link
			add_filter('plugin_action_links', get_class()  . '::register_settings_link', 10, 2 );
			
			//styles and scripts
			add_action('admin_enqueue_scripts', get_class()  . '::register_styles');
			
			//google maps scripts
			add_action('wp_enqueue_scripts', get_class()  . '::register_gmap_script');
					
			//register settings options
			add_action('admin_init', get_class()  . '::register_settings');
			
			//register settings functions
			add_action('admin_init', get_class()  . '::register_functions');
					
			//register default settings options on activation
			register_activation_hook(__FILE__, get_class()  . '::options_setup' );

			//register upgrade check function
			add_action('admin_init', get_class()  . '::upgrade_check');
			
			//add notices for prechecks
			add_action('admin_notices', get_class()  . '::plugin_admin_notice');
			
			//register uninstall hook
			register_uninstall_hook(__FILE__,  get_class()  . '::plugin_uninstall');
			
			// -- END PLUGIN FRAMEWORK ---------------------------------------------------------------------------------------- //
			
			// -- SHORTCODES ---------------------------------------------------------------------------------------- //
					
			// -- WIDGETS ---------------------------------------------------------------------------------------- //
					
			// -- CUSTOM REGISTRATIONS ---------------------------------------------------------------------------------------- //
			
			//register new schedules for cron scheduler
			add_filter( 'cron_schedules', get_class() . '::custom_schedules' );	
			
			//register controllers
			self::register_listeners();
			
			//register custom kses
			add_action('init', get_class()  . '::custom_kses');
			
			//add shortcode for google maps
			add_shortcode('igp_get_map', array(IGP_PVW_PLUGIN_CLASS, 'get_map_sc') );
			
			//register ajax handlers
			add_action('wp_ajax_instagram_config', get_class() . '::instagram_config_callback');
			
			$admin = new igp_pvw_plugin_framework();
			add_action('wp_ajax_reset_settings',array($admin,'reset_settings_callback'));
			add_action('wp_ajax_delete_account',array($admin,'delete_account_callback'));
			add_action('wp_ajax_duplicate_account',array($admin,'duplicate_account_callback'));
			add_action('wp_ajax_send_install_data',array($admin,'send_install_data_callback'));
			add_action('wp_ajax_send_debug_data',array($admin,'send_debug_data_callback'));
			
			// -- PLUGIN UPDATER ---------------------------------------------------------------------------------------- //
			include('plugin-updater.php');
			new igpPluginUpdater( 'http://updates.polevaultweb.com/' );
			
		}
		
		/* Add language support */
		public static function load_language_support() {
		
			load_plugin_textdomain( IGP_PVW_PLUGIN_LINK, false, IGP_PVW_PLUGIN_DIR . '/lang' );
		
		}
		
		/* Add settings options for plugin  */
		public static function register_settings() {  
		
			//register settings options
			register_setting( 'pvw_'.IGP_PVW_PLUGIN_SHORTCODE.'_plugin_options', 'pvw_'.IGP_PVW_PLUGIN_SHORTCODE.'_options','pvw_'.IGP_PVW_PLUGIN_SHORTCODE.'_validate_settings' );
		}
		
		/* Add hook to admin framework for options set up */
		public static function options_setup() {
				
			igp_pvw_plugin_framework::pvw_options_setup();
			
		}
   		  			
		/* Add menu item for plugin to Settings Menu */
		public static function register_settings_menu() {  
   		  			
   			add_options_page( IGP_PVW_PLUGIN_NAME, IGP_PVW_PLUGIN_NAME, 'read', IGP_PVW_PLUGIN_SETTINGS, get_class() . '::settings_page' );
	  				
		}

		/* Add settings link to Plugin page */
		public static function register_settings_link($links, $file) {  
   		  		
			static $this_plugin;
				if (!$this_plugin) $this_plugin = IGP_PVW_PLUGIN_BASE;
				 
				if ($file == $this_plugin){
				$settings_link = '<a href="options-general.php?page='.IGP_PVW_PLUGIN_SETTINGS.'">' . __('Settings', IGP_PVW_PLUGIN_SETTINGS) . '</a>';
				array_unshift( $links, $settings_link );
			}
			return $links;
				
		}
		
		
		/* Register custom stylesheets and script files */
		public static function register_styles() {
		 		
			if (isset($_GET['page']) && $_GET['page'] == IGP_PVW_PLUGIN_SETTINGS) {
		 
				//register styles
				wp_register_style( IGP_PVW_PLUGIN_SHORTCODE.'-admin-style', IGP_PVW_PLUGIN_URL . 'lib/admin/css/admin-style.css');
				
				//enqueue styles	
				wp_enqueue_style(IGP_PVW_PLUGIN_SHORTCODE.'-admin-style' );
				wp_enqueue_style('dashboard');
				
				//enqueue scripts
				wp_enqueue_script(IGP_PVW_PLUGIN_SHORTCODE.'-admin-tabs', IGP_PVW_PLUGIN_URL . 'lib/admin/scripts/admin-tabs.js');
				wp_enqueue_script(IGP_PVW_PLUGIN_SHORTCODE.'-admin-select', IGP_PVW_PLUGIN_URL . 'lib/admin/scripts/admin-select.js');
				wp_enqueue_script(IGP_PVW_PLUGIN_SHORTCODE.'-admin-ajax', IGP_PVW_PLUGIN_URL . 'lib/admin/scripts/admin-ajax.js');
				wp_enqueue_script('dashboard');
				wp_enqueue_script('jquery-ui-core');
				
			}
		}
		
		/* Register Google Map script */
		public static function register_gmap_script() {
		
			//only show script on single pages and if maps have been selected for any accounts
			global $wp_query;
			$posts = $wp_query->posts;
			
			if( igp_functions::page_has_maps($posts)){
			
				wp_enqueue_script( 'jquery' );
				wp_enqueue_script(IGP_PVW_PLUGIN_SHORTCODE.'-google-maps', 'https://maps.googleapis.com/maps/api/js?sensor=false');
				wp_enqueue_script(IGP_PVW_PLUGIN_SHORTCODE.'-google-map-single', IGP_PVW_PLUGIN_URL . 'lib/scripts/gmap.js');
			
			}
					
		}
		
		
		/* Register custom upgrade check function */
		public static function upgrade_check() {
		
			$saved_version = get_option( 'pvw_'.IGP_PVW_PLUGIN_SHORTCODE.'_version' );
			$current_version = isset($saved_version) ? $saved_version : 0;

			if ( version_compare( $current_version, IGP_PVW_PLUGIN_VERSION, '==' ) )
				return;
				
			//specific version checks on upgrade
			//if ( version_compare( $current_version, '0.1', '<' ) ) {}	
				
			//update the database version
			update_option( 'pvw_'.IGP_PVW_PLUGIN_SHORTCODE.'_version', IGP_PVW_PLUGIN_VERSION );
		
		} 
		
		/* Register custom uninstall function */
		public static function plugin_uninstall() {
		
			//delete settings and template options
			delete_option('pvw_'.IGP_PVW_PLUGIN_SHORTCODE.'_template'); 
			delete_option('pvw_'.IGP_PVW_PLUGIN_SHORTCODE.'_options'); 
			delete_option('pvw_'.IGP_PVW_PLUGIN_SHORTCODE.'_accounts'); 

			//delete version
			delete_option('pvw_'.IGP_PVW_PLUGIN_SHORTCODE.'_version');
			
				
		}
		
		public static function plugin_admin_notice(){
			
			if (isset($_GET['page']) && $_GET['page'] == IGP_PVW_PLUGIN_SETTINGS) {
				
				
				/* Display check for user to make sure a blog page is selected */
				if ('page' == get_option('show_on_front')) {
			
					if ( 0 == get_option('page_for_posts') ) {
					
						echo '<div class="updated">
								<p>You must select a page to display your posts in <a href="'.home_url().'/wp-admin/options-reading.php">Settings -> Reading</a></p>
							</div>';
					
					}
 
				}

				/* Display check to make sure there is write permissions on the debug file */
				$plugin = IGP_PVW_PLUGIN_SHORTCODE;
				$saved_options = igp_general_options::get_options();
					
				$debug_mode = $saved_options['debug_mode'];
				
				$debug_file = IGP_PVW_PLUGIN_PATH . "debug.txt";
				$file = file_exists($debug_file);
		
								
				if ($debug_mode == 'true' && $file) {
				
					//$write_igp = false; //igp_debug::can_write($file);
					$write = igp_debug::can_write($debug_file);
												
					if ($write == false) {
					
						echo '<div class="error">
									<p>'. $write.'Debug mode is turned on, however, the debug.txt file in the plugin folder is not writeable. Please contact your web hosting provider to amend the permissions on <i>wp-content/plugins/instagrate-pro/debug.txt</i> file.</p>
							  </div>';
							
						}
				}
				
				$check = array();
				$check = igp_instagrate::apiCheck();
		
				if ($check[0] == 0) {
									
					echo '<div class="error"><p>'.$check[1].'</p></div>';	
				
				} 
				
			}
		}

		
		/* Plugin Settings page and settings data */
		public static function settings_page() {
					
			igp_pvw_plugin_framework::pvw_plugin_settings();
		
		}
		
		//END - FUNCTIONS FOR PLUGIN FRAMEWORK //
		//---------------------------------------------------------------------------------------------------------------------------------------------------//
			
		/* Register settings functions */
		public static function register_functions() {
		 		
			if (isset($_GET['page']) && $_GET['page'] == IGP_PVW_PLUGIN_SETTINGS) {
		 
				//Custom header PHP
				igp_pvw_plugin_framework::settings_header();
				
			}
		}
		
		/* Shortcode for Google Maps */
		/* Function used by shortcode to display shots dribbble data */
		public static function get_map_sc($atts, $content = null) {
		
			//extract shortcode parameters
			extract(shortcode_atts(array(	'lat' => '',
											'lon' => '',
											'marker' => '',
											'class' => '',
											'width' => '400',
											'height' => '300' ), $atts));
			$html = '';
			
			if ($lat != '' && $lon != '') {
				
				$html .= '<div class="map_canvas'.$class.'" ';
				$html .= 'data-lat="'.$lat.'" ';
				$html .= 'data-lon="'.$lon.'" ';
				if ($marker != '') {
					$html .= 'data-marker="'.$marker.'" ';
				}
				$html .= 'style="width: '.$width.'px; height: '.$height.'px;">';
				$html .= '</div>';
				
			}

			return $html;
		
		}
		
		/* Add custom kses filtering for Google Maps output */
		public static function custom_kses() {
		
			global $allowedtags;
			$allowedtags['div'] = array( 	'align' => true,
											'class' => true,
											'dir' => true,
											'lang' => true,
											'style' => true,
											'xml:lang' => true,
											'data-lat' => true,
											'data-lon' => true,
											'data-marker' => true
										);
		
		}
		
		/* Add custom schedules for scheduled posting */
		public static function custom_schedules($schedules) {
		
			$new_schedules = array(		'weekly' => array(
											'interval' => 604800,
											'display' => 'Weekly'
										),
										'fortnightly' => array(
											'interval' => 1209600,
											'display' => 'Fortnightly'
										),
										'monthly' => array(
											'interval' => 2419200,
											'display' => 'Once Every 4 weeks'
										)
									);
			
			return array_merge( $schedules, $new_schedules );

		}
		
		/* Ajax functions for Instagram settings */
		public static function instagram_config_callback() {
			
			
			if (isset($_POST['id']) && isset($_POST['type'])) {
				
				$images = igp_instagrate::get_recent_images($_POST['id'],$_POST['type'],$_POST['tag']);
				
				$count = 0;
				$size = sizeof($images);
				
				$option = '';
				
				if (isset($images) && is_array($images)) {
					
					foreach ($images as $key => $image) {
						$count ++;
						
						$keyvalue = $key;
						if ($_POST['type'] == 'hashtag') { $keyvalue = 0;}
						
						if ($count == 1) {$selected = 'selected="selected"';} else {$selected = '';}
						$option .= '<option value="'.$keyvalue.'" '.$selected.'>';
						$option .= $image;
						$option .= '</option>';
						
					}
				}
				echo $option;
				die();
				
			}
						
		}
		
		/* Main listener function */
		public static function register_listeners() {
		
			$controller = new igp_controller();
			
			//register the realtime listener function
			add_action( 'template_redirect', array($controller,'instagrate_listener_real'));
			
			//register scheduled events
			
			//hourly
			$schedule = 'hourly';
			
			if( !wp_next_scheduled( $schedule.'_listen' )){
				wp_schedule_event( time(), $schedule, $schedule.'_listen' );
			}
			
			add_action( $schedule.'_listen', array($controller,'instagrate_listener_hourly') );
			
			//twicedaily
			$schedule = 'twicedaily';
			
			if( !wp_next_scheduled( $schedule.'_listen' )){
				wp_schedule_event( time(), $schedule, $schedule.'_listen' );
			}
			
			add_action( $schedule.'_listen', array($controller,'instagrate_listener_twicedaily') );
									
			//daily
			$schedule = 'daily';
			
			if( !wp_next_scheduled( $schedule.'_listen' )){
				wp_schedule_event( time(), $schedule, $schedule.'_listen' );
			}
			
			add_action( $schedule.'_listen', array($controller,'instagrate_listener_daily') );
						
			//weekly
			$schedule = 'weekly';
			
			if( !wp_next_scheduled( $schedule.'_listen' )){
				wp_schedule_event( time(), $schedule, $schedule.'_listen' );
			}
			
			add_action( $schedule.'_listen',array($controller,'instagrate_listener_weekly') );	
			
			//fortnightly
			$schedule = 'fortnightly';
			
			if( !wp_next_scheduled( $schedule.'_listen' )){
				wp_schedule_event( time(), $schedule, $schedule.'_listen' );
			}
			
			add_action( $schedule.'_listen',array($controller,'instagrate_listener_fortnightly') );
						
			//monthly
			$schedule = 'monthly';
			
			if( !wp_next_scheduled( $schedule.'_listen' )){
				wp_schedule_event( time(), $schedule, $schedule.'_listen' );
			}
			
			add_action( $schedule.'_listen', array($controller,'instagrate_listener_monthly') );
						
		}
			
					
	}
	
}

if (class_exists(IGP_PVW_PLUGIN_CLASS)) {

	//Load plugin
	instagrate_pro::load_plugin();
	
}
?>