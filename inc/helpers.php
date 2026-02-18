<?php
declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

function il_theme_option(string $key, string $default = ''): string {
    $options = get_option('il_theme_options');
    if (!is_array($options)) {
        return $default;
    }
    $value = $options[$key] ?? $default;
    return is_string($value) ? $value : $default;
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

        $output .= sprintf(
            '<a href="%s" class="%s">%s</a>',
            esc_url((string) $item->url),
            esc_attr($link_class),
            esc_html($item->title)
        );
    }

    public function end_el(&$output, $item, $depth = 0, $args = null): void {}
}
