<?php
declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

function il_theme_option(string $key, string $default = ''): string {
    $theme_mod = get_theme_mod('il_' . $key, null);
    if ($theme_mod !== null && $theme_mod !== '') {
        return is_scalar($theme_mod) ? (string) $theme_mod : $default;
    }

    $options = get_option('il_theme_options');
    if (!is_array($options)) {
        return $default;
    }

    $value = $options[$key] ?? $default;
    return is_scalar($value) ? (string) $value : $default;
}

function il_front_content(int $post_id, string $key, string $default = ''): string {
    $theme_mod = get_theme_mod('il_front_' . $key, null);
    if ($theme_mod !== null && $theme_mod !== '') {
        return is_scalar($theme_mod) ? (string) $theme_mod : $default;
    }

    return il_home_meta($post_id, $key, $default);
}

function il_front_content_int(int $post_id, string $key): int {
    $theme_mod = get_theme_mod('il_front_' . $key, null);
    if ($theme_mod !== null && $theme_mod !== '') {
        return absint($theme_mod);
    }

    return il_home_meta_int($post_id, $key);
}

function il_home_meta(int $post_id, string $key, string $default = ''): string {
    $value = get_post_meta($post_id, '_il_' . $key, true);
    return is_string($value) && $value !== '' ? $value : $default;
}

function il_home_meta_int(int $post_id, string $key): int {
    return (int) get_post_meta($post_id, '_il_' . $key, true);
}

function il_image_html(int $attachment_id, string $size, array $attr = [], string $fallback = ''): string {
    if ($attachment_id > 0) {
        $image = wp_get_attachment_image($attachment_id, $size, false, $attr);
        if (is_string($image) && $image !== '') {
            return $image;
        }
    }

    if ($fallback === '') {
        return '';
    }

    $alt = isset($attr['alt']) ? esc_attr((string) $attr['alt']) : '';
    return sprintf('<img src="%s" alt="%s" loading="lazy" decoding="async">', esc_url($fallback), $alt);
}

class IL_Nav_Walker extends Walker_Nav_Menu {
    private string $link_class;

    public function __construct(string $link_class = 'nav__link') {
        $this->link_class = $link_class;
    }

    public function start_lvl(&$output, $depth = 0, $args = null): void {}
    public function end_lvl(&$output, $depth = 0, $args = null): void {}

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0): void {
        if (!($item instanceof WP_Post)) {
            return;
        }

        $classes = is_array($item->classes) ? $item->classes : [];
        $active  = in_array('current-menu-item', $classes, true) || in_array('current-menu-parent', $classes, true);
        $link_class = $this->link_class . ($active ? ' ' . $this->link_class . '--active' : '');

        $url = is_string($item->url) && $item->url !== '' ? $item->url : '#';

        $output .= sprintf(
            '<a href="%s" class="%s">%s</a>',
            esc_url($url),
            esc_attr($link_class),
            esc_html($item->title)
        );
    }

    public function end_el(&$output, $item, $depth = 0, $args = null): void {}
}

function il_render_menu_links(string $location, string $link_class, array $fallback): void {
    if (has_nav_menu($location)) {
        wp_nav_menu([
            'theme_location' => $location,
            'container' => false,
            'items_wrap' => '%3$s',
            'fallback_cb' => false,
            'walker' => new IL_Nav_Walker($link_class),
        ]);

        return;
    }

    foreach ($fallback as $item) {
        $href = isset($item['href']) ? (string) $item['href'] : '#';
        $label = isset($item['label']) ? (string) $item['label'] : '';
        printf('<a href="%s" class="%s">%s</a>', esc_url($href), esc_attr($link_class), esc_html($label));
    }
}
