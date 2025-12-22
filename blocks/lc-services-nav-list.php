<?php
/**
 * Block template for LC Services Nav List.
 *
 * @package lc-mjp2025
 */

defined( 'ABSPATH' ) || exit;

$parent = get_page_by_path( 'services', OBJECT, 'page' );

// get child pages of the parent service page.
$services = get_posts(
	array(
		'post_type'      => 'page',
		'post_parent'    => $parent->ID,
		'posts_per_page' => -1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
		'post_status'    => 'publish',
	)
);
if ( ! $services ) {
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
<section class="service-list <?= esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="container py-5">
		<?php
		if ( get_field( 'title' ) ) {
			$level   = get_field( 'level' ) ? get_field( 'level' ) : 'h2';
			$classes = 'h2' === $level ? 'text-center' : 'pt-5';
			?>
		<<?= esc_html( $level ); ?> class="<?= esc_attr( $classes ); ?>"><?= esc_html( get_field( 'title' ) ); ?></<?= esc_html( $level ); ?>>
			<?php
		}
		if ( get_field( 'intro' ) ) {
			?>
		<div class="service-list__intro text-center mx-auto w-constrained-md mb-5"><?= esc_html( get_field( 'intro' ) ); ?></div>
			<?php
		}
		?>
		<div class="cols-lg-3">
			<?php
			foreach ( $services as $service ) {
				?>
				<li class="mb-3">
					<a class="service-list__link" href="<?= esc_url( get_permalink( $service->ID ) ); ?>">
						<h3 class="service-list__title"><?= esc_html( $service->post_title ); ?></h3>
					</a>
				</li>
				<?php
			}
			?>
		</div>
	</div>
</section>
