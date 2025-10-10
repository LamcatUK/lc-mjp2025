<?php
/**
 * Block template for LC Home Hero.
 *
 * @package lc-mjp2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="home-hero">
	<?= wp_get_attachment_image( get_field( 'background' ), 'full', false, array( 'class' => 'home-hero__image' ) ); ?>
	<div class="overlay"></div>
	<div class="container">
		<div class="d-flex flex-column align-items-center">
			<div class="home-hero__pre-title">MJP ELECTRICAL CONTRACTORS</div>
			<h1 class="home-hero__title text-center"><?= esc_html( get_field( 'title' ) ); ?></h1>
			<!-- <p class="home-hero__intro mb-4 text-center"><?= esc_html( get_field( 'intro' ) ); ?></p> -->
			<?php
			if ( get_field( 'link_1' ) || get_field( 'link_2' ) ) {
				?>
				<div class="d-flex align-items-center justify-content-center justify-content-md-between gap-2 flex-wrap mt-4">
					<?php
				if ( get_field( 'link_1' ) ) {
					$link_1 = get_field( 'link_1' );
					?>
					<a href="<?= esc_url( $link_1['url'] ); ?>" class="btn btn--primary btn-lg me-3"><?= esc_html( $link_1['title'] ); ?></a>
					<?php
				}
				?>
				<a href="tel:<?= esc_attr( parse_phone( get_field( 'contact_phone', 'option' ) ) ); ?>" class="btn btn--primary me-3 align-self-start"><i class="fas fa-phone"></i> Call <?= esc_html( get_field( 'contact_phone', 'option' ) ); ?></a>
				</div>
				<?php
			}
			?>
			<div class="d-flex gap-2 justify-content-start align-items-center flex-wrap badges">
				<img src="<?= esc_url( get_stylesheet_directory_uri() . '/img/napit-logo.png' ); ?>" class="mb-4" width="460" height="175">
				<a href="https://trustedtraders.which.co.uk/businesses/mjp-electrical-contractors-ltd/" target="_blank" rel="noopener noreferrer">
					<img src="<?= esc_url( get_stylesheet_directory_uri() . '/img/which.png' ); ?>" class="mb-4" width="460" height="175">
				</a>
			</div>
		</div>
	</div>
</section>