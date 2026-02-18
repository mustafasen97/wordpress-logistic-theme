<?php
declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

$default_menu = [
    ['href' => home_url('/'), 'label' => 'Ana Sayfa'],
    ['href' => home_url('/hakkimizda'), 'label' => 'Hakkımızda'],
    ['href' => home_url('/hizmetler'), 'label' => 'Hizmetlerimiz'],
    ['href' => home_url('/blog'), 'label' => 'Blog'],
    ['href' => home_url('/iletisim'), 'label' => 'İletişim'],
];


$show_top_bar = il_theme_option('show_top_bar', '1') === '1';
$header_cta_text = il_theme_option('header_cta_text', 'Teklif Al');
$header_cta_url = il_theme_option('header_cta_url', '#contact');

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php if ($show_top_bar) : ?>
<div class="top-bar">
    <div class="container top-bar__container">
        <div class="top-bar__info">
            <div class="top-bar__item"><span><?php echo esc_html(il_theme_option('work_hours', '08.00-18.00')); ?></span></div>
            <div class="top-bar__item"><span><?php echo esc_html(il_theme_option('phone', '+90 555 123 4567')); ?></span></div>
            <div class="top-bar__item"><span><?php echo esc_html(il_theme_option('email', 'deneme@gmail.com')); ?></span></div>
        </div>
        <div class="top-bar__actions">
            <div class="social-links">
                <?php foreach (['facebook' => 'F', 'instagram' => 'I', 'linkedin' => 'L'] as $network => $label) : $url = il_theme_option($network); ?>
                    <a href="<?php echo esc_url($url !== '' ? $url : '#'); ?>" aria-label="<?php echo esc_attr($network); ?>"<?php echo $url !== '' ? ' target="_blank" rel="noopener"' : ''; ?>><?php echo esc_html($label); ?></a>
                <?php endforeach; ?>
            </div>
            <div class="location-selector"><span><?php echo esc_html(il_theme_option('address', 'örnek adres')); ?></span></div>
        </div>
    </div>
</div>
<?php endif; ?>

<header class="header">
    <div class="container header__container">
        <div class="header__logo">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?><span>.</span></a>
        </div>

        <nav class="header__nav" aria-label="<?php esc_attr_e('Primary', 'ipsum-logistic'); ?>">
            <?php il_render_menu_links('primary', 'nav__link', $default_menu); ?>
        </nav>

        <div class="header__actions">
            <button class="icon-btn" aria-label="Search"><svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg></button>
            <button class="icon-btn" aria-label="Call"><svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg></button>
            <a href="<?php echo esc_url($header_cta_url !== "" ? $header_cta_url : "#contact"); ?>" class="btn btn--primary"><?php echo esc_html($header_cta_text); ?></a>
        </div>

        <button class="header__mobile-toggle" id="mobile-menu-btn" aria-label="Menu">
            <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
        </button>
    </div>

    <div class="mobile-menu" id="mobile-menu">
        <?php il_render_menu_links('mobile', 'mobile-menu__link', $default_menu); ?>
        <a href="<?php echo esc_url($header_cta_url !== "" ? $header_cta_url : "#contact"); ?>" class="btn btn--primary btn--full"><?php echo esc_html($header_cta_text); ?></a>
    </div>
</header>
