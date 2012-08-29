<?php

require_once IGP_PVW_PLUGIN_PATH.'lib/api/instagram.php';

require_once IGP_PVW_PLUGIN_PATH.'lib/admin/account-options.php';
require_once IGP_PVW_PLUGIN_PATH.'lib/admin/admin-options.php';
require_once IGP_PVW_PLUGIN_PATH.'lib/admin/debug/debug.php';

if (!class_exists('igp_pvw_plugin_framework')) {

class igp_pvw_plugin_framework {

	
	/* Set up options from template */
	function pvw_options_setup(){

		igp_general_options::template_init();
		
		$accounts = igp_account_options::get_accounts();
		
		$options = igp_general_options::get_options();
		
		$updated_options = array();
		
		//Account Options
		if ($accounts !== false && isset($accounts)) {
		
			foreach ($accounts as $key => $account) {
			
				if (isset($account['id'])) {
				
					$username = $account['username'];
					$userid = $account['userid'];
					$id = $account['id'];
					
					igp_account_options::update_account($id,$userid,$username);
					
				
				}
			}
		}
		
		$template = igp_general_options::get_template();
		
		//General Options	
		foreach($template as $option) {
			
			$saved_option = null;
			
			if(isset($option['input']) && $option['input'] == 'true'){
			
				$id = $option['id'];
				
				if (isset($option['std'])) {
					
					$std = $option['std'];
				}

				if (isset($options[$id])) {
				
					$saved_option = $options[$id];
				
				}
				
				if(empty($saved_option)) {
				
					$updated_options[$id] = $std;
				
				} else {
				
					$updated_options[$id] = $saved_option;
				
				}
			
			}
		}
		
		//update options
		igp_general_options::save_options($updated_options);
		
	}
	
	/* Reset saved options to template */
	function pvw_options_reset() {
		
		$delete = delete_option('pvw_'.IGP_PVW_PLUGIN_SHORTCODE.'_options');
		self::pvw_options_setup();
		
	}
	
	
	/* Duplicate Accounts */
	function pvw_igp_options_account_duplicate($accountid){
	
		$id = substr($accountid,0, strrpos ( $accountid , "_" ));
		$userid =  substr($accountid,strrpos ( $accountid , "_" )+1,strlen($accountid)-strrpos ( $accountid , "_" ));
		
		igp_account_options::duplicate_account($id);
		
		self::pvw_options_setup();		
	
	}
	
	/* Delete accounts from template and options */
	function pvw_igp_options_account_delete($accountid){

	
		$id = substr($accountid,0, strrpos ( $accountid , "_" ));
		$userid =  substr($accountid,strrpos ( $accountid , "_" )+1,strlen($accountid)-strrpos ( $accountid , "_" ));
		
	
		$shortname = IGP_PVW_PLUGIN_SHORTCODE;
		$tag = $shortname.'_'.$accountid;
		 
		
		// Accounts option
		$accounts = igp_account_options::get_accounts();
		
		if (isset($accounts)) {
			
			foreach ($accounts as $key => $account) {
			
				if($account['id'] == $id && $account['userid'] == $userid){
					   unset($accounts[$key]);
				  }
			
			}
			
			//Update new accounts
			igp_account_options::save_accounts($accounts);
				
		}
		
		// Templates option
		$templates = igp_general_options::get_template();
		
		foreach ($templates as $key => $template) {
		
			if(isset($template['account']) && $template['account'] == $tag){
				
				unset($templates[$key]);
				  
			}
		
		}
		
		//Update template
		igp_general_options::save_template($templates);
				
		// Saved options
		$options = igp_general_options::get_options();
		
		$tag_len = strlen($tag);
		
		foreach ($options as  $key => $option) {
		
			if(substr($key,0,$tag_len) == $tag){
				   unset($options[$key]);
				  
			  }
		
		}
				
		//Update options
		igp_general_options::save_options($options);
		
	}
	
	
	function pvw_delete_account_btn($accountid, $username) {
			
		$html = '';

		$html .=		'<div style="float: right; margin: -5px 0;" >';
		$html .=		'<input name="pvw_delete" id="'.$accountid.'" data-username="'.$username.'" type="button" value="'.__('Remove', IGP_PVW_PLUGIN_LINK).'" class="button submit-button" />';
		$html .=		'</div>'; 
		
		
		return $html;
	
	}
	
	function pvw_repair_account_btn($id) {
			
		$html = '';
		
			
		$instagram = new igp_Instagram(IGP_CLIENT_ID, IGP_CLIENT_SECRET, null);
		$loginUrl = $instagram->authorizeUrl(IGP_REDIRECT_URI.'?return_uri='.htmlentities(IGP_PVW_RETURN_URI.'-update='.$id));
		
		$html .= '<div style="float: right; " >';		
		$html .= '<a href="'.$loginUrl.'" class="button">Repair</a>';
		$html .= '</div>';
		
		return $html;
	
	}
	
	function pvw_duplicate_account_btn($accountid, $username) {
			
		$html = '';
		$html .=		'<div style="float: right; margin: -5px 0;" >';
		$html .=		'<input name="pvw_duplicate" id="'.$accountid.'" data-username="'.$username.'" type="button" value="'.__('Duplicate', IGP_PVW_PLUGIN_LINK).'" class="button submit-button" />';
		$html .=		'</div>'; 
		
		return $html;
	
	}
	
	/* Reset settings callback function */
	public static function reset_settings_callback() {

		self::pvw_options_reset();
		$html = '';
		
		$template = igp_general_options::get_template();
		$return = self::pvw_plugin_options_generator($template);
																						
		$html .=  $return[0];
		
		echo $html;
		die();

	}
	
	/* Delete account callback function */
	public static function delete_account_callback() {

		if (isset($_POST['id'])) {
		
			self::pvw_igp_options_account_delete($_POST['id']);
			$html = '';
			
			$template = igp_general_options::get_template();
			$return = self::pvw_plugin_options_generator($template);
			
			$html .= '<div id="pvw-nav">';
			$html .= '						<ul>';
			$html .=  $return[1];
			$html .= '						</ul>';
			$html .= '					</div>';
			$html .= '					<div id="content"> ';
			$html .=  $return[0]; 
			$html .= '</div>';
			$html .= '<div class="clear"></div>';
																							
			echo $html;
			die();
		
		} else {
		
			die(0);
		}
	
	}
	
	/* Duplicate account callback function */
	public static function duplicate_account_callback() {

		if (isset($_POST['id'])) {
		
			self::pvw_igp_options_account_duplicate($_POST['id']);
			$html = '';
			
			$template = igp_general_options::get_template();
			$return = self::pvw_plugin_options_generator($template);
			
			$html .= '<div id="pvw-nav">';
			$html .= '						<ul>';
			$html .=  $return[1];
			$html .= '						</ul>';
			$html .= '					</div>';
			$html .= '					<div id="content"> ';
			$html .=  $return[0]; 
			$html .= '</div>';
			$html .= '<div class="clear"></div>';
																							
							
			echo $html;
			die();
		
		} else {
		
			die(0);
		}
	
	}
	
	/* Send Install data */
	public static function send_install_data_callback() {
	
		igp_debug::send_install_data();
		echo 0;
		die();
	
	}
	
	/* Send Debug file */
	public static function send_debug_data_callback() {
	
		$response = igp_debug::send_debug_data();
		echo $response;
		die();
	
	}
	
	
	
	function pvw_get_accounts() {
	
		
		//$html = '<form action="#" method="post" id="nested-form-bug"></form>';
		$html = '';
		
		$accounts = igp_account_options::get_accounts();
	
		
		$count = 0;
		$issues = 0;
				
		if ($accounts) {
				
			foreach ($accounts as $key => $account) {
			
				if (isset($account['id'])) {
					
					
					$id = $account['id'];
					$count ++;
					$access = $account['access'];
					$userid = $account['userid'];
					$username = $account['username'];
		
					$accountid = $id.'_'.$userid;
					
					$instagram = new igp_Instagram(IGP_CLIENT_ID, IGP_CLIENT_SECRET, $access);
					
					try {
									
						$feed = $instagram->get('users/'.$userid.'/media/recent');
						
						if($feed->meta->code == 200) {
						
							$msg = '';
							$msg_class = 'pvw_connected';
							$link = '</p>'.self::pvw_duplicate_account_btn($accountid,$username).self::pvw_delete_account_btn($accountid,$username).'</div>';
						
						} else {
						
							$msg = ' - '.$feed->meta->error_message;
							$msg_class = 'pvw_connected';
							$link = '</p>'.self::pvw_delete_account_btn($accountid,$username).'</div>';
													
							
		
						
						}
						
					} catch(igp_InstagramApiError $e) {
							
						
						if ($e->getMessage() == 'Error: Instagram API Servers Down') {
							
							$msg = ' - '.$e->getMessage(); 
							$msg_class = 'pvw_disconnected';
							$link = '</p>'.self::pvw_duplicate_account_btn($accountid,$username).self::pvw_delete_account_btn($accountid,$username).'</div>';
						
						} else {
						
							$issues	++;		
							$msg = ' - '.$e->getMessage(); //- The Instagram Authorisation token has expired';
							$link = '</p>';
							$link .= self::pvw_repair_account_btn($id);
							$link .= self::pvw_delete_account_btn($accountid,$username);
							$msg_class = 'pvw_disconnected';
							$link .= '</div>';
							
						}
					
							
					}
					
					$html .= '<div class="'.$msg_class.'"><p>'.$id.': '.$username.$msg.$link;
					$html .= '<div class="clear"></div>';
			
				}
			
			}
		}
		 
		if ($count == 0) {
		
			$html = '<div class="notes"><p>You have no Instagram accounts configured</p></div>';
		
		} else {
		
			$s = '';
			if($count > 1) {
				$s = 's';
			}
			
			$issue_text = '';
			$alert_class = 'info';
			if ($issues > 0) {
			
				$have = 'has';
				if($issues > 1) {
					$have = 'have';
				}
				$issue_text = '<b> '.$issues.' of those '.$have.' issues that need to be resolved.</b>';
				$alert_class = 'notes';
			} 
			$html = '<div class="'.$alert_class.'"><p>You have '.$count.' Instagram account'.$s.' configured.'.$issue_text.'</p></div>'.$html;
		}
		
		return $html;
	
	
	}
	

	
	function settings_header() {
	
		//add Instagram authentication scripts
		if (isset($_GET['error']) || isset($_GET['code']) )  {
		
			$ig = new igp_Instagram(IGP_CLIENT_ID, IGP_CLIENT_SECRET, null);
			
			if(isset($_GET['error']) || isset($_GET['error_reason']) || isset($_GET['error_description'])){
				
				// Throw error message... the user might have pressed Deny.	
				//Put error up
				echo '<div class="error"><p><b>Instagram Login Error</b> - '.$_GET['error_description'].' </p></div>';
								
			}
			else
			{
				
				$url = IGP_PVW_RETURN_URI;
				
				if (isset($_GET['update'])) {
				
					$update = $_GET['update'];
					$url .= '-update='.$update;
				
				}
				
				 $url;
				
				$access_token = $ig->getAccessToken($_GET['code'],  IGP_REDIRECT_URI.'?return_uri='.$url); 
			
				$accesstkn = $access_token->access_token;
				$username = $access_token->user->username;
				$userid = $access_token->user->id;
				
				
				$instagram = new igp_Instagram(IGP_CLIENT_ID, IGP_CLIENT_SECRET, $accesstkn);
				
				if (isset($update) ){
				
					//update account details
					igp_account_options::repair_account($update,$userid,$username,$accesstkn);
				
				
				} else {
				
					//add account details
					igp_account_options::add_account($userid,$username,$accesstkn );

				}
				
				header("Location: ".IGP_PVW_RETURN_URI);
			

			}

		} 
	
	}
	
	function pvw_plugin_get_saved_option($saved_options,$option) {

		$return_value = "";
		
		if (isset($saved_options[$option])) {
		
			$return_value =  $saved_options[$option];
		
		}
			
		
		return $return_value;

	}

	function pvw_plugin_options_generator($options) {
			
		$shortname =  IGP_PVW_PLUGIN_SHORTCODE;	
		
		$prename = 'pvw_'.$shortname.'_options';
		
		$saved_options = igp_general_options::get_options();
		
		$counter = 0;
		$button_count = 0;
		$menu = '';
		$output = null;
		$buttons = '';
		
		$ttcount = 1;
		
		foreach ($options as $value) {
		
						
			if (isset($value['id'])) {
			
				$name = $prename.'['.$value['id'].']';
			}
				   
			$counter++;
			$val = '';
							
			//Start Heading
			 if ( $value['type'] != "heading"  )
			 {
				$class = ''; if(isset( $value['class'] )) { $class = $value['class']; }
				
				$h3 = '';
				if (isset($value['name'])) {
					$h3 = $value['name'];
				}
				
				$output .= '<div class="section section-'.$value['type'].' '. $class .'">'."\n";
				if ($h3 != '') {
				
					$output .= '<h3 class="heading">'. $h3 .'</h3>';
					
					if (isset($value['tooltip']) && $value['tooltip'] != '') {
						
						$output .= '<div class="tooltip">';
						
						
						$output .= '<a href="#tt'.$ttcount.'" title="Click for more info"><img src="'.IGP_PVW_PLUGIN_URL.'lib/admin/images/help.png" alt="info icon" /></a>';
							
						if ($ttcount == 1 ){
						
							
						
						}
						$output .= '<div id="tt'.$ttcount.'" class="answer">';
						$output .= '<a class="tt-close" href="#'.$ttcount.'">X</a>';
						$output .= '<p>'.$value['tooltip'].'</p>';
						$output .= '</div>';
						$output .= '</div>';
						$ttcount ++;
										
					}
					
					$output .= "\n";
					
				
				}
				
				if (isset($value['note'])) {
					$note= $value['note'];
				
					if ($note != '') {
						$output .= '<div class="notes"><p>'.$note.'</p></div><br/>'."\n";
					}
				}
				
				$output .= '<div class="option">'."\n" . '<div class="controls">'."\n";

			 } 
			 
			//End Heading
			
			$select_value = ''; 

			switch ( $value['type'] ) {
				
			case 'text':
				
				if (isset($value['std'])){
					$val = $value['std'];
				}
				
				$class ='';
				
				if ( isset($value['class']) ) {
					
					$class = '-'.$value['class'];
					
				}
				
				$std = self::pvw_plugin_get_saved_option($saved_options, $value['id']);
				if ( $std != "") { $val = $std; }
				$output .= '<input class="pvw-input'.$class.'" name="'. $name .'" id="'. $value['id'] .'" type="'. $value['type'] .'" value="'. stripslashes($val) .'" />';
			break;
			
			case 'select':
			
				$class ='';
				
				if ( isset($value['class']) ) {
					
					$class = '-'.$value['class'];
					
				}

				$output .= '<select class="pvw-input'.$class.'" name="'. $name .'" id="'. $value['id'] .'">';
			
				$select_value = self::pvw_plugin_get_saved_option($saved_options, $value['id']);
				 
				foreach ($value['options'] as $key=>$option) {
					
					$selected = '';
					
					 if($select_value != '') {
						 if ( $select_value == $key) { $selected = ' selected="selected"';} 
					 } else {
						 if ( isset($value['std']) )
							 if ($value['std'] == $option) { $selected = ' selected="selected"'; }
					 }
					  
					 $output .= '<option'. $selected .' value="'.$key.'" >';
					 $output .= $option;
					 $output .= '</option>';
				 
				 } 
				 $output .= '</select>';

				
			break;
			
			// Get schedules
			case 'select-schedule':
			
				$output .= '<select class="pvw-input" name="'. $name .'" id="'. $value['id'] .'">';
			
				$select_value = self::pvw_plugin_get_saved_option($saved_options, $value['id']);
				
				$schedules = wp_get_schedules();
				
				
				//order array by earliest second interval
				foreach ($schedules as $key => $row) {
					$orderByInterval[$key]  = $row['interval'];
				}

				array_multisort($orderByInterval, SORT_ASC, $schedules);

				foreach ($schedules as $key=>$option) {
					
					$selected = '';
					
					 if($select_value != '') {
						 if ( $select_value == $key) { $selected = ' selected="selected"';} 
					 } else {
						 if ( isset($value['std']) )
							 if ($value['std'] == $option) { $selected = ' selected="selected"'; }
					 }
					  
					 $output .= '<option'. $selected .' value="'.$key.'" >';
					 $output .= $option['display'];
					 $output .= '</option>';
				 
				 } 
				 $output .= '</select>';
				 
			break;
			
			// Get users
			case 'select-user':
			
				$val = $value['std'];
				$std = self::pvw_plugin_get_saved_option($saved_options, $value['id']);
				if ( $std != "") { $val = $std; }
				
				
				$args = array( 	'selected'                => $val,
								'include_selected'        => true,
								'name'                    => $name,
								'class'              	  => 'pvw-input',
								'echo'               => 0
								
								); 
			
				 
				$output .=  wp_dropdown_users($args);
				
			break;
			
			// Get categories
			case 'select-cat':
				
				$val = $value['std'];
				$std = self::pvw_plugin_get_saved_option($saved_options, $value['id']);
				if ( $std != "") { $val = $std; }
				
				$args = array(
					
					'hide_empty'         => 0, 
					'echo'               => 0,
					'selected'           => $val,
					'hierarchical'       => 0, 
					'name'               => $name,
					'class'              => 'pvw-input',
					'depth'              => 0,
					'tab_index'          => 0,
					'taxonomy'           => 'category',
					'hide_if_empty'      => false ,
					'id'				 => $value['id'] 
				);
		
				 $output .= wp_dropdown_categories( $args );
				
				
			break;
		
			
			// Get post formats
			
			case 'select-format':

				$output .= '<select class="pvw-input" name="'. $name .'" id="'. $value['id'] .'">';
			
				if ( current_theme_supports( 'post-formats' ) ) {
					
					$post_formats = get_theme_support( 'post-formats' );
					if ( is_array( $post_formats[0] ) ) {
				
						$output .= '<option value="Standard">Standard</option>';
						$select_value = self::pvw_plugin_get_saved_option($saved_options, $value['id']);
						 
						foreach ($post_formats[0] as $option) {
							
							$selected = '';
							
							 if($select_value != '') {
								 if ( $select_value == $option) { $selected = ' selected="selected"';} 
							 } else {
								 if ( isset($value['std']) )
									 if ($value['std'] == $option) { $selected = ' selected="selected"'; }
							 }
							  
							 $output .= '<option'. $selected .'>';
							 $output .= $option;
							 $output .= '</option>';
						 
						 } 
						 
					
					}
					
					else
					{
					
						$output .= '<option>';
						$output .= 'Standard';
						$output .= '</option>';
				
					}
				 
				}
				else
				{
					
					$output .= '<option>';
					$output .= 'Standard';
					$output .= '</option>';
				
				}
				
				$output .= '</select>';

				
			break;
			
			// Get post types
			
			case 'select-type':
				
				$output .= '<select class="pvw-input" name="'. $name .'" id="'. $value['id'] .'">';

					// prepare post type filter
					$args = array (		'public'  => true,
										'show_ui' => true
					);
					$posttypes  = get_post_types( $args, 'objects' );
					
					$select_value = self::pvw_plugin_get_saved_option($saved_options, $value['id']);
					
					foreach ( $posttypes as $pt ) :

						$selected = '';
	
						if($select_value != '') {
							if ( $select_value ==  esc_attr( $pt->name )) { $selected = ' selected="selected"';} 
						} 
						
						$output .= '<option value="' . esc_attr( $pt->name ) . '"' . $selected . '>';
						$output .= $pt->labels->singular_name;
						$output .= '</option>';
					endforeach;

				$output .= '</select>'; 
				
			break;		 
			
			// Get pages
			case 'select-page':
				
				$val = $value['std'];
				$std = self::pvw_plugin_get_saved_option($saved_options, $value['id']);
				if ( $std != "") { $val = $std; }
				
				$args = array(
					'selected'         => $val,
					'echo'             => 0,
					'name'             => $name
				);
		
				$output .= wp_dropdown_pages( $args );

				
			break;
			
			// Get last Image dropdown from Instagram
			case 'select-last-image':
			
				
				$output .= '<select class="pvw-input" name="'. $name .'" id="'. $value['id'] .'">';
			
				$tag = $value['account'];
				$id = substr($tag,4,strpos($tag,'_',5)-4);
				
				$instagram_options = self::pvw_plugin_get_saved_option($saved_options, $tag."_instagram_options");
				if ($instagram_options == '') { $instagram_options = 'all'; }
				
				$saved_hashtag = self::pvw_plugin_get_saved_option($saved_options, $tag."_hashtag"); 
				
				$lastid = array();
				
				$lastid[0] = self::pvw_plugin_get_saved_option($saved_options, $value['id']);
				
				$images = igp_instagrate::get_recent_images($id, $instagram_options, $saved_hashtag);
				
				if (isset($lastid) && $lastid[0] != 0) {
					
					if ($instagram_options == 'hashtag') {
					
						$output .= '<option value="'.$lastid[0].'" >';
						$output .= 'Cannot set for hashtag posting';
						$output .= '</option>';
					
					} else {
					
						if (isset($images) && is_array($images)) {
						
							if( !igp_instagrate::check_media_exists($id, $lastid[0])) {
					
								$last_id = igp_instagrate::get_last_id($id,$instagram_options,null);
								$lastid[0] = $last_id[0];
					
							}
							
							$imgCount = 0;
						
							foreach ($images as $key => $image) {
								$imgCount ++;
								$keyvalue = $key;
								
								if ($key == $lastid[0]) {$selected = 'selected="selected"';} else {$selected = '';}
								
								$output .= '<option value="'.$keyvalue.'" '.$selected.'>';
								$output .= $image;
								$output .= '</option>';
								
							}
						
						}
					
						
						if (!array_key_exists($lastid[0],$images)) {
						
							if ($instagram_options != 'hashtag') {
							
								$output .= '<option value="' . $lastid[0] . '" selected="selected">';
								$output .= igp_instagrate::get_img_title($id,$lastid[0]);
								$output .= '</option>';
							
							}
						
						}
					}
					
					
				} else {
					
					
					$imgCount = 0;
				
					if ($instagram_options == 'hashtag') { 
					
						$output .= '<option value="0" >';
						$output .= 'Cannot set for hashtag posting';
						$output .= '</option>';
					
					} else {
					
						if (isset($images) && is_array($images)) {
						
							foreach ($images as $key => $image) {
								$imgCount ++;
								
								$keyvalue = $key;
								if ($instagram_options == 'hashtag') { $keyvalue = 0;}
								
								if ($imgCount == 1) {$selected = 'selected="selected"';} else {$selected = '';}
								$output .= '<option value="'.$keyvalue.'" '.$selected.'>';
								$output .= $image;
								$output .= '</option>';
								
							}
						}
					
					}
					
				}
		
	
				$output .= '</select>'; 
			
			break;
			
			// Get taxonomies
			case 'select-tax':
				
				$val = $value['std'];
				$std = self::pvw_plugin_get_saved_option($saved_options, $value['id']);
				if ( $std != "") { $val = $std; }
				
				$args = array(
					'show_option_all'    => __('All '.$value['taxonomy'], 'pvw_framework'),
					'show_option_none'   => __('No '.$value['taxonomy'], 'pvw_framework'),
					'hide_empty'         => 0, 
					'echo'               => 0,
					'selected'           => $val,
					'hierarchical'       => 0, 
					'name'               => $name,
					'class'              => 'postform',
					'depth'              => 0,
					'tab_index'          => 0,
					'taxonomy'           => $value['taxonomy'],
					'hide_if_empty'      => false 	
				);
		
				$output .= wp_dropdown_categories( $args );

				
			break;
			//-------
			
			case 'select2':

				$output .= '<select class="pvw-input" name="'. $name .'" id="'. $value['id'] .'">';
			
				$select_value = self::pvw_plugin_get_saved_option($saved_options, $value['id']);
				 
				foreach ($value['options'] as $option => $name) {
					
					$selected = '';
					
					 if($select_value != '') {
						 if ( $select_value == $option) { $selected = ' selected="selected"';} 
					 } else {
						 if ( isset($value['std']) )
							 if ($value['std'] == $option) { $selected = ' selected="selected"'; }
					 }
					  
					 $output .= '<option'. $selected .' value="'.$option.'">';
					 $output .= $name;
					 $output .= '</option>';
				 
				 } 
				 $output .= '</select>';

				
			break;
			case 'textarea':
				
				$cols = '8';
				$rows = '8';
				$ta_value = '';
				
				if(isset($value['std'])) {
					
					$ta_value = $value['std']; 
					
					if(isset($value['options'])){
						$ta_options = $value['options'];
						if(isset($ta_options['cols'])){
						$cols = $ta_options['cols'];
						}
						if(isset($ta_options['rows'])){
						$rows = $ta_options['rows'];
						}
					}
					
				}
					$std = self::pvw_plugin_get_saved_option($saved_options, $value['id']);
					if( $std != "") { $ta_value = stripslashes( $std ); }
					$output .= '<textarea class="pvw-input" name="'. $name .'" id="'. $value['id'] .'" cols="'. $cols .'" rows="'.$rows.'">'.$ta_value.'</textarea>';
				
				
			break;
			case "radio":
				
				 $select_value = self::pvw_plugin_get_saved_option($saved_options,  $value['id']);
				 
				  				 
				 foreach ($value['options'] as $key => $option) 
				 { 

					$checked = '';
					   if($select_value != '') {
							if ( $select_value == $key) { $checked = 'checked="checked"'; } 
					   } else {
						if ($value['std'] == $key) { $checked = 'checked="checked"'; }
						}
					$output .= '<input class="pvw-input pvw-radio" type="radio" name="'. $name .'" value="'. $key .'" '. $checked .' />' . $option .'<br />';
				
				}
				 
			break;
			case "checkbox": 
			
				$std = $value['std'];
				$saved_std = self::pvw_plugin_get_saved_option($saved_options, $value['id']);
				$checked = '';
			
				
				
				if(isset($saved_std)) {
					
					
					if($saved_std == "true") {
					$checked = 'checked="checked"';
					}
					else{
					   $checked = '';
					}
				}
				else {
				
				
					if( $std == "true") {
					   $checked = 'checked="checked"';
					}
					else {
						$checked = '';
					}
				}
				
				$output .= '<input type="checkbox" class="checkbox pvw-input" name="'.  $name .'" id="'. $value['id'] .'" value="true" '. $checked .' />';
			

			break;
			case "multicheck":
			
				$std =  $value['std'];         
				
				foreach ($value['options'] as $key => $option) {
												 
				$tz_key = $value['id'] . '_' . $key;
				$saved_std = self::pvw_plugin_get_saved_option($saved_options, $tz_key);
						
				if(!empty($saved_std)) 
				{ 
					  if($saved_std == 'true'){
						 $checked = 'checked="checked"';  
					  } 
					  else{
						  $checked = '';     
					  }    
				} 
				elseif( $std == $key) {
				   $checked = 'checked="checked"';
				}
				else {
					$checked = '';                                                                                    }
				$output .= '<input type="checkbox" class="checkbox pvw-input" name="'. $tz_key .'" id="'. $tz_key .'" value="true" '. $checked .' /><label for="'. $tz_key .'">'. $option .'</label><br />';
											
				}
			break;
			
			case "button":
			
				$button_count++;
				
				$text =  $value['text'];  
				$action = str_replace( '%7E', '~', $_SERVER['REQUEST_URI']);
				
				$output .= '<input type="button" class="button" value="'.$text.'" name="button_'.$value['id'].'"  >';
			
				$buttons .= ' if(isset($_GET["button_'.$value['id'].'"]) && $_GET["button_'.$value['id'].'"] == \'true\' )';
				
				if (isset($value['std']) && ($value['std'] != 'debug' || $value['std'] != 'debug_file')) {
				
										
					$buttons .= '{ '.IGP_PVW_PLUGIN_CLASS.'::'.$value['method'].'();';
				
				}
				
				if (isset($value['std']) && ($value['std'] != 'debug' || $value['std'] != 'debug_file')) {
				
							
					$buttons .= ' echo \'<div class="updated"><p><strong>'.$value['message'].'</strong></p></div>\'; } ';	
				
				}
		
			break;
			
			case "debug":
			
				$output .= '<div class="info"><p>'. igp_debug::get_install_data('html').'</p></div>';
				
				
			break;
			
					
			case "note":
			
				$output .= '<div class="notes"><p>'. $value['message'] .'</p></div>';
				
				
			break;
			
			case "donation":
			
				
			
				if ($button_count == 1)	{$output .= '<form action="#" method="post" id="nested-form-bug"></form>'; }
				
				$donate_msg = '';
				if(isset($value['message'])) {$donate_msg = $value['message']; }
				
				$output .=  $donate_msg;
				$output .=  '<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
							<input type="hidden" name="cmd" value="_s-xclick">
							<input type="hidden" name="hosted_button_id" value="R6BY3QARRQP2Q">
							<input type="image" src="https://www.paypalobjects.com/en_US/GB/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal — The safer, easier way to pay online.">
							<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
							</form>
							' ;
				
				
			break;
			
			case "instagram_login":
				
				
				$check = array();
				$check = igp_instagrate::apiCheck();
		
				if ($check[0] == 1) {
									
					$instagram = new igp_Instagram(IGP_CLIENT_ID, IGP_CLIENT_SECRET, null);
					$loginUrl = $instagram->authorizeUrl(IGP_REDIRECT_URI.'?return_uri='.htmlentities(IGP_PVW_RETURN_URI));
				
					$output .= '<a href="'.$loginUrl.'" class="button-primary">'.$value['text'].'</a>';
				
				} else {
					
					$output .= '<a href="#" class="button-primary">Add Unavailable</a>';
					
				}
				
			
			break;
			
			case "accounts":
			
				$output .= '<div id="accounts" class="accounts">'.self::pvw_get_accounts().'</div>';
			
			
			break;
			
			case "intro":
			
			$msg = '';
			if(isset($value['message'])) {
			
				$msg = $value['message'];
			}
			
				$output .= '<div class="intro"><p>'.$msg.'</p></div>';
				
				
			break;
						
			case "info":
				$output .= '<div class="info"><p>'. $value['message'] .'</p></div>';
			break;  

			case "subheading":
				
				//$output .= '<h3>'.$value['name'].'</h3>'."\n";
				
			break; 
			
			case "heading":
				
				if($counter >= 2){
				   $output .= '</div>'."\n";
				}
				$jquery_click_hook = ereg_replace("[^A-Za-z0-9]", "", strtolower($value['name']) );
				$jquery_click_hook = "pvw-option-" . $jquery_click_hook;
				$menu .= '<li><a title="'.  $value['name'] .'" href="#'.  $jquery_click_hook  .'">'.  $value['name'] .'</a></li>';
				$output .= '<div class="group" id="'. $jquery_click_hook  .'"><h2>'.$value['name'].'</h2>'."\n";
			break; 
			
			} 
			
			// if TYPE is an array, formatted into smaller inputs... ie smaller values
			if ( is_array($value['type'])) {
				foreach($value['type'] as $array){
				
						$id = $array['id']; 
						$std = $array['std'];
						$saved_std = self::pvw_plugin_get_saved_option($saved_options, $id);
						if($saved_std != $std){$std = $saved_std;} 
						$meta = $array['meta'];
						
						if($array['type'] == 'text') { // Only text at this point
							 
							 $output .= '<input class="input-text-small pvw-input" name="'. $id .'" id="'. $id .'" type="text" value="'. $std .'" />';  
							 $output .= '<span class="meta-two">'.$meta.'</span>';
						}
					}
			}
			if ( $value['type'] != "heading" ) { 
				if ( $value['type'] != "checkbox" ) 
					{ 
					$output .= '<br/>';
					}
				if(!isset($value['desc'])){ $explain_value = ''; } else{ $explain_value = $value['desc']; } 
				$output .= '</div>';
				if ($explain_value  != '' ) {				
				$output .= '<div class="explain">'. $explain_value .'</div>'."\n";
				}
				$output .= '<div class="clear"> </div></div></div>'."\n";
				
				
				}
				
		}	
		$output .= '</div>';
		
		//$buttons .= ' else { }';
		
		return array($output,$menu,$buttons);

	}


	function pvw_plugin_settings() {
		
		
		$template = igp_general_options::get_template();
		
		$return = self::pvw_plugin_options_generator($template);

		eval($return[2]);
		
		?>
			<div id="pvw_settings" class="wrap">	
				<!-- BEGIN Wrap -->
				<div class="wrap" id="pvw_container">
				
					<iframe id="logoutframe" src="https://instagram.com/accounts/logout/" width="0" height="0"></iframe>
					
					<form method="post" action="options.php">
						<fieldset>
							<div id="header">
								<div>
									<h2 class="logo"><?php echo IGP_PVW_PLUGIN_NAME; ?> <span> v<?php echo IGP_PVW_PLUGIN_VERSION; ?></span></h2>
								</div>
								<div class="clear"></div>
								<div id="pvw-messages">
									
								</div>
								
													
							</div>
							
							<?php 	
								settings_fields('pvw_'.IGP_PVW_PLUGIN_SHORTCODE.'_plugin_options');
									
							?>
					
							<div id="main">
								<div id="pvw-nav">
									<ul>
									<?php echo $return[1] ?>
									</ul>
								</div>
								<div id="content"> 
																								
								<?php 
															
								echo $return[0]; /* Settings */ 
								
								?> 
								
								</div>
								<div class="clear"></div>
							</div>
							<div class="save_bar_top">
							
								<input name="pvw_save" type="submit" class="button-primary" value="<?php _e('Save Changes', IGP_PVW_PLUGIN_LINK) ?>" />
							
								<div style="display:inline">
									<span class="submit-footer-reset">
											<input name="pvw_reset" type="button" value="<?php _e('Reset Options', IGP_PVW_PLUGIN_LINK) ?>" class="button submit-button reset-button" />
									</span>
								</div>
								
							</div>						
						</fieldset>
					</form>
								
						
		
				<!-- END Wrap -->			
				</div>
				<div class="clear"></div>
				<!-- BEGIN Footer -->
				<div id="pvw_footer">
					
					<div id="links">
						<b><?php echo IGP_PVW_PLUGIN_NAME; ?> v<?php echo IGP_PVW_PLUGIN_VERSION; ?></b> | <?php _e('We hope you enjoy using the plugin ', IGP_PVW_PLUGIN_LINK); ?>
						<br/>
						<a target="_blank" href="http://www.polevaultweb.com/support/forum/<?php echo  IGP_PVW_PLUGIN_LINK; ?>-plugin/" title="<?php _e('Visit the support forum for', IGP_PVW_PLUGIN_LINK) ?> <?php echo IGP_PVW_PLUGIN_NAME; ?>"><?php _e('Support Forum', IGP_PVW_PLUGIN_LINK) ?></a> |
						<a target="_blank" href="<?php echo IGP_PVW_PLUGIN_WEB; ?>" title="<?php _e('Visit the site for', IGP_PVW_PLUGIN_LINK) ?> <?php echo IGP_PVW_PLUGIN_NAME; ?>"><?php _e('Plugin Site', IGP_PVW_PLUGIN_LINK) ?></a> |
						<a target="_blank" title="<?php _e('Follow on Twitter for updates', IGP_PVW_PLUGIN_LINK) ?>" href="http://twitter.com/#!/instagrate">@instagrate</a>
					</div>
					<div id="tweet">
						<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.instagrate.co.uk" data-text="I'm using the Instagrate Pro WordPress plugin" data-via="instagrate">Tweet</a>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
					
					</div>
					
					<div id="pvw">
						<a id="logo" href="http://www.polevaultweb.com/" title="Plugin by polevaultweb.com" target="_blank"><img src="<?php echo IGP_PVW_PLUGIN_URL; ?>lib/admin/images/pvw_logo.png" alt="polevaultweb logo" width="190" /></a>
					</div>
			
				</div>
				<!-- END Footer -->
				<div class="clear"></div>
			</div>	
				
		<?php 
			
			
	}


} //end of admin framework class

}

?>