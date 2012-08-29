<?php

/* Get general options template */
function pvw_igp_get_general_template(){


	// Set the Options Array
	$options = array();
	
	
	// ---------------------------------------------------------------------------------------------------------------------------------------------//					
		
	$options[] = array( "name" => __('Accounts',IGP_PVW_PLUGIN_LINK),
						"type" => "heading");
						
	$options[] = array( "name" => "",
						"message" => __('You can configure as many Instagram accounts as you want with this plugin, including using the same account more than once. The settings for individual accounts appear as menu items down the left hand side',IGP_PVW_PLUGIN_LINK),
						"type" => "intro");	
						
	$options[] = array( "name" => '',
						"desc" => __('Add a new Instagram account to the plugin',IGP_PVW_PLUGIN_LINK),
						"id" => "add_account",
						"text" => "Add Account",
						"type" => "instagram_login");	
					
	$options[] = array(	"type" => "accounts");		
	
											
	// ---------------------------------------------------------------------------------------------------------------------------------------------//					

	$options[] = array( "name" => __('Global Settings',IGP_PVW_PLUGIN_LINK),
						"type" => "heading");
						
	$options[] = array( "name" => "",
						"message" => __('These are global settings that apply to all the connected accounts.',IGP_PVW_PLUGIN_LINK),
						"type" => "intro");
						
	$options[] = array( "name" => __('Post Title Default',IGP_PVW_PLUGIN_LINK),
					"desc" => __('Enter a title for posts where the Instagram image has no title, or is just made up of tags that you are stripping out and for group image posts.',IGP_PVW_PLUGIN_LINK),
					"id" => "default_title",
					"input" => "true",
					"std" => "Instagram Image",
			 		"type" => "text");
					
	$tooltip	=  __('This is an advanced setting for sites using themes that do not have a separate page dedicated to posts. If in doubt do not switch on.',IGP_PVW_PLUGIN_LINK);
	
	$options[] = array( "name" => __('Bypass is_home() check',IGP_PVW_PLUGIN_LINK),
						"desc" => __('Check this to bypass the is_home() check when the plugin auto posts.',IGP_PVW_PLUGIN_LINK),
						"id" => "is_home",
						"std" => "false",
						"tooltip" => $tooltip,
						"type" => "checkbox",
						"input" => "true");	
						
	$tooltip	=  __('For example, two accounts are configured using hashtag "a" and hashtag "b". If an Instagram image contains both of these hashtags it will only be posted once. Enabling this setting will mean it will get posted twice, once by each account.',IGP_PVW_PLUGIN_LINK);
	
	$options[] = array( "name" => __('Allow posting of same image by different accounts',IGP_PVW_PLUGIN_LINK),
						"desc" => __('Check this to allow the same Instagram image to be posted by multiple accounts.',IGP_PVW_PLUGIN_LINK),
						"id" => "dup_image",
						"std" => "false",
						"tooltip" => $tooltip,
						"type" => "checkbox",
						"input" => "true");	
			 				
					
	$options[] = array( "name" => sprintf(__('Create link to the %1$s plugin page',IGP_PVW_PLUGIN_LINK),IGP_PVW_PLUGIN_NAME),
							"desc" => __('Check this to enable a credit link to the plugin page after images posted.',IGP_PVW_PLUGIN_LINK),
							"id" => "credit_link",
							"std" => "true",
							"type" => "checkbox",
							"input" => "true");
					
	// ---------------------------------------------------------------------------------------------------------------------------------------------//					
	
	// PLUGIN DEBUG AND SUPPORT SECTION
	
	// ---------------------------------------------------------------------------------------------------------------------------------------------//					
							
	$options[] = array( "name" => __('Plugin Support',IGP_PVW_PLUGIN_LINK),
						"type" => "heading");
						
	$options[] = array( "message" => __('If you have any issues with the plugin please visit the <a href="http://www.polevaultweb.com/support/forum/'.IGP_PVW_PLUGIN_LINK.'-plugin/">Support Forum</a>.',IGP_PVW_PLUGIN_LINK),
						"type" => "intro");
	
	$options[] = array( "name" => __('Debug Mode',IGP_PVW_PLUGIN_LINK),
						"desc" => __('Check this to enable debug mode for troubleshooting the plugin.',IGP_PVW_PLUGIN_LINK),
						"id" => "debug_mode",
						"std" => "false",
						"type" => "checkbox",
						"input" => "true");	
					
	$options[] = array( "name" => "",
						"desc" => __('If you have turned on debug mode and have tried to post new images and are having problems, please send the debug file so we can troubleshoot your issue.',IGP_PVW_PLUGIN_LINK),
						"id" => "send_debug",
						"text" => __('Send Debug File', IGP_PVW_PLUGIN_LINK),
						"method" => "send_debug_data",
						"message" => __('Debug file sent! Thank you', IGP_PVW_PLUGIN_LINK),
						"std" => "debug_file",
						"type" => "button");
							
	$options[] = array( "name" => "",
						"desc" => __('If you raise a topic or reply on the Support Forum about an issue you are having, please send the following debug data so we can troubleshoot your issue',IGP_PVW_PLUGIN_LINK),
						"id" => "send_data",
						"text" => __('Send Install Data', IGP_PVW_PLUGIN_LINK),
						"method" => "send_install_data",
						"message" => __('Install data sent! Thank you', IGP_PVW_PLUGIN_LINK),
						"std" => "debug",
						"type" => "button");
						
	$options[] = array( "name" => "",
						"type" => "debug");


	// ---------------------------------------------------------------------------------------------------------------------------------------------//					
	//Return template options
	
	return $options;
	
}

?>