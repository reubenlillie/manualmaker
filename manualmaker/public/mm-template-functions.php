<?php
/**
 * Defines functions that are hooked into template files
 *
 * All actions and filter hooks are called via `includes/mm-public.php`.
 * This way actual callback "events" (i.e, `add_action` and `add_filter`)
 * and function "definitons" (in this file) can be managed separately.
 *
 * When using one of the hooks (i.e., `do_action` or `apply_filters`),
 * be sure to note the addition and priority from `includes/mm-public.php`
 * in that hooks' comment block with the `@hooked` tag.
 * This makes it easier to keep track of when hooks are used,
 * and it helps developers decide how best to use additional hooks.
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

/*
 * Table of Contents
 *
 * 1.0  WP_Query
 * 2.0 Wrappers
 * 3.0 Headers
 *   3.1 Headers
 *   3.2 Footers
 * 4.0 Titles
 *   4.1 Paragraph Title
 *   4.2 Archive/Taxonomy Title and Description
 * 5.0 Sidebar
 * 6.0 Previous/Next Navigation Links
 *   6.1 Single Pages
 *   6.2 Archive and Taxonomy Pages
 * 7.0 Edit Links
 */

/*
 * 1.0 WP_Query
 */

/**
 * Sets a custom order for paragraphs on archive and taxonomy pages.
 *
 * Arranges paragraphs in numerical order
 * (or any order set by the 'order' field in the 'page_attributes' meta box),
 * and subparagraphs appear beneath their respective parents.
 *
 * @since 0.1.0
 *
 * @see pre_get_posts()
 * @link https://developer.wordpress.org/reference/hooks/pre_get_posts/
 *
 * @param object $query The WP_Query instance (passed by reference).
 * @return object The modified WP_Query instance.
 */

function action_mm_order_paragraphs ( $query ) {

	if ( ! is_admin()
		&& ( is_post_type_archive( 'paragraph' )
		|| is_tax( array( 'section', 'index_locator' ) ) )
		&& $query->is_main_query()
	) {

	$query->set( 'post_type', 'paragraph' );
	$query->set( 'order', 'ASC' );
	$query->set( 'orderby', array( 'menu_order', 'parent' ) );

	return $query;

	} // if

} // action_mm_order_paragraphs()

/*
 * 2.0 Wrappers
 */

/**
 * Opens the wrapping div tags on 'paragraph' pages.
 *
 * @since 0.1.0
 *
 * @see wp_parse_args()
 * @link https://developer.wordpress.org/reference/functions/wp_parse_args/
 *
 * @param array $args {
 *     Optional. An array of arguments.
 *
 *     @type string $inner_class   HTML class attribute for the inner wrapper.
 *                                 Default 'site-main'.
 *     @type string $inner_id      HTML id attribute for the inner wrapper.
 *                                 Default 'main'.
 *     @type string $inner_role    HTML role attribute for the inner wrapper.
 *                                 Default 'main'.
 *     @type string $inner_tag     HTML tag for the inner wrapper (no brackets).
 *                                 Default 'main'.
 *     @type bool   $inner_wrapper Whether to echo the inner wrapper or return.
 *                                 Default TRUE.
 *     @type string $outer_class   HTML class attribute for the outer wrapper.
 *                                 Default 'content-area'.
 *     @type string $outer_id      HTML id attribute for the outer wrapper.
 *                                 Default 'primary'.
 *     @type string $outer_role    HTML role attribute for the outer wrapper.
 *                                 Default ''.
 *     @type string $outer_tag     HTML tag for the outer wrapper (no brackets).
 *                                 Default 'div'.
 *     @type bool   $outer_wrapper Whether to echo the outer wrapper or return.
 *                                 Default TRUE.
 * }
 * @param array  $args  {
 *     Parsed $defaults.
 * }
 * @param string $open  The opening inner wrapper.
 * @param string $close The opening outer wrapper.
 * @return string The opening outer wrapper.
 * @return string The opening inner wrapper.
 */
