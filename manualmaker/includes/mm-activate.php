<?php
/**
 * Runs when ManualMaker is activated
 *
 * This file contains a function
 * that calls the functions for ManualMaker's custom post types and taxonomies,
 * then flushes rewrite rules for permalinks.
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
 * Runs when ManualMaker is activated.
 *
 * Call registration functions for the following post types and taxonomies:
 *
 * - 'paragraph' custom post type
 * - 'section' custom taxonomy
 * - 'index_locator' custom taxonomy
 *
 * then flushes the rewrite rules for permalinks to avoid 404 errors.
 *
 * @author Reuben L. Lillie <email@reubenlillie.com>
 * @since 0.1.0
 * @see flush_rewrite_rules()
 * @link https://developer.wordpress.org/reference/functions/flush_rewrite_rules/
 * @link https://developer.wordpress.org/plugins/the-basics/activation-deactivation-hooks/#activation
 * @link http://solislab.com/blog/plugin-activation-checklist/
 */
function manualmaker_activate() {

	/**
	 * Calls the function to register the custom 'paragraph' post type.
	 *
	 * This action is documented in 'admin/mm-post-types.php
	 */
	action_mm_register_paragraph_cpt();

	/**
	 * Calls the function to register the custom 'section' taxonomy.
	 *
	 * This action is documented in admin/mm-taxonomies.php
	 */
	action_mm_register_section_tax();

	/**
	 * Calls the function to register the custom 'index_locator' taxonomy.
	 *
	 * This action is documented in admin/mm-taxonomies.php
	 */
	action_mm_register_index_locator_tax();

	/**
	 * Flushes rewrite rules.
	 *
	 * Removes rewrite rules for permalinks then recreates them
	 * after the custom post types and taxonomies have been registered.
	 *
	 * NB: Because this is an expensive operation, only run this function
	 * after custom post types and taxonomies have been properly registered.
	 *
	 * @link https://developer.wordpress.org/reference/functions/flush_rewrite_rules/
	 * @link http://solislab.com/blog/plugin-activation-checklist/#flush-rewrite-rules
	 */
	flush_rewrite_rules();

} // manualmaker_activate()
