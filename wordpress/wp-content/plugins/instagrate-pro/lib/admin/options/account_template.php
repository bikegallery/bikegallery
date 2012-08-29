<?php

//require core file
require_once IGP_PVW_PLUGIN_PATH.'lib/core/instagrate.php';

//Get account options template
function pvw_igp_account_template($shortname,$id,$userid, $username){

	$tag = $shortname.'_'.$id.'_'.$userid;
	
	// Set the Options Array
	$options = array();
	
	
	// ---------------------------------------------------------------------------------------------------------------------------------------------//					
		
	$options[] = array( "name" => $id.': '.$username,
						"type" => "heading",
						"account" => $tag);
						
	$options[] = array( "message" => __('Specific settings for ',IGP_PVW_PLUGIN_LINK).$username,
						"type" => "intro",
						"account" => $tag);
											
	$tooltip	=  __('<b>Recent Images</b> will post only images by the connected account. <br/><br/><b>Feed Images</b> will post all images, including those by other users, in the connected account\'s feed. <br/><br/><b>All Hashtagged Images</b> will post images by any user with the certain hashtags.',IGP_PVW_PLUGIN_LINK);
		
	$instagram_options = array("all" => "Recent Images", "feed" => "Feed Images", "hashtag" => "All Hashtagged Images"); 
	
	$options[] = array( "name" => __('Instagram Options',IGP_PVW_PLUGIN_LINK),
					"desc" => __('Select what images will be posted.',IGP_PVW_PLUGIN_LINK),
					"account" => $tag,
					"id" => $tag."_instagram_options",
					"input" => "true",
					"options" => $instagram_options,
					"tooltip" => $tooltip,
					"class" => "ig",
					"std" => "all",
					"type" => "select");  

	
	$options[] = array( "name" => __('Hashtag Filter',IGP_PVW_PLUGIN_LINK),
					"desc" => __('Enter a hashtag to filter images posted. Only a single hastag can be searched.',IGP_PVW_PLUGIN_LINK),
					"account" => $tag,
					"id" => $tag."_hashtag",
					"input" => "true",
					"std" => "",
					"class" => "ht",
			 		"type" => "text");
					
	
	$lastid = igp_instagrate::get_last_id($id,'all',null);
	
	$options[] = array( "name" => __('Last Image Posted',IGP_PVW_PLUGIN_LINK),
					"desc" => __('Select the last image posted. All images after this will be posted. This cannot be set for Hashtag posting.',IGP_PVW_PLUGIN_LINK),
					"account" => $tag,
					"id" => $tag."_lastid",
					"input" => "true",
					"std" => $lastid[0],
					"type" => "select-last-image"); 
				
	$tooltip	=   __('<b>Real time posting</b> will post every image as a new post when people visit your site.<br/><br/><b>Scheduled posting</b> will post images on a schedule.',IGP_PVW_PLUGIN_LINK);
	
	$post_config = array("real" => "Real time posting", "schedule" => "Scheduled posting"); 
	
	$options[] = array( "name" => __('Posting Config',IGP_PVW_PLUGIN_LINK),
					"desc" => __('Select when images will be posted.',IGP_PVW_PLUGIN_LINK),
					"account" => $tag,
					"id" => $tag."_post_config",
					"input" => "true",
					"options" => $post_config,
					"std" => "real",
					"tooltip" => $tooltip,
					"type" => "select");  
					
	$tooltip	=   __('<b>Post for each image</b> will post every image as a new post.<br/><br/><b>All images in one post</b> will post all images in a single post.',IGP_PVW_PLUGIN_LINK);
	
	$schedule_config = array("each" => "Post for each image", "group" => "All images in one post"); 
	
	$options[] = array( "name" => __('Multiple Image Config',IGP_PVW_PLUGIN_LINK),
					"desc" => __('Select how the multiple images will be posted.',IGP_PVW_PLUGIN_LINK),
					"account" => $tag,
					"id" => $tag."_schedule_config",
					"options" => $schedule_config,
					"std" => "each",
					"input" => "true",
					"tooltip" => $tooltip,
					"type" => "select");
	
	$options[] = array( "name" => __('Schedule',IGP_PVW_PLUGIN_LINK),
					"desc" => __('Select the schedule of posting. This only applies if you have selected <b>Scheduled posting.</b>',IGP_PVW_PLUGIN_LINK),
					"account" => $tag,
					"id" => $tag."_schedule",
					"std" => 0,
					"input" => "true",
					"type" => "select-schedule");
								
						
	$options[] = array( "name" => __('Remove Hashtags from Post Title',IGP_PVW_PLUGIN_LINK),
					"desc" => __('Check this to enable the removal of hashtags from the Instagram image title, used for the post title.',IGP_PVW_PLUGIN_LINK),
					"account" => $tag,
					"id" => $tag."_title",
					"input" => "true",
					"std" => "false",
					"type" => "checkbox");
					
	$options[] = array( "name" => __('Convert Hashtags to Post Tags',IGP_PVW_PLUGIN_LINK),
					"desc" => __('Check this to enable the hashtags from the Instagram image title to be converted to post tags.',IGP_PVW_PLUGIN_LINK),
					"account" => $tag,
					"id" => $tag."_tags",
					"std" => "false",
					"input" => "true",
					"type" => "checkbox");
					
	$options[] = array( "name" => __('Post Author',IGP_PVW_PLUGIN_LINK),
					"desc" => __('Select which user is set as the post author',IGP_PVW_PLUGIN_LINK),
					"account" => $tag,
					"id" => $tag."_post_author",
					"input" => "true",
					"std" => 0,
					"type" => "select-user");  	

	$options[] = array( "name" => __('Post Category',IGP_PVW_PLUGIN_LINK),
					"desc" => __('Select the category you want the posts to be created in.',IGP_PVW_PLUGIN_LINK),
					"account" => $tag,
					"id" => $tag."_post_category",
					"input" => "true",
					"std" => 0,
					"type" => "select-cat");

	$post_status = array("publish" => "Publish", "draft" => "Draft"); 
	
	$options[] = array( "name" => __('Post Status',IGP_PVW_PLUGIN_LINK),
					"desc" => __('Select if the posts will be published or created as a draft.',IGP_PVW_PLUGIN_LINK),
					"account" => $tag,
					"id" => $tag."_post_status",
					"input" => "true",
					"options" => $post_status,
					"std" => "publish",
					"type" => "select");  

	$options[] = array( "name" => __('Post Type',IGP_PVW_PLUGIN_LINK),
					"desc" => __('Select the post type you want the post to be created as. This is handy for custom post types created by themes..',IGP_PVW_PLUGIN_LINK),
					"account" => $tag,
					"id" => $tag."_post_type",
					"input" => "true",
					"std" => 'post',
					"type" => "select-type"); 

	$options[] = array( "name" => __('Post Format',IGP_PVW_PLUGIN_LINK),
					"desc" => __('Select the post format you want the posts to be created in.',IGP_PVW_PLUGIN_LINK),
					"account" => $tag,
					"id" => $tag."_post_format",
					"input" => "true",
					"std" => 'Standard',
					"type" => "select-format"); 
					
	$options[] = array( "name" => __('Post Date',IGP_PVW_PLUGIN_LINK),
					"desc" => __('Check this to make the post date and time the same as image was created on Instagram.',IGP_PVW_PLUGIN_LINK),
					"account" => $tag,
					"id" => $tag."_post_date",
					"input" => "true",
					"std" => "true",
					"type" => "checkbox");
					
	$tooltip	=  __('<b>Link to Instagram Image</b> will use the images directly from the Instagram link.<br/><br/><b>Save to Media Library</b> will save the Instagram image to your WordPress Media Library. This option is needed if you want to create Featured Images and also Galleries.',IGP_PVW_PLUGIN_LINK);
						
	$image_saving = array("link" => "Link to Instagram Image","media" => "Save to Media Library" ); 
	
	$options[] = array( "name" => __('Image Saving',IGP_PVW_PLUGIN_LINK),
					"desc" => __('Select how the images will be saved / linked.',IGP_PVW_PLUGIN_LINK),
					"account" => $tag,
					"id" => $tag."_image_saving",
					"input" => "true",
					"options" => $image_saving,
					"std" => "link",
					"tooltip" => $tooltip,
					"type" => "select");  	
					
	$options[] = array( "name" => __('Featured Image',IGP_PVW_PLUGIN_LINK),
					"desc" => __('Check this to set the image as a featured image. This only applies if you have selected to save the images to the media library.',IGP_PVW_PLUGIN_LINK),
					"account" => $tag,
					"id" => $tag."_feat_img",
					"input" => "true",
					"std" => "false",
					"type" => "checkbox");
					
	$options[] = array( "name" => __('Enable a Gallery for multiple images in one post',IGP_PVW_PLUGIN_LINK),
					"desc" => __('Check this to enable a gallery for all the images in a post. This only applies if you have selected <b>Save to Media Library</b> and <b>All images in one post</b> in the previous options.',IGP_PVW_PLUGIN_LINK),
					"account" => $tag,
					"id" => $tag."_gallery",
					"input" => "true",
					"std" => "false",
					"type" => "checkbox");
					
	$options[] = array( "name" => __('Image(s) in Post',IGP_PVW_PLUGIN_LINK),
					"desc" => __('Check this to insert the image(s) in the post content. Turn this off if you want just a featured image or gallery (for multiple images) as the post.',IGP_PVW_PLUGIN_LINK),
					"account" => $tag,
					"id" => $tag."_img_post",
					"input" => "true",
					"std" => "true",
					"type" => "checkbox");
					
	$link_config = array("no" => "No Link", "image" => "Image", "page" => "Instagram Link"); 
					
	$options[] = array( "name" => __('Image Linking Config',IGP_PVW_PLUGIN_LINK),
					"desc" => __('Select where the link will go to.',IGP_PVW_PLUGIN_LINK),
					"account" => $tag,
					"id" => $tag."_link",
					"input" => "true",
					"options" => $link_config,
					"std" => "image",
					"type" => "select");
					
	$options[] = array( "name" => __('Image Size',IGP_PVW_PLUGIN_LINK),
					"desc" => __('Enter the size of the image in the post content. eg. 500',IGP_PVW_PLUGIN_LINK),
					"account" => $tag,
					"id" => $tag."_size",
					"input" => "true",
					"std" => "",
			 		"type" => "text");
	
	$options[] = array( "name" => __('Image CSS Class',IGP_PVW_PLUGIN_LINK),
					"desc" => __('Enter a CSS class which will apply to the image in the post content for styling. eg. aligncenter',IGP_PVW_PLUGIN_LINK),
					"account" => $tag,
					"id" => $tag."_css",
					"input" => "true",
					"std" => "",
			 		"type" => "text");
					
	$tooltip	=  __('<b>Location Data:</b> To enable Location Data, ensure you have allowed the Instagram app access to location services on you device and geotag you image in Instagram before saving.',IGP_PVW_PLUGIN_LINK);
	
	
	$options[] = array( "name" => __('Location Data',IGP_PVW_PLUGIN_LINK),
					"desc" => __('Check this to show the location data of where the image was taken as a Google Map with a pointer. Only applies if your Instagram images are set with Location on.',IGP_PVW_PLUGIN_LINK),
					"account" => $tag,
					"id" => $tag."_location",
					"input" => "true",
					"std" => "false",
					"tooltip" => $tooltip,
					"type" => "checkbox");
					
	$options[] = array( "name" => __('Location Map CSS',IGP_PVW_PLUGIN_LINK),
					"desc" => __('Enter a CSS class which will apply to the Location data map in the post content.',IGP_PVW_PLUGIN_LINK),
					"account" => $tag,
					"id" => $tag."_location_css",
					"input" => "true",
					"std" => "",
			 		"type" => "text");
					
	$options[] = array( "name" => __('Location Map Width',IGP_PVW_PLUGIN_LINK),
					"desc" => __('Enter a width which will apply to the Location data map in the post content.',IGP_PVW_PLUGIN_LINK),
					"account" => $tag,
					"id" => $tag."_location_width",
					"input" => "true",
					"std" => "400",
			 		"type" => "text");
	
	$options[] = array( "name" => __('Location Map Height',IGP_PVW_PLUGIN_LINK),
					"desc" => __('Enter a height which will apply to the Location data map in the post content.',IGP_PVW_PLUGIN_LINK),
					"account" => $tag,
					"id" => $tag."_location_height",
					"input" => "true",
					"std" => "300",
			 		"type" => "text");
					
	$tooltip	=   __('You can use the template tag <b>%%title%%</b> for the Instagram image title to position it within your custom post title. <br/><br/>E.g. "New from Instagram: %%title%%"',IGP_PVW_PLUGIN_LINK);
	
	$options[] = array( "name" => __('Custom Title',IGP_PVW_PLUGIN_LINK),
					"desc" => __('Enter a custom post title',IGP_PVW_PLUGIN_LINK),
					"account" => $tag,
					"id" => $tag."_custom_title",
					"input" => "true",
					"tooltip" => $tooltip,
					"std" => "",
			 		"type" => "text");
	
	$tooltip	=   __('You can use these template tags within your custom post body text. <br/> <br/><b>%%title%%</b> for the Instagram title. <br/><b>%%image%%</b> to position the image. (if you have selected it to appear in the post)<br/><b>%%link%%</b> to link to the Instagram image page. You can set the link text in the option below.<br/><b>%%username%%</b> for the Instagram username who posted the image. <br/><b><code>&lt;!--more--&gt;</code></b> to break the post into a read more link. Useful at the end of the post body before a Google Map is shown.',IGP_PVW_PLUGIN_LINK);
		
	$options[] = array( "name" => __('Custom Body Text',IGP_PVW_PLUGIN_LINK),
					"desc" => __('Enter a the custom post body. You can check the available template tags by clicking on the question mark button.',IGP_PVW_PLUGIN_LINK),
					"account" => $tag,
					"id" => $tag."_custom_body",
					"input" => "true",
					"tooltip" => $tooltip,
					"std" => "",
			 		"type" => "textarea");
	
	$options[] = array( "name" => __('%%link%% Text',IGP_PVW_PLUGIN_LINK),
					"desc" => __('Enter the text of the <b>%%link%%</b> to the Instagram page, where it is used in the Custom Body Text. Default is "View on Instagram".',IGP_PVW_PLUGIN_LINK),
					"account" => $tag,
					"id" => $tag."_link_text",
					"input" => "true",
					"std" => "",
			 		"type" => "text");
	
	// ---------------------------------------------------------------------------------------------------------------------------------------------//					
	// Return template options
	
	return $options;
	
	
	
}

?>