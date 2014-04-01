<?php
/**
 * @package   Quick_Featured_Images
 * @author    Martin Stehle <m.stehle@gmx.de>
 * @license   GPL-2.0+
 * @link      http://stehle-internet.de/
 * @copyright 2014 Martin Stehle
 *
 * @wordpress-plugin
 * Plugin Name:       Quick Featured Images
 * Plugin URI:        http://wordpress.org/plugins/quick-featured-images
 * Description:       Bulk set, replace and remove featured images
 * Version:           4.0
 * Author:            Martin Stehle
 * Author URI:        http://stehle-internet.de
 * Text Domain:       quick-featured-images
 * Domain Path:       /languages
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*
 * There is no frontend use of this plugin
 * so call it only in the backend
 *
 */
if ( is_admin() ) {
	require_once( plugin_dir_path( __FILE__ ) . 'public/class-quick-featured-images.php' );

	/*
	 * Register hooks that are fired when the plugin is activated or deactivated.
	 * When the plugin is deleted, the uninstall.php file is loaded.
	 *
	 */
	register_activation_hook( __FILE__, array( 'Quick_Featured_Images', 'activate' ) );
	register_deactivation_hook( __FILE__, array( 'Quick_Featured_Images', 'deactivate' ) );

	/*
	 * Load constants and some checks
	 *
	 */
	add_action( 'plugins_loaded', array( 'Quick_Featured_Images', 'get_instance' ) );

	/*
	 * Load the plugin core
	 *
	 */
	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-quick-featured-images-admin.php' );
	add_action( 'plugins_loaded', array( 'Quick_Featured_Images_Admin', 'get_instance' ) );

}
