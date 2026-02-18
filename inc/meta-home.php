<?php
declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

add_action('add_meta_boxes', static function (): void {
    $front_id = (int) get_option('page_on_front');
    if ($front_id > 0) {
        add_meta_box('il_front_meta', __('Front Page Sections', 'ipsum-logistic'), 'il_render_front_meta_box', 'page', 'normal', 'high', ['front_id' => $front_id]);
    }
});

function il_render_front_meta_box(WP_Post $post, array $meta_box): void {
    $front_id = (int) ($meta_box['args']['front_id'] ?? 0);
    if ($post->ID !== $front_id) {
        echo '<p>' . esc_html__('This meta box is available only for the page set as Front page.', 'ipsum-logistic') . '</p>';
        return;
    }

    wp_nonce_field('il_save_front_meta', 'il_front_meta_nonce');
    $fields = [
        'hero_title','hero_subtitle','hero_cta_text','hero_cta_url','hero_bg_image_id',
        'about_badge','about_heading','about_description','about_years_number','about_years_label','about_main_image_id','about_small_image_id',
        'about_feature_1','about_feature_2','about_feature_3',
        'why_badge','why_title','why_description','why_center_image_id','why_bubble_1_image_id','why_bubble_2_image_id','why_bubble_3_image_id','why_bubble_4_image_id',
        'why_feature_1_title','why_feature_1_desc','why_feature_2_title','why_feature_2_desc','why_feature_3_title','why_feature_3_desc','why_feature_4_title','why_feature_4_desc',
        'contact_title','contact_subtitle'
    ];

    echo '<table class="form-table"><tbody>';
    foreach ($fields as $field) {
        $value = get_post_meta($post->ID, '_il_' . $field, true);
        echo '<tr><th><label for="' . esc_attr($field) . '">' . esc_html($field) . '</label></th><td>';
        if (str_contains($field, 'description')) {
            printf('<textarea class="large-text" rows="4" id="%1$s" name="il_meta[%1$s]">%2$s</textarea>', esc_attr($field), esc_textarea((string) $value));
        } else {
            printf('<input class="regular-text" type="text" id="%1$s" name="il_meta[%1$s]" value="%2$s">', esc_attr($field), esc_attr((string) $value));
        }
        echo '</td></tr>';
    }
    echo '</tbody></table><p class="description">Image fields store attachment IDs from Media Library.</p>';
}

add_action('save_post_page', static function (int $post_id): void {
    if (!isset($_POST['il_front_meta_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['il_front_meta_nonce'])), 'il_save_front_meta')) {
        return;
    }
    if (!current_user_can('edit_post', $post_id) || wp_is_post_autosave($post_id) || wp_is_post_revision($post_id)) {
        return;
    }
    $front_id = (int) get_option('page_on_front');
    if ($post_id !== $front_id || !isset($_POST['il_meta']) || !is_array($_POST['il_meta'])) {
        return;
    }

    $meta = wp_unslash($_POST['il_meta']);
    foreach ($meta as $key => $raw_value) {
        $meta_key = '_il_' . sanitize_key((string) $key);
        $value = is_string($raw_value) ? $raw_value : '';

        if (str_contains((string) $key, '_url')) {
            $clean = esc_url_raw($value, ['http', 'https']);
        } elseif (str_contains((string) $key, 'email')) {
            $clean = sanitize_email($value);
        } elseif (str_contains((string) $key, 'description')) {
            $clean = wp_kses_post($value);
        } elseif (str_ends_with((string) $key, '_image_id') || str_contains((string) $key, '_id')) {
            $clean = (string) absint($value);
        } else {
            $clean = sanitize_text_field($value);
        }

        update_post_meta($post_id, $meta_key, $clean);
    }
});
