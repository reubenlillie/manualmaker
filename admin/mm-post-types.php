<?php
/**
 * Defines ManualMaker's custom post types
 *
 * This file contains functions to define the following custom post types:
 *
 * - 'paragraph' (hierarchical, like pages)
 *
 * @link https://github.com/reubenlillie/manualmaker/
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
 * Defines the 'paragraph' custom post type.
 *
 * Defines an array of arugments for a custom post type called 'paragraph'
 * that is hierarchical (like pages) and supports 'page-attributes'
 * for organizing subparagraphs according to 'parent' relationships.
 *
 * @since 0.1.0
 * @since 0.1.1    Added REST API access
 *
 * @see register_post_type()
 * @link https://developer.wordpress.org/reference/functions/register_post_type/
 */
function action_mm_register_paragraph_cpt() {

	$labels = array(
		'name'                  => _x( 'Paragraphs', 'Post Type General Name', 'manualmaker' ),
		'singular_name'         => _x( 'Paragraph', 'Post Type Singular Name', 'manualmaker' ),
		'menu_name'             => __( 'Paragraphs', 'manualmaker' ),
		'name_admin_bar'        => __( 'Paragraph', 'manualmaker' ),
		'archives'              => __( 'Paragraph Archives', 'manualmaker' ),
		'attributes'            => __( 'Paragraph Attributes', 'manualmaker' ),
		'parent_item_colon'     => __( '', 'manualmaker' ),
		'all_items'             => __( 'All Paragraphs', 'manualmaker' ),
		'add_new_item'          => __( 'Add New Paragraph', 'manualmaker' ),
		'add_new'               => __( 'Add New', 'manualmaker' ),
		'new_item'              => __( 'New Paragraph', 'manualmaker' ),
		'edit_item'             => __( 'Edit Paragraph', 'manualmaker' ),
		'update_item'           => __( 'Update Paragraph', 'manualmaker' ),
		'view_item'             => __( 'View Paragraph', 'manualmaker' ),
		'view_items'            => __( 'View Paragraphss', 'manualmaker' ),
		'search_items'          => __( 'Search Paragraph', 'manualmaker' ),
		'not_found'             => __( 'Not found', 'manualmaker' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'manualmaker' ),
		'featured_image'        => __( 'Featured Image', 'manualmaker' ),
		'set_featured_image'    => __( 'Set featured image', 'manualmaker' ),
		'remove_featured_image' => __( 'Remove featured image', 'manualmaker' ),
		'use_featured_image'    => __( 'Use as featured image', 'manualmaker' ),
		'insert_into_item'      => __( 'Insert into Paragraph', 'manualmaker' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Paragraph', 'manualmaker' ),
		'items_list'            => __( 'Paragraph list', 'manualmaker' ),
		'items_list_navigation' => __( 'Paragraph list navigation', 'manualmaker' ),
		'filter_items_list'     => __( 'Filter Paragraph list', 'manualmaker' ),
	); // $labels

	$rewrites = array(
		'slug'                  => 'paragraph',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => false,
	); // $rewrites

	$args = array(
		'label'                 => __( 'Manual Paragraph', 'manualmaker' ),
		'labels'                => $labels,
		'supports'              => array(
										'title',
										'editor',
										'revisions',
										'page-attributes',
									),
		'taxonomies'            => array(
										'section',
										'index_locator',
									),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 25, // below Comments
		'menu_icon'             => 'dashicons-editor-paragraph',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'show_in_rest'          => true,
		'can_export'            => true,
		'has_archive'           => 'paragraph',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'query_var'             => 'paragraph',
		'rewrite'               => $rewrites,
		'capability_type'       => 'page',
	); // $args

	/**
	 * Allow plugins and themes to override the default post type arguments.
	 *
	 * @since 0.1.0
	 *
	 * @see apply_filters()
	 * @link https://developer.wordpress.org/reference/functions/apply_filters/
	 * @link https://developer.wordpress.org/plugins/hooks/custom-hooks/
	 * @link https://make.wordpress.org/docs/plugin-developer-handbook/hooks/creating-custom-hooks/
	 */
	register_post_type(
		'paragraph',
		apply_filters( 'apply_to_action_mm_register_paragraph_cpt_args', $args, $labels, $rewrites )
	);

} // action_mm_register_paragraph_cpt()
