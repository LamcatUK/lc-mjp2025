<?php
/**
 * Block template for LC Trust Icons.
 *
 * @package lc-mjp2025
 */

defined( 'ABSPATH' ) || exit;
// Support Gutenberg color picker.
$bg = ! empty( $block['backgroundColor'] ) ? 'has-' . $block['backgroundColor'] . '-background-color' : '';
$fg = ! empty( $block['textColor'] ) ? 'has-' . $block['textColor'] . '-color' : '';

$classes = array();
if ( $bg ) {
	$classes[] = sanitize_html_class( $bg );
}
if ( $fg ) {
	$classes[] = sanitize_html_class( $fg );
}
?>
<section class="trust-icons py-4 <?= esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="container">
		<div class="text-muted text-center fw-semibold mb-4">Accreditation &amp; assurance</div>
		<div class="row">
			<div class="col-md-4 text-center justify-content-center d-flex flex-column align-items-center">
				<img src="<?= esc_url( get_stylesheet_directory_uri() . '/img/napit-logo.png' ); ?>" width="230" height="87.5">
			</div>
			<div class="col-md-4 fw-regular">
				<ul class="lh-normal">
					<li>Fully insured</li>
					<li>Enhanced DBS-checked electricians</li>
					<li>Certification provided on completion</li>
				</ul>
			</div>
			<div class="col-md-4 text-center">
				<a href="https://trustedtraders.which.co.uk/businesses/mjp-electrical-contractors-ltd/" target="_blank" rel="noopener noreferrer">
					<img src="<?= esc_url( get_stylesheet_directory_uri() . '/img/which.png' ); ?>" width="135" height="107">
				</a>
			</div>
		</div>
	</div>
</section>