<?php
/**
 * The main plugin file for ManualMaker
 *
 * Make WordPress into your online manual.
 *
 * This file gives WordPress details about ManualMaker for the admin area.
 * This file also defines ManualMaker's activation and deactivation hooks,
 * and requires the file that controls ManualMaker's core dependencies.
 *
 * @link https://github.com/reubenlillie/manualmaker/
 *
 * @package ManualMaker
 * @subpackage ManualMaker\main
 * @author Reuben L. Lillie <rlillie@nazarene.org>
 * @copyright 2017 Church of the Nazarene, Inc.
 * @license <http://www.gnu.org/licenses/gpl-2.0.txt> GNUv2 or later
 *
 * @wordpress-plugin
 * Plugin Name: ManualMaker
 * Plugin URI:  https://github.com/reubenlillie/manualmaker/
 * Description: Make WordPress into your online manual.
 * Author:      Reuben L. Lillie
 * Author URI:  https://reubenlillie.com/about/
 * Version:     0.1.1
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 * Text Domain: manualmaker
 *
 * ManualMaker is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License,
 * or any later version.
 *
 * ManualMaker is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General
 * Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with ManualMaker. If not, see https://www.gnu.org/licenses/gpl-2.0.html/.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Runs when ManualMaker is actived.
 */
require_once( plugin_dir_path( __FILE__ ) . 'includes/mm-activate.php' );

	/**
	 * Completes ManualMaker activation.
	 *
	 * @since 0.1.0
	 *
	 * @see register_activation_hook()
	 * @link https://developer.wordpress.org/reference/functions/register_activation_hook/
	 */
	register_activation_hook( __FILE__, 'manualmaker_activate' );

/**
 * Runs when ManualMaker is deactived.
 */
require_once( plugin_dir_path( __FILE__ ) . 'includes/mm-deactivate.php' );

	/**
	 * Completes ManualMaker deactivation.
	 *
	 * @since 0.1.0
	 *
	 * @see register_deactivation_hook()
	 * @link https://developer.wordpress.org/reference/functions/register_deactivation_hook/
	 */
	register_deactivation_hook( __FILE__, 'manualmaker_deactivate' );

/**
 * Controls ManualMaker's core dependencies.
 */
require_once( plugin_dir_path( __FILE__ ) . 'includes/mm-core.php' );
