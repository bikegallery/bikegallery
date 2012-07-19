<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'bikegallery');

/** MySQL database username */
define('DB_USER', 'jbritton');

/** MySQL database password */
define('DB_PASSWORD', 'BikeGallery*1974');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'N=H2ba&||+(S@_]:g61txQ@u/[DaZK+S%:.{Zmq5]opJRYZ|7v%e50oYfNl><A9`');
define('SECURE_AUTH_KEY',  'Ld!Nb71p5Cgw[(fA+ak`3a=lr/jGQgrsQVj:C+.}E|ExJn/-yLru*+[*`m7Q3HR(');
define('LOGGED_IN_KEY',    '*+$PX*dW<N:(8kJDH#BS!#?yn5<f%e8KYG+E!4D-*:kJoS^Bx9*:S=o-1u-|UVCu');
define('NONCE_KEY',        '!{^A.)1g*+A+)`4{XxFH}siG&_}E.*yb>QNE :M~;@Mr~t||}/)+p814-u7iWKMf');
define('AUTH_SALT',        'd1|aU7Arf8`+g{+e|=-!RY5v-u;i&`k>-y.wu#M&9.0fj4BJzV{qC^gf-%/QMue{');
define('SECURE_AUTH_SALT', 'dmN50=Ul#-5|zC*K,GIh=3pF`HE%/@Y6z+1=c4dt$5}~KMAlt6FK<1[<ximJr^>I');
define('LOGGED_IN_SALT',   'cExI+S;-+]n[!#I@`H=ngi2aSS/Gw8m,s_`0>6W*?|/6{-AsLoMS-1Q[jkBT@JtE');
define('NONCE_SALT',       '~r2clR999uj8=%Ix*r>Bjp-0ZkjQ7# HbBoY>1H:M`a};$mr*C[z(GG^9Yy[BwXB');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

