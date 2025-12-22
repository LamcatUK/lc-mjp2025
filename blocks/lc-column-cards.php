<?php
/**
 * Block template for LC Column Cards.
 *
 * @package lc-mjp2025
 */

defined( 'ABSPATH' ) || exit;

// Support Gutenberg color picker.
$bg = ! empty( $block['backgroundColor'] ) ? 'has-' . $block['backgroundColor'] . '-background-color' : '';
$fg = ! empty( $block['textColor'] ) ? 'has-' . $block['textColor'] . '-color' : '';

$card_class = 'has-secondary-100-background-color';

$classes = array();
if ( $bg ) {
	$classes[]  = sanitize_html_class( $bg );
	$card_class = '';
}
if ( $fg ) {
	$classes[] = sanitize_html_class( $fg );
}

$cols = get_field( 'columns' ) ? get_field( 'columns' ) : 'three';

?>
<section class="col-cards <?= esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="container py-5">
		<h2><?= wp_kses_post( get_field( 'title' ) ); ?></h2>
		<div class="col-cards__intro w-constrained-md mb-4"><?= esc_html( get_field( 'intro' ) ); ?></div>
		<div class="row g-3">
			<?php
			if ( have_rows( 'cards' ) ) {
				while ( have_rows( 'cards' ) ) {
					the_row();
					$card_link = get_sub_field( 'link' );
					?>
					<div class="<?= esc_attr( 'two' === $cols ? 'col-12 col-md-6' : 'col-12 col-md-4' ); ?>">
						<?php if ( $card_link ) : ?>
							<a href="<?= esc_url( $card_link['url'] ); ?>" class="col-card col-card--linked <?= esc_attr( $card_class ); ?>" 
								<?= $card_link['target'] ? 'target="' . esc_attr( $card_link['target'] ) . '"' : ''; ?>
								<?= $card_link['title'] ? 'title="' . esc_attr( $card_link['title'] ) . '"' : ''; ?>>
								<h3 class="fs-subtle"><?= wp_kses_post( get_sub_field( 'title' ) ); ?></h3>
								<div class="fs-body fw-thin"><?= wp_kses_post( get_sub_field( 'content' ) ); ?></div>
								<span class="col-card__arrow" aria-hidden="true"><i class="fas fa-chevron-right fa-2x"></i></span>
							</a>
						<?php else : ?>
							<div class="col-card <?= esc_attr( $card_class ); ?>">
								<h3 class="fs-subtle"><?= wp_kses_post( get_sub_field( 'title' ) ); ?></h3>
								<div class="fs-body fw-thin"><?= wp_kses_post( get_sub_field( 'content' ) ); ?></div>
							</div>
						<?php endif; ?>
					</div>
					<?php
				}
			}
			?>
		</div>
	</div>
</section>