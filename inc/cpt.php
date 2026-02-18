<?php
declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

add_action('init', static function (): void {
    register_post_type('il_service', [
        'label' => __('Services', 'ipsum-logistic'),
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'hizmetler'],
        'menu_icon' => 'dashicons-admin-tools',
        'supports' => ['title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'],
        'show_in_rest' => true,
    ]);

    register_post_type('il_faq', [
        'label' => __('FAQ', 'ipsum-logistic'),
        'public' => false,
        'show_ui' => true,
        'menu_icon' => 'dashicons-editor-help',
        'supports' => ['title', 'editor', 'page-attributes'],
        'show_in_rest' => false,
    ]);

    register_post_type('il_testimonial', [
        'label' => __('Testimonials', 'ipsum-logistic'),
        'public' => false,
        'show_ui' => true,
        'menu_icon' => 'dashicons-format-quote',
        'supports' => ['title', 'editor', 'thumbnail', 'page-attributes'],
        'show_in_rest' => false,
    ]);
});
