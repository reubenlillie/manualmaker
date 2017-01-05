<?php
/**
 * Controls ManualMaker's core public (front-end) dependencies
 *
 * This file includes all the files related to ManualMaker's front end
 * and hooks the functions declared in those files into ManualMaker core.
 *
 * All front-end action and filter hooks are consolidated here
 * to make searching for them easier,
 * and to help developers understand the order in which events occur.
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

/**
 * Registers ManualMaker's core public scripts and styles.
 */
require_once( plugin_dir_path( __FILE__ ) . 'mm-public-scripts.php' );

	/**
	 * Enqueues ManualMaker's scripts and styles.
	 *
	 * @since 0.1.0
	 *
	 * @see wp_enqueue_scripts()
	 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_scripts/
	 */
	add_action( 'wp_enqueue_scripts', 'action_mm_public_scripts' );

/**
 * Includes ManualMaker's default custom templates.
 */
require_once( plugin_dir_path( __FILE__ ) . 'mm-load-templates.php' );

	/**
	 * Loads ManualMaker's custom templates.
	 *
	 * Checks the query for anything related to ManualMaker,
	 * then designates which template files to load for which pages.
	 *
	 * Custom hooks available:
	 *
	 * - apply_to_action_mm_load_template
	 *
	 * @since 0.1.0
	 *
	 * @see template_include()
	 * @link https://developer.wordpress.org/reference/hooks/template_include/
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 */
	add_action( 'template_include', 'action_mm_load_template', 10 );

/*
 * Defines ManualMaker's default template functions.
 */
