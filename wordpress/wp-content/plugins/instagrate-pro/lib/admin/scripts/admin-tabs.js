
jQuery(document).ready(function(){
			
			jQuery('#pvw_container').on('click','.section .tooltip a',
					
						function(){
						
							jQuery(jQuery(this).attr('href')).fadeIn(250);
							jQuery('.section .tooltip ' + jQuery(this).attr('href') +' .tt-close').fadeIn(250);
						return false;
						}
			);
	
			
			jQuery('#pvw_container').on('click','.section .tooltip .answer .tt-close',
			
				function(){ 
					jQuery('.section .tooltip .answer').fadeOut(250);
					jQuery(this).fadeOut(250);
					return false;
					
				}
			);


			// jQuery Tabs for Plugin settings page
			var flip = 0;
				
			jQuery('#pvw_container').on('click','#expand_options', function(){
				if(flip == 0){
					flip = 1;
					jQuery('#pvw_container #pvw-nav').hide();
					jQuery('#pvw_container #content').width(755);
					jQuery('#pvw_container .group').add('#pvw_container .group h2').show();
	
					jQuery(this).text('[-]');
					
				} else {
					flip = 0;
					jQuery('#pvw_container #pvw-nav').show();
					jQuery('#pvw_container #content').width(595);
					jQuery('#pvw_container .group').add('#pvw_container .group h2').hide();
					jQuery('#pvw_container .group:first').show();
					jQuery('#pvw_container #pvw-nav li').removeClass('current');
					jQuery('#pvw_container #pvw-nav li:first').addClass('current');
					
					jQuery(this).text('[+]');
				
				}
			
			});
			
				jQuery('.group').hide();
				jQuery('.group:first').fadeIn();
				
				jQuery('.group .collapsed').each(function(){
					jQuery(this).find('input:checked').parent().parent().parent().nextAll().each( 
						function(){
           					if (jQuery(this).hasClass('last')) {
           						jQuery(this).removeClass('hidden');
           						return false;
           					}
           					jQuery(this).filter('.hidden').removeClass('hidden');
           				});
           		});
           					
				jQuery('.group .collapsed input:checkbox').click(unhideHidden);
				
				function unhideHidden(){
					if (jQuery(this).attr('checked')) {
						jQuery(this).parent().parent().parent().nextAll().removeClass('hidden');
					}
					else {
						jQuery(this).parent().parent().parent().nextAll().each( 
							function(){
           						if (jQuery(this).filter('.last').length) {
           							jQuery(this).addClass('hidden');
									return false;
           						}
           						jQuery(this).addClass('hidden');
           					});
           					
					}
				}
				
				jQuery('#pvw_container').on('click','.pvw-radio-img-img',function(){
					jQuery(this).parent().parent().find('.pvw-radio-img-img').removeClass('pvw-radio-img-selected');
					jQuery(this).addClass('pvw-radio-img-selected');
					
				});
				jQuery('.pvw-radio-img-label').hide();
				jQuery('.pvw-radio-img-img').show();
				jQuery('.pvw-radio-img-radio').hide();
				jQuery('#pvw-nav li:first').addClass('current');
				jQuery('#pvw_container').on('click','#pvw-nav li a' ,function(evt){
				
						jQuery('#pvw-nav li').removeClass('current');
						jQuery(this).parent().addClass('current');
						
						var clicked_group = jQuery(this).attr('href');
		 
						jQuery('.group').hide();
						
							jQuery(clicked_group).fadeIn();
		
						evt.preventDefault();
						
					});
					
	});
	
