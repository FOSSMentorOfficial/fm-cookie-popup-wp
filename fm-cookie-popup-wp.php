<?php
/*
Plugin Name: GDPR Cookie Maker
Text Domain: gdprcookiemaker
Domain Path: /languages
Description: A simple plugin to integrate a GDPR friendly cookie consent solution
Author: Wasif Younas
Version: 1.0.0
*/

if( ! defined( 'ABSPATH' ) ) {
    return;
}

define( 'PLUGIN_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'PLUGIN_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
//define( 'PLUGIN_URL', 'https://localhost/wp-test-project/public/wp-content/plugins/fm-cookie-popup-wp');


/* localize */
$textdomain_dir = plugin_basename( dirname( __FILE__ ) ) . '/languages';
load_plugin_textdomain( 'gdprcookiemaker', false, $textdomain_dir );


if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require __DIR__ . '/vendor/autoload.php';
}

/**
 * Run plugin
 *
 * @return void
 */
function cookiemaker_run_plugin() {
	GDPRCookieMaker\CI_Activation::init();
	GDPRCookieMaker\CI_Admin::get_instance();
	GDPRCookieMaker\CI_Public::get_instance();
	GDPRCookieMaker\CI_Iframe::get_instance();
}
add_action( 'plugins_loaded', 'cookiemaker_run_plugin' );


