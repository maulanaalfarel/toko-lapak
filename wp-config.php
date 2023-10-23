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
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'db_tokoonline' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         'Jo `zCW^W?k*K-=n,XL*= .C,yVXZ|4RH.~!@`B^nclxN.e_B[o$@fu~:&KHdNKd' );
define( 'SECURE_AUTH_KEY',  'q*-dEhszO9hiIzcF[![THuGo&[feu_F)0OX+lQGa,7)w]X>f7WLI]GN4sPx.8d4N' );
define( 'LOGGED_IN_KEY',    'D+$CLaV`.eX[u@dbEx0_#Tz] UZ]XCWP;r*W)uXDQn{q0n[:v7Tx)1NQE#vD!w]P' );
define( 'NONCE_KEY',        'Nd7YYN0fKhI%}7[=Xr_?Bm`r;Gk+`;NW|<0-:zcnWFF a$O%GXwfU8(*zj,]fXUN' );
define( 'AUTH_SALT',        'ff**4f.Vic)UYx?8z(t(;CQq:bT4`?bJWNMEbDMR.Cg<5cD OOrSjLyG8&]2~C]!' );
define( 'SECURE_AUTH_SALT', '<,B(ku:`qHibW2b%RzE;o:4 D/!9Z?C?4)@+1-LuAPv,WsF9cz|&*!hxx6EYpeuv' );
define( 'LOGGED_IN_SALT',   'w%z%BL%cXVDQNBHn.yT+w{iL;?6{etpIAU}&n(#QP8V61*i[o[t{]<zPbS/L TyV' );
define( 'NONCE_SALT',       'e-@vxp+Ty=5J<qNkgA!E}$w-x9*!Tk8pvk`!(c#H(T5Sym#4{4<g<f#!]t)euena' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
