<?php
/**
 * Functions.
 *
 * @package Lahdensivunkoti
 */

namespace Kala;

define( 'HOME_URI', home_url() );
define( 'WP_URI', HOME_URI . '/wp' );
define( 'THEME_URI', get_stylesheet_directory_uri() );
define( 'IMAGES', THEME_URI . '/images' );

require_once 'includes/clean-default-settings.php';
require_once 'includes/enqueue-assets.php';
require_once 'includes/gutenberg.php';
require_once 'includes/helpers.php';
require_once 'includes/filters.php';

/**
 * Setup theme.
 *
 * @return void
 */
function setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );
	add_editor_style( 'build/editor.css' );
	load_theme_textdomain( 'lahdensivunkoti', get_template_directory() . '/languages' );

	// Register menus.
	register_nav_menus(
		[
			'main'         => esc_html__( 'Main', 'lahdensivunkoti' ),
			'footer'       => esc_html__( 'Footer', 'lahdensivunkoti' ),
			'social_links' => esc_html__( 'Social links', 'lahdensivunkoti' ),
		]
	);

	add_image_size( 'lsk-large', 912, 684, true );
}
add_action( 'after_setup_theme', 'Kala\setup' );
