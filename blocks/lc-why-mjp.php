<?php
/**
 * Block template for LC Why MJP.
 *
 * @package lc-mjp2025
 */

defined( 'ABSPATH' ) || exit;

$cats = array(
	'Expertise & Professionalism'    => 'fa-award',
	'Reliability & Project Delivery' => 'fa-handshake',
	'Safety & Compliance'            => 'fa-shield-alt',
	'Quality & Efficiency'           => 'fa-bolt',
	'Future-Ready & Sustainable'     => 'fa-solar-panel',
	'Customer Focus'                 => 'fa-user-check',
);

?>
<section class="why-mjp py-5 has-primary-900-background-color has-white-color">
	<div class="container">
		<div class="row g-5">
			<div class="col-md-7">
				<h2 class="why-mjp__title"><?= esc_html( get_field( 'title' ) ); ?></h2>
				<div class="why-mjp__intro mb-4"><?= wp_kses_post( get_field( 'intro' ) ); ?></div>
				<a href="/contact/" class="btn btn--primary">Contact Us Today</a>
			</div>
			<div class="col-md-5">
				<ul class="list-unstyled">
				<?php
				if ( have_rows( 'why' ) ) {
					while ( have_rows( 'why' ) ) {
						the_row();
						$icon = get_sub_field( 'category' );
						?>
					<li class="d-flex gap-3 align-items-start mb-3">
						<div class="why__icon">
							<i class="fas <?= esc_attr( $cats[ $icon ] ); ?> fa-2x has-accent-400-color"></i>
						</div>
						<div class="why__reason"><?= esc_html( get_sub_field( 'reason' ) ); ?></div>
					</li>
						<?php
					}
				}
				?>
				</ul>
		</div>
	</div>
</section>	