<?php

/**
 * 
 * This file runs when the plugin in uninstalled (deleted).
 * This will not run when the plugin is deactivated.
 * Ideally you will add all your clean-up scripts here
 * that will clean-up unused meta, options, etc. in the database.
 *
 */

// If plugin is not being uninstalled, exit (do nothing)
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Delete Options
$options = array(
	'proxy_vpn_blocker_version',
	'pvb_proxycheckio_master_activation',
	'pvb_proxycheckio_API_Key_field',
	'pvb_proxycheckio_CLOUDFLARE_select_box',
	'pvb_proxycheckio_VPN_select_box',
	'pvb_proxycheckio_TLS_select_box',
	'pvb_proxycheckio_TAG_select_box',
	'pvb_proxycheckio_Custom_TAG_field',
	'pvb_proxycheckio_denied_access_field',
	'pvb_proxycheckio_Days_Selector',
	'pvb_proxycheckio_all_pages_activation'
);
foreach ( $options as $option ) {
	if ( get_option( $option ) ) {
		delete_option( $option );
	}
}
?>