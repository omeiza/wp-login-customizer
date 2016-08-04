<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * Plugin Name: WP Login Customizer
 * Description: A plugin to help you customize the background and logo image of your wordpress login screen
 * Version: 1.0
 * Authoe: Omeiza Owuda
 * Licence: GPL2
 */

// Define Plugin Directory Path
define( 'PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

// Define Plugin Directory URL
define( 'PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Main plugin functions
include( PLUGIN_DIR . 'wp_login_customizer.php' );
