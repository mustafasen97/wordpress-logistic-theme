<?php
/**
 * Enqueue theme assets and dynamic style variables.
 *
 * @package wordpress-logistic-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue frontend stylesheet and inject color custom properties.
 */
function logistic_theme_enqueue_styles() {
	$style_path = get_template_directory() . '/assets/css/style.css';
	$version    = file_exists( $style_path ) ? (string) filemtime( $style_path ) : wp_get_theme()->get( 'Version' );

	wp_enqueue_style(
		'logistic-theme-style',
		get_template_directory_uri() . '/assets/css/style.css',
		array(),
		$version
	);

	$about_card_bg    = logistic_theme_get_option( 'about_card_bg_color', '#fa9d54' );
	$section_bg_light = logistic_theme_get_option( 'light_section_bg_color', '#f8fafc' );
	$footer_bg        = logistic_theme_get_option( 'footer_bg_color', '#1e3a8a' );
	$footer_bottom_bg = logistic_theme_get_option( 'footer_bottom_bg_color', '#fa9d54' );

	$inline_css = sprintf(
		':root{--about-card-bg:%1$s;--section-bg-light:%2$s;--footer-bg:%3$s;--footer-bottom-bg:%4$s;}',
		esc_attr( $about_card_bg ),
		esc_attr( $section_bg_light ),
		esc_attr( $footer_bg ),
		esc_attr( $footer_bottom_bg )
	);

	wp_add_inline_style( 'logistic-theme-style', $inline_css );
}
add_action( 'wp_enqueue_scripts', 'logistic_theme_enqueue_styles' );
