<?php

require_once IGP_PVW_PLUGIN_PATH.'lib/admin/account-options.php';
require_once IGP_PVW_PLUGIN_PATH.'lib/admin/admin-options.php';

class igp_account {

	public $id;
	public $userid;
	public $username;
	public $access;

	public $instagram_options;
	public $hashtag;
	public $lastid;
	public $image_saving;
	public $post_config;
	public $schedule_config;
	public $schedule;
	public $gallery;
	public $title;
	public $tags;
	public $post_author;
	public $post_category;
	public $post_status;
	public $post_type;
	public $post_format;
	public $post_date;
	public $feat_img;
	public $img_post;
	public $link;
	public $size;
	public $css;
	public $location;
	public $location_width;
	public $location_height;
	public $location_css;
	public $custom_title;
	public $custom_body;
	public $link_text;
	

	public function __construct($id,$options) {
	
		$acc = igp_account_options::get_account($id);
	
		$this->id = $id;
		$this->userid = $acc['userid'];
		$this->username = $acc['username'];
		$this->access = $acc['access'];
		
		$shortcode = IGP_PVW_PLUGIN_SHORTCODE;
		
		$tag = $shortcode.'_'.$id.'_'.$this->userid;
			
		$this->instagram_options = $options[$tag.'_instagram_options'];
		$this->hashtag = $options[$tag.'_hashtag'];
		$this->lastid = $options[$tag.'_lastid'];
		$this->image_saving = $options[$tag.'_image_saving'];
		$this->post_config = $options[$tag.'_post_config'];
		$this->schedule_config = $options[$tag.'_schedule_config'];
		$this->schedule = $options[$tag.'_schedule'];
		$this->gallery = $options[$tag.'_gallery'];
		$this->title = $options[$tag.'_title'];
		$this->tags = $options[$tag.'_tags'];
		$this->post_author = $options[$tag.'_post_author'];
		$this->post_category = $options[$tag.'_post_category'];
		$this->post_status = $options[$tag.'_post_status'];
		$this->post_type = $options[$tag.'_post_type'];
		$this->post_format = $options[$tag.'_post_format'];
		$this->post_date = $options[$tag.'_post_date'];
		$this->feat_img = $options[$tag.'_feat_img'];
		$this->img_post = $options[$tag.'_img_post'];
		$this->link = $options[$tag.'_link'];
		$this->size = $options[$tag.'_size'];
		$this->css = $options[$tag.'_css'];
		$this->location = $options[$tag.'_location'];
		$this->location_width = $options[$tag.'_location_width'];
		$this->location_height = $options[$tag.'_location_height'];
		$this->location_css = $options[$tag.'_location_css'];
		$this->custom_title = $options[$tag.'_custom_title'];
		$this->custom_body = $options[$tag.'_custom_body'];
		$this->link_text = $options[$tag.'_link_text'];
	
	}
	
	

}

?>