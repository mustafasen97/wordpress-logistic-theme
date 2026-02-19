<?php
declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

$footer_desc = il_customize_value('il_footer_desc', 'Yılların verdiği tecrübeyle birlikte hizmetlerimiz bizler için güvenilirlik, dayanım odaklı bir yapıdan teslimatlara gerçekleşiyor.');
$footer_services_title = il_customize_value('il_footer_services_title', 'Hizmetlerimiz');
$footer_sitemap_title = il_customize_value('il_footer_sitemap_title', 'Site Haritası');
$footer_social_title = il_customize_value('il_footer_social_title', 'Bizi Sosyal Medyada Takip Edin');
$footer_contact_title = il_customize_value('il_footer_contact_title', 'Bize Ulaşın');
$footer_copyright = il_customize_value('il_footer_copyright', 'Tüm Hakları Saklıdır.');
?>
<footer class="footer">
    <div class="container footer__container">
        <div class="footer__grid">
            <div class="footer__col footer__col--about">
                <div class="footer__logo"><?php bloginfo('name'); ?><span>.</span></div>
                <p class="footer__desc"><?php echo esc_html($footer_desc); ?></p>
            </div>

            <div class="footer__col">
                <h3><?php echo esc_html($footer_services_title); ?></h3>
                <div class="footer__links">
                    <a href="<?php echo esc_url(home_url('/hizmetler')); ?>">Karayolu Taşımacılığı</a>
                    <a href="<?php echo esc_url(home_url('/hizmetler')); ?>">Havayolu Taşımacılığı</a>
                    <a href="<?php echo esc_url(home_url('/hizmetler')); ?>">Denizyolu Taşımacılığı</a>
                    <a href="<?php echo esc_url(home_url('/hizmetler')); ?>">Demiryolu Taşımacılığı</a>
                    <a href="<?php echo esc_url(home_url('/hizmetler')); ?>">Evden Eve Nakliyat</a>
                </div>
            </div>

            <div class="footer__col">
                <h3><?php echo esc_html($footer_sitemap_title); ?></h3>
                <div class="footer__links">
                    <a href="<?php echo esc_url(home_url('/')); ?>">Ana Sayfa</a>
                    <a href="<?php echo esc_url(home_url('/hakkimizda')); ?>">Hakkımızda</a>
                    <a href="<?php echo esc_url(home_url('/hizmetler')); ?>">Hizmetlerimiz</a>
                    <a href="<?php echo esc_url(home_url('/blog')); ?>">Blog</a>
                    <a href="<?php echo esc_url(home_url('/iletisim')); ?>">İletişim</a>
                </div>
            </div>

            <div class="footer__col">
                <h3><?php echo esc_html($footer_social_title); ?></h3>
                <div class="footer__social">
                    <a href="<?php echo esc_url(il_theme_option('instagram', '#')); ?>" aria-label="Instagram">I</a>
                    <a href="<?php echo esc_url(il_theme_option('facebook', '#')); ?>" aria-label="Facebook">F</a>
                    <a href="<?php echo esc_url(il_theme_option('linkedin', '#')); ?>" aria-label="LinkedIn">L</a>
                </div>

                <h3><?php echo esc_html($footer_contact_title); ?></h3>
                <ul class="footer__contact-list">
                    <li><?php echo esc_html(il_theme_option('phone', '+90 555 123 4567')); ?></li>
                    <li><?php echo esc_html(il_theme_option('address', 'Lorem Ipsum No: 5 Ümraniye - İstanbul')); ?></li>
                    <li><?php echo esc_html(il_theme_option('email', 'demo@mail.com')); ?></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="footer__bottom">
        <div class="container">Copyright © <?php echo esc_html(date_i18n('Y')); ?>. <?php echo esc_html($footer_copyright); ?></div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
