<?php
/**
 * Theme color options (Customizer + helpers).
 *
 * @package wordpress-logistic-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns default color options.
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
 * Returns a single option value with strict hex sanitation.
 *
 * @param string $key     Option key.
 * @param string $default Default fallback value.
 * @return string
 */
function logistic_theme_get_option( $key, $default = '' ) {
	$defaults = logistic_theme_get_default_options();

	if ( isset( $defaults[ $key ] ) ) {
		$default = $defaults[ $key ];
	}

	$value = get_theme_mod( $key, $default );

	if ( is_string( $value ) ) {
		$sanitized = sanitize_hex_color( $value );
		if ( $sanitized ) {
			return $sanitized;
		}
	}

	return $default;
}

/**
 * Register Customizer settings and controls for theme colors.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 */
function logistic_theme_customize_register( $wp_customize ) {
	$defaults = logistic_theme_get_default_options();

	$wp_customize->add_section(
		'logistic_theme_colors',
		array(
			'title'       => __( 'Theme Colors', 'wordpress-logistic-theme' ),
			'description' => __( 'Customize frequently used color areas.', 'wordpress-logistic-theme' ),
			'priority'    => 30,
		)
	);

	$controls = array(
		'about_card_bg_color'    => __( 'About Card Background', 'wordpress-logistic-theme' ),
		'light_section_bg_color' => __( 'Light Section Background', 'wordpress-logistic-theme' ),
		'footer_bg_color'        => __( 'Footer Background', 'wordpress-logistic-theme' ),
		'footer_bottom_bg_color' => __( 'Footer Bottom Background', 'wordpress-logistic-theme' ),
	);

	foreach ( $controls as $key => $label ) {
		$wp_customize->add_setting(
			$key,
			array(
				'default'           => $defaults[ $key ],
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'refresh',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$key,
				array(
					'label'   => $label,
					'section' => 'logistic_theme_colors',
				)
			)
		);
	}
}
add_action( 'customize_register', 'logistic_theme_customize_register' );
