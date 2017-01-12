<?php
/**
 * Controls ManualMaker's core admin (back-end) dependencies
 *
 * This file includes all the files related to ManualMaker's back end
 * and hooks the functions declared in those files into ManualMaker core.
 *
 * @link https://github.com/reubenlillie.com/manualmaker/
 *
 * @package ManualMaker
 * @subpackage ManualMaker\admin
 * @since 0.1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Completes the registration for ManualMaker's custom post types.
 */
require_once( plugin_dir_path( __FILE__ ) . 'mm-post-types.php' );

	/**
	 * Adds a custom 'paragraph' post type.
	 *
	 * Adds post types on `init`,
	 * that is, after WordPress finishes loading
	 * but before any headers are sent.
	 *
	 * Custom hooks available:
	 *
	 * - apply_to_action_mm_register_paragraph_cpt_args
	 *
	 * @since 0.1.0
	 * @see init
	 * @link https://developer.wordpress.org/reference/hooks/init/
	 */
	add_action( 'init', 'action_mm_register_paragraph_cpt', 0 );

/**
 * Completes the registration for ManualMaker's custom taxonomies.
 */
require_once( plugin_dir_path( __FILE__ ) . 'mm-taxonomies.php' );

	/**
	 * Adds a custom 'section' taxonomy.
	 *
	 * Adds the 'section' taxonomy on `init`,
	 * that is, after WordPress finishes loading
	 * but before any headers are sent.
	 *
	 * Custom hooks available:
	 *
	 * - `apply_to_action_mm_register_section_tax_args`
	 *
	 * @since 0.1.0
	 * @see init
	 * @link https://developer.wordpress.org/reference/hooks/init/
	 */
	add_action( 'init', 'action_mm_register_section_tax', 0 );

	/**
	 * Adds a custom 'index_locator' taxonomy.
	 *
	 * Adds the index_locator taxonomy on `init`,
	 * that is, after WordPress finishes loading
	 * but before any headers are sent.
	 *
	 * Custom hooks available:
	 *
	 * - apply_to_action_mm_register_index_locator_tax_args
	 *
	 * @since 0.1.0
	 * @see init
	 * @link https://developer.wordpress.org/reference/hooks/init/
	 */
	add_action( 'init', 'action_mm_register_index_locator_tax', 0 );
