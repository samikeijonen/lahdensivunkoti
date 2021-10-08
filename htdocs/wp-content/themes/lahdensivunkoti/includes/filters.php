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

/**
 * Display SVG icons in social links menu.
 *
 * @param  string  $item_output The menu item output.
 * @param  WP_Post $item        Menu item object.
 * @param  int     $depth       Depth of the menu.
 * @param  object  $args        wp_nav_menu() arguments.
 * @return string  $item_output The menu item output with social icon.
 */
function nav_menu_social_icons( $item_output, $item, $depth, $args ) {
    // Get supported social icons.
    $social_icons = social_links_icons();

    // Change SVG icon inside social links menu if there is supported URL.
    if ( 'social_links' === $args->theme_location ) {
        foreach ( $social_icons as $attr => $value ) {
            if ( false !== strpos( $item_output, $attr ) ) {
                $item_output = str_replace( $args->link_after, '</span>' . get_svg( esc_attr( $value ) ), $item_output );
            }
        }
    }

    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'Kala\nav_menu_social_icons', 10, 4 );

/**
 * Returns an array of supported social links (URL and icon name).
 *
 * @return array $social_links_icons
 */
function social_links_icons() {
    // Supported social links icons.
    $social_links_icons = array(
        'facebook.com'  => 'facebook',
        'instagram.com' => 'instagram',
        'twitter.com'   => 'twitter',
    );

    return $social_links_icons;
}
