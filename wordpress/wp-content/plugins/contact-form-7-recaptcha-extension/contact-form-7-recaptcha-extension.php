<?php
/*
Plugin Name: Contact Form 7 reCAPTCHA extension
Plugin URI: http://www.a-sd.de/
Description: Provides WP-reCAPTCHA possibilities to the Contact Form 7 plugin. Requires both.
Version: 0.0.12
Author: Andre Pietsch, Advicio (R) ServDesk GmbH
Email: andre.pietsch@a-sd.de
Author URI: http://www.a-sd.de
Text Domain: cf7recapext
Domain Path: /languages/
License: GPL2
*/

/*  Copyright 2011  Andre Pietsch, Advicio ServDesk GmbH (email: andre.pietsch@a-sd.de)
    
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.
    
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301
*/


// this is the 'driver' file that instantiates the objects and registers every hook

define('ALLOW_INCLUDE', true);

require_once('includes/CF7reCAPTCHA.class.php');

define('ASD_PLUGIN_FILE', __FILE__ );

$cf7_recaptcha = new CF7reCAPTCHA('cf7_recaptcha_options', 'cf7recapext');

register_activation_hook( __FILE__ , array($cf7_recaptcha, 'activate'));

?>