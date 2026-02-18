<?php
declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="top-bar">
    <div class="container top-bar__container">
        <div class="top-bar__info">
            <div class="top-bar__item"><span><?php echo esc_html(il_theme_option('work_hours', 'Pzt - Cuma: 09.00 - 18.00')); ?></span></div>
            <div class="top-bar__item"><span><?php echo esc_html(il_theme_option('phone', '+90 123 456 7891')); ?></span></div>
            <div class="top-bar__item"><span><?php echo esc_html(il_theme_option('email', 'info@example.com')); ?></span></div>
        </div>
        <div class="top-bar__actions">
            <div class="social-links">
                <?php foreach (['instagram' => 'Instagram', 'facebook' => 'Facebook', 'linkedin' => 'LinkedIn'] as $key => $label) : $url = il_theme_option($key); if ($url !== '') : ?>
                    <a href="<?php echo esc_url($url); ?>" aria-label="<?php echo esc_attr($label); ?>" rel="noopener" target="_blank"><?php echo esc_html(mb_substr($label, 0, 1)); ?></a>
                <?php endif; endforeach; ?>
            </div>
            <div class="location-selector"><span><?php echo esc_html(il_theme_option('address', 'Istanbul')); ?></span></div>
        </div>
    </div>
</div>
<header class="header">
    <div class="container header__container">
        <div class="header__logo"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?><span>.</span></a></div>
        <nav class="header__nav" aria-label="<?php esc_attr_e('Primary', 'ipsum-logistic'); ?>">
            <?php wp_nav_menu(['theme_location' => 'primary', 'container' => false, 'items_wrap' => '%3$s', 'fallback_cb' => false, 'walker' => new IL_Nav_Walker('nav__link')]); ?>
        </nav>
        <div class="header__actions"><a href="#contact" class="btn btn--primary"><?php esc_html_e('Teklif Al', 'ipsum-logistic'); ?></a></div>
        <button class="header__mobile-toggle" id="mobile-menu-btn" aria-label="Menu"><span>☰</span></button>
    </div>
    <div class="mobile-menu" id="mobile-menu">
        <?php wp_nav_menu(['theme_location' => 'mobile', 'container' => false, 'items_wrap' => '%3$s', 'fallback_cb' => false, 'walker' => new IL_Nav_Walker('mobile-menu__link')]); ?>
    </div>
</header>
