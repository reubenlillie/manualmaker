<?php
/**
 * Defines ManualMaker's custom taxonomies
 *
 * This file contains functions to define the following custom taxonomies:
 *
 * - 'section'(hierarchical, like categories)
 * - 'index_locator'(non-hierarchical, like tags)
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
 * Defines a custom 'section' taxonomy for the 'paragraph' post type.
 *
 * Registers a custom taxonomy for organizing paragraphs into sections
 * that is hierarchical (like categories)
 * and functions like a table of contents or chapters with subheadings.
 *
 * @since 0.1.0
 * @since 0.1.1    Add REST API access
 *
 * @see register_taxonomy()
 * @link https://developer.wordpress.org/reference/functions/register_taxonomy/
 * @link https://generatewp.com/taxonomy/
 */
function action_mm_register_section_tax() {

 	$labels = array(
		'name'                       => _x( 'Sections', 'Taxonomy General Name', 'manualmaker' ),
		'singular_name'              => _x( 'Section', 'Taxonomy Singular Name', 'manualmaker' ),
		'menu_name'                  => __( 'Sections', 'manualmaker' ),
		'all_items'                  => __( 'All Sections', 'manualmaker' ),
		'parent_item'                => __( 'Parent Section', 'manualmaker' ),
		'parent_item_colon'          => __( 'Parent Section:', 'manualmaker' ),
		'new_item_name'              => __( 'New Section Name', 'manualmaker' ),
		'add_new_item'               => __( 'Add New Section', 'manualmaker' ),
		'edit_item'                  => __( 'Edit Section', 'manualmaker' ),
		'update_item'                => __( 'Update Section', 'manualmaker' ),
		'view_item'                  => __( 'View Section', 'manualmaker' ),
		'separate_items_with_commas' => __( '', 'manualmaker' ),
		'add_or_remove_items'        => __( 'Add or remove Sections', 'manualmaker' ),
		'choose_from_most_used'      => __( '', 'manualmaker' ),
		'popular_items'              => __( '', 'manualmaker' ),
		'search_items'               => __( 'Search Sections', 'manualmaker' ),
		'not_found'                  => __( 'Not Found', 'manualmaker' ),
		'no_terms'                   => __( 'No items', 'manualmaker' ),
		'items_list'                 => __( 'Section list', 'manualmaker' ),
		'items_list_navigation'      => __( 'Section list navigation', 'manualmaker' ),
	); // $labels

	$rewrites = array(
		'slug'                       => 'section',
		'with_front'                 => true,
		'hierarchical'               => false,
	); // $rewrites

	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_in_rest'               => true,
		'rest_base'		     => 'sections',
		'show_tagcloud'              => false,
		'query_var'                  => 'section',
		'rewrite'                    => $rewrites,
		'update_count_callback'      => '_update_post_term_count',
	); // $args

	/**
	 * Allows plugins and themes to override the default taxonomy arguments.
	 *
	 * @since 0.1.0
	 *
	 * @see apply_filters()
	 * @link https://developer.wordpress.org/reference/functions/apply_filters/
	 * @link https://developer.wordpress.org/plugins/hooks/custom-hooks/
	 * @link https://make.wordpress.org/docs/plugin-developer-handbook/hooks/creating-custom-hooks/
	 */
    register_taxonomy(
		'section',
		array( 'paragraph' ),
		apply_filters( 'apply_to_action_mm_register_section_tax', $args, $labels, $rewrites )
	);

} // action_mm_register_section_tax()

/**
 * Defines a custom 'index_locator' taxonomy for the 'paragraph' post type.
 *
 * Registers a custom taxonomy for indexing paragraphs
 * that is non-hierarchical (like tags).
 *
 * @since 0.1.0
 * @since 0.1.1    Add REST API access
 *
 * @see register_taxonomy()
 * @link https://developer.wordpress.org/reference/functions/register_taxonomy/
 * @link https://generatewp.com/taxonomy/
 */

// Register Custom Taxonomy
function action_mm_register_index_locator_tax() {

	$labels = array(
		'name'                       => _x( 'Index Locators', 'Taxonomy General Name', 'manualmaker' ),
		'singular_name'              => _x( 'Index', 'Taxonomy Singular Name', 'manualmaker' ),
		'menu_name'                  => __( 'Index Locators', 'manualmaker' ),
		'all_items'                  => __( 'All Index Locators', 'manualmaker' ),
		'parent_item'                => __( '', 'manualmaker' ),
		'parent_item_colon'          => __( '', 'manualmaker' ),
		'new_item_name'              => __( 'New Index Locator Name', 'manualmaker' ),
		'add_new_item'               => __( 'Add New Index Locator', 'manualmaker' ),
		'edit_item'                  => __( 'Edit Index Locator', 'manualmaker' ),
		'update_item'                => __( 'Update Index Locator', 'manualmaker' ),
		'view_item'                  => __( 'View Index Locator', 'manualmaker' ),
		'separate_items_with_commas' => __( 'Separate Index Locators with commas', 'manualmaker' ),
		'add_or_remove_items'        => __( 'Add or remove Index Locators', 'manualmaker' ),
		'choose_from_most_used'      => __( 'Choose from Most Used Index Locators', 'manualmaker' ),
		'popular_items'              => __( '', 'manualmaker' ),
		'search_items'               => __( 'Search Index', 'manualmaker' ),
		'not_found'                  => __( 'Not Found', 'manualmaker' ),
		'no_terms'                   => __( 'No items', 'manualmaker' ),
		'items_list'                 => __( 'Index Locator list', 'manualmaker' ),
		'items_list_navigation'      => __( 'Index Locator list navigation', 'manualmaker' ),
	); // $labels

	$rewrites = array(
		'slug'                       => 'index',
		'with_front'                 => true,
		'hierarchical'               => false,
	); // $rewrites

	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_in_rest'               => true,
		'rest_base'		     => 'index_locators',
		'show_tagcloud'              => true,
		'query_var'                  => 'index_locator',
		'rewrite'                    => $rewrites,
		'update_count_callback'      => '_update_post_term_count',
	); // $args

	/**
	 * Allows plugins and themes to override the default taxonomy arguments.
	 *
	 * @since 0.1.0
	 *
	 * @see apply_filters()
	 * @link https://developer.wordpress.org/reference/functions/apply_filters/
	 * @link https://developer.wordpress.org/plugins/hooks/custom-hooks/
	 * @link https://make.wordpress.org/docs/plugin-developer-handbook/hooks/creating-custom-hooks/
	 */
	register_taxonomy(
		'index_locator',
		array( 'paragraph' ),
		apply_filters( 'apply_to_action_mm_register_index_locator_tax', $args, $labels, $rewrites )
	);

} // action_mm_register_index_locator_tax()
