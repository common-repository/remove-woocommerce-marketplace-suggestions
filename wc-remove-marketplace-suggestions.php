<?php
/*
Plugin Name: Remove WooCommerce Marketplace Suggestions
Description: Completely removes the WooCommerce 'Marketplace Suggestions' from WP admin
Version: 1.0.0
Author: Lawrie Malen
Author URI: http://www.verynewmedia.com/
Copyright: Lawrie Malen
Text Domain: wc-remove-marketplace-suggestions
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
WC requires at least: 3.5.0
WC tested up to: 3.6.0
*/

///
//	Create version option on activation
///

if (!defined('VNM_WC_REMOVE_MARKETPLACE_SUGGESTIONS')) {
	define('VNM_WC_REMOVE_MARKETPLACE_SUGGESTIONS', '1.0.0');
}

function vnmRemoveWCMPS_install() {
	update_option('vnmRemoveWCMPS_version', vnmRemoveWCMPS_VERSION);
}

register_activation_hook(__FILE__, 'vnmRemoveWCMPS_install');

///
//	Kill version option on activation
///

function vnmRemoveWCMPS_deactivate() {
	delete_option('vnmRemoveWCMPS_version');
}

register_deactivation_hook(__FILE__, 'vnmRemoveWCMPS_deactivate');

///
//	Update plugin
///

function vnmRemoveWCMPS_versionCheck() {
	if (get_option('vnmRemoveWCMPS_version') != vnmRemoveWCMPS_VERSION) {
		vnmRemoveWCMPS_install();
	}
	
	if (!defined('WC_VERSION')) {
		//	Do nothing - WooCommerce is not available
	} else {
		add_filter('woocommerce_allow_marketplace_suggestions', '__return_false');
	}
}

add_action('plugins_loaded', 'vnmRemoveWCMPS_versionCheck');

?>