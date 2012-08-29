<?php

class igp_debug {

	
	
	public function __construct() {
	
	
	
	}
	
	function varDumpToString ($var)	{
		
		ob_start();
		var_dump($var);
		$result = ob_get_clean();
		return $result;
	}
	
	public function can_write($file) {
	
		$can_write = false;
		
		//$fh = false;
		
		$fhandle = @fopen($file, 'a');
		if ($fhandle == '' ) {
			return false;
		} else {
			
			  fclose($fhandle);
			  return true;
		}
            
      
				
	}
	

	public function plugin_debug_write($string) {
		
		//Set the filepath and filename
		$debug_path_file = IGP_PVW_PLUGIN_PATH . "debug.txt";
		
		if (self::can_write($debug_path_file) == true) {
		
			try {
			
				$fh = fopen( $debug_path_file, "a" );
				fwrite( $fh, $string );
				fclose( $fh );
				
			} catch (Exception $e) {
			
			}
			
		}
		
			
	}
	
	public function get_install_data($type) {
	
		$html = '';
		
		$data = self::get_data();
		
		//var_dump($data);
		
		if ($type == 'html') {
			
			$break = "<br/>";
		
		} else {
		
			$break = "\n";
		}
		
		foreach ($data as $key => $setting) {
		
			if ($key == 'title') {
			
				$html .= '================= '.$setting.' =====================';
				$html .= $break.$break;
										
			} elseif (substr($key,0,6) == 'title-') {
			
				$html .= $break;
				$html .= '== '.$setting.' ==';
				$html .= $break.$break;
			
			} else {
			
				$html .= $key.': '.$setting;
				$html .= $break;
			}
		
		
		}
		
		return $html;
	
	}
	
	public function send_install_data() {
	
		global $current_user;
		
		$plugin = IGP_PVW_PLUGIN_NAME;
		$subject = $plugin.' Support - Install Data';
		$message = self::get_install_data('plain');
		
		$headers =  "From: \"$current_user->display_name\" <$current_user->user_email>\r\n";
		
		wp_mail( 'info@polevaultweb.com',$subject,$message,$headers);
			
	}
	
	public function debug_file_exists() {
	
		$plugin = IGP_PVW_PLUGIN_SHORTCODE;
		
		$saved_options = igp_general_options::get_options();
			
		$debug_mode = $saved_options['debug_mode'];
		
		$debug_file = IGP_PVW_PLUGIN_PATH.'debug.txt';
		$file = file_exists($debug_file);
		
		if ($debug_mode == 'true' && $file ) {
		
			return true;
		}
		else {
		
			return false;
			
		}
	
	}
	
	function send_debug_data() {

	
		global $current_user;
		$plugin = IGP_PVW_PLUGIN_SHORTCODE;
		$saved_options = get_option('pvw_'.$plugin.'_options');
			
		$debug_mode = $saved_options['debug_mode'];
		
		$debug_file = IGP_PVW_PLUGIN_PATH.'debug.txt';
		$file = file_exists($debug_file);
		
		$response = '';
		
		if ($debug_mode == 'true' && $file ) {
		
			global $current_user;
			get_currentuserinfo();
			
			$subject = IGP_PVW_PLUGIN_NAME.' Support - Debug File';
		
			$message = self::get_install_data('plain');
			
			$headers =  "From: \"$current_user->display_name\" <$current_user->user_email>\r\n";
			
			//print $message;
			wp_mail( 'info@polevaultweb.com',$subject,$message,$headers,$debug_file);
			$response = 'Debug file sent, thank you!';
					
		} else {
		
			$response = 'sending file. Debug mode must be on and a debug.txt file needs to have been created.';
		
		}
		
		return $response;
	}
	
	public function get_data() {
	
	
		global $current_user, $wpt_version;
		get_currentuserinfo();
	
		$data = array();
		
		
		$data['title'] = 'Install Data - '.IGP_PVW_PLUGIN_NAME;
		
		//WordPress
		$data['title-wp'] = 'WordPress Settings';
		
		$wpver = get_bloginfo('version');
		$data['Version'] = $wpver;
		$data['URL'] = home_url();
		$data['Install'] = get_bloginfo('wpurl');
		$data['Language'] = get_bloginfo('language');
		$data['Charset'] = get_bloginfo('charset');
		
		//PHP
		$data['title-php'] = 'PHP Settings';
		
		$data['PHP Version'] = phpversion();
		$data['Server Software'] = $_SERVER['SERVER_SOFTWARE'];
		$data['User Agent'] = $_SERVER['HTTP_USER_AGENT'];
		$data['cURL Init'] =  ( function_exists('curl_init') )?'On':'Off';
		$data['cURL Exec'] = ( function_exists('curl_exec') )?'On':'Off';
		
		//Sessions
		$data['title-sess'] = 'Session Settings';
		
		$_SESSION['enableSessionsTest'] = "On";
		$data['Session Support'] = !empty($_SESSION['enableSessionsTest']) ? "Enabled" : "Disabled";
		$data['Session name'] = ini_get('session.name');
		$data['Cookie path path'] =  ini_get('session.cookie_path');
		$data['Save path'] = ini_get('session.save_path'); 
		$data['Use cookies'] = (ini_get('session.use_cookies') ? 'On' : 'Off');
		$data['Use only cookies'] = (ini_get('session.use_only_cookies') ? 'On' : 'Off');
		
		//Theme
		$theme_data;
		if (function_exists('wp_get_theme')){
			$theme_data = wp_get_theme();
			$theme_uri = $theme_data->ThemeURI;
			$author_uri = $theme_data->Author_URI;
		} else {
			$theme_data = (object) get_theme_data(get_template_directory() . '/style.css');
			$theme_uri = $theme_data->URI;
			$author_uri = $theme_data->AuthorURI;
		}
		$theme_version = $theme_data->Version;
		$theme_name = $theme_data->Name;
		$description = $theme_data->Description;
		$author = $theme_data->Author;
		$theme_parent = $theme_data->Template;
			
		$data['title-theme'] = 'Theme Settings';

		$data['Theme Name'] = $theme_name;
		$data['URI'] = $theme_uri;
		$data['Theme Author'] = $author;
		$data['Author URI'] = $author_uri;
		$data['Parent'] = $theme_parent ;
		$data['Theme Version'] = $theme_version;
		
		//Plugins
		$data['title-plugins'] = 'Plugins Activated';
		
		$plugins = get_plugins();
		$plugins_string = '';
			foreach( array_keys($plugins) as $key ) {
				if ( is_plugin_active( $key ) ) {
					$plugin =& $plugins[$key];
					$plugin_name = $plugin['Name'];
					$plugin_uri = $plugin['PluginURI'];
					$plugin_version = $plugin['Version'];

					$data[$plugin_name] = 'v.'.$plugin_version.' - '. $plugin_uri;
				
				}
			}
		
		return $data;

	
	}





}

?>