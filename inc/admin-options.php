<?php
declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

add_action('admin_menu', static function (): void {
    add_theme_page(
        __('Theme Options', 'ipsum-logistic'),
        __('Theme Options', 'ipsum-logistic'),
        'manage_options',
        'il-theme-options',
        'il_render_theme_options_page'
    );
});

add_action('admin_init', static function (): void {
    register_setting('il_theme_options_group', 'il_theme_options', [
        'type' => 'array',
        'sanitize_callback' => 'il_sanitize_theme_options',
        'default' => [],
    ]);

    add_settings_section('il_contact_section', __('Contact & Social', 'ipsum-logistic'), '__return_null', 'il-theme-options');

    $fields = [
        'work_hours' => 'Work Hours',
        'phone' => 'Phone',
        'email' => 'Email',
        'address' => 'Address',
        'facebook' => 'Facebook URL',
        'instagram' => 'Instagram URL',
        'linkedin' => 'LinkedIn URL',
        'map_embed' => 'Map Iframe Embed',
    ];

    foreach ($fields as $key => $label) {
        add_settings_field($key, __($label, 'ipsum-logistic'), 'il_render_option_field', 'il-theme-options', 'il_contact_section', ['key' => $key]);
    }
});

function il_sanitize_theme_options(array $input): array {
    $allowed_iframe = ['iframe' => ['src' => true, 'width' => true, 'height' => true, 'style' => true, 'allowfullscreen' => true, 'loading' => true, 'referrerpolicy' => true, 'title' => true]];
    $out = [];
    $out['work_hours'] = sanitize_text_field((string) ($input['work_hours'] ?? ''));
    $out['phone'] = sanitize_text_field((string) ($input['phone'] ?? ''));
    $out['email'] = sanitize_email((string) ($input['email'] ?? ''));
    $out['address'] = sanitize_textarea_field((string) ($input['address'] ?? ''));

    foreach (['facebook', 'instagram', 'linkedin'] as $url_key) {
        $url = esc_url_raw((string) ($input[$url_key] ?? ''), ['http', 'https']);
        $out[$url_key] = $url;
    }

    $out['map_embed'] = wp_kses((string) ($input['map_embed'] ?? ''), $allowed_iframe);
    return $out;
}

function il_render_option_field(array $args): void {
    $key = (string) ($args['key'] ?? '');
    $options = get_option('il_theme_options');
    $value = is_array($options) ? (string) ($options[$key] ?? '') : '';

    if ($key === 'address' || $key === 'map_embed') {
        printf('<textarea class="large-text" rows="4" name="il_theme_options[%s]">%s</textarea>', esc_attr($key), esc_textarea($value));
        return;
    }

    $type = $key === 'email' ? 'email' : 'text';
    printf('<input class="regular-text" type="%s" name="il_theme_options[%s]" value="%s">', esc_attr($type), esc_attr($key), esc_attr($value));
}

function il_render_theme_options_page(): void {
    if (!current_user_can('manage_options')) {
        return;
    }
    echo '<div class="wrap"><h1>' . esc_html__('Theme Options', 'ipsum-logistic') . '</h1><form action="options.php" method="post">';
    settings_fields('il_theme_options_group');
    do_settings_sections('il-theme-options');
    submit_button();
    echo '</form></div>';
}
