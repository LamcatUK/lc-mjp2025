<?php
/**
 * Block template for LC Page Hero.
 *
 * @package lc-mjp2025
 */

defined( 'ABSPATH' ) || exit;

$page_title = get_field( 'title' ) ? get_field( 'title' ) : get_the_title();

?>
<section class="page-hero">
	<div class="container">
		<div class="row h-100">
			<div class="col-md-6 d-flex flex-column justify-content-center page-hero__content">
				<h1 class="page-hero__title"><?= esc_html( $page_title ); ?></h1>
				<div class="page-hero__intro mb-4"><?= esc_html( get_field( 'intro' ) ); ?></div>
				<div class="d-flex gap-2 justify-content-start flex-wrap">
				<?php
				if ( get_field( 'link' ) ) {
					$l = get_field( 'link' );
					?>
					<a href="<?= esc_url( $l['url'] ); ?>" class="btn btn--primary me-3 mb-4 align-self-start"><?= esc_html( $l['title'] ); ?></a>
					<?php
				}
				if ( ! is_page( 'contact' ) ) {
					?>
				<a href="tel:<?= esc_attr( parse_phone( get_field( 'contact_phone', 'option' ) ) ); ?>" class="btn btn--primary me-3 mb-4 align-self-start"><i class="fas fa-phone"></i> Call <?= esc_html( get_field( 'contact_phone', 'option' ) ); ?></a>
					<?php
				}
				?>
				</div>
				<div class="d-flex gap-2 justify-content-start align-items-center flex-wrap">
					<img src="<?= esc_url( get_stylesheet_directory_uri() . '/img/napit-logo.png' ); ?>" class="mb-4" width="460" height="175">
					<a href="https://trustedtraders.which.co.uk/businesses/mjp-electrical-contractors-ltd/" target="_blank" rel="noopener noreferrer">
						<img src="<?= esc_url( get_stylesheet_directory_uri() . '/img/which.png' ); ?>" class="mb-4" width="460" height="175">
					</a>
				</div>
			</div>
			<div class="col-md-6 page-hero__image-container">
				<?php
				if ( get_field( 'image' ) ) {
					echo wp_get_attachment_image( get_field( 'image' ), 'full', false, array( 'class' => 'page-hero__image' ) );
				} else {
					echo get_the_post_thumbnail( get_the_ID(), 'full', array( 'class' => 'page-hero__image' ) );
				}
				?>
			</div>
		</div>
	</div>
</section>