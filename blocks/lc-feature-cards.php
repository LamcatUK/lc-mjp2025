<?php
/**
 * Block template for LC Feature Cards.
 *
 * @package lc-mjp2025
 */

defined( 'ABSPATH' ) || exit;

// Get ACF fields.
$bg      = get_field( 'bg_colour' );
$fg      = get_field( 'fg_colour' );
$classes = array();

if ( $bg ) {
	$classes[] = 'has-' . sanitize_html_class( $bg ) . '-background-color';
}
if ( $fg ) {
	$classes[] = 'has-' . sanitize_html_class( $fg ) . '-color';
}

?>
<section class="feature-cards <?= esc_attr( implode( ' ', $classes ) ); ?> py-5">
	<div class="container">
		<div class="row g-5">
			<div class="col-md-6">
				<div class="feature-cards__card p-4 h-100 has-white-background-color">
					<h3 class="feature-cards__card-title"><?= esc_html( get_field( 'left_card_title' ) ); ?></h3>
					<div class="feature-cards__card-content"><?= wp_kses_post( get_field( 'left_card_content' ) ); ?></div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="feature-cards__card p-4 h-100 has-white-background-color">
					<h3 class="feature-cards__card-title"><?= esc_html( get_field( 'right_card_title' ) ); ?></h3>
					<div class="feature-cards__card-content"><?= wp_kses_post( get_field( 'right_card_content' ) ); ?></div>
				</div>
			</div>
		</div>
	</div>
</section>