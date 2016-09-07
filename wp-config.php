<?php
# Database Configuration
define( 'DB_NAME', 'snapshot_dimagi' );
define( 'DB_USER', 'dimagi' );
define( 'DB_PASSWORD', '3FhELf3uOzScyt8r' );
define( 'DB_HOST', '127.0.0.1' );
define( 'DB_HOST_SLAVE', '127.0.0.1' );
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');
$table_prefix = 'wp_';

# Security Salts, Keys, Etc
define('AUTH_KEY', '(d4!B Ee4`L9n*#jcGzj&<rGg7| eRL#zO-%%b+*rg1qUX{7QWW&kP.?`3rDv}O!');
define('SECURE_AUTH_KEY', 'R@J4ubkVPMjGf-}I}X%VWR3:XvDn2p4*bS3&62-H/627=&qLHjGbV6CJI+4Jqew$');
define('LOGGED_IN_KEY', 'tw-QFM+~o=>D|oQ+^%wWSR:#Oyor=U]C$<|LaStDw`kM5|^|Y?>3z1*rsG-9,,p=');
define('NONCE_KEY', 'dfHuJ61c a$@VK!+je@*s1EetxAr(Ow<mH.QNiW}G3+NI(~Y&OT,-GWk1HD`dHqQ');
define('AUTH_SALT',        'qa$_BII"4{Lf_EQuPC07<iP}@a~MqN9:yG73<nc)[/pXaKl?p["wZ]?WwYp+[MDz');
define('SECURE_AUTH_SALT', '`ml$C/!=B(Yu+{X:@9{NdFv+PmoAglm"U"-mi3rR^]Ri.o%?ObTcUJzWd^9$Ti^G');
define('LOGGED_IN_SALT',   'SD3E"Ny0swgM|}2Wy>g6v6g!p?OYfezR`t~t-w]p<_1oWNYj4cf04{-q]2fIMK|t');
define('NONCE_SALT',       ' W09k.qiiD~IsI(t[zvt!^pf*snf>9AnAw6tZ[i3;p92?jnQBzuX(+RhSCS,t-Lz');


# Localized Language Stuff

define( 'WP_CACHE', TRUE );

define( 'PWP_NAME', 'dimagi' );

define( 'FS_METHOD', 'direct' );

define( 'FS_CHMOD_DIR', 0775 );

define( 'FS_CHMOD_FILE', 0664 );

define( 'PWP_ROOT_DIR', '/nas/wp' );

define( 'WPE_APIKEY', '8e5c457647504a6e3b3fe8d1eb0d73216be3a7fc' );

define( 'WPE_FOOTER_HTML', "" );

define( 'WPE_CLUSTER_ID', '41252' );

define( 'WPE_CLUSTER_TYPE', 'pod' );

define( 'WPE_ISP', true );

define( 'WPE_BPOD', false );

define( 'WPE_RO_FILESYSTEM', false );

define( 'WPE_LARGEFS_BUCKET', 'largefs.wpengine' );

define( 'WPE_CDN_DISABLE_ALLOWED', true );

define( 'DISALLOW_FILE_EDIT', FALSE );

define( 'DISALLOW_FILE_MODS', FALSE );

define( 'DISABLE_WP_CRON', false );

define( 'WPE_FORCE_SSL_LOGIN', false );

define( 'FORCE_SSL_LOGIN', false );

/*SSLSTART*/ if ( isset($_SERVER['HTTP_X_WPE_SSL']) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on'; /*SSLEND*/

define( 'WPE_EXTERNAL_URL', false );

define( 'WP_POST_REVISIONS', FALSE );

define( 'WP_TURN_OFF_ADMIN_BAR', false );

define( 'WPE_BETA_TESTER', false );

umask(0002);

$wpe_cdn_uris=array ( );

$wpe_no_cdn_uris=array ( );

$wpe_content_regexs=array ( );

$wpe_all_domains=array ( 0 => 'dimagi.com', 1 => 'dimagi.wpengine.com', 2 => 'staging.dimagi.com', 3 => 'www.dimagi.com', );

$wpe_varnish_servers=array ( 0 => 'pod-41252', );

$wpe_ec_servers=array ( );

$wpe_largefs=array ( );

$wpe_netdna_domains=array ( );

$wpe_netdna_push_domains=array ( );

$wpe_domain_mappings=array ( );

$memcached_servers=array ( );

define( 'WPE_WHITELABEL', 'wpengine' );

define( 'WP_SITEURL', 'http://dimagi.staging.wpengine.com' );

define( 'WP_HOME', 'http://dimagi.staging.wpengine.com' );

define( 'WP_AUTO_UPDATE_CORE', false );

$wpe_special_ips=array ( 0 => '45.79.164.41', );

$wpe_netdna_domains_secure=array ( );

define( 'WPE_CACHE_TYPE', 'generational' );

define( 'WPE_LBMASTER_IP', '45.79.164.41' );

define( 'WPE_SFTP_PORT', 2222 );
define('WPLANG','');

# WP Engine ID


define('PWP_DOMAIN_CONFIG', 'www.dimagi.com' );

# WP Engine Settings






# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');

$_wpe_preamble_path = null; if(false){}