function action_mm_site_content_wrapper_open( $args ) {

	$defaults = array(
		'inner_class'   => 'site-main',
		'inner_id'      => 'main',
		'inner_role'    => 'main',
		'inner_tag'     => 'main',
		'inner_wrapper' => TRUE,
		'outer_class'   => 'content-area',
		'outer_id'      => 'primary',
		'outer_role'    => '',
		'outer_tag'     => 'div',
		'outer_wrapper' => TRUE,
	);

	// Parse incoming $args into an array and merge it with $defaults
	$args = wp_parse_args( $args, $defaults );

	$inner_wrapper = sprintf( '<%s id="%s" class="%s" role="%s">',
						esc_attr( $args['inner_tag'] ),
						esc_attr( $args['inner_id'] ),
						esc_attr( $args['inner_class'] ),
						esc_attr( $args['inner_role'] )
					 );

	$outer_wrapper = sprintf( '<%s id="%s" class="%s" role="%s">',
						esc_attr( $args['outer_tag'] ),
						esc_attr( $args['outer_id'] ),
						esc_attr( $args['outer_class'] ),
						esc_attr( $args['outer_role'] )
					 );

	/**
	 * Runs before the opening outer content wrapper HTML tag.
	 *
	 * @since 0.1.0
	 */
	do_action( 'do_before_mm_site_content_wrapper_outer_open' );

	if ( ! $args['outer_wrapper'] ) {
		return $outer_wrapper;
	} else {
		echo $outer_wrapper;
	} // else

		/**
		 * Runs after the opening outer content wrapper HTML tag.
		 *
		 * @since 0.1.0
		 */
		do_action( 'do_after_mm_site_content_wrapper_outer_open' );

		/**
		 * Runs before the opening inner content wrapper HTML tag.
		 *
		 * @since 0.1.0
		 */
		do_action( 'do_before_mm_site_content_wrapper_inner_open' );

		if ( ! $args['inner_wrapper'] ) {
			return $inner_wrapper;
		} else {
			echo $inner_wrapper;
		} // else

			/**
			 * Runs after the opening inner content wrapper HTML tag.
			 *
			 * @since 0.1.0
			 */
			do_action( 'do_after_mm_site_content_wrapper_inner_open' );

} // action_mm_site_content_wrapper_open()

/**
 * Closes the wrapping div tags on 'paragraph' pages.
 *
 * @since 0.1.0
 *
 * @see wp_parse_args()
 * @link https://developer.wordpress.org/reference/functions/wp_parse_args/
 *
 * @param array $defaults {
 *     Optional. An array of arguments.
 *
 *     @type string $inner_class   HTML class attribute for the inner wrapper.
 *                                 Default 'site-main'.
 *     @type string $inner_tag     HTML tag for the inner wrapper (no brackets).
 *                                 Default 'main'.
 *     @type bool   $inner_wrapper Whether to echo the inner wrapper or return.
 *                                 Default TRUE.
 *     @type string $outer_class   HTML class attribute for the outer wrapper.
 *                                 Default 'content-area'.
 *     @type string $outer_tag     HTML tag for the outer wrapper (no brackets).
 *                                 Default 'div'.
 *     @type bool   $outer_wrapper Whether to echo the outer wrapper or return.
 *                                 Default TRUE.
 * }
 * @param array  $args  {
 *     Parsed $defaults.
 * }
 * @param string $open  The closing inner wrapper.
 * @param string $close The closing outer wrapper.
 * @return string The closing inner wrapper.
 * @return string The closing outer wrapper.
 */
function action_mm_site_content_wrapper_close( $args ) {

	$defaults = array(
		'inner_class'   => 'site-main',
		'inner_tag'     => 'main',
		'inner_wrapper' => TRUE,
		'outer_class'   => 'content-area',
		'outer_tag'     => 'div',
		'outer_wrapper' => TRUE,
	);

	// Parse incoming $args into an array and merge it with $defaults
	$args = wp_parse_args( $args, $defaults );

	$inner_wrapper = sprintf( '</%s><!-- ."%s" -->',
						esc_attr( $args['inner_tag'] ),
						esc_attr( $args['inner_class'] )
					 );

	$outer_wrapper = sprintf( '</%s><!-- ."%s" -->',
						esc_attr( $args['outer_tag'] ),
						esc_attr( $args['outer_class'] )
					 );

			/**
			 * Runs before the closing content wrapper HTML tag.
			 *
			 * @since 0.1.0
			 *
			 * @hooked action_mm_sidebar - 10
			 */
			do_action( 'do_before_mm_site_content_wrapper_inner_close' );

		if ( ! $args['inner_wrapper'] ) {
			return $inner_wrapper;
		} else {
			echo $inner_wrapper;
		} // else

		/**
		 * Runs after the closing content wrapper HTML tag.
		 *
		 * @since 0.1.0
		 */
		do_action( 'do_after_mm_site_content_wrapper_inner_close' );

		/**
		 * Runs before the closing content wrapper HTML tag.
		 *
		 * @since 0.1.0
		 */
		do_action( 'do_before_mm_site_content_wrapper_outer_close' );

	if ( ! $args['outer_wrapper'] ) {
		return $outer_wrapper;
	} else {
		echo $outer_wrapper;
	} // else

	/**
	 * Runs after the closing content wrapper HTML tag.
	 *
	 * @since 0.1.0
	 */
	do_action( 'do_after_mm_site_content_wrapper_outer_close' );

} // action_mm_site_content_wrapper_close()

