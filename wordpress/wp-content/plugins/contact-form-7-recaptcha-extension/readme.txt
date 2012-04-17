=== Contact Form 7 reCAPTCHA Extension ===
Contributors: pitschi
Donate link: http://www.a-sd.de
Tags: Contact Form 7, Contact, Contact Form, CAPTCHA, reCAPTCHA, BWP reCAPTCHA, Better WordPress reCAPTCHA, WP-reCAPTCHA
Requires at least: 2.9
Tested up to: 3.3
Stable tag: 0.0.12

This plugin provides a new tag for the Contact Form 7 Plugin. It allows the usage of a reCAPTCHA field provided by a reCAPTCHA Plugin.

== Description ==

Contact Form 7 is an excellent WordPress plugin and the CF7 reCAPTCHA Plugin makes it even more awesome by adding reCAPTCHA capabilities.
In the past this functionality has been provided by a recaptcha module offered by the developer of CF7 which this plugin is based on. 

The Problem with the module was that it had to be copied into the modules directory every time the Contact Form 7 plugin was updated. 
That was bad. 

Therefore we decided that it would be nice to have a plugin that can be installed and mantained independedly from the CF7 plugin and its modules.

**IMPORTANT**
Some time ago the WP-reCAPTCHA plugin vanished from the WordPress plugin repository for a while. 
We had to use the Better WordPress reCAPTCHA Plugin instead. 
**So we can now use the one or the other reCAPTCHA tool.**
You can decide which one suits you and install it. 
If both reCAPTCHA tools are installed WP-reCAPTCHA is preferred at the moment.
This can change.
There will be a switch in a later version so you can decide which plugin should be used.

You can use your reCAPTCHA API keys with Better WordPress reCAPTCHA. 
Copy your keys from the WP-reCAPTCHA plugin settings and paste them into the Better WordPress reCAPTCHA plugin.



= Requirements =

* You need the [Contact Form 7](http://wordpress.org/extend/plugins/contact-form-7/ "Contact Form 7 Plugin") plugin to be installed and activated.
* You need at least one of the following plugins to be installed and activated:
** [WP-reCAPTCHA](http://wordpress.org/extend/plugins/wp-recaptcha/ "WP-reCAPTCHA Plugin")
** [Better WordPress reCAPTCHA](http://wordpress.org/extend/plugins/bwp-recaptcha/ "Better WordPress reCAPTCHA Plugin")

If both reCAPTCHA plugins are installed WP-reCAPTCHA is preferred.

= Settings = 

The settings of the installed reCAPTCHA plugin are used by default.

You can change that behaviour on the settings page of the plugin under:

*Settings* -> *CF7-reCAP Extension*


= Feedback =

If you like the plugin **please rate** it. If you don't like it, **please contact us** so we can address the problem or feature request. 

This plugin is provided as is by the [Advicio(R) ServDesk GmbH](http://www.advicio-servdesk.de/en "Advicio(R) ServDesk GmbH").

== Installation ==
1. Make a backup of your current installation
1. Make sure you fit the requirements
1. Download and unpack the download package
1. Upload the `contact-form-7-recaptcha-extension` folder to the '/wp-content/plugins/' directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. You will now have a "reCAPTCHA" tag option in the Contact Form 7 tag generator

= Usage =
1. On the actual Contact Form 7 configuration page, next to the "Form Box" with code in it, use the drop down click on Generate Tag
1. Choose *reCAPTCHA* (**not** CAPTCHA) 
1. copy the code that it gives you
1. past it into the "Form Box" where the existing code is
(thx to GGITech)

If you like the plugin **please rate** it. If you don't like it, **please contact us** so we can address the problem or feature request.


== Screenshots ==

1. The new reCAPTCHA option.
2. The property form for the reCAPTCHA field.
3. The reCAPTCHA tag in the form editor.
4. The reCAPTCHA in the finished form.
5. The configuration page under *Settings* -> *CF7-reCAP Extension* (version 0.0.8) 


== Changelog ==

= Known Issues = 
* at the moment it is only possible to have ONE reCAPTCHA per page. 
So if you activated reCAPTCHA for comments or some other stuff on the page there
will be problems. Found some possibilities to fix this but have to test and
implement them. (thx to huyz)
* there could be a problem with the hint for the administrator. Could not 
confirm that on 4 test instances but will check the code for that. (thx to webcoreinc)

= 0.0.12 (20111216) =
* NEW: WP-reCAPTCHA is back again. We support both WP-reCAPTCHA and Better WordPRess reCAPTCHA now.
* FIX: reCAPTCHA for registered users (thx to Rautenfreund)

= 0.0.11 (20111214) =
* FIX: WP-reCAPTCHA not available anymore. Switched to Better WordPress reCAPTCHA (thx to manfer)
* TEST: up to WP 3.3 and CF7 3.0.1

= 0.0.10 (20110704) = 
* FIX: some misconfiguration

= 0.0.9 (20110704) =
* FIX: an error within the IE if the recaptcha is not shown. (thx to darinm)
* FIX: an error with the multisite. Options are at the moment only stored by blog. Will add a site wide option later. (thx to huyz, robpoe)
* FIX: some usage description (thx to GGITech)

= 0.0.8 (20110623) =
* FIX: some basic translation issues
* FIX: some corrections in the German translation

= 0.0.7 (20110623) =
* NEW: added options to set the language and theme for the reCAPTCHA forms in CF7 (thx to tuxradio, Bramblz)
* NEW: German translation
* some minor code corrections

= 0.0.6 (20110616) = 
* added some code regarding the WP-reCAPTCHA settings
* the language setting of WP-reCAPTCHA is used
* the theme is the same as the theme for the comments set in the WP-reCAPTCHA options
(working on some detailed settings behavior for version 0.1.0 comming soon) 
* thx to tuxradio

= 0.0.5 (20110525) =
* corrected an error with the admin notices 
* thx to cookies131

= 0.0.4 (20110525) =
* another stupid error

= 0.0.3 (20110525) =
* hookup did not work corectly
* validation had errors
* thx to DoctorDR

= 0.0.2 (20110524) =
* some minor textual changes

= 0.0.1 (20110524) =
* initial version


== Upgrade Notice ==

= 0.0.12 = 
WP-reCAPTCHA is back again. Now we support both WP-reCAPTCHA and Better WordPress reCAPTCHA. But only one at a time. If both are installed WP-reCAPTCHA is preferred at the moment. We recommend an update.

= 0.0.11 = 
WP-reCAPTCHA was not available for some time. We decided to use Better WordPress reCAPTCHA. We recommend an update.

= 0.0.10 = 
Fixed some misconfiguration. We recomend an update.

= 0.0.9 = 
Fixed a bug with the IE and the multisite. We recomend an update.

= 0.0.8 = 
Corrected some basic translation issues and some minor things in the german translation. We recomend an update.

= 0.0.7 =
Made some minor code corrections. Added options to set language and theme. Added a German translation. We recomend an update.

= 0.0.6 = 
Made some changes regarding the theme and language settings of the WP-reCAPTCHA plugin. We recomend an update if you use these settings. 

= 0.0.5 =
An error hooking the admin notices lead to a warning. We recomend an update.

= 0.0.4 =
There was another stupid little error that did not happen in the false validation. We recomend an update.

= 0.0.3 = 
There were some major bugs that should have been corrected. We recomend an update.

= 0.0.2 = 
Has only some minor textual changes. No update necessary.


