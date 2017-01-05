<?php
/**
 * Defines ManualMaker's internationalization (i18n) dependencies
 *
 * This file includes all the files
 * related to ManualMaker's translation (internationalization/localization)
 * and hooks the functions declared in those files
 * into core.
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
 * Defines ManualMaker's textdomain.
 */
require_once( plugin_dir_path( __FILE__ ) . 'mm-textdomain.php' );

	/**
	 * Loads ManualMaker's textdomain.
	 *
	 * Loads the textdomain on `init`,
	 * that is, after WordPress finishes loading
	 * but before any headers are sent.
	 *
	 * @since 0.1.0
	 *
	 * @see init
	 * @link https://developer.wordpress.org/reference/hooks/init/
	 * @link https://developer.wordpress.org/reference/functions/load_plugin_textdomain/#comment-1568
	 */
	add_action( 'init', 'action_mm_load_plugin_textdomain' );

