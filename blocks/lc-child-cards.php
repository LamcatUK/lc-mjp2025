<?php
/**
 * Block template for LC Child Cards.
 *
 * @package lc-mjp2025
 */

defined( 'ABSPATH' ) || exit;

// get child pages of the parent service page.
$children = get_posts(
	array(
		'post_type'      => 'page',
		'post_parent'    => get_the_ID(),
		'posts_per_page' => -1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
		'post_status'    => 'publish',
	)
);
if ( ! $children ) {
	return;
}

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
<section class="child-cards <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
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
		<div class="child-cards__intro text-center mx-auto w-constrained-md mb-5"><?= esc_html( get_field( 'intro' ) ); ?></div>
			<?php
		}
		?>
		<div class="row g-4">
			<?php
			// if /3 then three cols, if /2 then two cols.
			$cols = count( $children ) % 3 === 0 ? 3 : 2;
			foreach ( $children as $child ) {
				$subtitle = get_field( 'service_subtitle', $child->ID ) ? get_field( 'service_subtitle', $child->ID ) : get_field( 'sector_subtitle', $child->ID );
				?>
				<div class="col-lg-<?= esc_attr( 12 / $cols ); ?>">
					<a class="child-cards__card" href="<?= esc_url( get_permalink( $child->ID ) ); ?>">
						<div class="child-cards__image-wrapper">
							<?= wp_get_attachment_image( get_post_thumbnail_id( $child->ID ), 'large', false, array( 'class' => 'child-cards__image' ) ); ?>
						</div>
						<div class="overlay"></div>
						<div class="child-cards__content">
							<h3 class="child-cards__title"><?= esc_html( $child->post_title ); ?></h3>
							<div class="child-cards__subtitle"><?= esc_html( $subtitle ); ?></div>
						</div>
					</a>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</section>
