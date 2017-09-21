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

switch ($_SERVER['HTTP_HOST']) {
  case 'boilerplate-wordpress.ac.dsdev':
    define('ENV', 'dev');
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'boilerplate-wordpress');
    define('DB_USER', 'remote');
    define('DB_PASSWORD', 'blahblahblah');
    define('WP_HOME','http://boilerplate-wordpress.ac.dsdev');
    define('WP_SITEURL','http://boilerplate-wordpress.ac.dsdev');
  break;

  case 'boilerplate-wordpress.ads.dsdev':
    define('ENV', 'localhost');
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'boilerplate-wordpress');
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'root');
    define('WP_HOME','http://boilerplate-wordpress.ads.dsdev');
    define('WP_SITEURL','http://boilerplate-wordpress.ads.dsdev');
  break;
}

define('DB_CHARSET', 'utf8');
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
define('AUTH_KEY',         '@7biI`+XLaKYKB;KSNgy%S1W;Ipc7^$&u7*]Vs3$[s|8;/-!NJ_s4^JXnTE&Dd,K');
define('SECURE_AUTH_KEY',  '#m6R <- pI?Sci,h&= 2Xv=SKM)h-SC@$8hkY<L5]ZK6h>vggs8rOeglUdQ$!n,i');
define('LOGGED_IN_KEY',    'WE:<[|@rV{[9L-XI(E~xsM5k]k&r{Y]o-(E`o=Z(R.d@<aLyP^ZDNd *o-~!,_6X');
define('NONCE_KEY',        '>Tag.X|A3|[l+jw4e~@Zx414q(J|]]zR}A7D2>,8D)iOr-xMI@Ml>.tH@yQ.4&P1');
define('AUTH_SALT',        ' 77[Gn;+xWw=xkhgRv65c!T31qqk>@>Q8Ly<Up<*F[9y<kX4~=|A8cOqy(v~wzyw');
define('SECURE_AUTH_SALT', 'u%}tT*(.U)/G<~_+<8<z9HT5{R|8u|]D8ME>.LD8nK;1}CX<}Z~xo{N1$cIo932%');
define('LOGGED_IN_SALT',   'kw{YUsl|Mkm0RmS[$6+RazkSPM]iTKc+UH_UeR}v&(alhT1(R]5|<.!!+3!P Q0,');
define('NONCE_SALT',       'PLfZMHzNv,z>+zmYk> ~b`ux1U-p$uqX.s,I!+!c^mULwxPt0zX$EtB-t8kY|AK1');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';


## Disable Editing in Dashboard
define('DISALLOW_FILE_EDIT', true);

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
