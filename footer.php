<?php
declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}
?>
<footer class="footer">
    <div class="container footer__container">
        <div class="footer__menu">
            <?php wp_nav_menu(['theme_location' => 'footer', 'container' => false, 'items_wrap' => '<ul class="footer__menu-list">%3$s</ul>', 'fallback_cb' => false]); ?>
        </div>
        <p class="footer__copyright">&copy; <?php echo esc_html(date_i18n('Y')); ?> <?php bloginfo('name'); ?></p>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
