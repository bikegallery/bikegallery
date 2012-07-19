===WP To Top===
Contributors: asvin balloo
Donate link: http://htmlblog.net
Tags: post, posts, scroll, top, yui
Requires at least: 2
Tested up to: 2.7
Stable tag: 1.0

This plugin will add a "Back to top" link automatically to your blog.

== Description ==

This plugin will add a "Back to top" link automatically to your blog. It features a smooth scrolling effect powered by the YUI library and customizable options.

By [Asvin Balloo](http://htmlblog.net/).

Supported features:

* Smooth scrolling animation, powered by the YUI library
* Customizable options via the admin panel
* Works on almost all browsers including IE6 (yes!)
* No need to add any markup to your theme

== Installation ==

1. Extract wptotop.zip in the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to **Settings** and then **WP To Top** to configure the plugin.

== Screenshots ==
1. Configuration page
2. WP To Top

== Frequently Asked Questions ==

= I have activated the plugin but nothing appears... =

Make sure you have the following code in your theme's footer.php :
`<?php wp_footer(); ?>`

If not, go to Design >> Theme Editor >> Select "footer.php" from right hand list >>  and paste `<?php wp_footer(); ?>` just before the '</body >' tag.


= I found a bug... =

Do it via my blog - http://htmlblog.net/ - enjoy!

== Changelog ==

Version: 1.0 (5 Mar 2009)

 * Initial Release