/*
 * 3.0 Headers and Footers
 */

/*
 * 3.1 Headers
 */

/**
 * Adds a content header on single 'paragraph' pages.
 *
 * @since 0.1.0
 *
 * @see wp_parse_args()
 * @link https://developer.wordpress.org/reference/functions/wp_parse_args/
 *
 * @param array $args {
 *     Optional. An array of arguments.
 *
 *     @type string $class HTML class attribute for the header tag.
 *                         Default 'entry-header'.
 *     @type bool   $echo  Whether to echo the header or return.
 *                         Default TRUE.
 * }
 * @param array  $args  {
 *     Parsed $defaults.
 * }
 * @param string $open  The opening header tag.
 * @param string $close The closing header tag.
 * @return string The opening header tag.
 * @return string The closing header tag.
 */
function action_mm_paragraph_header_content( $args ) {

	$defaults = array(
		'class' => 'entry-header',
		'echo'  => TRUE
	);

	// Parse incoming $args into an array and merge it with $defaults
	$args = wp_parse_args( $args, $defaults );

	// Define opening header tag HTML
	$open = sprintf( '<header class="%s">',
				esc_attr( $args['class'] )
			);

	// Define closing header tag HTML
	$close = sprintf( '</header><!-- .%s -->',
				esc_attr( $args['class'] )
			);

	/**
	 * Runs before the opening header tag.
	 *
	 * @since 0.1.0
	 */
	do_action( 'do_before_mm_paragraph_header_content_open' );

	if ( ! $args['echo'] ) {
		return $open;
	} else {
		echo $open;
	} //else

		/**
		 * Runs after the opening header tag.
		 *
		 * @since 0.1.0
		 *
		 * @hooked action_mm_paragraph_title_markup - 10
		 */
		do_action( 'do_after_mm_paragraph_header_content_open' );

		/**
		 * Runs before the closing header tag.
		 *
		 * @since 0.1.0
		 */
		do_action( 'do_before_mm_paragraph_header_content_close' );

	if ( ! $args['echo'] ) {
		return $close;
	} else {
		echo $close;
	} //else

	/**
	 * Runs after the closing header tag.
	 *
	 * @since 0.1.0
	 */
	do_action( 'do_after_mm_paragraph_header_content_close' );

} // action_mm_paragraph_header_content()

/**
 * Inserts a content header on archive and taxonomy pages.
 *
 * @since 0.1.0
 *
 * @see wp_parse_args()
 * @link https://developer.wordpress.org/reference/functions/wp_parse_args/
 *
 * @param array $defaults {
 *     Optional. An array of arguments.
 *
 *     @type string $class HTML class attribute for the header tag.
 *                         Default 'page-header'.
 *     @type bool   $echo  Whether to echo the header or return.
 *                         Default TRUE.
 * }
 * @param array  $args  {
 *     Parsed $defaults.
 * }
 * @param string $open  The opening header tag.
 * @param string $close The closing header tag.
 * @return string The opening header tag.
 * @return string The closing header tag.
 */
function action_mm_archive_header_content( $args ) {

	// Define the default arguments.
	$defaults = array(
		'class' => 'page-header',
		'echo'  => TRUE
	);

	// Parse incoming $args into an array and merge it with $defaults.
	$args = wp_parse_args( $args, $defaults );

	// Define opening header tag HTML.
	$open = sprintf( '<header class="%s">',
				esc_attr( $args['class'] )
			);

	// Define closing header tag HTML.
	$close = sprintf( '</header><!-- .%s -->',
				esc_attr( $args['class'] )
			);

	/**
	 * Runs before the opening header tag.
	 *
	 * @since 0.1.0
	 */
	do_action( 'do_before_mm_archive_header_content_open' );

	//
	if ( ! $args['echo'] ) {
		return $open;
	} else {
		echo $open;
	} //else

		/**
		 * Runs after the opening header tag.
		 *
		 * @since 0.1.0
		 *
		 * @hooked action_mm_archive_title_markup - 10
		 */
		do_action( 'do_after_mm_archive_header_content_open' );

		/**
		 * Runs before the closing header tag.
		 *
		 * @since 0.1.0
		 */
		do_action( 'do_before_mm_archive_header_content_close' );

	if ( ! $args['echo'] ) {
		return $close;
	} else {
		echo $close;
	} //else

	/**
	 * Runs after the closing header tag.
	 *
	 * @since 0.1.0
	 */
	do_action( 'do_after_mm_archive_header_content_close' );

} // action_mm_paragraph_archive_header_content()

