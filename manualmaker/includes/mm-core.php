<?php
/**
 * Controls ManualMaker's core dependencies
 *
 * This file includes the files that, in turn, control
 * ManualMaker's primary components, namely:
 *
 * - admin (back-end) dependencies
 * - internationalization (i18n)/localization (l10n) dependencies
 * - public (front-end) dependencies
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
* Controls ManualMaker's core admin (back-end) dependencies.
*/
require_once( plugin_dir_path( __FILE__ ) . '../admin/mm-admin.php' );

/**
* Controls ManualMaker's core internationalization dependencies.
*/
require_once( plugin_dir_path( __FILE__ ) . '../languages/mm-i18n.php' );

/**
* Controls ManualMaker's core public (front-end) dependencies.
*/
require_once( plugin_dir_path( __FILE__ ) . '../public/mm-public.php' );
