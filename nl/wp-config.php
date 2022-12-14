<?php
define( 'WP_CACHE', true ); // Added by WP Rocket

//define( 'WP_CACHE', true ); // Added by WP Rocket

define( 'WP_CACHE', false /* Modified by NitroPack */ ); // Added by WP Rocket
define( 'WP_DEBUG', true );
define('WP_DEBUG_LOG',true);
@ini_set('memory_limit','9999M');
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
define( 'DB_NAME', 'testtomassotablescom_wp' );
/** MySQL database username */
define( 'DB_USER', 'testtomassotablescom_wp' );
/** MySQL database password */
define( 'DB_PASSWORD', '86a4XEzC3Jx8xOCq' );
/** MySQL hostname */
define( 'DB_HOST', 'localhost:3306' );
/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );
/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '*`Puian32cwdkbg@-jD/C]!+ij-@^9>^Qop+%-o-!x6|z 160~fJ|>R@BQeETv6M');
define('SECURE_AUTH_KEY',  '*9[y8wWyh7+VH4^lW-@mz7xA%z`+n/d8z_pl71-9#:F 5$P#+a-p-NzERSOS{hPf');
define('LOGGED_IN_KEY',    'sm>&j^kVIwUn56-%XH(FV4lkiB8>jBT[>GQ?+8X#E$VF&R=S+ly]qB2aH I$J(>(');
define('NONCE_KEY',        '$d- {9:q+( `xNDjWD)5i+<o5l1p-w-k iAtQf@x.tc*|:TE) hXx4L*:3-NO)/!');
define('AUTH_SALT',        'dcupj)0~KYM:VA];(!Nt5(l/,loj<f9*+lv1D ZNJTQi[$3pr^jQO|uc(6-Tb;^X');
define('SECURE_AUTH_SALT', '++w8-Manl4,xx0NS(Q04qYb7IF{;2MD/r_nLXzO]&-Be(u!q7z;^WD-/ELxphoxO');
define('LOGGED_IN_SALT',   'l&/Osg+,aw!qiF%WOdp_QF=95fQ@G `^i,33S+%*WKQtQEbFkR.W+H-=,f+n?OO(');
define('NONCE_SALT',       '|KuNx<2+],r4#O? >Ui/lB^?99?L_Fa_2rnYEV48]y=H{WT&.:72afdR?qvhAx3m');
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

define( 'WP_HOME', 'https://test.tomassotables.com/nl' );
define( 'WP_SITEURL', 'https://test.tomassotables.com' );

//update_option( 'siteurl', 'https://test.tomassotables.com/nl' );
//update_option( 'home', 'https://test.tomassotables.com/nl' );

//define('WP_ALLOW_MULTISITE', true);
/* That's all, stop editing! Happy publishing. */
/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}
/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
