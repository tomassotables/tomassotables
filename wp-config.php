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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'testneobuilder' );

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
define( 'AUTH_KEY',         ';GJw/fx/}tUc%V]uJN0oFNlPgqLpjtEpz[3)j%b_&L0]t~gY4O{R^2WqX;v_0h<M' );
define( 'SECURE_AUTH_KEY',  '^YPzu ~!T|2)L=:FfD3;dPY>:y_A0NaIte4k:5gbE69F_8Cafa|C5gfhC1{r31Xx' );
define( 'LOGGED_IN_KEY',    'D M:-^W}=[lrv+5nuS2Fq/:AH~k2L;U2WCAkGwP92X.OjSHmc=VYX}JQqr-`z;}+' );
define( 'NONCE_KEY',        'vy9P/8^$uDg@6T![2A?wU!9Xe{x,H=pfn 9RS4EU^{ehgYd(hpEFBA%Mmtt3dFJO' );
define( 'AUTH_SALT',        '!7Pc9&;gN[|QtF9@0iL|aE}1E8;.>YFq-buX|Hm_29|qZA&{`;l&XXStu19J?^j ' );
define( 'SECURE_AUTH_SALT', 'L`%-Jt[FEK4ewxw,d?<.vnJ19@[0)IiOHTr;l3;a%HPrbXS?iQ;VE(~7uf? Y@88' );
define( 'LOGGED_IN_SALT',   'ig-Q&|WXAop[,Z`KxVUUg=GihcR~n&O0)OC<gMyMrWN~=*mKf! %ux-E/Sp;V(#6' );
define( 'NONCE_SALT',       '2j/u1=Y~pp;o4*3@BNxC<QOa}&qqMYdcPGQrutv]VJ2U#CLS(JlA/=tcC@ia$nC-' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );
define('FS_METHOD', 'direct');

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
