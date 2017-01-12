<?php
/**
 * The template for displaying single 'paragraph' pages
 *
 * @package ManualMaker
 * @subpackage ManualMaker/includes/templates
 * @since 0.1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

	/**
	 * Runs after the header.
	 *
	 * @since 0.1.0
	 *
	 * @hooked action_mm_content_wrapper_open - 10
	 */
	do_action( 'do_after_mm_get_header' );

		if ( have_posts() ) :

		/**
		 * Runs before starting the main content Loop.
		 *
		 * @since 0.1.0
		 *
		 * @hooked action_mm_paragraph_navigation - 10
		 */
		do_action( 'do_before_mm_single_paragraph_loop_start' );

		// Starts the Loop.
		while ( have_posts() ) : the_post();

			/**
			 * Runs after starting the main content Loop.
			 *
			 * @since 0.1.0
			 */
			do_action( 'do_after_mm_single_paragraph_loop_start' );

			manualmaker_get_template_part( 'content-paragraph.php' );

			/**
			 * Runs before ending the main content Loop.
			 *
			 * @since 0.1.0
			 */
			do_action( 'do_before_mm_single_paragraph_loop_end' );

		// Ends the Loop.
		endwhile;

		/**
		 * Runs after ending the main content Loop.
		 *
		 * @since 0.1.0
		 *
		 * @hooked action_mm_paragraph_naviatgion - 10
		 */
		do_action( 'do_after_mm_single_paragraph_loop_end' );

		// If no content, include the "No posts found" template.
		else :
		get_template_part( 'template-parts/content', 'none' );
		endif;

	/**
	 * Runs before the footer.
	 *
	 * @since 0.1.0
	 *
	 * @hooked action_mm_content_wrapper_close - 10
	 * @hooked action_mm_sidebar - 20
	 */
	do_action( 'do_before_mm_get_footer' );

get_footer();
