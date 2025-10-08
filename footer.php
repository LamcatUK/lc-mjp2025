<?php
/**
 * Footer template for the Harrier Gates 2025 theme.
 *
 * This file contains the footer section of the theme, including navigation menus,
 * office addresses, and colophon information.
 *
 * @package lc-mjp2025
 */

defined( 'ABSPATH' ) || exit;
?>
<div id="footer-top"></div>

<footer class="footer pt-5 pb-3">
    <div class="container">
        <div class="row pb-4 g-4">
			<div class="col-sm-3">
				<img src="<?= esc_url( get_stylesheet_directory_uri() . '/img/mjp-logo.svg' ); ?>" alt="MJP Electrical Contractors Ltd." class="mb-4 d-block" width="100" height="89">
				<div class="fs-tiny">Registered Address:<br><?= do_shortcode( '[contact_address]' ); ?></div>
            </div>
            <div class="col-sm-3">
				<div class="footer-title">Services</div>
                <?=
				wp_nav_menu(
					array(
						'theme_location' => 'footer_menu1',
						'menu_class'     => 'footer__menu',
					)
				);
				?>
            </div>
            <div class="col-sm-3">
				<div class="footer-title">Working With</div>
                <?=
				wp_nav_menu(
					array(
						'theme_location' => 'footer_menu2',
						'menu_class'     => 'footer__menu',
					)
				);
				?>
            </div>
            <div class="col-sm-3 footer__contact">
                <div class="footer-title">Contact</div>
				<ul class="fa-ul">
					<li><span class="fa-li"><i class="far fa-envelope"></i></span> <?= do_shortcode( '[contact_email]' ); ?></li>
					<li><span class="fa-li"><i class="fas fa-phone"></i></span> <?= do_shortcode( '[contact_phone]' ); ?></li>
				</ul>
				<div class="d-flex flex-wrap align-items-center social-icons gap-3 mb-5">
					<span>Connect:</span>
					<?= do_shortcode( '[social_icons class="d-flex justify-content-center gap-3 fs-h3"]' ); ?>
				</div>
				<div class="d-flex gap-3 justify-content-start align-items-center flex-wrap">
					<img src="<?= esc_url( get_stylesheet_directory_uri() . '/img/napit-logo.png' ); ?>" alt="NAPIT Approved Electrician" class="mb-4" width="118" height="74">
					<a href="https://trustedtraders.which.co.uk/businesses/mjp-electrical-contractors-ltd/" target="_blank" rel="noopener noreferrer">
						<img src="<?= esc_url( get_stylesheet_directory_uri() . '/img/which.png' ); ?>" class="mb-4" width="80" height="63" alt="Which Trusted Trader">
					</a>
				</div>
            </div>
        </div>

        <div class="colophon d-flex justify-content-between align-items-center flex-wrap">
            <div>
                &copy; <?= esc_html( gmdate( 'Y' ) ); ?> MJP Electrical Contractors Limited. Registered in England, no. 12802391. VAT No. 362550604.
            </div>
            <div>
				<a href="/terms-of-use/">Terms of use</a> | <a href="/privacy-policy/">Privacy</a> & <a href="/cookie-policy/">Cookies</a> |
                Site by <a href="https://www.lamcat.co.uk/" rel="nofollow noopener" target="_blank">Lamcat</a>
            </div>
        </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>