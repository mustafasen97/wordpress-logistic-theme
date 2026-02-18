<?php
/**
 * Theme bootstrap.
 *
 * @package wordpress-logistic-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once get_template_directory() . '/inc/admin-options.php';
require_once get_template_directory() . '/inc/enqueue.php';

/**
 * Set up theme defaults and supports.
 */
function logistic_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'responsive-embeds' );

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'wordpress-logistic-theme' ),
			'footer'  => __( 'Footer Menu', 'wordpress-logistic-theme' ),
		)
	);
}
add_action( 'after_setup_theme', 'logistic_theme_setup' );
