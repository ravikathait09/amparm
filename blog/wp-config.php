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
define('DB_NAME', 'amparm');

/** MySQL database username */
define('DB_USER', 'amparm');

/** MySQL database password */
define('DB_PASSWORD', 'foobarbaz');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'vynk?,^Qf7<|1K_)|t}lytWM}Z`QF1SL ;H!Feh_#;,#2!ooG>{JZ)l$ANlB$X@)');
define('SECURE_AUTH_KEY',  '8s;Oa0aTfn; c}GO?gEGEkVdYS,keQ0iJ Jdkz+2hu3Lz/UQupQ%8>n_|=U)[zE|');
define('LOGGED_IN_KEY',    'sjI-D&MHUIN||D7wY` u~)b[6RXlI=ro3eZq|pR!y](]%j]Ndsj-D_kv^|>_qFK3');
define('NONCE_KEY',        '68}|7>4a>{ac[ QR%PAQl.j]<f;+@tN]=%0|g1Kw|/7X?Yr?_LsT5@!-Xnu&ap&F');
define('AUTH_SALT',        'Z{%oo,}2,zo4~_`:+W3orDzXLm-Q[[;3yp{R~G(gVmJ:df+qMZnFa_69i].Pq^c7');
define('SECURE_AUTH_SALT', 'k5vK|:|IepF{d>@UfVux9/2OXG]?Rm;-:7~ ;{fuYm?vTD6|Xh.K+vd=)%,z#--1');
define('LOGGED_IN_SALT',   'si71IcK&M6wdPEqP5};`g.j)+0p+!zn80(<|}!0@jY7h^.m_`u 9Vfz6Nl5!hoe@');
define('NONCE_SALT',       '{}PS<1!TAuMF60S6L3n-*< T_8<]C. 2(AEXP?g8*n~kn8c3VHs!Vl;7`CnA$PRM');

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