/*
 * Footers
 */

/**
 * Adds a content footer on single 'paragraph' pages.
 *
 * @since 0.1.0
 *
 * @see wp_parse_args()
 * @link https://developer.wordpress.org/reference/functions/wp_parse_args/
 *
 * @param array $args {
 *     Optional. An array of arguments.
 *
 *     @type string $class HTML class attribute for the footer tag.
 *                         Default 'entry-footer'.
 *     @type bool   $echo  Whether to echo the footer or return.
 *                         Default TRUE.
 * }
 * @param array  $args  {
 *     Parsed $defaults.
 * }
 * @param string $open  The opening footer tag.
 * @param string $close The closing footer tag.
 * @return string The opening footer tag.
 * @return string The closing footer tag.
 */
function action_mm_paragraph_footer_content( $args ) {

	$defaults = array(
		'class' => 'entry-footer',
		'echo'  => TRUE
	);

	// Parse incoming $args into an array and merge it with $defaults
	$args = wp_parse_args( $args, $defaults );

	// Define opening footer tag HTML
	$open = sprintf( '<footer class="%s">',
				esc_attr( $args['class'] )
			);

	// Define closing footer tag HTML
	$close = sprintf( '</footer><!-- .%s -->',
				esc_attr( $args['class'] )
			);

	/**
	 * Runs before the opening footer tag.
	 *
	 * @since 0.1.0
	 */
	do_action( 'do_before_mm_paragraph_footer_content_open' );

	if ( ! $args['echo'] ) {
		return $open;
	} else {
		echo $open;
	} //else

		/**
		 * Runs after the opening footer tag.
		 *
		 * @since 0.1.0
		 *
		 * @hooked action_mm_edit_post_link - 10
		 */
		do_action( 'do_after_mm_paragraph_footer_content_open' );

		/**
		 * Runs before the closing footer tag.
		 *
		 * @since 0.1.0
		 */
		do_action( 'do_before_mm_paragraph_footer_content_close' );

	if ( ! $args['echo'] ) {
		return $close;
	} else {
		echo $close;
	} //else

	/**
	 * Runs after the closing header tag.
	 *
	 * @since 0.1.0
	 */
	do_action( 'do_after_mm_paragraph_footer_content_close' );

} // action_mm_paragraph_footer_content()

/*
 * 4.0 Titles
 */

/*
 * 4.1 Paragraph Title
 */

/**
 * Adds the paragraph title to the markup.
 *
 * Adds a permalink for the title on archive and taxonomy pages,
 * but only adds the title text on single 'paragraph' pages.
 *
 * @since 0.1.0
 *
 * @see the_title()
 * @link https://developer.wordpress.org/reference/functions/the_title/
 */
function action_mm_paragraph_title_markup() {

	/**
	 * Runs before adding the paragraph title.
	 *
	 * @since 0.1.0
	 *
	 * @hooked 'action_mm_paragraph_navigation' - 10
	 */
	do_action( 'do_before_mm_the_paragraph_title' );

	if ( is_post_type_archive( 'paragraph' )
		|| is_tax( array( 'section', 'index_locator' ) )
		|| is_search()
	) {

			the_title( sprintf(
				'<h2 class="entry-title"><a href="%s" rel="bookmark">',
				esc_url( get_permalink() ) ),
				'</a></h2>'
			);
	} elseif ( is_single() ) {

		the_title( '<h1 class="entry-title">', '</h1>' );

	}

	/**
	 * Runs after adding the paragraph title.
	 *
	 * @since 0.1.0
	 */
	do_action( 'do_after_mm_the_paragraph_title' );

} // action_mm_paragraph_title_markup()

/*
 * 4.2 Archive/Taxonomy Title and Description
 */

