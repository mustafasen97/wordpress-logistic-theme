<?php
declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}
?>
<footer class="footer">
    <div class="container footer__container">
        <div class="footer__col footer__col--about">
            <div class="footer__logo"><?php bloginfo('name'); ?><span>.</span></div>
            <p>Yılların verdiği tecrübeyle birlikte hizmetleriniz bizler için güvenilirlik, dayanım odaklı bir yapıdan teslimatlara gerçekleşiyor.</p>
        </div>

        <div class="footer__col">
            <h3>Hizmetlerimiz</h3>
            <?php
            wp_nav_menu([
                'theme_location' => 'footer',
                'container' => false,
                'menu_class' => 'footer__menu',
                'fallback_cb' => static function (): void {
                    echo '<ul class="footer__menu">';
                    echo '<li><a href="' . esc_url(home_url('/hizmetler')) . '">Karayolu Taşımacılığı</a></li>';
                    echo '<li><a href="' . esc_url(home_url('/hizmetler')) . '">Havayolu Taşımacılığı</a></li>';
                    echo '<li><a href="' . esc_url(home_url('/hizmetler')) . '">Denizyolu Taşımacılığı</a></li>';
                    echo '</ul>';
                },
            ]);
            ?>
        </div>

        <div class="footer__col">
            <h3>Site Haritası</h3>
            <ul class="footer__menu">
                <li><a href="<?php echo esc_url(home_url('/')); ?>">Ana Sayfa</a></li>
                <li><a href="<?php echo esc_url(home_url('/hakkimizda')); ?>">Hakkımızda</a></li>
                <li><a href="<?php echo esc_url(home_url('/hizmetler')); ?>">Hizmetlerimiz</a></li>
                <li><a href="<?php echo esc_url(home_url('/blog')); ?>">Blog</a></li>
                <li><a href="<?php echo esc_url(home_url('/iletisim')); ?>">İletişim</a></li>
            </ul>
        </div>

        <div class="footer__col">
            <h3>Bize Ulaşın</h3>
            <ul class="footer__contact-list">
                <li><?php echo esc_html(il_theme_option('phone', '+90 123 456 7890')); ?></li>
                <li><?php echo esc_html(il_theme_option('address', 'Konum')); ?></li>
                <li><?php echo esc_html(il_theme_option('email', 'info@example.com')); ?></li>
            </ul>
        </div>
    </div>
    <div class="footer__bottom">
        <div class="container"><p>Copyright © <?php echo esc_html(date_i18n('Y')); ?> <?php bloginfo('name'); ?>. Tüm Hakları Saklıdır.</p></div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
