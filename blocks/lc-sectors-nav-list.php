<?php
/**
 * Block template for LC Sectors Nav List.
 *
 * @package lc-mjp2025
 */

defined( 'ABSPATH' ) || exit;

$parent = get_page_by_path( 'sectors', OBJECT, 'page' );

// get child pages of the parent service page.
$sectors = get_posts(
	array(
		'post_type'      => 'page',
		'post_parent'    => $parent->ID,
		'posts_per_page' => -1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
		'post_status'    => 'publish',
	)
);
if ( ! $sectors ) {
	return;
}

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

?>
<section class="sectors-list <?= esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="container py-5">
		<div class="row g-5">
			<div class="col-lg-6">
				<?php
				if ( get_field( 'title' ) ) {
					?>
				<h2><?= esc_html( get_field( 'title' ) ); ?></h2>
					<?php
				}
				if ( get_field( 'intro' ) ) {
					?>
				<div class="sectors-list__intro w-constrained-lg"><?= wp_kses_post( get_field( 'intro' ) ); ?></div>
					<?php
				}
				?>
			</div>
			<div class="col-lg-6">
				<ul class="sectors-list__list">
					<?php
					foreach ( $sectors as $sector ) {
						?>
					<li>
						<a class="sectors-list__link <?= esc_attr( $card_class ); ?>" href="<?= esc_url( get_permalink( $sector->ID ) ); ?>">
							<h3 class="sectors-list__title fs-subtle"><?= esc_html( html_entity_decode( $sector->post_title, ENT_QUOTES, 'UTF-8' ) ); ?></h3>
							<span class="sectors-list__arrow" aria-hidden="true"><i class="fas fa-chevron-right fa-2x"></i></span>
						</a>
					</li>
						<?php
					}
					?>
				</ul>
			</div>
		</div>
	</div>
</section>