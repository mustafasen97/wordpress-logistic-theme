<?php
declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

function il_asset_ver(string $relative_path): string {
    $file = get_template_directory() . '/' . ltrim($relative_path, '/');
    return file_exists($file) ? (string) filemtime($file) : '1.0.0';
}

add_action('wp_enqueue_scripts', static function (): void {
    wp_enqueue_style('il-reset', get_template_directory_uri() . '/assets/css/reset.css', [], il_asset_ver('assets/css/reset.css'));

    $style_deps = ['il-reset'];
    if (is_front_page()) {
        wp_enqueue_style('il-splide', get_template_directory_uri() . '/assets/vendor/splide/splide.min.css', ['il-reset'], il_asset_ver('assets/vendor/splide/splide.min.css'));
        wp_enqueue_script('il-splide', get_template_directory_uri() . '/assets/vendor/splide/splide.min.js', [], il_asset_ver('assets/vendor/splide/splide.min.js'), true);
        $style_deps[] = 'il-splide';
    }

    wp_enqueue_style('il-style', get_template_directory_uri() . '/assets/css/style.css', $style_deps, il_asset_ver('assets/css/style.css'));

    $primary = sanitize_hex_color(il_theme_option('color_primary', '#fb923c')) ?: '#fb923c';
    $secondary = sanitize_hex_color(il_theme_option('color_secondary', '#1e3a8a')) ?: '#1e3a8a';
    $inline_css = ':root{--color-primary:' . $primary . ';--color-primary-dark:' . $primary . ';--color-blue:' . $secondary . ';--color-blue-dark:' . $secondary . ';}';
    wp_add_inline_style('il-style', $inline_css);

    wp_enqueue_script('il-main', get_template_directory_uri() . '/assets/js/script.js', is_front_page() ? ['il-splide'] : [], il_asset_ver('assets/js/script.js'), true);
});
