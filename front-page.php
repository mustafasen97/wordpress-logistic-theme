<?php
declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

get_header();
$page_id = (int) get_queried_object_id();
$hero_bg_id = il_home_meta_int($page_id, 'hero_bg_image_id');
$hero_bg_fallback = get_template_directory_uri() . '/assets/images/nakliyat-ve-lojistik-temasi-hero-section-banner-background.webp';
$hero_bg = $hero_bg_id > 0 ? wp_get_attachment_image_url($hero_bg_id, 'full') : $hero_bg_fallback;

$services = new WP_Query(['post_type' => 'il_service', 'posts_per_page' => 8, 'orderby' => 'menu_order title', 'order' => 'ASC', 'no_found_rows' => true]);
$faqs = new WP_Query(['post_type' => 'il_faq', 'posts_per_page' => 4, 'orderby' => 'menu_order title', 'order' => 'ASC', 'no_found_rows' => true]);
?>
<main>
<section class="hero">
    <div class="hero__bg" style="background-image: url('<?php echo esc_url($hero_bg); ?>');"></div>
    <div class="hero__overlay"></div>
    <div class="container hero__container">
        <div class="hero__content">
            <h1 class="hero__title"><?php echo esc_html(il_home_meta($page_id, 'hero_title', 'Uluslararası Profesyonel Taşımacılık ve Lojistik Çözümleri')); ?></h1>
            <p class="hero__description"><?php echo esc_html(il_home_meta($page_id, 'hero_subtitle', 'Rorem ipsum dolor sit amet, consectetur adipiscing elit.')); ?></p>
            <div class="hero__actions">
                <a href="<?php echo esc_url(il_home_meta($page_id, 'hero_cta_url', '#contact')); ?>" class="btn btn--blue"><?php echo esc_html(il_home_meta($page_id, 'hero_cta_text', 'Ücretsiz Teklif Alın')); ?></a>
                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', il_theme_option('phone', '+902345678910'))); ?>" class="hero__phone"><span class="hero__phone-text">Bizi Hemen Arayın <strong><?php echo esc_html(il_theme_option('phone', '+90 234 567 8910')); ?></strong></span></a>
            </div>
        </div>
        <div class="hero__form-wrapper">
            <form class="hero__form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
                <h3>Hemen Teklif Alın</h3>
                <input type="hidden" name="action" value="il_contact_form">
                <?php wp_nonce_field('il_contact_form', 'il_contact_nonce'); ?>
                <input type="text" name="company" value="" tabindex="-1" autocomplete="off" style="position:absolute;left:-9999px;" aria-hidden="true">
                <div class="form-group"><input type="text" name="name" placeholder="Ad Soyad" required></div>
                <div class="form-group"><input type="email" name="email" placeholder="E-Posta" required></div>
                <div class="form-group"><input type="tel" name="phone" placeholder="Telefon Numarası" required></div>
                <div class="form-group"><textarea name="message" placeholder="Mesajınız"></textarea></div>
                <button type="submit" class="btn btn--light-blue btn--full">Hemen Teklif Al</button>
            </form>
        </div>
    </div>
