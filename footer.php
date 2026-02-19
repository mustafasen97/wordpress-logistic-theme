<?php
declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}
?>
<footer class="footer">
    <div class="container footer__container">
        <div class="footer__grid">
            <div class="footer__col footer__col--about">
                <div class="footer__logo"><?php bloginfo('name'); ?><span>.</span></div>
                <p class="footer__desc"><?php echo esc_html(il_theme_option('footer_about_text', 'Yılların verdiği tecrübeyle birlikte hizmetlerimiz bizler için güvenilirlik, dayanım odaklı bir yapıdan teslimatlara gerçekleşiyor.')); ?></p>
            </div>

            <div class="footer__col">
                <h3>Hizmetlerimiz</h3>
                <div class="footer__links">
                    <a href="<?php echo esc_url(home_url('/hizmetler')); ?>">Karayolu Taşımacılığı</a>
                    <a href="<?php echo esc_url(home_url('/hizmetler')); ?>">Havayolu Taşımacılığı</a>
                    <a href="<?php echo esc_url(home_url('/hizmetler')); ?>">Denizyolu Taşımacılığı</a>
                    <a href="<?php echo esc_url(home_url('/hizmetler')); ?>">Demiryolu Taşımacılığı</a>
                    <a href="<?php echo esc_url(home_url('/hizmetler')); ?>">Evden Eve Nakliyat</a>
                </div>
            </div>

            <div class="footer__col">
                <h3>Site Haritası</h3>
                <div class="footer__links">
                    <a href="<?php echo esc_url(home_url('/')); ?>">Ana Sayfa</a>
                    <a href="<?php echo esc_url(home_url('/hakkimizda')); ?>">Hakkımızda</a>
                    <a href="<?php echo esc_url(home_url('/hizmetler')); ?>">Hizmetlerimiz</a>
                    <a href="<?php echo esc_url(home_url('/blog')); ?>">Blog</a>
                    <a href="<?php echo esc_url(home_url('/iletisim')); ?>">İletişim</a>
                </div>
            </div>

            <div class="footer__col">
                <h3><?php echo esc_html(il_theme_option('footer_social_title', 'Bizi Sosyal Medyada Takip Edin')); ?></h3>
                <div class="footer__social">
                    <a href="<?php echo esc_url(il_theme_option('instagram', '#')); ?>" aria-label="Instagram">I</a>
                    <a href="<?php echo esc_url(il_theme_option('facebook', '#')); ?>" aria-label="Facebook">F</a>
                    <a href="<?php echo esc_url(il_theme_option('linkedin', '#')); ?>" aria-label="LinkedIn">L</a>
                </div>

                <h3><?php echo esc_html(il_theme_option('footer_contact_title', 'Bize Ulaşın')); ?></h3>
                <ul class="footer__contact-list">
                    <li><?php echo esc_html(il_theme_option('phone', '+90 555 123 4567')); ?></li>
                    <li><?php echo esc_html(il_theme_option('address', 'Lorem Ipsum No: 5 Ümraniye - İstanbul')); ?></li>
                    <li><?php echo esc_html(il_theme_option('email', 'demo@mail.com')); ?></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="footer__bottom">
        <div class="container">Copyright © <?php echo esc_html(date_i18n('Y')); ?>. <?php echo esc_html(il_theme_option('footer_copyright_text', 'Tüm Hakları Saklıdır.')); ?></div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
