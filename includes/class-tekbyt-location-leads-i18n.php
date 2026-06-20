<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://talhaahmadkhan.blog
 * @since      1.0.0
 *
 * @package    Tekbyt_Location_Leads
 * @subpackage Tekbyt_Location_Leads/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Tekbyt_Location_Leads
 * @subpackage Tekbyt_Location_Leads/includes
 * @author     Talha Khan <talhaahmadkhan08@gmail.com>
 */
class Tekbyt_Location_Leads_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'tekbyt-location-leads',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
