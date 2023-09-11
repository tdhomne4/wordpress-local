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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'nwp_db' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '!,9&j9lwV=XOv3`v, REwiuoW#F@fJ*yl?=rZhEX+?W4[031N{IY$Z?Hr 0*e|)a' );
define( 'SECURE_AUTH_KEY',  'pt1@fe~T.PB^/JQ{>1!cM9DU` .pSh^XTl+1)C%M<k,W>Oz1W)w][hg{GH:A%#52' );
define( 'LOGGED_IN_KEY',    'Udnb//kkW,}0j)Nwzo305|> D]5Hx/=l?`~I*4K,8:zc2:xr!@+%rV7Jo-1)U.,S' );
define( 'NONCE_KEY',        'W5NUdPs?W3ST@0}X=XDW%qCSlpq_SPKnvyAIM+Be41Qg^cDUSQcUbU{7$[!JD6Z:' );
define( 'AUTH_SALT',        '4CAk568p-&Fe.OSi#Y!(/hm}6PiQ~DMgGF$YiLKH{zL^x 6LQ6UKE@G&GSP.-aKJ' );
define( 'SECURE_AUTH_SALT', 'Nh,o99_Wlm3HK<D]|wb$4NXNP~E8 dBQs;WQ?~l(vCaiy19o*S2myB/tb6V?x%US' );
define( 'LOGGED_IN_SALT',   'AjRCGKCHnc[$N(q`V@TT__j8QbT_KnG/o(Q4A^u:[) 5[9>b7~w5W)?SB-x#V=E^' );
define( 'NONCE_SALT',       '~3#FDSqTkH Aqap2< M7KnZLn23ONJ7d{$!~>L0W-oAA[b6IjR:$zd3/nmaZ0,D2' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
	define('CONCATENATE_SCRIPTS',false);
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

define('FS_METHOD', 'direct');

// // /**Absolurte path to the Wordpress directory */
// // if(!defined('ABSPATH'))
// // define('ABSPATH',dirname(__FILE__) . '/');
// define('CONCATENATE_SCRIPTS',false);

define('ALTERNATE_WP_CRON', true);