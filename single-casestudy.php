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
			<h1><?= esc_html( get_the_title() ); ?></h1>
			<div class="case-study__card">
				<?php the_content(); ?>
			</div>
			<div class="row" id="gallery_items">
				<?php
				foreach ( get_field( 'case_study_gallery' ) as $image ) {
					?>
				<div class="col-md-4 mb-4 gallery-item-wrapper">
					<a href="<?= esc_url( wp_get_attachment_image_url( $image, 'full' ) ); ?>" class="work__link image-16x9 glightbox" data-gallery="work-gallery-all" data-type="image">
						<?= wp_get_attachment_image( $image, 'large', false, array( 'class' => 'work__image' ) ); ?>
					</a>
				</div>
					<?php
				}
				?>
			</div>
		</div>
	</article>
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