<?php
declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

function il_sanitize_checkbox($value): string {
    return !empty($value) ? '1' : '0';
}

function il_sanitize_select($value, WP_Customize_Setting $setting): string {
    $control = $setting->manager->get_control($setting->id);
    if ($control instanceof WP_Customize_Control && is_array($control->choices) && isset($control->choices[$value])) {
        return $value;
    }

    return (string) $setting->default;
}

add_action('customize_register', static function (WP_Customize_Manager $wp_customize): void {
    $wp_customize->add_panel('il_theme_panel', [
        'title' => __('Ipsum Logistic Theme', 'ipsum-logistic'),
        'priority' => 30,
    ]);

    $wp_customize->add_section('il_branding_header', [
        'title' => __('Branding & Header', 'ipsum-logistic'),
        'panel' => 'il_theme_panel',
    ]);

    $wp_customize->add_section('il_hero_section', [
        'title' => __('Hero Section', 'ipsum-logistic'),
        'panel' => 'il_theme_panel',
    ]);

    $wp_customize->add_section('il_about_section', [
        'title' => __('About Section', 'ipsum-logistic'),
        'panel' => 'il_theme_panel',
    ]);

    $wp_customize->add_section('il_services_section', [
        'title' => __('Services Section', 'ipsum-logistic'),
        'panel' => 'il_theme_panel',
    ]);

    $wp_customize->add_section('il_why_section', [
        'title' => __('Why Us Section', 'ipsum-logistic'),
        'panel' => 'il_theme_panel',
    ]);

    $wp_customize->add_section('il_testimonials_section', [
        'title' => __('Testimonials Section', 'ipsum-logistic'),
        'panel' => 'il_theme_panel',
    ]);

    $wp_customize->add_section('il_contact_social', [
        'title' => __('Contact & Social', 'ipsum-logistic'),
        'panel' => 'il_theme_panel',
    ]);

    $wp_customize->add_section('il_footer_section', [
        'title' => __('Footer', 'ipsum-logistic'),
        'panel' => 'il_theme_panel',
    ]);

    $settings = [
        'il_color_primary' => ['section' => 'il_branding_header', 'label' => __('Primary Color', 'ipsum-logistic'), 'default' => '#fb923c', 'sanitize' => 'sanitize_hex_color', 'control' => 'WP_Customize_Color_Control'],
        'il_color_secondary' => ['section' => 'il_branding_header', 'label' => __('Secondary Color', 'ipsum-logistic'), 'default' => '#1e3a8a', 'sanitize' => 'sanitize_hex_color', 'control' => 'WP_Customize_Color_Control'],
        'il_show_top_bar' => ['section' => 'il_branding_header', 'label' => __('Show Top Bar', 'ipsum-logistic'), 'default' => '1', 'sanitize' => 'il_sanitize_checkbox', 'type' => 'checkbox'],
        'il_header_cta_text' => ['section' => 'il_branding_header', 'label' => __('Header CTA Text', 'ipsum-logistic'), 'default' => 'Teklif Al', 'sanitize' => 'sanitize_text_field'],
        'il_header_cta_url' => ['section' => 'il_branding_header', 'label' => __('Header CTA URL', 'ipsum-logistic'), 'default' => '#contact', 'sanitize' => 'esc_url_raw'],
        'il_header_layout' => ['section' => 'il_branding_header', 'label' => __('Header Layout', 'ipsum-logistic'), 'default' => 'default', 'sanitize' => 'il_sanitize_select', 'type' => 'select', 'choices' => ['default' => __('Default', 'ipsum-logistic'), 'centered-logo' => __('Centered Logo', 'ipsum-logistic')]],

        'il_front_hero_title' => ['section' => 'il_hero_section', 'label' => __('Hero Title', 'ipsum-logistic'), 'default' => 'Uluslararası Profesyonel Taşımacılık ve Lojistik Çözümleri', 'sanitize' => 'sanitize_text_field'],
        'il_front_hero_subtitle' => ['section' => 'il_hero_section', 'label' => __('Hero Description', 'ipsum-logistic'), 'default' => 'Rorem ipsum dolor sit amet, consectetur adipiscing elit.', 'sanitize' => 'sanitize_textarea_field', 'type' => 'textarea'],
        'il_front_hero_cta_text' => ['section' => 'il_hero_section', 'label' => __('Hero CTA Text', 'ipsum-logistic'), 'default' => 'Ücretsiz Teklif Alın', 'sanitize' => 'sanitize_text_field'],
        'il_front_hero_cta_url' => ['section' => 'il_hero_section', 'label' => __('Hero CTA URL', 'ipsum-logistic'), 'default' => '#contact', 'sanitize' => 'esc_url_raw'],
        'il_front_hero_second_cta_text' => ['section' => 'il_hero_section', 'label' => __('Hero Secondary CTA Text', 'ipsum-logistic'), 'default' => 'Hizmetlerimizi Keşfedin', 'sanitize' => 'sanitize_text_field'],
        'il_front_hero_phone_prefix' => ['section' => 'il_hero_section', 'label' => __('Hero Phone Label', 'ipsum-logistic'), 'default' => 'Bizi Hemen Arayın', 'sanitize' => 'sanitize_text_field'],
        'il_front_hero_form_title' => ['section' => 'il_hero_section', 'label' => __('Hero Form Title', 'ipsum-logistic'), 'default' => 'Hemen Teklif Alın', 'sanitize' => 'sanitize_text_field'],
        'il_front_hero_form_name_placeholder' => ['section' => 'il_hero_section', 'label' => __('Hero Form Name Placeholder', 'ipsum-logistic'), 'default' => 'Ad Soyad', 'sanitize' => 'sanitize_text_field'],
        'il_front_hero_form_email_placeholder' => ['section' => 'il_hero_section', 'label' => __('Hero Form Email Placeholder', 'ipsum-logistic'), 'default' => 'E-Posta', 'sanitize' => 'sanitize_text_field'],
        'il_front_hero_form_phone_placeholder' => ['section' => 'il_hero_section', 'label' => __('Hero Form Phone Placeholder', 'ipsum-logistic'), 'default' => 'Telefon Numarası', 'sanitize' => 'sanitize_text_field'],
        'il_front_hero_form_cargo_placeholder' => ['section' => 'il_hero_section', 'label' => __('Hero Form Cargo Placeholder', 'ipsum-logistic'), 'default' => 'Yük Tipi', 'sanitize' => 'sanitize_text_field'],
        'il_front_hero_form_checkbox_text' => ['section' => 'il_hero_section', 'label' => __('Hero Form Consent Text', 'ipsum-logistic'), 'default' => "KVKK Açık Rıza Metni'ni okudum, anladım ve onaylıyorum.", 'sanitize' => 'sanitize_text_field'],
        'il_front_hero_form_button_text' => ['section' => 'il_hero_section', 'label' => __('Hero Form Button Text', 'ipsum-logistic'), 'default' => 'Hemen Teklif Al', 'sanitize' => 'sanitize_text_field'],

        'il_front_about_badge' => ['section' => 'il_about_section', 'label' => __('About Badge', 'ipsum-logistic'), 'default' => 'Hakkımızda', 'sanitize' => 'sanitize_text_field'],
        'il_front_about_heading' => ['section' => 'il_about_section', 'label' => __('About Heading', 'ipsum-logistic'), 'default' => 'Yılların Deneyimiyle Birlikte Her Sevkiyat Ayrı Bir Güvence', 'sanitize' => 'sanitize_text_field'],
        'il_front_about_description' => ['section' => 'il_about_section', 'label' => __('About Description', 'ipsum-logistic'), 'default' => 'Borem ipsum dolor sit amet, consectetur adipiscing elit.', 'sanitize' => 'wp_kses_post', 'type' => 'textarea'],
        'il_front_about_years_number' => ['section' => 'il_about_section', 'label' => __('Experience Number', 'ipsum-logistic'), 'default' => '+25', 'sanitize' => 'sanitize_text_field'],
        'il_front_about_years_label' => ['section' => 'il_about_section', 'label' => __('Experience Label', 'ipsum-logistic'), 'default' => 'Yıllık Tecrübe', 'sanitize' => 'sanitize_text_field'],
        'il_front_about_feature_1' => ['section' => 'il_about_section', 'label' => __('About Feature 1', 'ipsum-logistic'), 'default' => 'Hızlı Destek', 'sanitize' => 'sanitize_text_field'],
        'il_front_about_feature_2' => ['section' => 'il_about_section', 'label' => __('About Feature 2', 'ipsum-logistic'), 'default' => 'Sigortalı Taşımacılık', 'sanitize' => 'sanitize_text_field'],
        'il_front_about_feature_3' => ['section' => 'il_about_section', 'label' => __('About Feature 3', 'ipsum-logistic'), 'default' => 'Zamanında Teslimat', 'sanitize' => 'sanitize_text_field'],
        'il_front_about_read_more_text' => ['section' => 'il_about_section', 'label' => __('About Button Text', 'ipsum-logistic'), 'default' => 'Devamını Oku', 'sanitize' => 'sanitize_text_field'],
        'il_front_about_contact_pill_text' => ['section' => 'il_about_section', 'label' => __('About Contact Pill Text', 'ipsum-logistic'), 'default' => 'Bizimle İletişime Geç', 'sanitize' => 'sanitize_text_field'],

        'il_front_services_badge' => ['section' => 'il_services_section', 'label' => __('Services Badge', 'ipsum-logistic'), 'default' => 'Hizmetlerimiz', 'sanitize' => 'sanitize_text_field'],
        'il_front_services_title' => ['section' => 'il_services_section', 'label' => __('Services Title', 'ipsum-logistic'), 'default' => 'Popüler Lojistik Hizmetlerimiz', 'sanitize' => 'sanitize_text_field'],
        'il_front_services_archive_text' => ['section' => 'il_services_section', 'label' => __('Services Archive Button Text', 'ipsum-logistic'), 'default' => 'Tümünü Görüntüle', 'sanitize' => 'sanitize_text_field'],
        'il_front_service_card_button_text' => ['section' => 'il_services_section', 'label' => __('Service Card Button Text', 'ipsum-logistic'), 'default' => 'İncele', 'sanitize' => 'sanitize_text_field'],
        'il_front_service_card_cta_aria' => ['section' => 'il_services_section', 'label' => __('Service Card CTA Aria Label', 'ipsum-logistic'), 'default' => 'Teklif Al', 'sanitize' => 'sanitize_text_field'],

        'il_front_why_badge' => ['section' => 'il_why_section', 'label' => __('Why Us Badge', 'ipsum-logistic'), 'default' => 'Neden Biz', 'sanitize' => 'sanitize_text_field'],
        'il_front_why_title' => ['section' => 'il_why_section', 'label' => __('Why Us Title', 'ipsum-logistic'), 'default' => 'Neden Bizi Seçmelisiniz?', 'sanitize' => 'sanitize_text_field'],
        'il_front_why_description' => ['section' => 'il_why_section', 'label' => __('Why Us Description', 'ipsum-logistic'), 'default' => 'Lojistik operasyonlarda kalite ve güvenlik.', 'sanitize' => 'wp_kses_post', 'type' => 'textarea'],

        'il_front_testimonials_title' => ['section' => 'il_testimonials_section', 'label' => __('Testimonials Title', 'ipsum-logistic'), 'default' => 'Müşterilerimiz Ne Diyor?', 'sanitize' => 'sanitize_text_field'],
        'il_front_testimonials_subtitle' => ['section' => 'il_testimonials_section', 'label' => __('Testimonials Subtitle', 'ipsum-logistic'), 'default' => 'Forem ipsum dolor sit amet, consectetur adipiscing elit.', 'sanitize' => 'sanitize_text_field'],

        'il_work_hours' => ['section' => 'il_contact_social', 'label' => __('Work Hours', 'ipsum-logistic'), 'default' => '08.00-18.00', 'sanitize' => 'sanitize_text_field'],
        'il_phone' => ['section' => 'il_contact_social', 'label' => __('Phone', 'ipsum-logistic'), 'default' => '+90 555 123 4567', 'sanitize' => 'sanitize_text_field'],
        'il_email' => ['section' => 'il_contact_social', 'label' => __('Email', 'ipsum-logistic'), 'default' => 'deneme@gmail.com', 'sanitize' => 'sanitize_email'],
        'il_address' => ['section' => 'il_contact_social', 'label' => __('Address', 'ipsum-logistic'), 'default' => 'örnek adres', 'sanitize' => 'sanitize_textarea_field', 'type' => 'textarea'],
        'il_facebook' => ['section' => 'il_contact_social', 'label' => __('Facebook URL', 'ipsum-logistic'), 'default' => '', 'sanitize' => 'esc_url_raw'],
        'il_instagram' => ['section' => 'il_contact_social', 'label' => __('Instagram URL', 'ipsum-logistic'), 'default' => '', 'sanitize' => 'esc_url_raw'],
        'il_linkedin' => ['section' => 'il_contact_social', 'label' => __('LinkedIn URL', 'ipsum-logistic'), 'default' => '', 'sanitize' => 'esc_url_raw'],

        'il_footer_about_text' => ['section' => 'il_footer_section', 'label' => __('Footer About Text', 'ipsum-logistic'), 'default' => 'Yılların verdiği tecrübeyle birlikte hizmetlerimiz bizler için güvenilirlik, dayanım odaklı bir yapıdan teslimatlara gerçekleşiyor.', 'sanitize' => 'sanitize_textarea_field', 'type' => 'textarea'],
        'il_footer_social_title' => ['section' => 'il_footer_section', 'label' => __('Footer Social Title', 'ipsum-logistic'), 'default' => 'Bizi Sosyal Medyada Takip Edin', 'sanitize' => 'sanitize_text_field'],
        'il_footer_contact_title' => ['section' => 'il_footer_section', 'label' => __('Footer Contact Title', 'ipsum-logistic'), 'default' => 'Bize Ulaşın', 'sanitize' => 'sanitize_text_field'],
        'il_footer_copyright_text' => ['section' => 'il_footer_section', 'label' => __('Footer Copyright Text', 'ipsum-logistic'), 'default' => 'Tüm Hakları Saklıdır.', 'sanitize' => 'sanitize_text_field'],
    ];

    foreach ([1, 2, 3, 4] as $i) {
        $settings['il_front_why_feature_' . $i . '_title'] = ['section' => 'il_why_section', 'label' => sprintf(__('Why Feature %d Title', 'ipsum-logistic'), $i), 'default' => ['Geniş Hizmet Ağı', 'Sigortalı Taşımacılık', 'Zamanında Teslimat', '7/24 Destek'][$i - 1], 'sanitize' => 'sanitize_text_field'];
        $settings['il_front_why_feature_' . $i . '_desc'] = ['section' => 'il_why_section', 'label' => sprintf(__('Why Feature %d Description', 'ipsum-logistic'), $i), 'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'sanitize' => 'sanitize_text_field'];
    }

    foreach ($settings as $setting_id => $config) {
        $wp_customize->add_setting($setting_id, [
            'type' => 'theme_mod',
            'default' => $config['default'],
            'sanitize_callback' => $config['sanitize'],
            'transport' => 'refresh',
        ]);

        $control_type = (string) ($config['type'] ?? 'text');
        if (($config['control'] ?? '') === 'WP_Customize_Color_Control') {
            $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $setting_id, [
                'label' => $config['label'],
                'section' => $config['section'],
                'settings' => $setting_id,
            ]));
            continue;
        }

        $control = [
            'label' => $config['label'],
            'section' => $config['section'],
            'settings' => $setting_id,
            'type' => $control_type,
        ];

        if (isset($config['choices']) && is_array($config['choices'])) {
            $control['choices'] = $config['choices'];
        }

        $wp_customize->add_control($setting_id, $control);
    }

    $media_controls = [
        'il_front_hero_bg_image_id' => ['section' => 'il_hero_section', 'label' => __('Hero Background Image', 'ipsum-logistic')],
        'il_front_about_main_image_id' => ['section' => 'il_about_section', 'label' => __('About Main Image', 'ipsum-logistic')],
        'il_front_about_small_image_id' => ['section' => 'il_about_section', 'label' => __('About Small Image', 'ipsum-logistic')],
        'il_front_why_center_image_id' => ['section' => 'il_why_section', 'label' => __('Why Us Center Image', 'ipsum-logistic')],
        'il_front_why_bubble_1_image_id' => ['section' => 'il_why_section', 'label' => __('Why Us Bubble Image 1', 'ipsum-logistic')],
        'il_front_why_bubble_2_image_id' => ['section' => 'il_why_section', 'label' => __('Why Us Bubble Image 2', 'ipsum-logistic')],
    ];

    foreach ($media_controls as $setting_id => $config) {
        $wp_customize->add_setting($setting_id, [
            'type' => 'theme_mod',
            'default' => 0,
            'sanitize_callback' => 'absint',
            'transport' => 'refresh',
        ]);

        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, $setting_id, [
            'label' => $config['label'],
            'section' => $config['section'],
            'mime_type' => 'image',
        ]));
    }
});
