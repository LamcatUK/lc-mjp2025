<?php
/**
 * Block template for LC Trust Bar.
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
<section class="trust-bar <?= esc_attr( implode( ' ', $classes ) ); ?> py-4">
	<div class="container">
		<div class="row g-5 justify-content-center">
			<?php
			if ( have_rows( 'trust_items' ) ) {
				while ( have_rows( 'trust_items' ) ) {
					the_row();
					$name = get_sub_field( 'item' );
					?>
					<div class="col-6 col-md-3 col-lg-3 d-flex flex-column align-items-center text-center">
						<i class="fas fa-check-circle fa-2x has-accent-400-color mb-3"></i>
						<div class="fw-semibold"><?= esc_html( $name ); ?></div>
					</div>
					<?php
				}
			}
			?>
		</div>
	</div>
</section>