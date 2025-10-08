<?php
/**
 * Block template for LC Home Hero.
 *
 * @package lc-mjp2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="home-hero">
	<?= wp_get_attachment_image( get_field( 'background' ), 'full' ); ?>
	<div class="overlay"></div>
	<div class="container">
		<div class="d-flex flex-column align-items-center">
			<div class="home-hero__pre-title">MJP ELECTRICAL CONTRACTORS</div>
			<h1 class="home-hero__title text-center"><?= esc_html( get_field( 'title' ) ); ?></h1>
			<p class="home-hero__intro mb-4 text-center"><?= esc_html( get_field( 'intro' ) ); ?></p>
			<?php
			if ( get_field( 'link_1' ) || get_field( 'link_2' ) ) {
				?>
				<div class="d-flex justify-content-between gap-2 flex-wrap">
					<?php
				if ( get_field( 'link_1' ) ) {
					$link_1 = get_field( 'link_1' );
					?>
					<a href="<?= esc_url( $link_1['url'] ); ?>" class="btn btn--primary btn-lg me-3"><?= esc_html( $link_1['title'] ); ?></a>
					<?php
				}
				if ( get_field( 'link_2' ) ) {
					$link_2 = get_field( 'link_2' );
					?>
					<a href="<?= esc_url( $link_2['url'] ); ?>" class="btn btn--primary btn-lg me-3"><?= esc_html( $link_2['title'] ); ?></a>
					<?php
				}
				?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</section>