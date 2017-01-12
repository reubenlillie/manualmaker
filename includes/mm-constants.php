<?php
/**
 * Defines the constants to be used throughout ManualMaker
 *
 * Exception: `MANUALMAKER_PATH` is defined in the main plugin file
 * to .
 *
 * @link https://github.com/reubenlillie/manualmaker/
 *
 * @package ManualMaker
 * @subpackage ManualMaker\includes
 * @since 0.1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Defines constants to be used throughout ManualMaker.
 *
 * @since 0.1.0
 */
function mm_define_initial_constants() {

	/**
	 * Defines the current version of ManualMaker.
	 *
	 * The value should be updated to match
	 * the version number in the main plugin file header.
	 *
	 * @since 0.1.0
	 */
	define( 'MANUALMAKER_VERSION', '0.1.0' );

} // mm_define_initial_constants()
