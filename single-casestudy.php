<?php
/**
 * Template for displaying single posts.
 *
 * @package lc-mjp2025
 */

defined( 'ABSPATH' ) || exit;
get_header();
?>
<main id="main" class="case-study">
	<section class="breadcrumbs fs-ui mb-4">
		<div class="container pt-4">
		<?php
		if ( function_exists( 'yoast_breadcrumb' ) ) {
			yoast_breadcrumb( '<div id="breadcrumbs" class="my-2">', '</div>' );
		}
		?>
		</div>
	</section>
	<article>
		<div class="container">
			<div class="case-study__card">
				<h1><?= esc_html( get_the_title() ); ?></h1>
				<?php the_content(); ?>
			</div>
			<div class="row py-5" id="gallery_items">
				<?php
				foreach ( get_field( 'case_study_gallery' ) as $image ) {
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
	</article>
	<section class="image-cta">
		<img src="<?= get_stylesheet_directory_uri() . '/img/cta-bg.jpg'; ?>" alt="" class="image-cta__image" />
		<div class="image-cta__overlay"></div>
		<div class="image-cta__content container">
			<div class="row h-100 align-items-center">
				<div class="col-md-7">
					<h2 class="h1 image-cta__title">Inspired by our recent projects?</h2>
					<div class="image-cta__description">If a design has caught your eye, we can create a tailored solution for your property. From gates to full entrance installations, our team is here to help.</div>
				</div>
				<div class="col-md-5 text-center my-auto">
					<a class="btn btn--primary" href="/request-survey/" target="_self">Request a Survey</a>
				</div>
			</div>
		</div>
	</section>
</main>
<?php
add_action(
	'wp_footer',
	function () {
		?>
<script>
document.addEventListener('DOMContentLoaded', function() {
	const lightbox = GLightbox({
		touchNavigation: true,
		loop: true
	});
});
</script>
		<?php
	}
);

get_footer();
?>