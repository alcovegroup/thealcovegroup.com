<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'alcove_wp_database');

/** MySQL database username */
define('DB_USER', 'alcovewordpress');

/** MySQL database password */
define('DB_PASSWORD', '68eVoqjiPSBg');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/* Multisite */
// define( 'WP_ALLOW_MULTISITE', true );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '~[z@i{I.I(-4soe:M||dd-cWa&c5w+&LouyV@`^l`JuKk`Xef.rdJ&T4A@:_UCh^');
define('SECURE_AUTH_KEY',  'A0|OS{Mwl:(0FWD2#0H1)>6Cs$%SAkG})qhbliZQFc6boKOoY:!>nJz)vC&yU#^R');
define('LOGGED_IN_KEY',    '^jjjxE_u)UnXB`eF56NE,aKSH$bEV3M C*c@_+KFP3M?z_X`tWJ90o)g2/R57 jE');
define('NONCE_KEY',        'f!3PVr1e0NEN2rD7^3h}XKp`ou59kVQ{`E?vY?i!2?l P3G>Mw#-nec)zA:H*3mG');
define('AUTH_SALT',        'KN52sG|hs;hq5TXAhKrsX?6oYm=n-_P7ruF4 [Mx)9~%:mt@?xmNdKl2p] H$-gS');
define('SECURE_AUTH_SALT', '-]+eZI/F<$ue#ywi-&E+4ZfMhl%3$MUm+L+F;^P<Pgf~m*2Q3Qb+4n^SbP^!|Q4d');
define('LOGGED_IN_SALT',   'B&6(@tM!HE9/*d-dh#p/cAFTk~`b?{#p&)iKdRj(6bgOJT8-A7[tj3qxh$_?-bue');
define('NONCE_SALT',       'zB?VIAHsmE@`^i?[{j6CVY*}Npu4V-7$+cVfti|uCC9?ARVf9,VZV~xmKjvxh|Y-');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);
define('WP_DEBUG_LOG', false);
define('WP_DEBUG_DISPLAY', false);

define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', getenv('CURRENT_DOMAIN'));
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
