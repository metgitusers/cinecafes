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
define( 'DB_NAME', 'cinecafes_wp' );

/** MySQL database username */
define( 'DB_USER', 'cinecafes_wpu' );

/** MySQL database password */
define( 'DB_PASSWORD', 'B8K$^BE[{p3Z' );

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
define( 'AUTH_KEY',         'Wn%t^}_$/%X>2e&j>!58f{1q4[^Sg#%<=1AH?H?lA#FI)r:&7#w?(43( N^+RGHU' );
define( 'SECURE_AUTH_KEY',  'O5{aWsSZL&Ii6FC+=^pNSIqx4J+WS;-9&Sl/O4oeE+!M)Ui&laQ&um3Rs9_b-^b ' );
define( 'LOGGED_IN_KEY',    ';Gasx=*@9.*svi@j9(nCbry<mjg}b:sdoaTm,#qY{2`/(]7$gp,$}x{M|^L#4T[1' );
define( 'NONCE_KEY',        'E!|;i%[oUby)LRQQ3J}J-3R]8-Et|mh*f4*? O8tWtamfs^%V/fbeCFO H,.7{[?' );
define( 'AUTH_SALT',        '=(1)1@ha6cs5xfoaxX8|25jX&bGUmgK&db@esP,h}%<tE$Fc<Q`,YIJ/k_5(Tiat' );
define( 'SECURE_AUTH_SALT', 'FoaV<3()8>{/eMj<sekB6K*tsASV(~(=TXNgl<3PZhk~@bz;POeAbf!QO}HbE6>.' );
define( 'LOGGED_IN_SALT',   '>Sl(d!^wPJlLko22F6+NXmxh~R-v5+U|[HC9>RD+9hy~jraT8E1R>VMkTf2!W9!y' );
define( 'NONCE_SALT',       'zq/__c9O]2z^HB9sChMLYV^uQ{uM6&%2+uh%!5eGCOh4ZQApPVW_BcSt-Z(;TC.A' );

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
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