/**
 * Adds the archive title and description to the markup.
 *
 * @since 0.1.0
 *
 * @see mm_the_archive_title()
 *
 * @see the_archive_description()
 * @link https://developer.wordpress.org/reference/functions/the_archive_description/
 */
function action_mm_archive_title_markup() {

	/**
	 * Runs before adding the archive title.
	 *
	 * @since 0.1.0
	 *
	 * @hooked 'action_mm_paragraphs_navigation' - 10
	 */
	do_action( 'do_before_mm_the_archive_title' );

	// Add the archive title inside an h1 tag by default.
	mm_the_archive_title( '<h1 class="page-title">', '</h1>' );

	/**
	 * Runs after adding the archive title.
	 *
	 * @since 0.1.0
	 */
	do_action( 'do_after_mm_the_archive_title' );

	/**
	 * Runs before adding the archive description.
	 *
	 * @since 0.1.0
	 */
	do_action( 'do_before_mm_the_archive_description' );

	// Add the the archive description.
	the_archive_description();

	/**
	 * Runs after adding the archive description.
	 *
	 * @since 0.1.0
	 */
	do_action( 'do_after_mm_the_archive_description' );

} // action_mm_archive_title_markup()

/**
 * Displays the archive title based on the queried object.
 *
 * Replaces WordPress' `the_archive_title()` for ManualMaker template files
 * so that the word **All** appears before the post type name
 * instead of **Archives:** when viewing the 'paragraph' post type archive.
 *
 * This should make more sense from a reader's point of view,
 * since ManualMaker's 'paragraph' archive page is basically like
 * reading the_ entire document_ made with ManualMaker
 * rather than an "archive" selected from a fewer number of such paragraphs.
 *
 * If you want something different than **All**
 * to display when viewing the 'paragraph' post type archive,
 * then you should make your own modified copy of this function.
 *
 * Otherwise, use `apply_to_mm_the_archive_title`
 * to append conditions for the `$title` variable to this function.
 *
 * @since 0.1.0
 *
 * @see is_post_type_archive()
 * @link https://developer.wordpress.org/reference/functions/is_post_type_archive/
 *
 * @see get_the_archive_title()
 * @link https://developer.wordpress.org/reference/functions/get_the_archive_title/
 *
 * @param string $before Optional. Content to prepend to the description.
 *                                 Default empty.
 * @param string $after  Optional. Content to append to the description.
 *                                 Default empty.
 * @param string $title  The archive title.
 */
function mm_the_archive_title( $before = '', $after = '' ) {

	if ( is_post_type_archive( 'paragraph' ) ) {

		$title = str_replace(
			'Archives: ',
			// translators: 'paragraph' post type archive title
			_x( 'All ', 'manualmaker' ),
			get_the_archive_title()
		);

	} else {

		$title = get_the_archive_title();

	}

	/**
	 * Allows plugins and themes to add conditions for `$title` variable.
	 *
	 * @since 0.1.0
	 */
	apply_filters( 'apply_to_mm_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before, $title, $after;
	}

} // mm_the_archive_title()

/*
 * 5.0 Sidebar
 */

/**
 * Adds a sidebar.
 *
 * @since 0.1.0
 *
 * @see get_sidebar()
 * @link https://developer.wordpress.org/reference/functions/get_sidebar/
 *
 * @param callback $mm_sidebar The default sidebar.
 * @return callback A filtered sidebar, if applicable.
 */
function action_mm_get_sidebar( $mm_sidebar ) {

	/**
	 * ManualMaker's default sidebar.
	 *
	 * @since 0.1.0
	 * @var callback $mm_sidebar
	 */
	$mm_sidebar = get_sidebar();

	/**
	 * Allows plugins and themes to override the  default sidebar variable.
	 *
	 * @since 0.1.0
	 */
	return apply_filters( 'apply_to_action_mm_sidebar', $mm_sidebar );

} // action_mm_get_sidebar()

/*
 * 6.0 Previous/Next Navigation Links
 */

/*
 * 6.1 Single Pages
 */

/**
 * Defines previous/next navigation for single pages.
 *
 * @since 0.1.0
 *
 * @see the_post_navigation()
 * @link https://developer.wordpress.org/reference/functions/the_post_navigation/
 *
 * @param array $defaults {
 *     The default array for the_post_naviation.
 * }
 * @param array  $args  {
 *     Parsed $defaults.
 * }
 * @return callback A filtered array for `the_post_naviation()`, if applicable.
 */
