<?php

require_once IGP_PVW_PLUGIN_PATH.'lib/admin/account-options.php';
require_once IGP_PVW_PLUGIN_PATH.'lib/admin/admin-options.php';
require_once IGP_PVW_PLUGIN_PATH.'lib/admin/debug/debug.php';
require_once IGP_PVW_PLUGIN_PATH.'lib/core/account.php';
require_once IGP_PVW_PLUGIN_PATH.'lib/core/instagrate.php';
require_once IGP_PVW_PLUGIN_PATH.'lib/functions/functions.php';

class igp_controller {

	public function __construct() {
	
	}
	
	// Posting schedule/ real
	
	// Feed or hastag - change last image id
	
	public function instagrate_listener($type, $schedule = 0) {
		
		//debug text
		$debug = "------------------------------------------------------------------------------------------------------------------------------------------\n";
		$debug .= IGP_PVW_PLUGIN_NAME." - Plugin Debug Output: " . Date( DATE_RFC822 ) . "\n";
		$debug .= "PAGE LOAD " . Date( DATE_RFC822 ) . "\n";
		$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
		
		$debug .= "Home page is: ".get_home_template(). "\n";
		$debug .= "Current page is: ".get_page_template(). "\n";
		$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
		$debug .= "ACTION"."\n";
		$debug .= "Type: ".$type. "\n";
		$debug .= "Schedule: ".$schedule. "\n";
		$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
		
		//Get accounts
		$accounts = igp_account_options::get_accounts();
		
		$debug .= sizeof($accounts)." Accounts configured"."\n";
		$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
			
		$options  = igp_general_options::get_options();
			
		$debug_mode = $options['debug_mode'];
		$is_home = $options['is_home'];
		$dup_image = $options['dup_image'];
		$default_title = $options['default_title'];
		
		$comment_credit = "\n<!-- This post is created by ".IGP_PVW_PLUGIN_NAME." v".IGP_PVW_PLUGIN_VERSION." -->\n";
		
		//check if page is blog page (as long as is_home bypass is not enabled) or run on any page if it's a scheduled run
		if (($is_home == 'true' || ( $is_home == 'false' && is_home())) || $type == 'schedule' ) {
		
			$debug .= "--CHECK Page is_home() or type is schedule TRUE ". Date( DATE_RFC822 ) . "\n";
			$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
		
			$pluginlink = '';
			if ($options['credit_link'] == 'true' ) { 
			
				$pluginlink = '<br/><a href="'.IGP_PVW_PLUGIN_WEB.'" title="A plugin by polevaultweb.com">Posted by '.IGP_PVW_PLUGIN_NAME.' v'.IGP_PVW_PLUGIN_VERSION.'</a>'; 
			
			}
			
			if(isset($accounts) && $accounts) {
			
				$debug .= "--CHECK account is array TRUE ". Date( DATE_RFC822 ) . "\n";
				$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
		
				foreach ($accounts as $key => $acc) {
				
					$id = $acc['id'];
					
					$shortcode = IGP_PVW_PLUGIN_SHORTCODE;
		
					$debug .= "--PROCESSING account: ".$id." ". Date( DATE_RFC822 ) . "\n";
					$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
		
					$account = new igp_account($id,$options);
					
					$tag = $shortcode.'_'.$id.'_'.$account->userid;
					
					if ($type == $account->post_config &&  $schedule == $account->schedule ) {
						
						$debug .= "--CHECK account type: ".$account->post_config." = listener type: ".$type." TRUE ". Date( DATE_RFC822 ) . "\n";
						$debug .= "--CHECK account schedule: ".$account->schedule." = listener schedule: ".$schedule." TRUE ". Date( DATE_RFC822 ) . "\n";
						$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
		
						
						//grab all the recent images
						$data = igp_instagrate::get_images($account);
						$images = $data[0];
						$lastid = $data[1];
						$debug .= $data[2];
						$response = $data[3];
						
						$debug .= "--PROCESSING ".sizeof($images)." Images -  ".$id." ". Date( DATE_RFC822 ) . "\n";
						$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
		
						//check images exist
						if (isset($images) && is_array($images) && sizeof($images) > 0 && $response) {
							
							$debug .= "--CHECK images is array and count > 0 TRUE ". Date( DATE_RFC822 ) . "\n";
							$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
		
							//Global settings
			
							$post_author = $account->post_author;
							$post_category = array($account->post_category);
							$post_status = $account->post_status;
							$post_type = $account->post_type;
							
							
							//every image is a post
							//-----------------------------------------------------------------------------------------------------------------------------------------//
							if ($account->schedule_config == 'each') {
							
								$debug .= "--CHECK post config: ".$account->post_config." = real TRUE ". Date( DATE_RFC822 ) . "\n";
								$debug .= "--CHECK schedule config: ".$account->schedule_config." = each TRUE ". Date( DATE_RFC822 ) . "\n";
								$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
		
							
								$count = sizeof($images);
								$i = 0;
															
								foreach($images as $image) {
								
									

									$account_image_exists = igp_functions::instagrate_id_exists($tag.'_'.$image['id'],'account');
									$image_exists = false;
									
									if ($dup_image == 'false') {
									
										$image_exists = igp_functions::instagrate_id_exists($image['id'],'image');
									}
									
									if ( $account_image_exists == false && $image_exists == false) {
									
										$debug .= "--CHECK instagrate_id: ".$tag.'_'.$image['id']." does not exist in wp_postmeta TRUE ". Date( DATE_RFC822 ) . "\n";
										$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
			
									
										if ($image['id'] != $account->lastid) {
										
											$debug .= "--CHECK imageid: ".$image['id']." != accounts last id: ".$account->lastid." TRUE ". Date( DATE_RFC822 ) . "\n";
											$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
			
											$i ++;
											

											$debug .= "--START POSTING imageid: ".$image['id']." ". Date( DATE_RFC822 ) . "\n";
											$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
			
											$debug .= "----USERNAME: ".$image['username'].Date( DATE_RFC822 ) . "\n";
											
											$posttitle = $image['title'];
										
											$tag_helper = igp_functions::strip_hashtags($posttitle, $default_title );
											
											//post title
											$debug .= "--FUNCTION CHECK - Post title: ";
																					
											if ($account->title == 'true') {
											
												$debug .= "STRIP TAGS "." ". Date( DATE_RFC822 ) . "\n";
												$posttitle = $tag_helper[1];
											
											} else {
											
												$debug .= "TITLE REMAINS "." ". Date( DATE_RFC822 ) . "\n";	
												if ($posttitle == '') {
												
													$debug .= "Original Title Blank use default: ".$default_title." ". Date( DATE_RFC822 ) . "\n";
													$posttitle = $default_title;
												
												}
											
											}
											
											$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
			
											//alt
											$alt = ' alt="'.$posttitle.'"';
											//title
											$title = ' title="'.$posttitle.'"';
											
											//custom title
											$debug .= "--FUNCTION CHECK - Custom title: ". Date( DATE_RFC822 ) . "\n";										
											$posttitle = igp_functions::get_custom_string($account->custom_title,$posttitle,'title');
											$debug .= "New Title: ".$posttitle." ". Date( DATE_RFC822 ) . "\n";
											$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
			
											
											//post tags											
											$debug .= "--FUNCTION CHECK - Post Tags: ";	
											if ($account->tags == 'true') {
											
													$debug .= "CONVERT TO WP TAGS "." ". Date( DATE_RFC822 ) . "\n";
													$posttags = $tag_helper[0];
											
											} else {
											
													$debug .= "IGNORE HASHTAGS "." ". Date( DATE_RFC822 ) . "\n";
													$posttags = null;
											}
											$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
			
										
											//post date
											$debug .= "--FUNCTION CHECK - Post Date: ";	
											if ($account->post_date == 'true') {
												
												$postdate = $image['created'];
												$postdate = date('Y-m-d H:i:s',$postdate);
												$postdategmt = $postdate;
												$debug .= "INSTAGRAM DATE ".$postdate." ". Date( DATE_RFC822 ) . "\n";
												
											} else {
												
												$postdategmt = date('Y-m-d H:i:s',current_time('timestamp',1) - (($count-$i) * 20));
												$postdate = date('Y-m-d H:i:s',current_time('timestamp',0) - (($count-$i) * 20));
												$debug .= "WP POST DATE ".$postdate." ". Date( DATE_RFC822 ) . "\n";
				
											}
											$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
																		
											$post_title = trim($posttitle);
											$post_content = '';
											$post_tags = $posttags;
											$post_date = $postdate;
											$post_date_gmt = $postdategmt;
											
											
											$new_post = array(	'post_title' => $post_title,
																'post_content' => $post_content,
																'post_author' => $post_author,
																'post_category' => $post_category ,
																'tags_input' => $post_tags,
																'post_status' => $post_status,
																'post_type' => $post_type,
																'post_date' => $post_date,
																'post_date_gmt' =>  $post_date_gmt
															 );
											
											$debug .= "--FUNCTION wp_insert_post TRUE ". Date( DATE_RFC822 ) . "\n";
											$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
			
											$postid = wp_insert_post( $new_post );
											
											$debug .= "--FUNCTION Apply custom meta to make sure the image won't get duplicated TRUE ". Date( DATE_RFC822 ) . "\n";
											$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
			
											//apply custom meta to make sure the image won't get duplicated for that account
											add_post_meta($postid,'instagrate_id',$tag.'_'.$image['id']);
											
											//apply custom meta to make sure the image won't get duplicated by any account
											add_post_meta($postid,'instagrate_image_id',$image['id']);
											
											//apply format if not standard
											$debug .= "--FUNCTION CHECK - Post Format: ";
											if ($account->post_format != 'Standard') {
												set_post_format( $postid , $account->post_format);
												$debug .= "FORMAT ".$account->post_format." ". Date( DATE_RFC822 ) . "\n";
											} else { $debug .= "FORMAT IGNORED "." ". Date( DATE_RFC822 ) . "\n";}
											$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
			
											
											//image saving config
											$imgsrc = $image['image_large'];
											$debug .= "--FUNCTION CHECK - Image Saving: ";
											if ($account->image_saving == 'media' ){
											
												$debug .= "MEDIA LIBRARY"." ". Date( DATE_RFC822 ) . "\n";
												//put image from instagram into wordpress media library and link to it.
												$att_image = igp_functions::strip_querysting($imgsrc);
												$debug .= "--Attachment: ".$att_image." ". Date( DATE_RFC822 ) . "\n";
												//load into media library
												$attach_id = igp_functions::attach_image($att_image,$postid);
												$debug .= "--Attach Id: ".$attach_id." ". Date( DATE_RFC822 ) . "\n";
												//get new shot image url from media attachment
												$imgsrc = wp_get_attachment_url($attach_id);
												$debug .= "--Img SRC: ".$imgsrc." ". Date( DATE_RFC822 ) . "\n";
												
											} else {
											
												$debug .= "INSTAGRAM LINK"." ". Date( DATE_RFC822 ) . "\n";
											}
											$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
			
											
											//apply featured image if needed
											$debug .= "--FUNCTION CHECK - Featured Image: ";
											if ($account->feat_img == 'true' && $account->image_saving == 'media') {
											
												$debug .= "Set Featured TRUE ". Date( DATE_RFC822 ) . "\n";
												add_post_meta($postid, '_thumbnail_id', $attach_id);
												
											} else { $debug .= "Set Featured FALSE ". Date( DATE_RFC822 ) . "\n";}
											$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
			

											//only add image to post if configured
											$postimage = '';
											$debug .= "--FUNCTION CHECK - Post Image: ";
											if ($account->img_post == 'true') {
											
												$debug .= "--Include in Post TRUE ". Date( DATE_RFC822 ) . "\n";
												//image class
												$imageclass = '';
												
												if ($account->css != '') {
												
													$debug .= "--Set CSS TRUE ". Date( DATE_RFC822 ) . "\n";
													$imageclass = ' class="'.$account->css.'"';
												
												}
												
												//image size
												$imagesize = '';
												
												if ($account->size != '') {
												
													$debug .= "--Set Size TRUE ". Date( DATE_RFC822 ) . "\n";
													$imagesize = ' width="'.$account->size.'"';
												
												}
																								
												//image
												$postimage = '<img src="'.$imgsrc.'"'.$alt.$title.$imagesize.$imageclass.' />';
												
												//linking around image
												$url = $imgsrc;
												if ($account->link != 'no'){
												
													$debug .= "--Make a link TRUE ". Date( DATE_RFC822 ) . "\n";
													if ($account->link == 'page') {
														
														$debug .= "--Link to Instragram Page TRUE ". Date( DATE_RFC822 ) . "\n";
														$url = $image['url'];
													
													}
													
													$postimage = '<a href="'.$url.'" title="View Image">'.$postimage.'</a>';
												
												}
											
											}
											$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
			
											
											//custom post content	
											$post_content = $account->custom_body;
											$debug .= "--FUNCTION CHECK - Custom Body: ";
											if ($post_content != '') {
												
												$debug .= "CUSTOM BODY EXISTS"." ". Date( DATE_RFC822 ) . "\n";
												//%%title%%
												$post_content = igp_functions::get_custom_string($post_content,$posttitle,'title');
												//%%image%%
												$post_content = igp_functions::get_custom_string($post_content,$postimage,'image');
												//%%username%%
												$post_content = igp_functions::get_custom_string($post_content,$image['username'],'username');
												//%%link%%
												$postlink = '<a href="'.$image['url'].'" title="'.$account->link_text.'">'.$account->link_text.'</a>';
												$post_content = igp_functions::get_custom_string($post_content,$postlink,'link');
											
											} else {
											
												$debug .= "NO CUSTOM BODY "." ". Date( DATE_RFC822 ) . "\n";
												$post_content = $postimage;
											}
											$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
			
											
																		
											//location map data
											$debug .= "--FUNCTION CHECK - Location: ";
											if ($account->location == 'true' && $image['location_lat'] != ""){
											
												$debug .= "Setting TRUE and Image has Location Data TRUE ". Date( DATE_RFC822 ) . "\n";
												
												//location map css class
												$location_class = '';
												if ($account->location_css != '') {
										
													$debug .= "--Location Class TRUE ". Date( DATE_RFC822 ) . "\n";
													$location_class = ' '.$account->location_css;
												}
												
												$debug .= "----LAT: ".$image['location_lat'].' '. Date( DATE_RFC822 ) . "\n";
												$debug .= "----LON: ".$image['location_lon'].' '. Date( DATE_RFC822 ) . "\n";
												$debug .= "----NAME: ".$image['location_name'].' '. Date( DATE_RFC822 ) . "\n";
												//add post meta for lon, lat, title
												add_post_meta($postid,'igp_latlon',$image['location_lat'].','.$image['location_lon']);
												
												$location = '[igp_get_map lat="'.$image['location_lat'].'" lon="'.$image['location_lon'].'" marker="'.$image['location_name'].'" class="'.$location_class.'" width="'.$account->location_width.'" height="'.$account->location_height.'"]';
												
												/*
												$location = '<div class="map_canvas'.$location_class.'" ';
												$location .= 'data-lat="'.$image['location_lat'].'" ';
												$location .= 'data-lon="'.$image['location_lon'].'" ';
												if ($image['location_name'] != '') {
													$location .= 'data-marker="'.$image['location_name'].'" ';
												}
												$location .= 'style="width: '.$account->location_width.'px; height: '.$account->location_height.'px;">';
												$location .= '</div>';
												*/
												
												$debug .= "----LOCATION OUTPUT: ".$location.' '. Date( DATE_RFC822 ) . "\n";
													
												$post_content .= $location;
											
											} else { $debug .= "Setting FALSE and/ or Image has Location Data FALSE ". Date( DATE_RFC822 ) . "\n";}
											$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
			
											//credit link
											$post_content = $comment_credit.$post_content.$pluginlink;
							
											//update the post with content
											$update_post = array();
											$update_post['ID'] = $postid;
											$update_post['post_status'] = $post_status;
											$update_post['post_content'] = $post_content;
											
											$debug .= "----Before UPDATE - Content: ".$post_content.' '. Date( DATE_RFC822 ) . "\n";
											// Update the post into the database
											wp_update_post( $update_post );
											$after_update = get_post($postid); 
											$after_content = "";
											$after_content = $after_update->post_content;
											$debug .= "----After UPDATE - Content: ".$after_content.' '. Date( DATE_RFC822 ) . "\n";
											$debug .= "--FUNCTION wp_update_post TRUE ". Date( DATE_RFC822 ) . "\n";
											$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
			
															
																		
										} else {
										
											//Image is the same as last posted
											$debug .= "--CHECK imageid: ".$image['id']." != accounts last id: ".$account->lastid." FALSE ". Date( DATE_RFC822 ) . "\n";
											$debug .= "--PROCESSING IMAGE SKIPPED ". Date( DATE_RFC822 ) . "\n";
											$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
								
										
										}
									
									} 
									
									else {
									
										//Instagrate ID already exists in database wp_postmeta
										$debug .= "--CHECK instagrate_id: ".$tag.'_'.$image['id']." does not exist in wp_postmeta FALSE ". Date( DATE_RFC822 ) . "\n";
										$debug .= "--PROCESSING IMAGE SKIPPED ". Date( DATE_RFC822 ) . "\n";
										$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
								
									
									
									
									}
								
								}
								
							} 
							//-----------------------------------------------------------------------------------------------------------------------------------------//
							//all images in one post
							//-----------------------------------------------------------------------------------------------------------------------------------------//
							else {
							
							
								$imageCount = 0;
								
							
								
								//Check there are valid images to go in a post
								foreach($images as $image) {
								
									$account_image_exists = igp_functions::instagrate_id_exists($tag.'_'.$image['id'],'account');
									$image_exists = false;
									
									if ($dup_image == 'false') {
									
										$image_exists = igp_functions::instagrate_id_exists($image['id'],'image');
									}
									
									if ( $account_image_exists == false && $image_exists == false) {
									
															
										$debug .= "--CHECK instagrate_id: ".$tag.'_'.$image['id']." does not exist in wp_postmeta TRUE ". Date( DATE_RFC822 ) . "\n";
										$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
			
									
										if ($image['id'] != $account->lastid) {
										
											$debug .= "--CHECK imageid: ".$image['id']." != accounts last id: ".$account->lastid." TRUE ". Date( DATE_RFC822 ) . "\n";
											$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
			
											$imageCount ++;
											

											$debug .= "--IMAGE ID ADD TO ARRAY FOR GROUP POST imageid: ".$image['id']." ". Date( DATE_RFC822 ) . "\n";
											$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
			
											
							
															
										} else {
										
											//Image is the same as last posted
											$debug .= "--CHECK imageid: ".$image['id']." != accounts last id: ".$account->lastid." FALSE ". Date( DATE_RFC822 ) . "\n";
											$debug .= "--PROCESSING IMAGE SKIPPED ". Date( DATE_RFC822 ) . "\n";
											$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
								
										
										}
									
									} else {
									
										//Instagrate ID already exists in database wp_postmeta
										$debug .= "--CHECK instagrate_id: ".$tag.'_'.$image['id']." does not exist in wp_postmeta FALSE ". Date( DATE_RFC822 ) . "\n";
										$debug .= "--PROCESSING IMAGE SKIPPED ". Date( DATE_RFC822 ) . "\n";
										$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
								
									}
								
								}
								
								if ($imageCount > 0) {
								
									$debug .= "--CHECK ".$imageCount." Images valid to go into Post TRUE". Date( DATE_RFC822 ) . "\n";
									$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
									
									//Get all the static post info together
									$posttitle ='';
									//custom title
									$debug .= "--FUNCTION CHECK - Custom title: ";											
									$posttitle = igp_functions::get_custom_string($account->custom_title,'','title');
									if ($posttitle == '') {
										
										$debug .= "No Custom Title, use default ". $default_title." ". Date( DATE_RFC822 ) . "\n";
										$posttitle = $default_title;
										
									} else {
										
										$debug .= "Use Custom Title: ".$posttitle." ". Date( DATE_RFC822 ) . "\n";
									}
									
									
									$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
									
									$post_title = trim($posttitle);
									$post_content = '';
									
								
									//post date
									$debug .= "--FUNCTION CHECK - Post Date: ";	
									
									$postdategmt = date('Y-m-d H:i:s',current_time('timestamp',1));
									$postdate = date('Y-m-d H:i:s',current_time('timestamp',0));
									$debug .= "WP POST DATE ".$postdate." ". Date( DATE_RFC822 ) . "\n";
									$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
									
									$post_date = $postdate;
									$post_date_gmt = $postdategmt;
									
									$new_post = array(	'post_title' => $post_title,
														'post_content' => $post_content,
														'post_author' => $post_author,
														'post_category' => $post_category ,
														//'tags_input' => $post_tags,
														'post_status' => $post_status,
														'post_type' => $post_type,
														'post_date' => $post_date,
														'post_date_gmt' =>  $post_date_gmt
													 );
									
									$debug .= "--FUNCTION wp_insert_post TRUE ". Date( DATE_RFC822 ) . "\n";
									$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
		
									$postid = wp_insert_post( $new_post );
									
									//apply format if not standard
									$debug .= "--FUNCTION CHECK - Post Format: ";
									if ($account->post_format != 'Standard') {
										set_post_format( $postid , $account->post_format);
										$debug .= "FORMAT ".$account->post_format." ". Date( DATE_RFC822 ) . "\n";
									} else { $debug .= "FORMAT IGNORED "." ". Date( DATE_RFC822 ) . "\n";}
									$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
									
									//Loop through Images and build up post content and tags
									$count = sizeof($images);
									$i = 0;
									
									$postmetaids = '';
									$postmetaimageids = '';
									
									$posttags = array();
									
									$all_post_content = '';
																							
									foreach($images as $image) {
									
										if (!igp_functions::instagrate_id_exists($tag.'_'.$image['id'])) {
										
											$debug .= "--CHECK instagrate_id: ".$tag.'_'.$image['id']." does not exist in wp_postmeta TRUE ". Date( DATE_RFC822 ) . "\n";
											$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
				
										
											if ($image['id'] != $account->lastid) {
											
												$debug .= "--CHECK imageid: ".$image['id']." != accounts last id: ".$account->lastid." TRUE ". Date( DATE_RFC822 ) . "\n";
												$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
				
												$i ++;
												
	
												$debug .= "--START POSTING imageid: ".$image['id']." ". Date( DATE_RFC822 ) . "\n";
												$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
				
												$tag_helper = igp_functions::strip_hashtags($posttitle, $default_title );
												
												$posttitle = $image['title'];
												
												//post title
												$debug .= "--FUNCTION CHECK - Image title: ";
																						
												if ($account->title == 'true') {
												
													$debug .= "STRIP TAGS "." ". Date( DATE_RFC822 ) . "\n";
													$posttitle = $tag_helper[1];
												
												} else {
												
													$debug .= "TITLE REMAINS "." ". Date( DATE_RFC822 ) . "\n";	
													if ($posttitle == '') {
													
														$debug .= "Original Title Blank use default: ".$default_title." ". Date( DATE_RFC822 ) . "\n";
														$posttitle = $default_title;
													
													}
												
												} 
												
												$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
				
															
												//alt
												$alt = ' alt="'.$posttitle.'"';
												//title
												$title = ' title="'.$posttitle.'"';
												
												//post tags											
												$debug .= "--FUNCTION CHECK - Post Tags: ";	
												if ($account->tags == 'true') {
												
														$debug .= "CONVERT TO WP TAGS "." ". Date( DATE_RFC822 ) . "\n";
														$posttags = array_merge($posttags,$tag_helper[0]);
												
												} else {
												
														$debug .= "IGNORE HASHTAGS "." ". Date( DATE_RFC822 ) . "\n";
														$posttags = null;
												}
												$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
							
												$postmetaids .= $tag.'_'.$image['id'].', ';
												$postmetaimageids .= $image['id'].', ';									
											
				
												
												//image saving config
												$imgsrc = $image['image_large'];
												$debug .= "--FUNCTION CHECK - Image Saving: ";
												if ($account->image_saving == 'media' ){
												
													$debug .= "MEDIA LIBRARY"." ". Date( DATE_RFC822 ) . "\n";
													//put image from instagram into wordpress media library and link to it.
													$att_image = igp_functions::strip_querysting($imgsrc);
													$debug .= "--Attachment: ".$att_image." ". Date( DATE_RFC822 ) . "\n";
													//load into media library
													$attach_id = igp_functions::attach_image($att_image,$postid);
													$debug .= "--Attach Id: ".$attach_id." ". Date( DATE_RFC822 ) . "\n";
													//get new shot image url from media attachment
													$imgsrc = wp_get_attachment_url($attach_id);
													$debug .= "--Img SRC: ".$imgsrc." ". Date( DATE_RFC822 ) . "\n";
													
												} else {
												
													$debug .= "INSTAGRAM LINK"." ". Date( DATE_RFC822 ) . "\n";
												}
												$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
				
												
												//apply featured image if needed
												$debug .= "--FUNCTION CHECK - Featured Image: ";
												if ($account->feat_img == 'true' && $account->image_saving == 'media') {
												
													$debug .= "Set Featured TRUE ". Date( DATE_RFC822 ) . "\n";
													add_post_meta($postid, '_thumbnail_id', $attach_id);
													
												} else { $debug .= "Set Featured FALSE ". Date( DATE_RFC822 ) . "\n";}
												$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
				
	
												//only add image to post if configured
												$postimage = '';
												$debug .= "--FUNCTION CHECK - Post Image: ";
												if ($account->img_post == 'true') {
												
													$debug .= "--Include in Post TRUE ". Date( DATE_RFC822 ) . "\n";
													//image class
													$imageclass = '';
													
													if ($account->css != '') {
													
														$debug .= "--Set CSS TRUE ". Date( DATE_RFC822 ) . "\n";
														$imageclass = ' class="'.$account->css.'"';
													
													}
													
													//image size
													$imagesize = '';
													
													if ($account->size != '') {
													
														$debug .= "--Set Size TRUE ". Date( DATE_RFC822 ) . "\n";
														$imagesize =  ' width="'.$account->size.'"';
													
													}
													
													//image
													$postimage = '<img src="'.$imgsrc.'"'.$alt.$title.$imagesize.$imageclass.' />';
													
													//linking around image
													$url = $imgsrc;
													if ($account->link != 'no'){
													
														$debug .= "--Make a link TRUE ". Date( DATE_RFC822 ) . "\n";
														if ($account->link == 'page') {
															
															$debug .= "--Link to Instragram Page TRUE ". Date( DATE_RFC822 ) . "\n";
															$url = $image['url'];
														
														}
														
														$postimage = '<a href="'.$url.'" title="View Image">'.$postimage.'</a>';
													
													}
												
												
													$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
													
													//custom post content	
													$post_content = $account->custom_body;
													$debug .= "--FUNCTION CHECK - Custom Body: ";
													if ($post_content != '') {
														
														$debug .= "CUSTOM BODY EXISTS"." ". Date( DATE_RFC822 ) . "\n";
														//%%title%%
														$post_content = igp_functions::get_custom_string($post_content,$posttitle,'title');
														//%%image%%
														$post_content = igp_functions::get_custom_string($post_content,$postimage,'image');
														//%%username%%
														$post_content = igp_functions::get_custom_string($post_content,$image['username'],'username');
														//%%link%%
														$postlink = '<a href="'.$image['url'].'" title="'.$account->link_text.'">'.$account->link_text.'</a>';
														$post_content = igp_functions::get_custom_string($post_content,$postlink,'link');
														$post_content .= '<br/>';
													
													} else {
													
														$debug .= "NO CUSTOM BODY "." ". Date( DATE_RFC822 ) . "\n";
														$post_content = $postimage.'<br/>';
													}
													$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
																											
													
													//location map data
													$debug .= "--FUNCTION CHECK - Location: ";
													if ($account->location == 'true' && $image['location_lat'] != ""){
													
														$debug .= "Setting TRUE and Image has Location Data TRUE ". Date( DATE_RFC822 ) . "\n";
														
														//location map css class
														$location_class = '';
														if ($account->location_css != '') {
												
															$debug .= "--Location Class TRUE ". Date( DATE_RFC822 ) . "\n";
															$location_class = ' '.$account->location_css;
														}
														
														$debug .= "----LAT: ".$image['location_lat'].' '. Date( DATE_RFC822 ) . "\n";
														$debug .= "----LON: ".$image['location_lon'].' '. Date( DATE_RFC822 ) . "\n";
														$debug .= "----NAME: ".$image['location_name'].' '. Date( DATE_RFC822 ) . "\n";
														//add post meta for lon, lat, title
														add_post_meta($postid,'igp_latlon',$image['location_lat'].','.$image['location_lon']);
														
														$location = '[igp_get_map lat="'.$image['location_lat'].'" lon="'.$image['location_lon'].'" marker="'.$image['location_name'].'" class="'.$location_class.'" width="'.$account->location_width.'" height="'.$account->location_height.'"]<br/>';
												
														/*
														$location = '<div class="map_canvas'.$location_class.'" ';
														$location .= 'data-lat="'.$image['location_lat'].'" ';
														$location .= 'data-lon="'.$image['location_lon'].'" ';
														if ($image['location_name'] != '') {
															$location .= 'data-marker="'.$image['location_name'].'" ';
														}
														$location .= 'style="width: '.$account->location_width.'px; height: '.$account->location_height.'px;">';
														$location .= '</div>';
														*/

														$debug .= "----LOCATION OUTPUT: ".$location.' '. Date( DATE_RFC822 ) . "\n";
																										
														$post_content .= $location;
													
													} else { $debug .= "Setting FALSE and/ or Image has Location Data FALSE ". Date( DATE_RFC822 ) . "\n";}
													$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
					
													$all_post_content .= $post_content;
												
												}
								
																
											} else {
											
												//Image is the same as last posted
												$debug .= "--CHECK imageid: ".$image['id']." != accounts last id: ".$account->lastid." FALSE ". Date( DATE_RFC822 ) . "\n";
												$debug .= "--PROCESSING IMAGE SKIPPED ". Date( DATE_RFC822 ) . "\n";
												$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
									
											
											}
										
										} else {
										
											//Instagrate ID already exists in database wp_postmeta
											$debug .= "--CHECK instagrate_id: ".$tag.'_'.$image['id']." does not exist in wp_postmeta FALSE ". Date( DATE_RFC822 ) . "\n";
											$debug .= "--PROCESSING IMAGE SKIPPED ". Date( DATE_RFC822 ) . "\n";
											$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
									
										}
									
									}
									
									//apply custom meta to make sure the images won't get duplicated
									add_post_meta($postid,'instagrate_id',$postmetaids);
									
									//apply custom meta to make sure the images won't get duplicated by different accounts
									add_post_meta($postid,'instagrate_image_id',$postmetaimageids);
									
									
									//Gallery
									$debug .= "--FUNCTION CHECK - Gallery: ";
 
									if ($account->gallery == 'true' && $account->image_saving == 'media' ) {
										
										$debug .= "Gallery Setting TRUE". Date( DATE_RFC822 ) . "\n";
										$all_post_content = '[gallery]'.$all_post_content;
									}
									
									//credit link
									$all_post_content .= $pluginlink;
									
									//update the post with the tags and body
									$post_tags = $posttags;
									$post_content =$comment_credit.$all_post_content;
																		
									//update the post with content
									$update_post = array();
									$update_post['ID'] = $postid;
									$update_post['tags_input'] = $post_tags;
									$update_post['post_status'] = $post_status;
									$update_post['post_content'] = $post_content;
	
									// Update the post into the database
									wp_update_post( $update_post );
									$debug .= "--FUNCTION wp_update_post TRUE ". Date( DATE_RFC822 ) . "\n";
									$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
	
									
									
									$debug .= "--CHECK post config: ".$account->post_config." = schedule TRUE ". Date( DATE_RFC822 ) . "\n";
									$debug .= "--CHECK schedule config: ".$account->schedule_config." = group TRUE ". Date( DATE_RFC822 ) . "\n";
									$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
								
								} else {
									
									
									$debug .= "--CHECK ".$imageCount." Images valid to go into Post FALSE". Date( DATE_RFC822 ) . "\n";
									$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
									
									
								}							
							}


							//set last id
							$debug .= "--FUNCTION Update Last Id: ". $lastid." TRUE ". Date( DATE_RFC822 ) . "\n";
							$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
			
							$options[$tag.'_lastid'] = $lastid;
							igp_general_options::save_options($options);

						
						} else {
						
							
							$res = ($response) ? 'true' : 'false';
							//Check images array is set
							$debug .= "--CHECK Response: ".$res." - images is array and has Images FALSE ". Date( DATE_RFC822 ) . "\n";
							$debug .= "--PROCESSING STOPPED ". Date( DATE_RFC822 ) . "\n";
							$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
							$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
			
						
						}
						
						
						
						$debug .= "--PROCESSING END ". Date( DATE_RFC822 ) . "\n";
						$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
						$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
			
						
					} else {
					
						//Types and schedule doesnt match
						$debug .= "--CHECK account type: ".$account->post_config." = listener type: ".$type." FALSE ". Date( DATE_RFC822 ) . "\n";
						$debug .= "--CHECK account schedule: ".$account->schedule." = listener schedule: ".$schedule." FALSE ". Date( DATE_RFC822 ) . "\n";
						$debug .= "--PROCESSING STOPPED ". Date( DATE_RFC822 ) . "\n";
					
					}
					
					
					unset($account); 
				}
				
			} 
			
			else {
			
				//Accounts not array or false
				$debug .= "--CHECK account is array FALSE ". Date( DATE_RFC822 ) . "\n";
				$debug .= "--PROCESSING STOPPED ". Date( DATE_RFC822 ) . "\n";
				$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
				$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
			
			
			}
		
		} 
		
		else {
		
			//Page visited is not is_home page
			$debug .= "--CHECK Page is_home() FALSE ". Date( DATE_RFC822 ) . "\n";
			$debug .= "--PROCESSING STOPPED ". Date( DATE_RFC822 ) . "\n";
			$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
			$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
			
		
		}
		
		if ($debug_mode == 'true') {
				
			igp_debug::plugin_debug_write($debug);
			
		}
		
	}
	
	public function instagrate_listener_real() {
		
		self::instagrate_listener('real');
		
	}
	
	public function instagrate_listener_hourly() {
		
		self::instagrate_listener('schedule','hourly');
		
	}
	
	public function instagrate_listener_twicedaily() {
		
		self::instagrate_listener('schedule','twicedaily');
		
	}
	
	public function instagrate_listener_daily() {
		
		self::instagrate_listener('schedule','daily');
		
	}
	
	public function instagrate_listener_weekly() {
		
		self::instagrate_listener('schedule','weekly');
		
	}
	
	public function instagrate_listener_fortnightly() {
		
		self::instagrate_listener('schedule','fortnightly');
		
	}
	
	public function instagrate_listener_monthly() {
		
		self::instagrate_listener('schedule','monthly');
		
	}




}

?>