<?php
declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

require_once get_template_directory() . '/inc/helpers.php';
require_once get_template_directory() . '/inc/enqueue.php';
require_once get_template_directory() . '/inc/cpt.php';
require_once get_template_directory() . '/inc/admin-options.php';
require_once get_template_directory() . '/inc/meta-home.php';
require_once get_template_directory() . '/inc/form-handlers.php';
require_once get_template_directory() . '/inc/customizer.php';

add_action('after_setup_theme', static function (): void {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);

    register_nav_menus([
        'primary' => __('Primary Menu', 'ipsum-logistic'),
        'footer'  => __('Footer Menu', 'ipsum-logistic'),
        'mobile'  => __('Mobile Menu', 'ipsum-logistic'),
    ]);
});
