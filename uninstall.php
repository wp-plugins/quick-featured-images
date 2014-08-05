<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package   Quick_Featured_Images
 * @author    Martin Stehle <m.stehle@gmx.de>
 * @license   GPL-2.0+
 * @link      http://stehle-internet.de
 * @copyright 2014 Martin Stehle
 */

// If uninstall not called from WordPress, then exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// remove settings
delete_option( 'quick-featured-images-settings' ); 
delete_option( 'quick-featured-images-defaults' ); 
