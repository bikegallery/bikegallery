jQuery(document).ready(function(){	
	
	
	if (jQuery('#setting-error-settings_updated')){
		
		t = setTimeout('fade_update_message()', 2000);
	}

	
	jQuery('#pvw_container').on('click', ':button',
			
		function(){
	
			if (jQuery(this).attr("name") == 'pvw_reset') {
			
				
				if (confirm('Click OK to reset settings')) {
				
					jQuery('#main').addClass('processing');

					jQuery.post(
					ajaxurl, 
					{
					  'action':'reset_settings'
					}, 
				   function(response){
					   
							jQuery('#main #content').empty();
							jQuery('#main #content').append(response);
							
							jQuery('.group').hide();
							jQuery('.group:first').fadeIn();
							
							jQuery('#main').removeClass('processing');
							
							var msg = 	'Settings reset';
							show_message(1, msg);
							t = setTimeout('fade_message()', 2000);
							
					   
					  
					   }
					);
				
				
				}
				
			
			} else 
			if (jQuery(this).attr("name") == 'pvw_delete') {
			
				
				var username = jQuery(this).attr("data-username");
				var accid = jQuery(this).attr("id");
							
				if (confirm('Click OK to delete this account for ' + username)) {
				
					jQuery('#main').addClass('processing');

					jQuery.post(
					ajaxurl, 
					{
					  'action':'delete_account',
					  'id':accid
					}, 
				   function(response){
					   
							
							if (response == 0 ){
							
								var msg = ' deleting account ' + username;
								show_message(0, msg);
								t = setTimeout('fade_message()', 2000);
								
								jQuery('#main').removeClass('processing');
							
							} else {
							
								jQuery('#main').empty();
								jQuery('#main').append(response);
								
								jQuery('.group').hide();
								jQuery('.group:first').fadeIn();
								
								jQuery('#main').removeClass('processing');
								
								var msg = 	username + ' account deleted';
								show_message(1, msg);
								t = setTimeout('fade_message()', 2000);
							
							}
							
					   
					   
					   }
					);
				
				
				}
			
			} else 
			if (jQuery(this).attr("name") == 'pvw_duplicate') {
			
				
				var username = jQuery(this).attr("data-username");
				var accid = jQuery(this).attr("id");
							
				if (confirm('Click OK to duplicate this account for ' + username)) {
				
					jQuery('#main').addClass('processing');

					jQuery.post(
					ajaxurl, 
					{
					  'action':'duplicate_account',
					  'id':accid
					}, 
				   function(response){
					   
							
							if (response == 0 ){
							
								var msg = ' duplicating account ' + username;
								show_message(0, msg);
								t = setTimeout('fade_message()', 2000);
								
								jQuery('#main').removeClass('processing');
							
							} else {
							
								jQuery('#main').empty();
								jQuery('#main').append(response);
								
								jQuery('.group').hide();
								jQuery('.group:first').fadeIn();
								
								jQuery('#main').removeClass('processing');
								
								var msg = 	username + ' account duplicated';
								show_message(1, msg);
								t = setTimeout('fade_message()', 2000);
							
							}
							
					   
					   
					   }
					);
				
				
				}
			
			}
			else
				if (jQuery(this).attr("name") == 'button_send_data') {
			
				
					jQuery('#main').addClass('processing');

					jQuery.post(
					ajaxurl, 
					{
					  'action':'send_install_data'
					}, 
					   function(response){
						   
							var msg = 'Install data sent, thank you!';
							show_message(1, msg);
							t = setTimeout('fade_message()', 2000);
							
							jQuery('#main').removeClass('processing');
							
						   }
					);
				
				
			}
			else
				if (jQuery(this).attr("name") == 'button_send_debug') {
			
				
					jQuery('#main').addClass('processing');

					jQuery.post(
					ajaxurl, 
					{
					  'action':'send_debug_data'
					}, 
					   function(response){
						   
							var result = 0;
							
							if (response == 'Debug file sent, thank you!' ){
								
								result = 1;
							} else {
								
								response = ' ' + response;
							
							}
							
							show_message(result, response);
							t = setTimeout('fade_message()', 2000);
								
							jQuery('#main').removeClass('processing');
							
						 
						   }
					);
				
			}
			else {
			
			
			}
		
		return false;
		}
		
		
	);
		
	
	   
		
});

function show_message(n, msg) {
	if(n == 1) {
		jQuery('#pvw-messages').html('<div id="message" class="updated fade"><p><strong>' +  msg + '</strong></p></div>').show();
	} else {
		jQuery('#pvw-messages').html('<div id="message" class="error fade"><p><strong>Error in' + msg + '</strong></p></div>').show();
	}
 }
	 
function fade_message() {
		jQuery('#pvw-messages').fadeOut(1000);
		clearTimeout(t);
}

function fade_update_message() {
		jQuery('#setting-error-settings_updated').fadeOut(1000);
		clearTimeout(t);
}