<?php
  /*
   Plugin Name: Proxy & VPN Blocker
   description: Proxy & VPN Blocker. This plugin will prevent Proxies and VPN's accessing your site's login page or making comments on pages & posts using the Proxycheck.io API
   Version: 1.3.1
   Author: RickstermUK
   Author URI: https://profiles.wordpress.org/rickstermuk
   License: GPLv2
   */

$version = '1.3.1';

if ( version_compare( get_option('proxy_vpn_blocker_version'), $version, '<' ) ) {
    update_option( 'proxy_vpn_blocker_version', $version );
}

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
// Load plugin class files
require_once( 'includes/class-proxy-vpn-blocker.php' );
require_once( 'includes/plugin-options.php' );

// Load plugin libraries
require_once( 'includes/lib/class-proxy-vpn-blocker-admin-api.php' );

/**
 * Returns the main instance of proxy_vpn_blocker to prevent the need to use globals.
 *
 * @since  1.0
 * @return object proxy_vpn_blocker
 */
function proxy_vpn_blocker () {
    global $version;
	$instance = proxy_vpn_blocker::instance( __FILE__, $version );

	if ( is_null( $instance->settings ) ) {
		$instance->settings = proxy_vpn_blocker_Settings::instance( $instance );
	}

	return $instance;
}

proxy_vpn_blocker();



function disable_pvb_file_exists() {
    if ( is_file( ABSPATH . 'disablepvb.txt') ) {
        ?>
        <div class="error notice">
            <p><?php _e( 'Proxy & VPN Blocker is currently not protecting your site, disablepvb.txt exists in your WordPress root, please delete it!', 'proxy-vpn-blocker' ); ?></p>
        </div>
    <?php
    }
}

add_action( 'admin_notices', 'disable_pvb_file_exists' );

/**
* proxycheck integration
*
* @since 1.0
* @Updated 1.3.0
*/
function proxycheck_integrate(){
    if ( !is_file( ABSPATH . 'disablepvb.txt') ) {
        if ( get_option('pvb_proxycheckio_CLOUDFLARE_select_box') == "" && isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $Visitor_IP_Address = $_SERVER["HTTP_CF_CONNECTING_IP"];
        } else {
            $Visitor_IP_Address = $_SERVER["REMOTE_ADDR"];
        }
        include_once "proxycheckio-api-call.php";
        $proxycheckdenied = get_option('pvb_proxycheckio_denied_access_field');
   
        $blockedcountries = get_option('pvb_proxycheckio_blocked_countries_field');
        if ( isset($blockedcountries) && is_array($blockedcountries) ) { $Perform_Country_Check = 1; } else { $Perform_Country_Check = 0; }
   
        $proxycheck_answer = proxycheck_function($Visitor_IP_Address, $Perform_Country_Check);
        if ( $proxycheck_answer[0] == 1 ) {
            define( "DONOTCACHEPAGE", true ); // Do not cache this page
            wp_die( '<p>' . $proxycheckdenied . '</p>', $proxycheckdenied, array( 'back_link' => true ) );
        }
   
        if ( $Perform_Country_Check == 1 && in_array($proxycheck_answer[1], $blockedcountries)) {
            define( "DONOTCACHEPAGE", true ); // Do not cache this page
            wp_die( '<p>' . __( 'Your country, ', 'proxy-vpn-blocker' ) .  $proxycheck_answer[1] . __( ', is blocked from viewing this page or website.', 'proxy-vpn-blocker' ) . '</p><p><strong>' .  __( 'Access Denied', 'proxy-vpn-blocker' ) . '</strong></p>', $proxycheckdenied, array( 'back_link' => true ) );
        }
        // No proxy has been detected so set a transient to cache this result and then return false.
        set_transient( "pvb_" . $Visitor_IP_Address, time()+1800 . "-" . 0, 60 * 30 );
    }
}


/**
* For WooCommerce Account Login page we have to do something different to make it look nice.
*
* @since 1.0.2
* @Updated 1.3.0
*/
function proxycheck_woocommerce_integrate(){
    if ( !is_file( ABSPATH . 'disablepvb.txt') ) {
        if ( get_option('pvb_proxycheckio_CLOUDFLARE_select_box') == "" && isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $Visitor_IP_Address = $_SERVER["HTTP_CF_CONNECTING_IP"];
        } else {
            $Visitor_IP_Address = $_SERVER["REMOTE_ADDR"];
        }
        include_once "proxycheckio-api-call.php";
        $proxycheckdenied = get_option('pvb_proxycheckio_denied_access_field');
   
        $blockedcountries = get_option('pvb_proxycheckio_blocked_countries_field');
        if ( isset($blockedcountries) && is_array($blockedcountries) ) { $Perform_Country_Check = 1; } else { $Perform_Country_Check = 0; }
   
        $proxycheck_answer = proxycheck_function($Visitor_IP_Address, $Perform_Country_Check);
        if ( $proxycheck_answer[0] == 1 ) {
            $html = '<p>' . $proxycheckdenied . '</p>' . "\n";
            $html .= '<div class="woocomerceformremove" style="display: none;"' . "\n";
            echo $html;
        }
        if ( $Perform_Country_Check == 1 && in_array($proxycheck_answer[1], $blockedcountries)) {
            $html = '<p>' . __( 'Your country, ', 'proxy-vpn-blocker' ) .  $proxycheck_answer[1] . __( ', is blocked from viewing this page or website.', 'proxy-vpn-blocker' ) . '</p><p><strong>' .  __( 'Access Denied', 'proxy-vpn-blocker' ) . '</strong></p>' . "\n";
            $html .= '<div class="woocomerceformremove" style="display: none;"' . "\n";
            echo $html;
        }
        // No proxy has been detected so set a transient to cache this result and then return false.
        set_transient( "pvb_" . $Visitor_IP_Address, time()+1800 . "-" . 0, 60 * 30 );
    }
}

/**
* activation switch to enable or disable querying. @since 1.1.0
*/
if ( get_option('pvb_proxycheckio_master_activation') == "on") {
	/**
	* WordPress Auth protection and comments protection. @since 1.0
	*/
	add_filter( 'authenticate', 'proxycheck_integrate', 1);
	add_filter( 'login_head', 'proxycheck_integrate', 1);
	add_action( 'pre_comment_on_post', 'proxycheck_integrate', 1);
	/**
	* WooCommerce Support for aesthetics. @since 1.0.2
	*/
	add_filter( 'woocommerce_before_customer_login_form', 'proxycheck_woocommerce_integrate', 1);
	/**
	* Enable for all pages option
	*/
	if ( get_option('pvb_proxycheckio_all_pages_activation') == "on") {
		add_action( 'plugins_loaded', 'proxycheck_integrate', 1);
	}
} else if ( get_option('pvb_proxycheckio_master_activation') == "") {
	//do nothing
}
?>