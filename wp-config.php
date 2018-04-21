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
define('DB_NAME', 'u4228831_wp468');

/** MySQL database username */
define('DB_USER', 'u4228831_wp468');

/** MySQL database password */
define('DB_PASSWORD', '1S2-.pTUS8');

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
define('AUTH_KEY',         'cgs9lv00zqntsdtqckhywmlvioycog2prirhysoasv0rpdrj5yot6m89k1whgzyc');
define('SECURE_AUTH_KEY',  '5ahojfi8uusczrvp36xkazjhz9ubfnfp83lcggsafhdv11rqbalqjibyqsururln');
define('LOGGED_IN_KEY',    'zc58sp4lbasyl7k28i6oucm5vwcffya8qcih3zbhqplyt7vgeg0s6mbcq5sesgor');
define('NONCE_KEY',        '7lwkr0dhftrz9ioqcesnc96tc6ralolatbwtmwuxck2f6lvjmcvdxomctcokq0zb');
define('AUTH_SALT',        'k1hpc7fw566qysxzgojdagbaiq8aqkddiz5d8fueyc6bhhr08rqkuobme68dxaiz');
define('SECURE_AUTH_SALT', '4qbklhqfbmlwmznsipeov5f3feeqx0yofinxypm9cwq0dnsshkrgnzy8heqtm8uk');
define('LOGGED_IN_SALT',   'hdcplmt48kgvgvg4fjtqdjxsxdmkesunfentkqpwq1uxsvudnlh0in92dfk81x0m');
define('NONCE_SALT',       'psidu05kxlks0obo7zwkecevv814qyaeume1yov3wodsycc4hqjfyocjnge2jtls');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpv9_';

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
