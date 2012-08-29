<?php

require_once IGP_PVW_PLUGIN_PATH.'lib/admin/account-options.php';
require_once IGP_PVW_PLUGIN_PATH.'lib/functions/functions.php';
//require other php files for API handlers etc
require_once IGP_PVW_PLUGIN_PATH.'lib/api/instagram.php';

class igp_instagrate {

	
	public function apiCheck(){
	    
	  $instagram = new igp_Instagram(IGP_CLIENT_ID, IGP_CLIENT_SECRET, null);
	   
	  $response = array();
	  
	  try {
	   
	  	$instagram->get('');
	   	$response[0] = 1;
	   	$response[1] = '';
	   
	   } catch(igp_InstagramApiError $e) {
									
		  $response[0] = 0;
		  $response[1] = $e->getMessage();
			
	   }
	   
	   return $response;

 
    }
	
	
	public function get_images($account) {
					
		$debug = '';
		
		$instagram = new igp_Instagram(IGP_CLIENT_ID, IGP_CLIENT_SECRET, $account->access);
					
		switch ( $account->instagram_options) {

			 case 'all':
				$get = 'users/'. $account->userid.'/media/recent';
				$param = 'min_id';
				break;
			case 'feed':
				$get = 'users/self/feed';
				$param = 'min_id';
				break;
			case 'hashtag':
				$get = 'tags/'. $account->hashtag.'/media/recent';
				$param = 'min_tag_id';
				break;
			
		}
		
		$images = array();
		$data = array();
		
		$response = false;
		
		//get last media id
		$lastid = $account->lastid;	
		$new_lastid = 0;	
		
		
		try {
		
			
			$last_image_id = $account->lastid;
			
			if($account->instagram_options != 'hashtag') {
				
				if (!self::check_media_exists($account->id, $last_image_id)) {
				
					$rtn_last_id = self::get_last_id($account->id,$account->instagram_options,null);
					$last_image_id = $rtn_last_id[0];					
				}
				
			}
			
			
			$params =  array($param => $last_image_id );
			
			$debug .= "--Param Last Id: ".$last_image_id."\n";
			$debug .= "--GET: ".$get."\n";
			$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
		
			
			$data = $instagram->get($get, $params);
			
			$imgCount = 0;
			if (isset($data->data)) { 
			
				$imgCount = sizeof($data->data); 
				$imgdata = $data->data;
			}
			
			$debug .= "--Images got: ".$imgCount."\n";
			$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
				
	
			
			if (isset($data) && isset($imgdata) ) {
			
				foreach ($imgdata as $item) {
				
					if ($new_lastid == 0 ) { $new_lastid = $item->id; }
				
				}
					
				foreach($data->data as $item):
											
					$new_image = array(
										"id" => $item->id,
										"title" => (isset($item->caption->text)? igp_functions::strip_title($item->caption->text):""),
										"image_small" => $item->images->thumbnail->url,
										"image_middle" => $item->images->low_resolution->url,
										"image_large" => $item->images->standard_resolution->url,
										"created" => $item->created_time,
										"username" => (isset($item->user->username)?$item->user->username:""),
										"location_lat" => (isset($item->location->latitude)?$item->location->latitude:""),
										"location_lon" =>(isset($item->location->longitude)?$item->location->longitude:""),
										"location_name" => (isset($item->location->name)?$item->location->name:""),
										"location_id" => (isset($item->location->id)?$item->location->id:""),
										"url" => $item->link,
										"likes" => $item->likes->count,
										"comments" => $item->comments->count
									);		
					
					
					if ($account->instagram_options != 'hashtag' && $account->hashtag != '') {
					
						//check title contains the hashtag
						$has_hash = strpos($new_image['title'],$account->hashtag);
						
						if ($has_hash === false) {
						
							//ignore out of the array
							$debug .= "--CHECK Hashtag exists in title ".$new_image['title']." FALSE "."\n";
							$debug .= "--Image Id ".$new_image['id']."\n";
							$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
							
						} else {
						
							$debug .= "--CHECK Hashtag exists in title ".$new_image['title']." TRUE "."\n";
							$debug .= "--Image Id ".$new_image['id']."\n";
							$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
							
							$images[] = $new_image;
							
						}
					
					
					} else {
					
						$images[] = $new_image;
					
					}
					
								
				endforeach;
				
				
				$debug .= "--Total Images returned: ".sizeof($images)."\n";
				$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
			
				$orderByDate = array();
					
				//order array by earliest image
				foreach ($images as $key => $row) {
					$orderByDate[$key]  = strtotime($row['created']);
				}

				array_multisort($orderByDate, SORT_ASC, $images);
			
				//Last id
				if ($account->instagram_options == 'hashtag') {
				
					$pagin = $data->pagination;
					//var_dump($pagin);
					if (isset($pagin->min_tag_id)) {
						$lastid = $pagin->min_tag_id;
					} else {
					
						$lastid = $account->lastid;
					
					}
				} else {
					
					$lastid = $new_lastid;
					
				}
				
				$debug .= "--New Last Id : ".$lastid ."\n";
				$debug .= "------------------------------------------------------------------------------------------------------------------------------------------\n";
				$response = true;		
				
		
			}
		
		} catch(igp_InstagramApiError $e) {
									
			$debug .= "--".$e->getMessage() ."\n";
			$response = false;
		}
		
		$return = array();
		$return[0] = $images;
		$return[1] = $lastid;
		$return[2] = $debug;
		$return[3] = $response;
		
		return $return;
		
	}
	
	
	
