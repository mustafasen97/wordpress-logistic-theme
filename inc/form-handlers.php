<?php
declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

add_action('admin_post_nopriv_il_contact_form', 'il_handle_contact_form');
add_action('admin_post_il_contact_form', 'il_handle_contact_form');

function il_handle_contact_form(): void {
    if (!isset($_POST['il_contact_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['il_contact_nonce'])), 'il_contact_form')) {
        wp_safe_redirect(wp_get_referer() ?: home_url('/'));
        exit;
    }

    $honeypot = isset($_POST['company']) ? trim((string) wp_unslash($_POST['company'])) : '';
    if ($honeypot !== '') {
        wp_safe_redirect(wp_get_referer() ?: home_url('/'));
        exit;
    }

    $ip = isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field((string) wp_unslash($_SERVER['REMOTE_ADDR'])) : 'unknown';
    $rate_key = 'il_contact_rate_' . md5($ip);
    $attempts = (int) get_transient($rate_key);
    if ($attempts >= 5) {
        wp_safe_redirect(add_query_arg('form', 'rate_limited', wp_get_referer() ?: home_url('/')));
        exit;
    }
    set_transient($rate_key, $attempts + 1, HOUR_IN_SECONDS);

    $name = sanitize_text_field((string) wp_unslash($_POST['name'] ?? ''));
    $email = sanitize_email((string) wp_unslash($_POST['email'] ?? ''));
    $phone = sanitize_text_field((string) wp_unslash($_POST['phone'] ?? ''));
    $message = sanitize_textarea_field((string) wp_unslash($_POST['message'] ?? ''));

    $admin_email = get_option('admin_email');
    if (is_email($admin_email)) {
        $subject = sprintf('[%s] %s', wp_specialchars_decode(get_bloginfo('name'), ENT_QUOTES), __('New Contact Form', 'ipsum-logistic'));
        $body = "Name: {$name}\nEmail: {$email}\nPhone: {$phone}\n\nMessage:\n{$message}";
        wp_mail($admin_email, $subject, $body);
    }

    wp_safe_redirect(add_query_arg('form', 'success', wp_get_referer() ?: home_url('/')));
    exit;
}
