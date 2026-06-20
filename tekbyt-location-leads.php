<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://talhaahmadkhan.blog
 * @since             1.0.0
 * @package           Tekbyt_Location_Leads
 *
 * @wordpress-plugin
 * Plugin Name:       Tekbyt Location Leads
 * Plugin URI:        https://talhaahmadkhan.blog
 * Description:        Small but production-style WordPress feature set that tests custom development, WordPress architecture, dynamic content, forms, AJAX, REST API handling, security, performance, and code quality.
 * Version:           1.0.0
 * Author:            Talha Khan
 * Author URI:        https://talhaahmadkhan.blog/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tekbyt-location-leads
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'TEKBYT_LOCATION_LEADS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tekbyt-location-leads-activator.php
 */
function activate_tekbyt_location_leads() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tekbyt-location-leads-activator.php';
	Tekbyt_Location_Leads_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tekbyt-location-leads-deactivator.php
 */
function deactivate_tekbyt_location_leads() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tekbyt-location-leads-deactivator.php';
	Tekbyt_Location_Leads_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_tekbyt_location_leads' );
register_deactivation_hook( __FILE__, 'deactivate_tekbyt_location_leads' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tekbyt-location-leads.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_tekbyt_location_leads() {

	$plugin = new Tekbyt_Location_Leads();
	$plugin->run();

}
run_tekbyt_location_leads();
