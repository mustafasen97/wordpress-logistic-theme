<?php
/**
 * Enqueue theme assets.
 *
 * @package wordpress-logistic-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Resolves color option with fallback.
 *
 * @param string $key Option key.
 * @param string $fallback Default color.
 * @return string
 */
function logistic_theme_get_color_option( $key, $fallback ) {
	$value = '';

	if ( function_exists( 'logistic_theme_get_option' ) ) {
		$value = logistic_theme_get_option( $key, $fallback );
	} elseif ( function_exists( 'get_theme_mod' ) ) {
		$value = get_theme_mod( $key, $fallback );
	}

	$sanitized = sanitize_hex_color( $value );
	return $sanitized ? $sanitized : $fallback;
}

/**
 * Enqueue frontend stylesheet and dynamic CSS variables.
 */
function logistic_theme_enqueue_styles() {
	wp_enqueue_style(
		'logistic-theme-style',
		get_template_directory_uri() . '/assets/css/style.css',
		array(),
		wp_get_theme()->get( 'Version' )
	);

	$about_card_bg    = logistic_theme_get_color_option( 'about_card_bg_color', '#fa9d54' );
	$section_bg_light = logistic_theme_get_color_option( 'light_section_bg_color', '#f8fafc' );
	$footer_bg        = logistic_theme_get_color_option( 'footer_bg_color', '#1e3a8a' );
	$footer_bottom_bg = logistic_theme_get_color_option( 'footer_bottom_bg_color', '#fa9d54' );

	$css = sprintf(
		':root{--about-card-bg:%1$s;--section-bg-light:%2$s;--footer-bg:%3$s;--footer-bottom-bg:%4$s;}',
		esc_html( $about_card_bg ),
		esc_html( $section_bg_light ),
		esc_html( $footer_bg ),
		esc_html( $footer_bottom_bg )
	);

	wp_add_inline_style( 'logistic-theme-style', $css );
}
add_action( 'wp_enqueue_scripts', 'logistic_theme_enqueue_styles' );
