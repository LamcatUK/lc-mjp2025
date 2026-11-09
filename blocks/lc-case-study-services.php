<?php
/**
 * Block template for LC Case Study Services.
 *
 * @package lc-mjp2025
 */

defined( 'ABSPATH' ) || exit;

$services = array_filter( (array) get_field( 'services' ) );
if ( ! $services ) {
	return;
}

$title = get_field( 'title' ) ? get_field( 'title' ) : 'Services used on this project';

?>
<section class="sectors-list">
	<div class="container py-5">
		<h2 class="h3 mb-4"><?= esc_html( $title ); ?></h2>
		<ul class="sectors-list__list sectors-list__list--cols">
			<?php foreach ( $services as $service_id ) { ?>
			<li>
				<a class="sectors-list__link has-secondary-100-background-color" href="<?= esc_url( get_permalink( $service_id ) ); ?>">
					<h3 class="sectors-list__title fs-subtle"><?= esc_html( html_entity_decode( get_the_title( $service_id ), ENT_QUOTES, 'UTF-8' ) ); ?></h3>
					<span class="sectors-list__arrow" aria-hidden="true"><i class="fas fa-chevron-right fa-2x"></i></span>
				</a>
			</li>
			<?php } ?>
		</ul>
	</div>
</section>
