<?php
/**
 * The WordPress Plugin Boilerplate.
 *
 * A foundation off of which to build well-documented WordPress plugins that
 * also follow WordPress Coding Standards and PHP best practices.
 *
 * @package   WP_GCM
 * @author    Varun Srinivas <me@varun1505.com>
 * @license   GPL-2.0+
 * @link      http://varun1505.com
 * @copyright 2013 SudoSaints
 *
 * @wordpress-plugin
 * Plugin Name:       WordPress push notificaions for Android via GCM
 * Plugin URI:        http://varun1505.com/wpgcm
 * Description:       WordPress push notificaions for Android via GCM
 * Version:           1.0.0
 * Author:            Varun Srinivas
 * Author URI:        http://varun1505.com
 * Text Domain:       wp-gcm
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/varun1505/wp-gcm-push-notifications.git
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/

require_once( plugin_dir_path( __FILE__ ) . 'public/class-wp-gcm.php' );

/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 *
 */
register_activation_hook( __FILE__, array( 'WP_GCM', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'WP_GCM', 'deactivate' ) );

add_action( 'plugins_loaded', array( 'WP_GCM', 'get_instance' ) );

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

/*
 * The code below is intended to to give the lightest footprint possible.
 */
if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-wp-gcm-admin.php' );
	add_action( 'plugins_loaded', array( 'WP_GCM_Admin', 'get_instance' ) );
}


/*
 * Include all the external classes required
 */
 
require_once( plugin_dir_path( __FILE__ ) . 'includes/class-response.php' );
require_once( plugin_dir_path( __FILE__ ) . 'includes/class-push-message.php' );