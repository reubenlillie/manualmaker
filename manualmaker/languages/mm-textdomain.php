<?php
/**
 * Defines ManualMaker's textdomain
 *
 * This file contains a function to load ManualMaker's textdomain
 * so it is ready for localization.
 *
 * @link https://github.com/reubenlillie/manualmaker/
 *
 * @package ManualMaker
 * @subpackage ManualMaker\languages
 * @since 0.1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Loads ManualMaker's textdomain.
 *
 * Loads the translated strings
 * handled by the files in ManualMaker's `/languages/` directory.
 *
 * @since 0.1.0
 *
 * @see load_plugin_textdomain()
 * @link https://developer.wordpress.org/reference/functions/load_plugin_textdomain/
 * @link https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/
 */
function action_mm_load_plugin_textdomain() {

	load_plugin_textdomain(
		'manualmaker',
		FALSE,
		basename( dirname( __FILE__ ) ) . '/languages/'
	);

} // action_mm_load_plugin_textdomain()


