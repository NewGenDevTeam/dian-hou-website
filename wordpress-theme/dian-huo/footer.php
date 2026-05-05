<?php
$phone    = dh_opt('phone',     '+60 17 878 7652');
$wa       = dh_opt_url('whatsapp', 'https://wa.link/3f0hjs');
$email    = dh_opt('contact_email', 'urgo.adm@gmail.com');
$addr_en  = dh_opt('address_en',  'Level 3, Jalan SS 24/9, PJ');
$addr_zh  = dh_opt('address_zh',  '白蒲 SS 24/9路 3樓');
?>
<footer>
    <div class="container">
        <div class="footer-inner">
            <div class="footer-logo">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/logo.jpg" alt="Dian Huo Hotpot">
                <div>
                    <div class="footer-brand">點火心窩 <span>Dian Huo Hotpot</span></div>
                </div>
            </div>
            <div class="footer-info">
                <div class="en-only" data-i18n="footer-addr"><?php echo esc_html($addr_en); ?></div>
                <div class="zh-only"><?php echo esc_html($addr_zh); ?></div>
                <div><a href="<?php echo esc_url($wa); ?>"><?php echo esc_html($phone); ?></a></div>
                <div><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></div>
            </div>
        </div>
        <div class="footer-copy" data-i18n="footer-copy">© <?php echo date('Y'); ?> 點火心窩 Dian Huo Hotpot · All rights reserved</div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
