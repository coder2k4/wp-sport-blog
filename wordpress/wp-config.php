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
define( 'DB_NAME', 'wp_sportisland' );

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
define( 'AUTH_KEY',         'Vn_Rn=_ (ofSsd_8i#okO*qG#c?gmShO|9:..zh6aHfau?ez.NQl?t&oR0lnHHa4' );
define( 'SECURE_AUTH_KEY',  'e*>:b!S!xNHhsV^$|X_B.g%$y]7wV<y0tl r,cN >:F0a$O;&,_Uh6O7nZrq$R-<' );
define( 'LOGGED_IN_KEY',    'xR}GCOC-e8{=u!6PIlk,#6rNVHRY#AH1*L96yGJ_6^sKY7y6g@B45PO_=,nrNpA4' );
define( 'NONCE_KEY',        '9dNlnsVHd7JgtAsr<PE(px .Fg?zms.$YL7T~&uR_5BtNz%q#Ns~Q;C+}&xLA]po' );
define( 'AUTH_SALT',        'y:NWVp9 t#I<5o@bnv)1sdA%Zi#ER^h>j(^SSojX1mC[OKJpXeXfdI*VMsjMes~:' );
define( 'SECURE_AUTH_SALT', '@2x1kMU~k)DKG_<Su2Id_aCp}.n:&Z;0[iObD$^8%fN&j[,C9+m01)?ZXTI<QZyc' );
define( 'LOGGED_IN_SALT',   'yeIuEUPA~2i72AsP?SlBn6luKc6v+m2/iZ6d1x?BNaH&JE{X2n|eY A2^nT*,/_`' );
define( 'NONCE_SALT',       '}M=ls GR$hSR;Q-m&KS6QVn{`th:k]kg)g5Dt X_cv:ME#Dh2M&j!6DQubeI`w,A' );

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