function action_mm_paragraph_navigation( $args ) {

	$defaults = the_post_navigation( array(
			'next_text' => '<span class="meta-nav" aria-hidden="true">' .
								__( 'Next', 'manualmaker' ) .
							'</span> ' .
							'<span class="screen-reader-text">' .
								__( 'Next post:', 'manualmaker' ) .
							'</span> ' .
							'<span class="post-title">%title</span>',
			'prev_text' => '<span class="meta-nav" aria-hidden="true">' .
								__( 'Previous', 'manualmaker' ) .
							'</span> ' .
							'<span class="screen-reader-text">' .
								__( 'Previous post:', 'manualmaker' ) .
							'</span> ' .
							'<span class="post-title">%title</span>',
		)
	);

	// Parse incoming $args into an array and merge it with $defaults
	$args = wp_parse_args( $args, $defaults );

	/**
	 * Runs before returning `the_post_navigation`.
	 *
	 * @since 0.1.0
	 */
	do_action( 'do_before_action_mm_paragraph_navigation' );

	if ( is_single( 'paragraph' ) ) {

		/**
		 * Allows plugins and themes to override array parameters.
		 *
		 * @since 0.1.0
		 */
		return apply_filters( 'apply_to_action_mm_paragraph_navigation', $args );

	} // if

	else {
			return;
	}

	/**
	 * Runs after returning `the_post_navigation`.
	 *
	 * @since 0.1.0
	 */
	do_action( 'do_after_action_mm_paragraph_navigation' );

} // action_mm_paragraph_navigation()

/*
 * 6.2 Archive and Taxonomy Pages
 */

/**
 * Defines previous/next navigation for archive and taxonomy pages.
 *
 * @since 0.1.0
 *
 * @see the_posts_navigation()
 * @link https://developer.wordpress.org/reference/functions/the_posts_navigation/
 *
 * @param array $defaults {
 *     The default array for the_post_naviation.
 * }
 * @param array  $args  {
 *     Parsed $defaults.
 * }
 * @return callback A filtered array for `the_posts_naviation()`, if applicable.

 */
function action_mm_paragraphs_navigation( $args ) {

	$defaults = the_posts_pagination( array(
		'prev_text'          => __( 'Previous page', 'manualmaker' ),
		'next_text'          => __( 'Next page', 'manualmaker' ),
		'before_page_number' => '<span class="meta-nav screen-reader-text">' .
								__( 'Page', 'manualmaker' ) .
								' </span>',
		)
	);

	// Parse incoming $args into an array and merge it with $defaults
	$args = wp_parse_args( $args, $defaults );

	/**
	 * Runs before returning `the_posts_navigation`.
	 *
	 * @since 0.1.0
	 */
	do_action( 'do_before_action_mm_paragraphs_navigation' );

	if( is_post_type_archive( 'paragraph' )
		|| is_tax( array( 'section', 'index_locator' ) )
		|| is_search()
	) {

		/**
		 * Allows plugins and themes to override array parameters.
		 *
		 * @since 0.1.0
		 */
		return apply_filters( 'apply_to_action_mm_paragraphs_navigation', $args );

	} // if

	/**
	 * Runs after returning `the_posts_navigation`.
	 *
	 * @since 0.1.0
	 */
	do_action( 'do_after_action_mm_paragraphs_navigation' );

} // action_mm_paragraphs_navigation()

/*
 * 7.0 Edit Links
 */

/**
 * Displays the edit post link for 'paragraph' custom post type.
 *
 * @since 0.1.0
 *
 * @see edit_post_link()
 * @link https://developer.wordpress.org/reference/functions/edit_post_link/
 */
function action_mm_edit_post_link( $args ) {

	$defaults = array(
		'class' => 'edit-link'
	);

	/**
	 * Runs before opening footer tag for `edit_post_link()`.
	 *
	 * @since 0.1.0
	 */
	do_action( 'do_before_action_mm_edit_post_link' );

	// Parse incoming $args into an array and merge it with $defaults
	$args = wp_parse_args( $args, $defaults );

	edit_post_link(
		__( 'Edit', 'manualmaker' ),
		'<span class="' . esc_attr( $args['class'] ) . '">',
		'</span><!-- .' . esc_attr( $args['class'] ) . '-->'
	);

	/**
	 * Runs after closing footer tag for `edit_post_link()`.
	 *
	 * @since 0.1.0
	 */
	do_action( 'do_after_action_mm_edit_post_link' );

} // action_mm_edit_post_link()
