<?php
/**
 * Registers ManualMaker's core public scripts and styles
 *
 * This file defines the source files
 * for ManualMaker's front end JavaScript and CSS.
 *
 * @link https://github.com/reubenlillie.com/manualmaker/
 *
 * @package ManualMaker
 * @subpackage ManualMaker\public
 * @since 0.1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function action_mm_public_scripts() {

	// Checks the current query for anything related to ManualMaker.
    if (
    	'paragraph' == get_post_type()
        || is_tax( array( 'section', 'index_locator' ) )
    ) {

		wp_enqueue_style(
			'mm-public-screen',
			plugins_url( 'css/mm-public.css', __FILE__ ),
			null,
			'0.1.0',
			'screen'
		);

	} // if

} // action_mm_public_scripts()
