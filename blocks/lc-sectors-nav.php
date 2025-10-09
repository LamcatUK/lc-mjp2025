<?php
/**
 * Block template for LC Sectors Nav.
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

?>
<section class="sectors-nav has-secondary-100-background-color">
	<div class="container py-5">
		<?php
		if ( get_field( 'title' ) ) {
			?>
		<h2 class="text-center"><?= esc_html( get_field( 'title' ) ); ?></h2>
			<?php
		}
		if ( get_field( 'intro' ) ) {
			?>
		<div class="sectors-nav__intro text-center mx-auto w-constrained-lg mb-5"><?= wp_kses_post( get_field( 'intro' ) ); ?></div>
			<?php
		}
		?>
		<div class="row g-4">
			<?php
			foreach ( $sectors as $sector ) {
				?>
				<div class="col-lg-3">
					<a class="sectors-nav__card" href="<?= esc_url( get_permalink( $sector->ID ) ); ?>">
						<div class="sectors-nav__image-wrapper">
							<?= wp_get_attachment_image( get_post_thumbnail_id( $sector->ID ), 'large', false, array( 'class' => 'sectors-nav__image' ) ); ?>
						</div>
						<div class="overlay"></div>
						<div class="sectors-nav__content">
							<h3 class="sectors-nav__title"><?= esc_html( $sector->post_title ); ?></h3>
							<div class="sectors-nav__subtitle"><?= esc_html( get_field( 'sector_subtitle', $sector->ID ) ); ?></div>
						</div>
					</a>
				</div>
				<?php
			}
			?>
			</div>
		</div>
	</div>
</section>