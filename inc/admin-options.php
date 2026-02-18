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

    add_settings_section('il_branding_section', __('Branding & Header', 'ipsum-logistic'), '__return_null', 'il-theme-options');
    add_settings_section('il_contact_section', __('Contact & Social', 'ipsum-logistic'), '__return_null', 'il-theme-options');

    $branding_fields = [
        'color_primary' => ['label' => 'Primary Color', 'type' => 'color'],
        'color_secondary' => ['label' => 'Secondary Color (Blue)', 'type' => 'color'],
        'show_top_bar' => ['label' => 'Show Top Bar', 'type' => 'checkbox'],
        'header_cta_text' => ['label' => 'Header CTA Text', 'type' => 'text'],
        'header_cta_url' => ['label' => 'Header CTA URL', 'type' => 'url'],
    ];

    foreach ($branding_fields as $key => $config) {
        add_settings_field(
            $key,
            __($config['label'], 'ipsum-logistic'),
            'il_render_option_field',
            'il-theme-options',
            'il_branding_section',
            ['key' => $key, 'type' => $config['type']]
        );
    }

    $contact_fields = [
        'work_hours' => ['label' => 'Work Hours', 'type' => 'text'],
        'phone' => ['label' => 'Phone', 'type' => 'text'],
        'email' => ['label' => 'Email', 'type' => 'email'],
        'address' => ['label' => 'Address', 'type' => 'textarea'],
        'facebook' => ['label' => 'Facebook URL', 'type' => 'url'],
        'instagram' => ['label' => 'Instagram URL', 'type' => 'url'],
        'linkedin' => ['label' => 'LinkedIn URL', 'type' => 'url'],
        'map_embed' => ['label' => 'Map Iframe Embed', 'type' => 'textarea'],
    ];

    foreach ($contact_fields as $key => $config) {
        add_settings_field(
            $key,
            __($config['label'], 'ipsum-logistic'),
            'il_render_option_field',
            'il-theme-options',
            'il_contact_section',
            ['key' => $key, 'type' => $config['type']]
        );
    }
});

function il_sanitize_theme_options(array $input): array {
    $allowed_iframe = ['iframe' => ['src' => true, 'width' => true, 'height' => true, 'style' => true, 'allowfullscreen' => true, 'loading' => true, 'referrerpolicy' => true, 'title' => true]];
    $out = [];

    $out['color_primary'] = sanitize_hex_color((string) ($input['color_primary'] ?? '')) ?: '#fb923c';
    $out['color_secondary'] = sanitize_hex_color((string) ($input['color_secondary'] ?? '')) ?: '#1e3a8a';
    $out['show_top_bar'] = !empty($input['show_top_bar']) ? '1' : '0';
    $out['header_cta_text'] = sanitize_text_field((string) ($input['header_cta_text'] ?? 'Teklif Al'));
    $out['header_cta_url'] = esc_url_raw((string) ($input['header_cta_url'] ?? '#contact'), ['http', 'https']);

    $out['work_hours'] = sanitize_text_field((string) ($input['work_hours'] ?? ''));
    $out['phone'] = sanitize_text_field((string) ($input['phone'] ?? ''));
    $out['email'] = sanitize_email((string) ($input['email'] ?? ''));
    $out['address'] = sanitize_textarea_field((string) ($input['address'] ?? ''));

    foreach (['facebook', 'instagram', 'linkedin'] as $url_key) {
        $out[$url_key] = esc_url_raw((string) ($input[$url_key] ?? ''), ['http', 'https']);
    }

    $out['map_embed'] = wp_kses((string) ($input['map_embed'] ?? ''), $allowed_iframe);

    return $out;
}

function il_render_option_field(array $args): void {
    $key = (string) ($args['key'] ?? '');
    $type = (string) ($args['type'] ?? 'text');
    $options = get_option('il_theme_options');
    $value = is_array($options) ? (string) ($options[$key] ?? '') : '';

    if ($type === 'textarea') {
        printf('<textarea class="large-text" rows="4" name="il_theme_options[%s]">%s</textarea>', esc_attr($key), esc_textarea($value));
        return;
    }

    if ($type === 'checkbox') {
        printf('<label><input type="checkbox" name="il_theme_options[%s]" value="1" %s> %s</label>', esc_attr($key), checked($value, '1', false), esc_html__('Enable', 'ipsum-logistic'));
        return;
    }

    if ($type === 'color') {
        printf('<input class="regular-text" type="color" name="il_theme_options[%s]" value="%s">', esc_attr($key), esc_attr($value !== '' ? $value : '#000000'));
        return;
    }

    $input_type = in_array($type, ['url', 'email', 'text'], true) ? $type : 'text';
    printf('<input class="regular-text" type="%s" name="il_theme_options[%s]" value="%s">', esc_attr($input_type), esc_attr($key), esc_attr($value));
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