</section>
<section class="experience"><div class="container experience__container"><div class="experience__images">
<div class="img-wrapper img-wrapper--main"><?php echo wp_kses_post(il_image_html(il_home_meta_int($page_id, 'about_main_image_id'), 'large', ['loading' => 'lazy', 'decoding' => 'async', 'alt' => 'Depo'], get_template_directory_uri() . '/assets/images/jon-tyson-kR4K8nJ9JRc-unsplash.webp')); ?></div>
<div class="experience__badge"><strong><?php echo esc_html(il_home_meta($page_id, 'about_years_number', '+25')); ?></strong><span><?php echo esc_html(il_home_meta($page_id, 'about_years_label', 'Yıllık Tecrübe')); ?></span></div>
<div class="img-wrapper img-wrapper--small"><?php echo wp_kses_post(il_image_html(il_home_meta_int($page_id, 'about_small_image_id'), 'medium', ['loading' => 'lazy', 'decoding' => 'async', 'alt' => 'Çalışan'], get_template_directory_uri() . '/assets/images/chuttersnap-BNBA1h-NgdY-unsplash_1_11zon.webp')); ?></div>
</div><div class="experience__content"><span class="badge badge--blue"><?php echo esc_html(il_home_meta($page_id, 'about_badge', 'Hakkımızda')); ?></span><h2 class="section-title"><?php echo esc_html(il_home_meta($page_id, 'about_heading', 'Yılların Deneyimiyle Birlikte Her Sevkiyat Ayrı Bir Güvence')); ?></h2><p class="section-desc"><?php echo wp_kses_post(il_home_meta($page_id, 'about_description', 'Borem ipsum dolor sit amet.')); ?></p><div class="experience__features"><div class="feature-item"><span><?php echo esc_html(il_home_meta($page_id, 'about_feature_1', 'Hızlı Destek')); ?></span></div><div class="feature-item"><span><?php echo esc_html(il_home_meta($page_id, 'about_feature_2', 'Sigortalı Taşımacılık')); ?></span></div><div class="feature-item"><span><?php echo esc_html(il_home_meta($page_id, 'about_feature_3', 'Zamanında Teslimat')); ?></span></div></div></div></div></section>

<section class="services splide" id="services-slider"><div class="container services__container"><div class="services__header"><div class="services__title-wrapper"><span class="badge badge--outline">Hizmetlerimiz</span><h2 class="section-title services__title">Popüler Lojistik Hizmetlerimiz</h2></div></div><div class="splide__track"><ul class="splide__list">
<?php if ($services->have_posts()) : while ($services->have_posts()) : $services->the_post(); ?>
<li class="splide__slide"><article class="service-card"><div class="service-card__img"><?php if (has_post_thumbnail()) { the_post_thumbnail('medium_large', ['loading' => 'lazy', 'decoding' => 'async']); } ?></div><div class="service-card__body"><h3><?php the_title(); ?></h3><p><?php echo esc_html(get_the_excerpt()); ?></p><div class="service-card__actions"><a href="<?php the_permalink(); ?>" class="btn btn--outline-blue">İncele</a></div></div></article></li>
<?php endwhile; wp_reset_postdata(); endif; ?>
</ul></div></div></section>

<section class="why-us"><div class="container why-us__container"><div class="why-us__content"><span class="badge badge--outline"><?php echo esc_html(il_home_meta($page_id, 'why_badge', 'Neden Biz')); ?></span><h2 class="section-title"><?php echo esc_html(il_home_meta($page_id, 'why_title', 'Neden Bizi Tercih Etmelisiniz?')); ?></h2><p class="section-desc"><?php echo wp_kses_post(il_home_meta($page_id, 'why_description', 'Lojistik operasyonlarda kalite ve güvenlik.')); ?></p></div></div></section>

<section class="news-faq"><div class="container news-faq__container"><div class="faq"><div class="faq-header"><h2 class="section-title">Sık Sorulan Sorular</h2></div>
<?php if ($faqs->have_posts()) : while ($faqs->have_posts()) : $faqs->the_post(); ?><div class="faq-item"><button class="faq-trigger" type="button"><?php the_title(); ?><span class="icon">⌄</span></button><div class="faq-content"><?php echo wp_kses_post(wpautop(get_the_content())); ?></div></div><?php endwhile; wp_reset_postdata(); endif; ?>
</div></div></section>

<section class="contact" id="contact"><div class="container contact__container"><div class="contact__wrapper"><div class="contact__info-col"><h2 class="contact__title text-white"><?php echo esc_html(il_home_meta($page_id, 'contact_title', 'Bizimle İletişime Geç')); ?></h2><p class="contact__desc text-white-opacity"><?php echo esc_html(il_home_meta($page_id, 'contact_subtitle', 'Korem ipsum dolor sit amet, consectetur adipiscing elit.')); ?></p></div></div></div></section>

<section class="map-section" aria-label="Lokasyonumuz"><div class="map-container"><?php echo wp_kses(il_theme_option('map_embed'), ['iframe' => ['src' => true, 'width' => true, 'height' => true, 'style' => true, 'allowfullscreen' => true, 'loading' => true, 'referrerpolicy' => true, 'title' => true]]); ?></div></section>
</main>
<?php get_footer();
