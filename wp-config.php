<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
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
define('DB_NAME', 'tonjoo_wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');


define('FS_METHOD', 'direct');

// define('DISABLE_WP_CRON', true);

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'xtrg`#w;9].|RiJ^(.1(3) lV4#@:3nAqZ![Ca-x[Ps3ZVMzkhoSPT?QoXq[pc0j');
define('SECURE_AUTH_KEY', 'jL>} J5/8Hc%34BD6KI(|++UXmw.nN+b/mKzu<,fp?5]F:l5x!ZWG4+qMx:;4bNJ');
define('LOGGED_IN_KEY', '6K]k{L0E%oiUaI,#C{~>+7nh(q&I^K;*H+-9^=1*h,^Jtg^ DWlGH]qZ]QRz->2w');
define('NONCE_KEY', '&(SySN~sXA95GfGp6L~iA+fvP=!~Xqy34`Gt<=XxEIBe7v>wb;+=:1nlKU]~Z!6B');
define('AUTH_SALT', '?:%hH_lsOb2kN*DjZvZNz:?57z3%>M|LA%x|Yc]UuI&4)O7s1aNs<s&vICV%S|pJ');
define('SECURE_AUTH_SALT', '<X+DOVZoma-:0tb$E-6QV(qLpD2: U[$eh]AKY:$Xzn{C5Z)@!THs0y3uG,Es[L2');
define('LOGGED_IN_SALT', ',WhtX3Wf/|6B.%dS|?6OkloW^W! oTFi6.l1YXm5yk-v1y MQ]3[vQm)I}#IY#*t');
define('NONCE_SALT', '>M&DgqnP&lI[`/_~9/x2.y(C(I@g,_p~<q)X+]sm0$I7~.-W7yOQExcQP3zSnD.y');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_tonjo';

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
define('WP_DEBUG', false);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (! defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
