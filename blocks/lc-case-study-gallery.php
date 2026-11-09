<?php
/**
 * Block template for LC Case Study Gallery.
 *
 * @package lc-mjp2025
 */

defined( 'ABSPATH' ) || exit;

$images = array_filter( (array) get_field( 'gallery' ) );
if ( ! $images ) {
	return;
}

// Initialise the lightbox once per page.
if ( ! has_action( 'wp_footer', 'lc_case_study_lightbox_init' ) ) {
	add_action( 'wp_footer', 'lc_case_study_lightbox_init' );
}

?>
<section class="cs-gallery">
	<div class="container">
		<div class="row py-5" id="gallery_items">
			<?php
			foreach ( $images as $image ) {
				?>
			<div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-4 gallery-item-wrapper">
				<a href="<?= esc_url( wp_get_attachment_image_url( $image, 'full' ) ); ?>" class="work__link image-3x4 glightbox" data-gallery="work-gallery-all" data-type="image">
					<?= wp_get_attachment_image( $image, 'large', false, array( 'class' => 'work__image' ) ); ?>
				</a>
			</div>
				<?php
			}
			?>
		</div>
	</div>
</section>