require_once( plugin_dir_path( __FILE__ ) . 'mm-template-functions.php' );

	/*
	 * Table of Contents
	 *
	 * 1. WP_Query
	 * 2. Wrappers
	 * 3. Headers
	 * 4. Titles
	 * 5. Sidebar
	 * 6. Previous/Next Navigation Links
	 * 7. Edit Links
	 */

	/*
	 * 1.0 WP_Query
	 */

	/**
	 * Sets a custom order for paragraphs on archive and taxonomy pages.
	 *
	 * Adds post types on `pre_get_posts`,
	 * that is, after the query variable object is created
	 * but before the actual query is run.
	 *
	 * @since 0.1.0
	 *
	 * @see pre_get_posts()
	 * @link https://developer.wordpress.org/reference/hooks/pre_get_posts/
	 */
	add_action( 'pre_get_posts', 'action_mm_order_paragraphs', 10 );

	/*
	 * 2.0 Wrappers
	 */

	/**
	 * Opens a content wrapper.
	 *
	 * Adds an opening wrapper after displaying the header
	 * on single 'paragraph' pages
	 * and on 'paragraph' archive and taxonomy pages.
	 *
	 * Custom hooks available:
	 *
	 * - do_before_mm_site_content_wrapper_open
	 * - do_after_mm_site_content_wrapper_open
	 *
	 * @since 0.1.0
     */
	add_action( 'do_after_mm_get_header',
		'action_mm_site_content_wrapper_open', 10 );

	/**
	 * Closes a content wrapper.
	 *
	 * Adds a closing wrapper before displaying the footer
	 * on single 'paragraph' pages
	 * and on 'paragraph' archive and taxonomy pages.
	 *
	 * Custom hooks available:
	 *
	 * - do_before_mm_site_content_wrapper_close
	 * - do_after_mm_site_content_wrapper_close
	 *
	 * @since 0.1.0
	 */
	add_action( 'do_before_mm_get_footer',
		'action_mm_site_content_wrapper_close', 10 );

	/*
	 * 3.0 Headers
	 */

	/**
	 * Adds a header after opening the article tag for paragraph content.
	 *
	 * Custom hooks available:
	 *
	 * - do_before_mm_paragraph_header_content_open
	 * - do_after_mm_paragraph_header_content_open
	 * - do_before_mm_paragraph_header_content_close
	 * - do_after_mm_paragraph_header_content_close
	 *
	 * @since 0.1.0
	 */
	add_action( 'do_after_mm_paragraph_content_article_open',
		'action_mm_paragraph_header_content', 10 );

	/**
	 * Adds a header before starting the loop on archive pages.
	 *
	 * Custom hooks available:
	 *
	 * - do_before_mm_archive_header_content_open
	 * - do_after_mm_archive_header_content_open
	 * - do_before_mm_archive_header_content_close
	 * - do_after_mm_archive_header_content_close
	 *
	 * @since 0.1.0
	 */
	add_action( 'do_before_mm_archive_paragraph_loop_start',
		'action_mm_archive_header_content', 20 );

	/*
	 * 4.0 Titles
	 */

	/**
	 * Adds an archive's/taxonomy's title and description to template markup.
	 *
	 * Adds a title and description after opening the header tag
	 * on 'paragraph' archive and taxonomy pages.
	 *
	 * Custom hooks available:
	 *
	 * - do_before_mm_the_archive_title
	 * - do_after_mm_the_archive_title
	 * - do_before_mm_the_archive_description
	 * - do_after_mm_the_archive_description
	 *
	 * @since 0.1.0
	 */
	add_action( 'do_after_mm_archive_header_content_open',
		'action_mm_archive_title_markup', 10 );

	/**
	 * Adds a paragraph's title to template markup.
	 *
	 * Conditionally adds a title after the opening header tag
	 * on 'paragraph' archive and taxonomy pages with a permalink,
	 * or on single 'paragraph' pages without a permalink.
	 *
	 * @since 0.1.0
	 */
	add_action( 'do_after_mm_paragraph_header_content_open',
	   	'action_mm_paragraph_title_markup', 10 );

	/*
	 * 5.0 Sidebar
	 */

	/**
	 * Adds a sidebar.
	 *
	 * Adds a sidebar after main content but before the footer
	 * to 'paragraph' single and archive pages.
	 *
	 * Custom hooks available:
	 *
	 * - apply_to_action_mm_sidebar
	 *
	 * @since 0.1.0
	 */
	add_action( 'do_after_mm_site_content_wrapper_outer_close',
		'action_mm_get_sidebar', 10 );

	/*
	 * 6.0 Previous/Next Navigation Links
	 */

	/*
	 * 6.1 Single Pages
	 */

	/*
	 * Adds previous/next navigation to single 'paragraph' pages.
	 *
	 * Adds previous/next navigation
	 * after starting the main content Loop.
	 *
	 * Custom hooks available:
	 *
	 * - do_before_action_mm_paragraph_navigation
	 * - apply_to_action_mm_paragraph_navigation
	 * - do_after_action_mm_paragraph_navigation
	 *
	 * @since 0.1.0
	 */
	add_action( 'do_before_mm_single_paragraph_loop_start' ,
		'action_mm_paragraph_navigation', 10 );

	/*
	 * Adds previous/next navigation to single 'paragraph' pages.
	 *
	 * Adds previous/next navigation
	 * before ending the main content Loop.
	 *
	 * Custom hooks available:
	 *
	 * - do_before_action_mm_paragraph_navigation
	 * - apply_to_action_mm_paragraph_navigation
	 * - do_after_action_mm_paragraph_navigation
	 *
	 * @since 0.1.0
	 */
	add_action( 'do_after_mm_single_paragraph_loop_end',
		'action_mm_paragraph_navigation', 10 );

	/*
	 * 6.2 Archive and Taxonomy Pages
	 */

	/*
	 * Adds previous/next navigation on 'paragraph' archive and taxonomy pages.
	 *
	 * Adds previous/next navigation
	 * before the archive title
	 * inside the page header tag.
	 *
	 * Custom hooks available:
	 *
	 * - do_before_action_mm_paragraphs_navigation
	 * - apply_to_action_mm_paragraphs_navigation
	 * - do_after_action_mm_paragraphs_navigation
	 *
	 * @since 0.1.0
	 */
	add_action( 'do_before_mm_archive_paragraph_loop_start',
		'action_mm_paragraphs_navigation', 10 );
	/*
	 * Adds previous/next navigation on 'paragraph' archive and taxonomy pages.
	 *
	 * Adds previous/next navigation
	 * before ending the main content Loop.
	 *
	 * Custom hooks available:
	 *
	 * - do_before_action_mm_paragraphs_navigation
	 * - apply_to_action_mm_paragraphs_navigation
	 * - do_after_action_mm_paragraphs_navigation
	 *
	 * @since 0.1.0
	 */
	add_action( 'do_after_mm_archive_paragraph_loop_end',
			'action_mm_paragraphs_navigation', 10 );

	/*
	 * 7.0 Edit Links
	 */

	/**
	 * Displays the edit post link for 'paragraph' custom post type.
	 *
	 * Custom hooks available:
	 *
	 * - do_before_action_mm_edit_post_link
	 * - do_after_action_mm_edit_post_link
	 *
	 * @since 0.1.0
	 */
	add_action( 'do_before_mm_paragraph_content_article_close',
		'action_mm_edit_post_link', 20 );
