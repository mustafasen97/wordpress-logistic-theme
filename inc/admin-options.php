<?php
/**
 * Admin options defaults and sanitization.
 *
 * @package wordpress-logistic-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns default theme options.
 *
 * @return array<string, string>
 */
function logistic_theme_get_default_options() {
	return array(
		'about_card_bg_color'    => '#fa9d54',
		'light_section_bg_color' => '#f8fafc',
		'footer_bg_color'        => '#1e3a8a',
		'footer_bottom_bg_color' => '#fa9d54',
	);
}

/**
 * Sanitizes theme options.
 *
 * @param array<string, mixed> $input Raw options.
 * @return array<string, string>
 */
function logistic_theme_sanitize_options( $input ) {
	$defaults = logistic_theme_get_default_options();
	$output   = $defaults;

	foreach ( $defaults as $key => $default ) {
		if ( isset( $input[ $key ] ) ) {
			$sanitized = sanitize_hex_color( $input[ $key ] );
			$output[ $key ] = $sanitized ? $sanitized : $default;
		}
	}

	return $output;
}
