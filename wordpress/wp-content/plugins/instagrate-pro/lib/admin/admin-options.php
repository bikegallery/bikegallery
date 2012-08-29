<?php

require_once IGP_PVW_PLUGIN_PATH.'lib/admin/options/general_template.php';
require_once IGP_PVW_PLUGIN_PATH.'lib/functions/functions.php';

class igp_general_options {

	//private $plugin;
	private $template;
	
	public function __construct() {
	
		
	}
	
	public function load_template() {
	
		$template = pvw_igp_get_general_template();
		return $template;
	
	}
	
	public function template_init() {
	
		$template = self::load_template();
		
		$plugin = IGP_PVW_PLUGIN_SHORTCODE;
		update_option('pvw_'.$plugin.'_template',$template); 
	
	}
	
	public function get_template() {
	
		$plugin = IGP_PVW_PLUGIN_SHORTCODE;
		$template = get_option('pvw_'.$plugin.'_template');
	
		
		return $template;
	
	}
	
	public function get_options() {
	
		$plugin = IGP_PVW_PLUGIN_SHORTCODE;
		$options = get_option('pvw_'.$plugin.'_options');
		
		return $options;
	
	}
	
	
	public function save_options($options) {
	
		$plugin = IGP_PVW_PLUGIN_SHORTCODE;
		update_option('pvw_'.$plugin.'_options',$options);
	
	}
	
	public function save_template($template) {
	
		$plugin = IGP_PVW_PLUGIN_SHORTCODE;
		update_option('pvw_'.$plugin.'_template',$template);
	
	}
	
	public function save_template_option($template, $id, $keyV, $value) {
	
		$plugin = IGP_PVW_PLUGIN_SHORTCODE;
		//var_dump( $value);
		
		foreach($template as $key => $option) {
			
			if(isset($option['id']) && $option['id'] == $id){
				
				$option[$keyV] = $value;
				
				$template[$key] = $option;
				
				break;
				
			}
		}
		
		$result = update_option('pvw_'.$plugin.'_template',$template);
		
		return $result;
	
	}
	
	public function map_selected() {
	
		$options = self::get_options();
		
		$selected = false;
		
		foreach($options as $key => $option) {
		
			if (substr($key, -9) == '_location' && $option == 'true' ){
			
				$selected = true;
				break;
			
			}
		
		}
		
		return $selected;
	
	}
	

}

function pvw_igp_validate_settings($plugin_options) {
	  
		$template = igp_general_options::get_template();	
				
		
		//Checkbox issues
		
		foreach($template as $option) {
		
			if($option['type'] == 'checkbox') {
							
				$id = $option['id'];
							
				//$key = array_search($id, $plugin_options);	
		
				if ( !isset($plugin_options[$id])  ) {
						
					$plugin_options[$id] = "false";
					
				}
			}	
		}
		
		//clean hastag
		foreach($plugin_options as $key => $option) {
		
			if (substr($key,-8) == '_hashtag') {
			
				$plugin_options[$key] = igp_functions::clean_hastag($option);
			
			}
		}
	
		
		return $plugin_options;
}

?>