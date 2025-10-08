<?php
/**
 * Block template for LC Service Cards.
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
?>
<section class="service-cards">
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
		<div class="service-cards__intro text-center mx-auto w-constrained-md mb-5"><?= esc_html( get_field( 'intro' ) ); ?></div>
			<?php
		}
		?>
		<div class="row g-4">
			<?php
			foreach ( $services as $service ) {
				?>
				<div class="col-lg-4">
					<a class="service-cards__card" href="<?= esc_url( get_permalink( $service->ID ) ); ?>">
						<div class="service-cards__image-wrapper">
							<?= wp_get_attachment_image( get_post_thumbnail_id( $service->ID ), 'large', false, array( 'class' => 'service-cards__image' ) ); ?>
						</div>
						<div class="overlay"></div>
						<div class="service-cards__content">
							<h3 class="service-cards__title"><?= esc_html( $service->post_title ); ?></h3>
							<div class="service-cards__subtitle"><?= esc_html( get_field( 'service_subtitle', $service->ID ) ); ?></div>
						</div>
					</a>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</section>
