<?php
/**
 * General filters used in the theme
 *
 * @package Lahdensivunkoti
 */

namespace Kala;

/**
 * Remove "Archive: " from archive titles
 *
 * @param string $title The title for the archive.
 * @return string
 */
function theme_archive_title( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>';
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	} elseif ( is_home() ) {
		$title = get_the_title( get_option( 'page_for_posts' ) );
	}

	return $title;
}
add_filter( 'get_the_archive_title', 'Kala\theme_archive_title' );

/**
 * Automatically skip the default assigned slug on any attachment.
 * So an attachment that might normally get the slug "services" will now get the slug "services-2".
 */
add_filter( 'wp_unique_post_slug_is_bad_attachment_slug', '__return_true' );

/**
 * Move Yoast to the bottom of the page.
 *
 * @return string
 */
function yoast_to_bottom() {
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'Kala\yoast_to_bottom', 999, 1 );
