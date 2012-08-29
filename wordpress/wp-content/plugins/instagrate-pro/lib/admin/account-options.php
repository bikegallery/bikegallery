<?php

require_once IGP_PVW_PLUGIN_PATH.'lib/admin/options/account_template.php';

class igp_account_options {

	//private $plugin = IGP_PVW_PLUGIN_SHORTCODE;
	//private $template;
	
	public function __construct() {
		
	
	}
	
	public function load_template($id,$userid,$username) {
	
		$plugin = IGP_PVW_PLUGIN_SHORTCODE;
		$template = pvw_igp_account_template($plugin,$id,$userid,$username);
		
		return $template;
	}

	public function template_init() {
	
		//$template = self::load_template();
		$plugin = IGP_PVW_PLUGIN_SHORTCODE;
		update_option('pvw_'.$plugin.'_template',$template); 
	
	}
	
	public function add_template($template) {
	
		$general_template = igp_general_options::get_template();
		
		$new_template =  array_merge($general_template, $template);
		
		self::add_template_stds($template);
		
		igp_general_options::save_template($new_template);
	
	}
	
	public function add_template_stds($template) {
	
		
		//$updated_options = array();
		$updated_options = igp_general_options::get_options();
		
		//General Options	
		foreach($template as $option) {
			
			if(isset($option['input']) && $option['input'] == 'true'){
				
				$id = $option['id'];
				
				if (isset($option['std'])) {
					$std = $option['std'];
					$updated_options[$id] = $std;
				}
			}
		}
		
		//update options
		igp_general_options::save_options($updated_options);
	
	}
	
	public function get_accounts() {
	
		$accounts = array();
		$plugin = IGP_PVW_PLUGIN_SHORTCODE;
		$accounts = get_option( 'pvw_'.$plugin.'_accounts' );
		
		return $accounts;
	
	}
	
	public function get_account($id) {
	
		$accounts = self::get_accounts();
		
		if(isset($accounts) && $accounts) {
		
			foreach ($accounts as $key => $account) {
			
				if (isset($account['id'])) {
				
					if($account['id'] == $id ){
						
						return $account;

					}
				
				}
				 
			}
			
		}
		
		return false;
			
	}

	public function save_accounts($accounts) {
	
		$plugin = IGP_PVW_PLUGIN_SHORTCODE;
		update_option( 'pvw_'.$plugin.'_accounts', $accounts );
			
	}
	
	public function get_last_account($accounts) {
	
		$id = 0;
		
		if(isset($accounts) && $accounts) {
		
			foreach ($accounts as $account) {
	
			$id = $account['id'];

			}

		
		}
		
		return $id;
	
	}
	
	public function add_account($userid, $username, $access) {
			
		$accounts = self::get_accounts();
		
		$id = self::get_last_account($accounts);
		
		$id ++;
 		
		$new_account = array( 	"id" => $id,
								"userid" => $userid,
								"username" => $username,
								"access" => $access );
							
		$accounts[] = $new_account;
		
		self::save_accounts($accounts);
		
		$template = self::load_template($id, $userid,$username);
		
		self::add_template($template);
		
		
	}
	
	public function repair_account($id, $userid, $username, $access) {
	
		$accounts = self::get_accounts();
		
		if(isset($accounts) && $accounts) {
		
			foreach ($accounts as $key => $account) {
			
				if (isset($account['id'])) {
				
					if($account['id'] == $id && $account['userid'] == $userid){
						
						$account['userid'] = $userid;
						$account['username'] = $username;
						$account['access'] = $access;
					  
					}
				
				}
				 
			}
			
		}
		
		self::save_accounts($accounts);
	
	
	}
	
	public function duplicate_account($id) {
			
		$accounts = self::get_accounts();
		
		if(isset($accounts) && $accounts) {
		
			$new_id = self::get_last_account($accounts);
			
			foreach ($accounts as $key => $account) {
			
				if (isset($account['id'])) {
				
					if($account['id'] == $id){
					
						$userid = $account['userid'];
						$username = $account['username'];
						$access = $account['access'];
					
					}
				}
			}		
			
			$new_id ++;
			
			$new_account = array( 	"id" => $new_id,
									"userid" => $userid,
									"username" => $username,
									"access" => $access );
								
			$accounts[] = $new_account;
			
			self::save_accounts($accounts);
			
			$template = self::load_template($new_id, $userid,$username);
			
			self::add_template($template);
		
		}
		
		
	}
	
	public function update_account($id, $userid,$username) {
	
		$template = self::load_template($id, $userid,$username);
		
		self::add_template($template);
	
	
	}
	
	
	
}



?>