	public function get_img_title($id, $mediaid) {
			
		
		$account = igp_account_options::get_account($id);
		
		$access = $account['access'];
		$userid = $account['userid'];
		
		$instagram = new igp_Instagram(IGP_CLIENT_ID, IGP_CLIENT_SECRET, $access);
					
		$get = 'media/'.$mediaid;
		
		try {
		
			$data = $instagram->get($get);
			
			$item = $data->data;
			
			$title = isset($item->caption->text)? igp_functions::strip_title($item->caption->text):"";
	
		
		} catch(igp_InstagramApiError $e) {
						
			$title = $e->getMessage();
					
		
		}
		
		return $title;
		
	}
	
	public function check_media_exists($id, $mediaid) {
			
		
		$account = igp_account_options::get_account($id);
		
		$result = false;
		
		$access = $account['access'];
		$userid = $account['userid'];
		
		$instagram = new igp_Instagram(IGP_CLIENT_ID, IGP_CLIENT_SECRET, $access);
					
		$get = 'media/'.$mediaid;
		
		try {
		
			$data = $instagram->get($get);
			
			$result = true;
	
		
		} catch(igp_InstagramApiError $e) {
						
			$result = false;
		}
		
		return $result;
		
	}

	
	



	public function get_last_id($id, $type = 'all', $hashtag = null) {
			
		$lastid = array();
		
		$account = igp_account_options::get_account($id);
		
		$access = $account['access'];
		$userid = $account['userid'];
		
		$instagram = new igp_Instagram(IGP_CLIENT_ID, IGP_CLIENT_SECRET, $access);
					
		switch ($type) {

			 case 'all':
				$get = 'users/'.$userid.'/media/recent';
				break;
			case 'feed':
				$get = 'users/self/feed';
				break;
			case 'hashtag':
				$get = 'tags/'.$hashtag.'/media/recent';
				break;
			
		}
		
		try {
		
			$data = $instagram->get($get);
			
			$images = array();
			
			if (isset($data)) {
			
				foreach($data->data as $item):
											
							$images[] = array(
								"id" => $item->id,
								"title" => (isset($item->caption->text)?igp_functions::strip_title($item->caption->text):"")
							);				
			
				endforeach;
			
			}
			
			if (isset($images[0]["id"])){
							
				$lastid[0] =  $images[0]["id"];
				$lastid[1] =  $images[0]["title"];
			
			} else {
			
				$lastid[0] = 0;
				$lastid[1] = '';
			}
		
		} catch(igp_InstagramApiError $e) {
						
			$lastid[0] = 0;
			$lastid[1] = '';
					
		
		}
		
		return $lastid;
		
	}
	
	public function get_recent_images($id, $type = 'all', $hashtag = null) {
			
		$account = igp_account_options::get_account($id);
		
		$access = $account['access'];
		$userid = $account['userid'];
		
		$instagram = new igp_Instagram(IGP_CLIENT_ID, IGP_CLIENT_SECRET, $access);
					
		switch ($type) {

			 case 'all':
				$get = 'users/'.$userid.'/media/recent';
				break;
			case 'feed':
				$get = 'users/self/feed';
				break;
			case 'hashtag':
				$get = 'tags/'.$hashtag.'/media/recent';
				break;
			
		}
		
		$images = array();
		
		try {
		
			$data = $instagram->get($get);
			
						
			if (isset($data)) {
			
				foreach($data->data as $item):
											
					$title = (isset($item->caption->text)?igp_functions::strip_title($item->caption->text):"");
					$title = igp_functions::truncateString($title,80);
					
					$images[$item->id] = $title;	
			
				endforeach;
			
			}
		
		} catch(igp_InstagramApiError $e) {
									
			$images[] = $e->getMessage();
		
		}
		
		return $images;
		
	}
	


}


?>