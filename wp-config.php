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
define('DB_NAME', 'fyfe');

/** MySQL database username */
define('DB_USER', 'sunbeardigital');

/** MySQL database password */
define('DB_PASSWORD', 'qzKzh;VBVBiLBba62F');

/** MySQL hostname */
define('DB_HOST', 'sun-bear-digital.cxlcqhulom1z.ap-southeast-2.rds.amazonaws.com');

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
define('AUTH_KEY',         '~YbBC_.626,ZreUR+3m,k`Gq-,t=xB5`F0|3m]caLkA`p*{)y7!&&`m~.^QuEXOK');
define('SECURE_AUTH_KEY',  'QaH;z+(m{?nVf?I#QIRrJV/d(Ngw@`sOC[4-HF[^!pijA&6s VnZtWjXSh+|ESsp');
define('LOGGED_IN_KEY',    'OvrxyqJ%W-r5j@lesI&D7uH]kN@0bx<=Y[Rf*V2Yc-m_CzEP)ht+[S/ /$9R/ipT');
define('NONCE_KEY',        'ueN^#fH$NwylNAb`b>Syt!iEK{sih)}?/aGC ]8_W?.#?<FC*eg8$TUI3Br9=X0O');
define('AUTH_SALT',        'Iq!4gcjh96})_K/vR[n_iIe[3rYjF$1$@n_%d)W&AF$q&d{VbgI G-(Mj43-UL]s');
define('SECURE_AUTH_SALT', '(OlxnYItAnnP)pinu( FVr<Q/Hq6$p8)v9.NTx;}-?][mzjpX1_6LAgM19IpeWy:');
define('LOGGED_IN_SALT',   'j}^oYBvk7+mxr([(nJ-)s3mUVacwe?Onzcj2x~nN%if85q3KO;`E]dgt^yS#Xx>m');
define('NONCE_SALT',       'E.GD_C,p~ 1Y DGlhpI)jtuXsh?a|*zfNng>@2B1@0~NgvOj^,k(4k||hNw 3bB=');

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
// define( 'DISALLOW_FILE_EDIT', true );

