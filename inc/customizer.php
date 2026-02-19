<?php
declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

function il_customize_sanitize_text(string $value): string {
    return sanitize_text_field($value);
}

function il_customize_sanitize_textarea(string $value): string {
    return sanitize_textarea_field($value);
}

function il_customize_sanitize_checkbox($value): string {
    return !empty($value) ? '1' : '0';
}

function il_customize_sanitize_select(string $value): string {
    $allowed = ['left', 'center'];
    return in_array($value, $allowed, true) ? $value : 'left';
}

function il_customize_sanitize_url(string $value): string {
    return esc_url_raw($value, ['http', 'https']);
}

add_action('customize_register', static function (WP_Customize_Manager $wp_customize): void {
    $wp_customize->add_panel('il_theme_customization', [
        'title' => __('Theme Customization', 'ipsum-logistic'),
        'priority' => 30,
    ]);

    $wp_customize->add_section('il_branding_header', [
        'title' => __('Branding & Header', 'ipsum-logistic'),
        'panel' => 'il_theme_customization',
    ]);

    $wp_customize->add_setting('il_color_primary', ['default' => '#fb923c', 'sanitize_callback' => 'sanitize_hex_color']);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'il_color_primary', [
        'label' => __('Primary Color', 'ipsum-logistic'),
        'section' => 'il_branding_header',
    ]));

    $wp_customize->add_setting('il_color_secondary', ['default' => '#1e3a8a', 'sanitize_callback' => 'sanitize_hex_color']);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'il_color_secondary', [
        'label' => __('Secondary Color', 'ipsum-logistic'),
        'section' => 'il_branding_header',
    ]));

    $branding_text = [
        'il_header_cta_text' => ['Header CTA Text', 'Teklif Al'],
        'il_header_cta_url' => ['Header CTA URL', '#contact'],
    ];

    foreach ($branding_text as $key => [$label, $default]) {
        $is_url = str_ends_with($key, '_url');
        $wp_customize->add_setting($key, [
            'default' => $default,
            'sanitize_callback' => $is_url ? 'il_customize_sanitize_url' : 'il_customize_sanitize_text',
        ]);
        $wp_customize->add_control($key, [
            'label' => __($label, 'ipsum-logistic'),
            'section' => 'il_branding_header',
            'type' => $is_url ? 'url' : 'text',
        ]);
    }

    $wp_customize->add_setting('il_show_top_bar', ['default' => '1', 'sanitize_callback' => 'il_customize_sanitize_checkbox']);
    $wp_customize->add_control('il_show_top_bar', [
        'label' => __('Show Top Bar', 'ipsum-logistic'),
        'section' => 'il_branding_header',
        'type' => 'checkbox',
    ]);

    $wp_customize->add_setting('il_header_layout', ['default' => 'left', 'sanitize_callback' => 'il_customize_sanitize_select']);
    $wp_customize->add_control('il_header_layout', [
        'label' => __('Header Logo Position', 'ipsum-logistic'),
        'description' => __('Left keeps original layout, Center puts logo in the middle on desktop.', 'ipsum-logistic'),
        'section' => 'il_branding_header',
        'type' => 'select',
        'choices' => ['left' => __('Left', 'ipsum-logistic'), 'center' => __('Center', 'ipsum-logistic')],
    ]);

    $wp_customize->add_section('il_hero', ['title' => __('Hero Section', 'ipsum-logistic'), 'panel' => 'il_theme_customization']);

    $hero_fields = [
        'il_hero_title' => ['Hero Title', 'Uluslararası Profesyonel Taşımacılık ve Lojistik Çözümleri'],
        'il_hero_subtitle' => ['Hero Subtitle', 'Rorem ipsum dolor sit amet, consectetur adipiscing elit.'],
        'il_hero_cta_text' => ['Primary Button Text', 'Ücretsiz Teklif Alın'],
        'il_hero_cta_url' => ['Primary Button URL', '#contact'],
        'il_hero_secondary_cta_text' => ['Secondary Button Text', 'Hizmetlerimizi Keşfedin'],
        'il_hero_secondary_cta_url' => ['Secondary Button URL', '#services-slider'],
        'il_hero_phone_label' => ['Phone CTA Label', 'Bizi Hemen Arayın'],
        'il_hero_form_title' => ['Form Title', 'Hemen Teklif Alın'],
        'il_hero_form_name_placeholder' => ['Form Name Placeholder', 'Ad Soyad'],
        'il_hero_form_email_placeholder' => ['Form Email Placeholder', 'E-Posta'],
        'il_hero_form_phone_placeholder' => ['Form Phone Placeholder', 'Telefon Numarası'],
        'il_hero_form_cargo_placeholder' => ['Form Cargo Placeholder', 'Yük Tipi'],
        'il_hero_form_kvkk_text' => ['KVKK Text', "KVKK Açık Rıza Metni'ni okudum, anladım ve onaylıyorum."],
        'il_hero_form_submit_text' => ['Form Submit Button', 'Hemen Teklif Al'],
    ];

    foreach ($hero_fields as $key => [$label, $default]) {
        $is_url = str_ends_with($key, '_url');
        $wp_customize->add_setting($key, ['default' => $default, 'sanitize_callback' => $is_url ? 'il_customize_sanitize_url' : 'il_customize_sanitize_text']);
        $wp_customize->add_control($key, ['label' => __($label, 'ipsum-logistic'), 'section' => 'il_hero', 'type' => $is_url ? 'url' : 'text']);
    }

    $wp_customize->add_setting('il_hero_bg_image_id', ['default' => 0, 'sanitize_callback' => 'absint']);
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'il_hero_bg_image_id', [
        'label' => __('Hero Background Image', 'ipsum-logistic'),
        'section' => 'il_hero',
        'mime_type' => 'image',
    ]));

    $wp_customize->add_section('il_about', ['title' => __('About Section', 'ipsum-logistic'), 'panel' => 'il_theme_customization']);
    $about_fields = [
        'il_about_badge' => ['Section Badge', 'Hakkımızda'],
        'il_about_heading' => ['Heading', 'Yılların Deneyimiyle Birlikte Her Sevkiyat Ayrı Bir Güvence'],
        'il_about_description' => ['Description', 'Borem ipsum dolor sit amet, consectetur adipiscing elit.'],
        'il_about_years_number' => ['Experience Number', '+25'],
        'il_about_years_label' => ['Experience Label', 'Yıllık Tecrübe'],
        'il_about_feature_1' => ['Feature 1', 'Hızlı Destek'],
        'il_about_feature_2' => ['Feature 2', 'Sigortalı Taşımacılık'],
        'il_about_feature_3' => ['Feature 3', 'Zamanında Teslimat'],
        'il_about_button_text' => ['Button Text', 'Devamını Oku'],
        'il_about_button_url' => ['Button URL', '/hakkimizda'],
        'il_about_contact_pill_text' => ['Contact Pill Text', 'Bizimle İletişime Geç'],
    ];

    foreach ($about_fields as $key => [$label, $default]) {
        $is_url = str_ends_with($key, '_url');
        $sanitize = $is_url ? 'il_customize_sanitize_url' : (str_contains($key, 'description') ? 'il_customize_sanitize_textarea' : 'il_customize_sanitize_text');
        $control_type = str_contains($key, 'description') ? 'textarea' : ($is_url ? 'url' : 'text');
        $wp_customize->add_setting($key, ['default' => $default, 'sanitize_callback' => $sanitize]);
        $wp_customize->add_control($key, ['label' => __($label, 'ipsum-logistic'), 'section' => 'il_about', 'type' => $control_type]);
    }

    foreach (['il_about_main_image_id' => 'Main Image', 'il_about_small_image_id' => 'Small Image'] as $key => $label) {
        $wp_customize->add_setting($key, ['default' => 0, 'sanitize_callback' => 'absint']);
        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, $key, [
            'label' => __($label, 'ipsum-logistic'),
            'section' => 'il_about',
            'mime_type' => 'image',
        ]));
    }

    $wp_customize->add_section('il_services', ['title' => __('Services Section', 'ipsum-logistic'), 'panel' => 'il_theme_customization']);
    $service_fields = [
        'il_services_badge' => ['Section Tag', 'Hizmetlerimiz'],
        'il_services_title' => ['Section Title', 'Popüler Lojistik Hizmetlerimiz'],
        'il_services_all_button_text' => ['All Services Button Text', 'Tümünü Görüntüle'],
        'il_services_all_button_url' => ['All Services Button URL', '/hizmetler'],
        'il_services_card_button_text' => ['Card Button Text', 'İncele'],
        'il_services_card_cta_aria_label' => ['Card Offer Button Aria Label', 'Teklif Al'],
        'il_services_fallback_title' => ['Fallback Card Title', 'Servis bulunamadı'],
        'il_services_fallback_desc' => ['Fallback Card Description', 'Servis eklediğinizde burada listelenecektir.'],
    ];
    foreach ($service_fields as $key => [$label, $default]) {
        $is_url = str_ends_with($key, '_url');
        $wp_customize->add_setting($key, ['default' => $default, 'sanitize_callback' => $is_url ? 'il_customize_sanitize_url' : 'il_customize_sanitize_text']);
        $wp_customize->add_control($key, ['label' => __($label, 'ipsum-logistic'), 'section' => 'il_services', 'type' => $is_url ? 'url' : 'text']);
    }

    $wp_customize->add_section('il_why', ['title' => __('Why Us Section', 'ipsum-logistic'), 'panel' => 'il_theme_customization']);
    $why_fields = [
        'il_why_badge' => ['Section Tag', 'Neden Biz'],
        'il_why_title' => ['Section Title', 'Neden Bizi Seçmelisiniz?'],
        'il_why_description' => ['Description', 'Lojistik operasyonlarda kalite ve güvenlik.'],
    ];

    foreach ($why_fields as $key => [$label, $default]) {
        $wp_customize->add_setting($key, ['default' => $default, 'sanitize_callback' => str_contains($key, 'description') ? 'il_customize_sanitize_textarea' : 'il_customize_sanitize_text']);
        $wp_customize->add_control($key, ['label' => __($label, 'ipsum-logistic'), 'section' => 'il_why', 'type' => str_contains($key, 'description') ? 'textarea' : 'text']);
    }

    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting('il_why_feature_' . $i . '_title', ['default' => ['', 'Geniş Hizmet Ağı', 'Sigortalı Taşımacılık', 'Zamanında Teslimat', '7/24 Destek'][$i], 'sanitize_callback' => 'il_customize_sanitize_text']);
        $wp_customize->add_control('il_why_feature_' . $i . '_title', ['label' => sprintf(__('Feature %d Title', 'ipsum-logistic'), $i), 'section' => 'il_why', 'type' => 'text']);

        $wp_customize->add_setting('il_why_feature_' . $i . '_desc', ['default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'sanitize_callback' => 'il_customize_sanitize_text']);
        $wp_customize->add_control('il_why_feature_' . $i . '_desc', ['label' => sprintf(__('Feature %d Description', 'ipsum-logistic'), $i), 'section' => 'il_why', 'type' => 'text']);
    }

    foreach (['il_why_center_image_id' => 'Center Image', 'il_why_bubble_1_image_id' => 'Bubble Image 1', 'il_why_bubble_2_image_id' => 'Bubble Image 2'] as $key => $label) {
        $wp_customize->add_setting($key, ['default' => 0, 'sanitize_callback' => 'absint']);
        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, $key, [
            'label' => __($label, 'ipsum-logistic'),
            'section' => 'il_why',
            'mime_type' => 'image',
        ]));
    }

    $wp_customize->add_section('il_testimonials', ['title' => __('Testimonials Section', 'ipsum-logistic'), 'panel' => 'il_theme_customization']);
    foreach ([
        'il_testimonials_title' => ['Section Title', 'Müşterilerimiz Ne Diyor?'],
        'il_testimonials_subtitle' => ['Section Subtitle', 'Forem ipsum dolor sit amet, consectetur adipiscing elit.'],
    ] as $key => [$label, $default]) {
        $wp_customize->add_setting($key, ['default' => $default, 'sanitize_callback' => 'il_customize_sanitize_text']);
        $wp_customize->add_control($key, ['label' => __($label, 'ipsum-logistic'), 'section' => 'il_testimonials', 'type' => 'text']);
    }

    $wp_customize->add_section('il_footer', ['title' => __('Footer', 'ipsum-logistic'), 'panel' => 'il_theme_customization']);
    $footer_fields = [
        'il_footer_desc' => ['Footer Description', 'Yılların verdiği tecrübeyle birlikte hizmetlerimiz bizler için güvenilirlik, dayanım odaklı bir yapıdan teslimatlara gerçekleşiyor.'],
        'il_footer_services_title' => ['Services Column Title', 'Hizmetlerimiz'],
        'il_footer_sitemap_title' => ['Sitemap Column Title', 'Site Haritası'],
        'il_footer_social_title' => ['Social Column Title', 'Bizi Sosyal Medyada Takip Edin'],
        'il_footer_contact_title' => ['Contact Column Title', 'Bize Ulaşın'],
        'il_footer_copyright' => ['Copyright Text', 'Tüm Hakları Saklıdır.'],
    ];

    foreach ($footer_fields as $key => [$label, $default]) {
        $wp_customize->add_setting($key, ['default' => $default, 'sanitize_callback' => 'il_customize_sanitize_textarea']);
        $wp_customize->add_control($key, ['label' => __($label, 'ipsum-logistic'), 'section' => 'il_footer', 'type' => 'textarea']);
    }
});
