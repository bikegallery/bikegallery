<?php

require_once(ABSPATH . "wp-admin" . '/includes/image.php');
require_once(ABSPATH . "wp-admin" . '/includes/file.php');
require_once(ABSPATH . "wp-admin" . '/includes/media.php');
//require emoji
require_once IGP_PVW_PLUGIN_PATH.'lib/functions/emoji.php';

class igp_functions {

	
	function get_image_src($string){
		
		preg_match( '/src="(.+?)"/',$string,$matches);
		return $matches[1]; 
	} 
	
	function strip_title($title) {
			
			
			$clean = '';
			
			$clean = filter_var($title, FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_LOW);
			
			$clean = igp_emoji_html_stripped($clean);
			$clean = trim($clean);
						
			
			return $clean;
			
	}
	
	function get_custom_string($customtext, $pos_text, $find_text, $default_pos = "start") {

		$find_text = '%%'.$find_text.'%%';
		
		if ($customtext == "") {
		
			$newtext = $pos_text;
		}
		else {
		
			if (strpos($customtext,$find_text) === false) {
			
				$newtext = $customtext;
			}
			else
			{
				$newtext = str_replace($find_text, $pos_text, $customtext);
			}
		
		}
		
		return $newtext;

	}
	
	
	function attach_image($url, $postid) {
		
		$tmp = download_url( $url );
		$file_array = array(
			'name' => basename( $url ),
			'tmp_name' => $tmp
		);
		
		// Check for download errors
		if ( is_wp_error( $tmp ) ) {
			@unlink( $file_array[ 'tmp_name' ] );
			return $tmp;
		}

		$id = media_handle_sideload( $file_array, $postid );
		// Check for handle sideload errors.
	 
		if ( is_wp_error( $id ) ) {
			@unlink( $file_array['tmp_name'] );
			return $id;
		} else {
			
			return $id;
			
		}
	}

	/* Remove the querystring from a URL */
	function strip_querysting($url) {

		if (strpos($url,'?') !== false) {
			$url = substr($url,0,strpos($url, '?'));
		}
		return $url;
		
	}
	
	/* Creates an HTML table from an array of data */
	function table_generator($data) {
	
		$html = '<table class="pvw_admin_table">';
	
		$head = 0;
		
		foreach ($data as $innerArray) {
			
			
			if (is_array($innerArray)){
				//  Scan through inner loop
				
				$html .= '<tr>';
				
				foreach ($innerArray as $value) {
					
					if ($head == 0) {
					
						$html .= '<th>'.$value.'</th>';
						
					
					} else {
					
						if (is_array($value)){
						
							$html .= '<td><ul>';
							
							foreach ($value as $li) {
							
								$html .= '<li>'.$li.'</li>';
				
							}
							
							$html .= '</ul></td>';
						
						}
						else {
					
							$html .= '<td>'.$value.'</td>';
						
						}
					}
					
				}
				$head ++;
				$html .= '</tr>';
				
			}
		
		}
		
		$html .= '</table>';
		
		return $html;
		
	}
	
	/* Output Custom CSS from theme options */
	function custom_header_css() {

			$shortname =  IGP_PVW_PLUGIN_SHORTCODE;	
			$saved_options = get_option('pvw_'.$shortname.'_options');
			
			$output = '';
			$css_option = $saved_options[$shortname.'_css_options'];
			$custom_css = $saved_options[$shortname.'_custom_css'];
			
			if ($css_option == 'custom') {
			
				if ($custom_css <> '') {
				$output .= $custom_css . "\n";
				}
				
				// Output styles
				if ($output <> '') {
					$output = "<!-- ".IGP_PVW_PLUGIN_NAME." Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
					echo $output;
				}
			
			} 

	}
	
	function curPageURL() {
		 
		 $pageURL = 'http';
		 if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		 $pageURL .= "://";
		 if ($_SERVER["SERVER_PORT"] != "80" && $_SERVER['HTTP_HOST'] != 'localhost:8888' ) {
		  $pageURL .= $_SERVER["HTTP_HOST"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		 } else {
		  $pageURL .= $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
		 }
		 return strtolower ($pageURL);
	
	}
		
	 function adminOptionsURL($url) {
			 
			 $pageURL = substr($url,0, strrpos($url, "/wp-content"));
			 
		
			 return $pageURL.'/wp-admin/options-general.php?page=instagratepro';
	}
			
	 function pluginsURL() {
			 
			 $pageURL = 'http';
			 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
			 $pageURL .= "://";
			 if ($_SERVER["SERVER_PORT"] != "80") {
			  $pageURL .= $_SERVER["HTTP_HOST"].":".$_SERVER["SERVER_PORT"];
			 } else {
			  $pageURL .= $_SERVER["HTTP_HOST"];
			 }
			 return $pageURL.'/wp-admin/plugins.php';
	
	}
			
	function truncateString($str, $max, $rep = '...') {
	  
	  if(strlen($str) > $max) {
		$leave = $max - strlen($rep);
		return substr_replace($str, $rep, $leave);
	  } else {
		return $str;
	  }
	  
	}
	
	/* Strip hashtags and return title and tag array */
	function strip_hashtags($title,$default_title) {
		
		$pattern = '/(?<!&)#(\\w+)/';
		
		$matches = array();
		
		preg_match_all($pattern,$title, $matches);
		
		$tags = array();
		
		$clean_tags = array();
		
		foreach ($matches[1] as $key => $value) {
			
			$tags[$key] = str_replace('#', '', $value);
		
		}
		$clean_tags[0] = $tags;
		
		$clean_title = preg_replace($pattern, '', $title);			
		$clean_tags[1] = rtrim($clean_title);

		if ($clean_tags[1] == ''){
		
			$clean_tags[1] = $default_title;
		}
		
		return $clean_tags;		

	}
	
	function clean_hastag($tag) {
	
		$hashtag = '';
		
		$hashtag = str_replace('#', '', $tag);
		
		$posSP = strrpos($hashtag, " ");
		
		if ( $posSP !== false) {
		
			$hashtag = substr($hashtag,0,$posSP);
			return $hashtag;
		
		}
		
		$posSP = strrpos($hashtag, ",");
		
		if ( $posSP !== false) {
		
			$hashtag = substr($hashtag,0,$posSP);
			return $hashtag;
		
		}
		
		return  $hashtag;
		
	
	}
	
	function instagrate_id_exists($instagrate_id, $type = 'account') {
		
		global $wpdb;
	
		$result = false;
		
		$meta_key = 'instagrate_id';
		if ($type == 'image') {
			
			$meta_key = 'instagrate_image_id';
		
		} 
		
		$meta_value = $instagrate_id;
		
		$count = 0;
		
		$count = $wpdb->get_var($wpdb->prepare( "SELECT count(*) FROM $wpdb->postmeta WHERE meta_key = %s AND meta_value like %s ", $meta_key, '%'.$meta_value.'%' ));
		
		
		if ($count > 0) { $result = true; }
		
		return $result;
	
	
	}
	
	function page_has_maps($posts) {
		
		
		$result = false;
	
		
		if (isset($posts) && is_array($posts)) {
			
			
			foreach ($posts as $post) {
			
				$post_id = $post->ID;
				
				if (get_post_meta($post_id, 'igp_latlon')) {
				
					$result = true;
					break;
					
				}
				
				
			}
			
		}
		
		return $result;
		
	}
	
	

}

?>