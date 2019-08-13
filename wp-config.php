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
define('DB_NAME', 'portfolio2');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '.].@Yto%QV6xlxHRU*jJe@dEPN==e)GjZ=w`L!^=o:zsp,CsUN@?VIhC6 8b>}R/');
define('SECURE_AUTH_KEY',  '/Z`9^Kr]$a`I,X}YT2Q<]Q|t18R6^AOBi_o:w3M7JSd|-YL;KO<C_+bUCIjZt<_2');
define('LOGGED_IN_KEY',    '@hh)l.4Ji-Bu;N-ewv-rQ9Y,+$K8dA&C<a[Sw:}y[XN-C*z%!J{@f@YX8^c+ilI5');
define('NONCE_KEY',        'IrXwV!>azokEl@X6R3|Kq6|$_/l|Cp)h_K,7d,~D&<~cdGK7X[3YV)489K1^uv8/');
define('AUTH_SALT',        'v5t~c!nEk93>|iY8%t1#7iI>qQ724CsGk5}O?~FZky!0rt%]T{^*XrU?(DkBD|wv');
define('SECURE_AUTH_SALT', 'ebp1 |{zwuUH2#jShxqz:p{exv9oy}_9>fDqy8Hk~=l;jyW>]}h<;Gk!I~a@G<()');
define('LOGGED_IN_SALT',   '9S}E-9xWT[{-5bo]rN[2[n)>}f[#?R1#hW*NEe(,cjpIa>EWJ^6`d1m^d$%I9i/^');
define('NONCE_SALT',       'EBxxZf^^jLpquS]8MqUwAF8du^A6D;fs}xF+W=c9tX}dG+A<%u+LlN4T6)c[?nIP');

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
define('WP_DEBUG', true);
define('WP_DEBUG_DISPLAY', false);
define('WP_DEBUG_LOG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
