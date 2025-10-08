<?php
/**
 * Block template for LC Image CTA.
 *
 * @package lc-mjp2025
 */

defined( 'ABSPATH' ) || exit;

$cta = get_field( 'link' ) ? get_field( 'link' ) : null;

$image = wp_get_attachment_image( get_field( 'image' ), 'full', false, array( 'class' => 'image-cta__image' ) );
?>
<section class="image-cta">
	<?php
	if ( get_field( 'background' ) ) {
		echo wp_get_attachment_image( get_field( 'background' ), 'full', false, array( 'class' => 'image-cta__image' ) );
	} else {
		?>
		<img class="image-cta__image" src="<?= esc_url( get_stylesheet_directory_uri() . '/img/cta-bg.jpg' ); ?>" alt="Placeholder Image">
		<?php
	}
	?>
	<div class="image-cta__overlay"></div>
	<div class="image-cta__content container">
		<div class="row h-100 align-items-center">
			<div class="col-md-7">
				<h2 class="h1 image-cta__title"><?= esc_html( get_field( 'title' ) ); ?></h2>
				<div class="image-cta__description"><?= esc_html( get_field( 'content' ) ); ?></div>
			</div>
			<div class="col-md-5 text-center my-auto">
				<a class="btn btn--primary" href="<?= esc_url( $cta['url'] ); ?>" target="<?= esc_attr( $cta['target'] ); ?>"><?= esc_html( $cta['title'] ); ?></a>
			</div>
		</div>
	</div>
</section>