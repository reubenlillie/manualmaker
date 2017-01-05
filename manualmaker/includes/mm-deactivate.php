<?php
/**
 * Runs when ManualMaker is deactivated
 *
 * Flushes rewrite rules that were written when ManualMaker was activated.
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
 * Runs when ManualMaker is dactivated.
 *
 * Custom post types and taxonomies are removed authomatically,
 * but flushing the rewrite rules for permalinks here removes
 * the ones which were written on activation.
 *
 * @since 0.1.0
 *
 * @link https://developer.wordpress.org/plugins/the-basics/activation-deactivation-hooks/#deactivation
 *
 * @see flush_rewrite_rules()
 * @link https://developer.wordpress.org/reference/functions/flush_rewrite_rules/
 */
function manualmaker_deactivate() {

	/**
	 * Flushes rewrite rules.
	 *
	 * Removes rewrite rules for permalinks then recreates them.
	 *
	 * NB: Because this is an expensive operation, only run this function
	 * when the rewrite rules need to be changed.
	 *
	 * @link https://developer.wordpress.org/reference/functions/flush_rewrite_rules/
	 */
    flush_rewrite_rules();

} // manualmaker_deactivate()
