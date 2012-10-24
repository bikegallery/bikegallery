jQuery(document).ready(function($){

		jQuery('#pvw_container .post-config select').each(function(){
		   
		    var selectid = jQuery(this).attr("id");
			var tag = selectid.substring(0,selectid.length-16);
			
			if (jQuery(this).val() == 'single') {
				jQuery('#' + tag + '_single_config').closest('.single').show()
				
			} else {
				jQuery('#' + tag + '_single_config').closest('.single').hide()
				
			}		
		
		 });
		
		//Single Post config
		jQuery('#pvw_container').on('change', '.post-config select',function(){	
			
			var selectid = jQuery(this).attr("id");
			var tag = selectid.substring(0,selectid.length-16);
			
			if (jQuery(this).val() == 'single') {
				jQuery('#' + tag + '_single_config').closest('.single').show()
				
			} else {
				jQuery('#' + tag + '_single_config').closest('.single').hide()
				
			}
		
		});
		
		jQuery('#pvw_container').on('change', '.post-type select',function(){	
			
			var selectid = jQuery(this).attr("id");
			var selectValue = jQuery(this).val();
			 
			var tag = selectid.substring(0,selectid.length-10);
	
			var accid = tag.substring(4,tag.indexOf('_',5));
			
			if (jQuery('#' + tag + '_schedule_config').val() == 'single') {
			
				
					
				jQuery.post(
					   ajaxurl, 
					   {
						  'action':'post_config_single',
						  'id':accid,
						  'type':selectValue
					   }, 
					   function(response){
						  jQuery('#' + tag + '_single_config').empty();
						  jQuery('#' + tag + '_single_config').append(response);
					   }
					);
					
			}
		
		});

		
		//Changes to instagram config 
		
		jQuery('#pvw_container').on('change', '.pvw-input-ig',function(){
		//jQuery('.pvw-input-ig').change(function(){
		
			
			var selectid = jQuery(this).attr("id");
			var selectValue = jQuery(this).val();
			 
			var tag = selectid.substring(0,selectid.length-18);
			
			var hashtagId = '#' + tag + '_hashtag';
			var hashtag = jQuery(hashtagId).val();
			
			var lastImageId = '#' + tag + '_lastid';
			//var lastImage = jQuery(lastImageId).val();
			
			var accid = tag.substring(4,tag.indexOf('_',5));
					
			// call ajax
			jQuery(lastImageId).empty();
			jQuery(lastImageId).append('<option>Retrieving from Instagram...</option>');
			
			
			if (selectValue == 'hashtag' && hashtag == '') {
			
				//do nothing
			
			} else if (selectValue == 'hashtag' && hashtag != '') {

				//Hashtag give value as 0
				jQuery(lastImageId).empty();
				jQuery(lastImageId).append('<option value="0">Cannot set for hashtag posting</option>');

			} else	{
			
				jQuery.post(
				   ajaxurl, 
				   {
					  'action':'instagram_config',
					  'id':accid,
					  'type':selectValue,
					  'tag': hashtag
				   }, 
				   function(response){
					  jQuery(lastImageId).empty();
					  jQuery(lastImageId).append(response);
				   }
				);
			
			}
			
			if (selectValue == 'hashtag') {
			
				if (hashtag == '') {
				
					jQuery(lastImageId).empty();
					jQuery(lastImageId).append('<option>You need to enter a hashtag</option>');
				}
				
				//jQuery(lastImageId).attr('disabled', 'disabled');

			
			
			} else {
				
				//jQuery(lastImageId).removeAttr("disabled");		
				
				}
				
				
			}
		
		);
		
		//Changes to instagram  hashtags
		jQuery('#pvw_container').on('change', '..pvw-input-ht',function(){
		//jQuery('.pvw-input-ht').change(function(){
		
			
			var hashtagId = jQuery(this).attr("id");
			var hashtag = jQuery(this).val();
			 
			var tag = hashtagId.substring(0,hashtagId.length - 8);
			
			var selectid = '#' + tag + '_instagram_options';
			var selectValue = jQuery(selectid).val();
			
			var lastImageId = '#' + tag + '_lastid';
			//var lastImage = jQuery(lastImageId).val();
			
			var accid = tag.substring(4,tag.indexOf('_',5));
					
			if (selectValue == 'hashtag') {
			
				// call ajax
				jQuery(lastImageId).empty();
				jQuery(lastImageId).append('<option>Retrieving from Instagram...</option>');
				
				if (hashtag == '') {

					jQuery(lastImageId).empty();
					jQuery(lastImageId).append('<option>You need to enter a hashtag</option>');
				
				
				} else  {
					
					jQuery(lastImageId).empty();
					jQuery(lastImageId).append('<option value="0">Cannot set for hashtag posting</option>');
						
				
				}
						
				
			} else {
				
				//jQuery(lastImageId).removeAttr("disabled");
				
			}
			
			
			});
	
	
		

});
	