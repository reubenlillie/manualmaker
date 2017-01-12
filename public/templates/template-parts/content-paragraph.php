<?php
/**
 * The template used for displaying 'paragraph' content on archive pages.
 *
 * @package ManualMaker
 * @subpackage ManualMaker\includes\templates\template-parts
 * @since 0.1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Runs before article opens.
 *
 * @since 0.1.0
 */
do_action( 'do_before_mm_paragraph_content_article_open' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	/**
	 * Runs after article opens.
	 *
	 * @since 0.1.0
	 *
	 * @hooked action_mm_paragraph_header - 10
	 */
	do_action( 'do_after_mm_paragraph_content_article_open' );

	/**
	 * Runs after article opens.
	 *
	 * @since 0.1.0
	 *
	 * @hooked action_mm_paragraph_content_wrapper_open - 10
	 */
	do_action( 'do_before_mm_paragraph_content' );
	?>

	<div class="entry-content">

		<?php
		the_content();

		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'manualmaker' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'manualmaker' ) . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
		) );
		?>

	</div><!-- .entry-content -->

	<?php
	/**
	 * Runs before article closes.
	 *
	 * @since 0.1.0
	 *
	 * @hooked action_mm_paragraph_content_wrapper_close - 10
	 * @hooked action_mm_paragraph_footer_content - 20
	 */
	do_action( 'do_before_mm_paragraph_content_article_close' );
	?>

</article><!-- #post-## --><?php

/**
 * Runs after article closes.
 *
 * @since 0.1.0
 */
do_action( 'do_after_mm_paragraph_content_article_close' );
