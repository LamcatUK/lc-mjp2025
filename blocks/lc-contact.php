<?php
/**
 * Block template for LC Contact.
 *
 * @package lc-mjp2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="contact has-secondary-100-background-color">
	<div class="container py-5">
		<div class="row g-5">
			<div class="col-md-6">
				<?php
				if ( get_field( 'contact_title' ) ) {
					echo '<h2>' . esc_html( get_field( 'contact_title' ) ) . '</h2>';
				}
				if ( get_field( 'contact_intro' ) ) {
					echo '<div class="contact__intro mb-4">' . wp_kses_post( get_field( 'contact_intro' ) ) . '</div>';
				}
				?>
				<ul class="contact__details fa-ul mb-5">
					<li class="contact__detail mb-3">
						<span class="fa-li has-accent-400-color"><i class="fa-solid fa-phone"></i></span> <?= do_shortcode( '[contact_phone]' ); ?>
					</li>
					<li class="contact__detail mb-3">
						<span class="fa-li has-accent-400-color"><i class="fa-regular fa-envelope"></i></span> <?= do_shortcode( '[contact_email]' ); ?>
					</li>
				</ul>
				<div class="h4">Connect with us</div>
				<?= do_shortcode( '[social_icons class="d-flex justify-content-start gap-3 fs-h2"]' ); ?>
			</div>
			<div class="col-md-6">
				<?= do_shortcode( '[contact-form-7 id="' . esc_attr( get_field( 'form_id' ) ) . '" title="' . esc_attr( get_field( 'form_title' ) ) . '"]' ); ?>
			</div>
		</div>
	</div>
</section>