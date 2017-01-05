<?php
/**
 * Includes templates for custom 'paragraph' archive and single pages
 *
 * This file contains a function (`action_mm_load_template()`)
 * for including ManualMaker's custom templates at the appropriate time,
 * and a function (`manualmaker_get_template_part()`)
 * for including template parts within ManualMaker's template files.
 *
 * @link https://github.com/reubenlillie/manualmaker/
 *
 * @package ManualMaker
 * @subpackage ManualMaker\public
 * @since 0.1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Loads ManualMaker's custom templates.
 *
 * Checks the query for anything related to ManualMaker,
 * then designates which template files to load for which pages,
 * otherwise falls back to the default template hierarchy.
 *
 * @since 0.1.0
 *
 * @see get_query_var()
 * @link https://developer.wordpress.org/reference/functions/get_query_var/
 *
 * @see is_tax()
 * @link https://developer.wordpress.org/reference/functions/is_tax/
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @link https://make.wordpress.org/core/handbook/best-practices/coding-standards/php/#yoda-conditions/
 *
 * @param string $template_file The path to the template file to be loaded.
 * @return string Fallback to the filtered default template, if applicable.
 */
function action_mm_load_template( $template_file ) {

	// Checks the current query for anything related to ManualMaker.
    if (
    	get_query_var( 'post_type' ) != 'paragraph' &&
        true != is_tax( array( 'section', 'index_locator' ) )
    ) {

        return $template_file;

    } // if

    // Loads a custom archive template on archive, taxonomy, and search pages.
    if (
    	is_archive() ||
    	is_tax( array( 'section', 'index_locator' ) ) ||
    	is_search()
    ) {

        if ( file_exists( get_stylesheet_directory() .
            '/archive-paragraph.php' ) ) {

                return get_stylesheet_directory() .
                    '/archive-paragraph.php';

        } else {

            return plugin_dir_path( __FILE__ ) .
                'templates/archive-paragraph.php';

		} // else

    } // if archive || 'section' || 'index_locator' || search

    // Loads a custom single 'paragraph' template.
    elseif ( is_single() ) {

        if ( file_exists( get_stylesheet_directory() .
            '/single-paragraph.php' ) ) {

                return get_stylesheet_directory() .
                    '/single-paragraph.php';

        } else {

            return plugin_dir_path( __FILE__ ) .
                'templates/single-paragraph.php';

		} // else

    } // elseif single

    // Returns a fallback to default template hierarchy.
    else {

        return apply_filters( 'apply_to_action_mm_load_template', $template_file );

    } // else

} // action_mm_load_templates()

/**
 * Loads a template part into the template file.
 *
 * This custom template tag allows a theme to override ManualMaker's template parts.
 *
 * WordPress Codex recommends this 'if' statement
 * for loading a template in a plugin,
 * while allowing themes to override that template.
 *
 * If you do override ManualMaker's default template in a theme,
 * use `get_template_part()` instead
 * within your theme's template file.
 *
 * @since 0.1.0
 *
 * @see load_template()
 * @link https://developer.wordpress.org/reference/functions/load_template/
 *
 * @see locate_template()
 * @link https://developer.wordpress.org/reference/functions/locate_template/
 *
 * @param string $template_file The path to the template file to be loaded.
 */
function manualmaker_get_template_part( $template_file ) {

	if ( $overridden_template = locate_template(
		'manualmaker/template-parts/' . $template_file ) ) {

		/*
		 * If either the child theme or the parent theme
		 * has a file to override ManualMaker's template,
		 * then that theme's file path is loaded.
		 */
		load_template( $overridden_template );

	} else {

		/*
		 * Otherwise, ManualMaker's template file
		 * is loaded by default.
		 */
		include( plugin_dir_path( __FILE__ ) .
			'templates/template-parts/' . $template_file );

	}

} // manualmaker_get_template_part()

