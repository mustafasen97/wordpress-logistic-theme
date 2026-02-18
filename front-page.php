<?php
declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$page_id = (int) get_queried_object_id();
$theme_uri = get_template_directory_uri();
$allowed_iframe = ['iframe' => ['src' => true, 'width' => true, 'height' => true, 'style' => true, 'allowfullscreen' => true, 'loading' => true, 'referrerpolicy' => true, 'title' => true]];

$services = new WP_Query([
    'post_type' => 'il_service',
    'posts_per_page' => 8,
    'orderby' => ['menu_order' => 'ASC', 'date' => 'DESC'],
    'no_found_rows' => true,
]);

$faqs = new WP_Query([
    'post_type' => 'il_faq',
    'posts_per_page' => 4,
    'orderby' => ['menu_order' => 'ASC', 'date' => 'DESC'],
    'no_found_rows' => true,
]);

$testimonials = new WP_Query([
    'post_type' => 'il_testimonial',
    'posts_per_page' => 3,
    'orderby' => ['menu_order' => 'ASC', 'date' => 'DESC'],
    'no_found_rows' => true,
]);

$news = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => 2,
    'orderby' => 'date',
    'order' => 'DESC',
    'no_found_rows' => true,
]);

$hero_bg_id = il_home_meta_int($page_id, 'hero_bg_image_id');
$hero_bg_fallback = $theme_uri . '/assets/images/nakliyat-ve-lojistik-temasi-hero-section-banner-background.webp';
$hero_bg = $hero_bg_id > 0 ? wp_get_attachment_image_url($hero_bg_id, 'full') : $hero_bg_fallback;
?>
<main>
    <section class="hero">
        <div class="hero__bg" style="background-image: url('<?php echo esc_url($hero_bg ?: $hero_bg_fallback); ?>');"></div>
        <div class="hero__overlay"></div>
        <div class="container hero__container">
            <div class="hero__content">
                <h1 class="hero__title"><?php echo esc_html(il_home_meta($page_id, 'hero_title', 'Uluslararası Profesyonel Taşımacılık ve Lojistik Çözümleri')); ?></h1>
                <p class="hero__description"><?php echo esc_html(il_home_meta($page_id, 'hero_subtitle', 'Rorem ipsum dolor sit amet, consectetur adipiscing elit.')); ?></p>
                <div class="hero__actions">
                    <a href="<?php echo esc_url(il_home_meta($page_id, 'hero_cta_url', '#contact')); ?>" class="btn btn--blue"><?php echo esc_html(il_home_meta($page_id, 'hero_cta_text', 'Ücretsiz Teklif Alın')); ?></a>
                    <a href="#services-slider" class="btn btn--primary">Hizmetlerimizi Keşfedin</a>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', il_theme_option('phone', '+902345678910'))); ?>" class="hero__phone">
                        <span class="hero__phone-icon">📞</span>
                        <span class="hero__phone-text">Bizi Hemen Arayın <strong><?php echo esc_html(il_theme_option('phone', '+90 234 567 8910')); ?></strong></span>
                    </a>
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
                    <div class="form-group"><input type="text" name="cargo_type" placeholder="Yük Tipi"></div>
                    <div class="form-check">
                        <input type="checkbox" id="kvkk" required>
                        <label for="kvkk">KVKK Açık Rıza Metni'ni okudum, anladım ve onaylıyorum.</label>
                    </div>
                    <button type="submit" class="btn btn--light-blue btn--full">Hemen Teklif Al</button>
                </form>
            </div>
        </div>
    </section>

    <section class="experience">
        <div class="container experience__container">
            <div class="experience__images">
                <div class="img-wrapper img-wrapper--main"><?php echo wp_kses_post(il_image_html(il_home_meta_int($page_id, 'about_main_image_id'), 'large', ['loading' => 'lazy', 'decoding' => 'async', 'alt' => 'Depo'], $theme_uri . '/assets/images/jon-tyson-kR4K8nJ9JRc-unsplash.webp')); ?></div>
                <div class="experience__badge"><strong><?php echo esc_html(il_home_meta($page_id, 'about_years_number', '+25')); ?></strong><span><?php echo nl2br(esc_html(il_home_meta($page_id, 'about_years_label', 'Yıllık Tecrübe'))); ?></span></div>
                <div class="img-wrapper img-wrapper--small"><?php echo wp_kses_post(il_image_html(il_home_meta_int($page_id, 'about_small_image_id'), 'medium', ['loading' => 'lazy', 'decoding' => 'async', 'alt' => 'Çalışan'], $theme_uri . '/assets/images/chuttersnap-BNBA1h-NgdY-unsplash_1_11zon.webp')); ?></div>
            </div>

            <div class="experience__content">
                <span class="badge badge--blue"><?php echo esc_html(il_home_meta($page_id, 'about_badge', 'Hakkımızda')); ?></span>
                <h2 class="section-title"><?php echo esc_html(il_home_meta($page_id, 'about_heading', 'Yılların Deneyimiyle Birlikte Her Sevkiyat Ayrı Bir Güvence')); ?></h2>
                <p class="section-desc"><?php echo wp_kses_post(il_home_meta($page_id, 'about_description', 'Borem ipsum dolor sit amet, consectetur adipiscing elit.')); ?></p>

                <div class="experience__features">
                    <div class="feature-item"><span><?php echo esc_html(il_home_meta($page_id, 'about_feature_1', 'Hızlı Destek')); ?></span></div>
                    <div class="feature-item"><span><?php echo esc_html(il_home_meta($page_id, 'about_feature_2', 'Sigortalı Taşımacılık')); ?></span></div>
                    <div class="feature-item"><span><?php echo esc_html(il_home_meta($page_id, 'about_feature_3', 'Zamanında Teslimat')); ?></span></div>
                </div>

                <div class="experience__actions">
                    <a href="<?php echo esc_url(home_url('/hakkimizda')); ?>" class="btn btn--dark-blue">Devamını Oku</a>
                    <div class="contact-pill"><span>Bizimle İletişime Geç</span></div>
                </div>
            </div>
        </div>
    </section>

    <section class="services splide" id="services-slider">
        <div class="container services__container">
            <div class="services__header">
                <div class="services__title-wrapper">
                    <span class="badge badge--outline">Hizmetlerimiz</span>
                    <h2 class="section-title services__title">Popüler Lojistik Hizmetlerimiz</h2>
                </div>
                <a href="<?php echo esc_url(get_post_type_archive_link('il_service') ?: home_url('/hizmetler')); ?>" class="btn btn--dark-blue btn--hidden-mobile">Tümünü Görüntüle</a>
            </div>

            <div class="splide__track">
                <ul class="splide__list">
                    <?php if ($services->have_posts()) : ?>
                        <?php while ($services->have_posts()) : $services->the_post(); ?>
                            <li class="splide__slide">
                                <article class="service-card">
                                    <div class="service-card__img">
                                        <?php
                                        if (has_post_thumbnail()) {
                                            the_post_thumbnail('medium_large', ['loading' => 'lazy', 'decoding' => 'async']);
                                        } else {
                                            echo '<img src="' . esc_url($theme_uri . '/assets/images/bernd-dittrich-eCc7FjMoR74-unsplash_compressed.webp') . '" alt="' . esc_attr(get_the_title()) . '" loading="lazy" decoding="async">';
                                        }
                                        ?>
                                    </div>
                                    <div class="service-card__body">
                                        <h3><?php the_title(); ?></h3>
                                        <p><?php echo esc_html(get_the_excerpt() ?: wp_trim_words((string) get_the_content(), 14)); ?></p>
                                        <div class="service-card__actions">
                                            <a href="<?php the_permalink(); ?>" class="btn btn--outline-blue">İncele</a>
                                            <a href="#contact" class="btn btn--primary btn--icon-only" aria-label="Teklif Al">➤</a>
                                        </div>
                                    </div>
                                </article>
                            </li>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <li class="splide__slide"><article class="service-card"><div class="service-card__body"><h3>Servis bulunamadı</h3><p>Servis eklediğinizde burada listelenecektir.</p></div></article></li>
                    <?php endif; wp_reset_postdata(); ?>
                </ul>
            </div>
        </div>
    </section>

    <section class="why-us">
        <div class="container why-us__container">
            <div class="why-us__visuals">
                <div class="composition">
                    <div class="composition__center"><?php echo wp_kses_post(il_image_html(il_home_meta_int($page_id, 'why_center_image_id'), 'large', ['loading' => 'lazy', 'decoding' => 'async', 'alt' => 'Neden biz'], $theme_uri . '/assets/images/elevate-dI-aXC7DWpQ-unsplash_compressed.webp')); ?></div>
                    <div class="composition__bubble composition__bubble--1"><?php echo wp_kses_post(il_image_html(il_home_meta_int($page_id, 'why_bubble_1_image_id'), 'thumbnail', ['loading' => 'lazy', 'decoding' => 'async', 'alt' => 'detay 1'], $theme_uri . '/assets/images/william-william-NndKt2kF1L4-unsplash.webp')); ?></div>
                    <div class="composition__bubble composition__bubble--2"><?php echo wp_kses_post(il_image_html(il_home_meta_int($page_id, 'why_bubble_2_image_id'), 'thumbnail', ['loading' => 'lazy', 'decoding' => 'async', 'alt' => 'detay 2'], $theme_uri . '/assets/images/jean-woloszczyk-V5kVoHT44I-unsplash.webp')); ?></div>
                </div>
            </div>
            <div class="why-us__content">
                <span class="badge badge--primary"><?php echo esc_html(il_home_meta($page_id, 'why_badge', 'Neden Biz')); ?></span>
                <h2 class="section-title"><?php echo esc_html(il_home_meta($page_id, 'why_title', 'Neden Bizi Seçmelisiniz?')); ?></h2>
                <p class="section-desc"><?php echo wp_kses_post(il_home_meta($page_id, 'why_description', 'Lojistik operasyonlarda kalite ve güvenlik.')); ?></p>

                <div class="features-list">
                    <?php for ($i = 1; $i <= 4; $i++) : ?>
                        <div class="feature-row">
                            <div class="feature-icon">•</div>
                            <div class="feature-text">
                                <h4><?php echo esc_html(il_home_meta($page_id, 'why_feature_' . $i . '_title', ['Geniş Hizmet Ağı', 'Sigortalı Taşımacılık', 'Zamanında Teslimat', '7/24 Destek'][$i - 1])); ?></h4>
                                <p><?php echo esc_html(il_home_meta($page_id, 'why_feature_' . $i . '_desc', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.')); ?></p>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonials">
        <div class="container">
            <h2 class="section-title text-center">Müşterilerimiz Ne Diyor?</h2>
            <p class="section-desc text-center">Forem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <div class="testimonials__grid">
                <?php if ($testimonials->have_posts()) : ?>
                    <?php while ($testimonials->have_posts()) : $testimonials->the_post(); ?>
                        <article class="testimonial-card">
                            <p><?php echo esc_html(wp_trim_words((string) get_the_content(), 28)); ?></p>
                            <h3><?php the_title(); ?></h3>
                        </article>
                    <?php endwhile; ?>
                <?php endif; wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </section>

    <section class="news-faq">
        <div class="container news-faq__container">
            <div>
                <h2 class="section-title">Sektörden Haberler</h2>
                <div class="news-carousel" id="news-carousel">
                <?php if ($news->have_posts()) : ?>
                    <?php while ($news->have_posts()) : $news->the_post(); ?>
                        <article class="news-card news-slide">
                            <a class="news-card__img" href="<?php the_permalink(); ?>"><?php has_post_thumbnail() ? the_post_thumbnail('medium', ['loading' => 'lazy', 'decoding' => 'async']) : print '<img src="' . esc_url($theme_uri . '/assets/images/caleb-ruiter-EmEQ6kK_5P0-unsplash_compressed.webp') . '" alt="' . esc_attr(get_the_title()) . '">'; ?></a>
                            <div class="news-card__content">
                                <div>
                                    <h3><?php the_title(); ?></h3>
                                    <span class="date"><?php echo esc_html(get_the_date()); ?></span>
                                    <p><?php echo esc_html(wp_trim_words((string) get_the_excerpt(), 22)); ?></p>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="btn btn--outline-blue btn--sm">Devamını Oku</a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                <?php endif; wp_reset_postdata(); ?>
                </div>
            </div>

            <div>
                <div class="faq-header">
                    <h2 class="section-title">FAQ</h2>
                </div>
                <?php if ($faqs->have_posts()) : ?>
                    <?php while ($faqs->have_posts()) : $faqs->the_post(); ?>
                        <div class="faq-item">
                            <button class="faq-trigger" type="button"><?php the_title(); ?><span class="icon">⌄</span></button>
                            <div class="faq-content"><?php echo wp_kses_post(wpautop((string) get_the_content())); ?></div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>

    <section class="contact" id="contact">
        <div class="container contact__container">
            <div class="contact__wrapper">
                <div class="contact__form-col">
                    <h2 class="contact__title"><?php echo esc_html(il_home_meta($page_id, 'contact_title', 'Bize Mesaj Gönder')); ?></h2>
                    <p class="contact__desc"><?php echo esc_html(il_home_meta($page_id, 'contact_subtitle', 'Korem ipsum dolor sit amet, consectetur adipiscing elit.')); ?></p>
                    <form class="contact-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
                        <input type="hidden" name="action" value="il_contact_form">
                        <?php wp_nonce_field('il_contact_form', 'il_contact_nonce'); ?>
                        <input type="text" name="company" value="" tabindex="-1" autocomplete="off" style="position:absolute;left:-9999px;" aria-hidden="true">
                        <div class="form-row">
                            <div class="form-group">
                                <label>Ad Soyad</label>
                                <input type="text" name="name" placeholder="Adınız Soyadınız" required>
                            </div>
                            <div class="form-group">
                                <label>E-Mail</label>
                                <input type="email" name="email" placeholder="E-Posta Adresiniz" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Telefon Numarası</label>
                                <input type="tel" name="phone" placeholder="Telefon Numaranız" required>
                            </div>
                            <div class="form-group">
                                <label>Konu</label>
                                <input type="text" name="subject" placeholder="Konu">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Mesaj</label>
                            <textarea name="message" rows="3" placeholder="Mesajınız" required></textarea>
                        </div>
                        <button type="submit" class="btn btn--dark-blue btn--full">Mesaj Gönder</button>
                    </form>
                </div>

                <div class="contact__info-col">
                    <div class="deco-circle deco-circle--1"></div>
                    <div class="deco-circle deco-circle--2"></div>
                    <div>
                        <h2 class="contact__title text-white">Bizimle İletişime Geç</h2>
                        <p class="contact__desc text-white-opacity">Korem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <ul class="contact-list">
                            <li>
                                <div class="contact-icon">📍</div>
                                <div><h4>Konum</h4><p><?php echo nl2br(esc_html(il_theme_option('address', 'Lorem Ipsum No: 5 Ümraniye - İstanbul'))); ?></p></div>
                            </li>
                            <li>
                                <div class="contact-icon">✉️</div>
                                <div><h4>Email Adresimiz</h4><p><?php echo esc_html(il_theme_option('email', 'loremipsum@yourdomain.com')); ?></p></div>
                            </li>
                            <li>
                                <div class="contact-icon">📞</div>
                                <div><h4>Telefon Numaramız</h4><p><?php echo esc_html(il_theme_option('phone', '+90 123 456 789')); ?></p></div>
                            </li>
                        </ul>
                    </div>
                    <div class="contact__social">
                        <h4>Bizi Sosyal Medyada Takip Edin</h4>
                        <div class="social-row">
                            <a href="<?php echo esc_url(il_theme_option('instagram', '#')); ?>" aria-label="instagram">I</a>
                            <a href="<?php echo esc_url(il_theme_option('facebook', '#')); ?>" aria-label="facebook">F</a>
                            <a href="<?php echo esc_url(il_theme_option('linkedin', '#')); ?>" aria-label="linkedin">L</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="map-section" aria-label="Lokasyonumuz">
        <div class="map-container">
            <?php
            $map = il_theme_option('map_embed');
            if ($map === '') {
                $map = '<iframe src="https://www.google.com/maps?q=Istanbul&output=embed" width="100%" height="450" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Harita"></iframe>';
            }
            echo wp_kses($map, $allowed_iframe);
            ?>
        </div>
    </section>
</main>
<?php get_footer(); ?>
