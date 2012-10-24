=== Instagrate Pro ===
Contributors: polevaultweb
Plugin URI: http://www.instagrate.co.uk/
Author URI: http://www.polevaultweb.com/
Tags: instagram, posts, integration, automatic, post, wordpress, posting, images
Requires at least: 3.0
Tested up to: 3.4.1
Stable tag: 0.3.1

The best plugin to integrate Instagram images with WordPress.

== Description ==

Instagrate Pro is a powerful WordPress plugin that allows you to integrate Instagram images into your WordPress site. You can connect multiple Instagram accounts and automatically post your images, feed images or all hashtagged images everytime someone visits your site or on a schedule.

Full features:

* Simple connection to Instagram. Login securely to Instagram to authorise this plugin to access your image data. **This plugin does not ask or store your Instagram username and password, you only log into Instagram.**
* Unlimited Instagram accounts including duplicates that can post recent, feed and all hashtagged images.
* Hashtag filtering of your own images and those in the feed. So if you only want certain images on your blog tag the #wp for example.
* Control the last image posted for own and feed images.
* Post images everytime your site is visited or on a schedule using the WordPress cron scheduler.
* Schedules are hourly, twicedaily, daily, weekly, fortnightly and monthly.
* Post every image as its own post, group multiple images into one post or post to the same post, page or custom post type. Helpful for those weekly Instagram round ups.
* You can strip hashtags from the title and you have the option to convert them to post tags.
* Select which WordPress user will be the author of the posts.
* Select which WordPress category to post to.
* Configure if the post is automatically published or set to draft for review.
* Post image as a custom post type. Select post, page or any other post type you have set up.
* Select a post format if your theme supports them.
* Configure the date of the post as either the date and time it was created on Instagram or when the post is created in WordPress.
* Select how the image is used in the post. You can save the image to the media library or just link to the Instagram image.
* Create featured images when the image is saved to the media library.
* Create galleries of images when the images are saved to the media library and you select posts multiple images as on post.
* Control if the image is actually put in the post content. Turn this off if you want just a featured image or gallery (for multiple images) as the post.
* Set the image as a link. Select where that link goes to - the image (helpful for fancybox) or the original Instagram page.
* Set the image size and CSS class.
* Configure if you want to show a Google Map for images that have been geotagged with location data.
* Set the map's height, width and CSS class.
* Enter custom text for the post title, using the template tag %%title%% to position the Instagram title.
* Enter custom text for the post body, using the template tag %%title%%, %%image%%, %%username%%, %%date%%, %%location%% and %%link%% to position the Instagram title, image, date, location and link to Instagram Page.

If you have any issues or feature requests please visit and use the [Support Forum](http://www.polevaultweb.com/support/forum/instagrate-pro-plugin/)

== Installation ==

This section describes how to install the plugin and get it working.

1. Delete any existing `instagrate-pro` folder from the `/wp-content/plugins/` directory.
2. Upload `instagrate-pro` folder to the `/wp-content/plugins/` directory.
3. Activate the plugin through the 'Plugins' menu in WordPress.
4. Go to the Instagrate Pro menu item under the 'Settings' menu and connect your Instagram accounts and set the rest of configuration you want.

To update the plugin either use the automatic updater or manually follow these steps:

1. Deactivate the plugin through the 'Plugins' menu in WordPress.
2. Delete any existing `instagrate-pro` folder from the `/wp-content/plugins/` directory.
3. Upload `instagrate-pro` folder to the `/wp-content/plugins/` directory.
4. Activate the plugin through the 'Plugins' menu in WordPress.

== Changelog ==

= 0.3.1 = 

* Fix - Reinstated post meta for location data.
* Fix - Custom post text with %%title%% now showing correctly if custom title was also set.

= 0.3 =

* New - Continual posting of images to the same post, page or custom post type.
* New - Image link option to open in new window.
* New - New template tag for Instagram image taken date - %%date%%.
* New - New template tag for Instagram location name for geotagged images - %%location%%.
* Improvement - Custom body text now allows HTML content.
* Improvement - Warning if cURL extension not installed. This is a prerequisite of the plugin.
* Fix - The plugin's settings are now only visible to administrators.
* Fix - Post is only published once image is set. This is a fix for users with auto social posting plugins who weren't seeing images in their social posts.
* Fix - Small warning in updater.
* Fix - Removed post meta for location data as this is stored in shortcode in the post body.

= 0.2.2 =

* New - New template tag for Instagram username - %%username%%
* New - Added better custom body text support for mulitple images in single posts.
* Fix - Removes error message if hashtagging selected but no tag inputted, or tag has no photos.
* Fix - Changed the way the Google Maps are saved and displayed using shortcodes to avoid stripping of HTML tags by WordPress.
* Misc - Amends code comment before post to remove links, leaving just plugin name and version for troubleshooting.

= 0.2.1 =

* Fix - Strips emojis but keeps foreign characters in the Instagram image title.
* Fix - Last image Id not updating correctly.
* Fix - Debug.txt was getting deleted on check to see if write permissions existed.

= 0.2 =

* New - Automatic plugin updates!
* New - Option to override is_home() check setting on automatic posting if themes do not have a set blog page.
* New - Option to allow duplicate posting of images by separate accounts. By default images will only ever get posted once.
* New - Accounts display info if the Instagram servers are down.
* Fix - Posting issues if Instagram server is down.
* Fix - PHP notices on has_cap and get_theme.
* Fix - Removed nested form bugs for browser compatibility.
* Fix - Checks for write permissions on debug.txt file and displays message if not writeable.

= 0.1.1 =

* Fix - extended schedules (weekly and longer) not being run.
* Fix - custom / default post title for grouped image posts.
* Fix - removed special characters from post titles.

= 0.1 =

* First release, bugs expected.

== Frequently Asked Questions ==

= I have an issue with the plugin =

Please visit the [Support Forum](http://www.polevaultweb.com/support/forum/instagrate-pro-plugin/) and see what has been raised before, if not raise a new topic.

== Disclaimer ==

This plugin uses the Instagram(tm) API and is not endorsed or certified by Instagram or Burbn, inc. All Instagram(tm) logoes and trademarks displayed on this website are property of Burbn, inc.