<?php
/**
 * Block template for LC Team.
 *
 * @package lc-mjp2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="team">
	<div class="container py-5">
		<h2><?= esc_html( get_field( 'title' ) ); ?></h2>
		<div><?= wp_kses_post( get_field( 'intro' ) ); ?></div>
		<div class="row g-4 mt-3 justify-content-center">
			<?php
			$people = new WP_Query(
				array(
					'post_type'      => 'person',
					'posts_per_page' => -1,
					'orderby'        => 'menu_order',
					'order'          => 'ASC',
				)
			);
			if ( $people->have_posts() ) {
				while ( $people->have_posts() ) {
					$people->the_post();
					?>
			<div class="col-sm-6 col-md-3">
				<div class="team__person h-100 d-flex flex-column">
					<?php
					if ( has_post_thumbnail() ) {
						?>
					<div class="team__photo">
						<?php
						the_post_thumbnail(
							'medium_large',
							array(
								'class' => 'img-fluid',
								'alt'   => get_the_title(),
							)
						);
						?>
					</div>
						<?php
					} else {
						?>
					<div class="team__photo">
						<img src="<?= esc_url( get_stylesheet_directory_uri() . '/img/person-placeholder.jpg' ); ?>" alt="<?php the_title_attribute(); ?>" class="img-fluid" />
					</div>
						<?php
					}
					?>
					<div class="team__detail">
						<h3 class="team__name h5 mb-1"><?php the_title(); ?></h3>
						<div class="team__role mb-2"><?php echo esc_html( get_field( 'role', get_the_ID() ) ); ?></div>
					</div>
					<?php
					// Close the person div.
					?>
				</div>
			</div>
					<?php
				}
			}
			wp_reset_postdata();
			?>
		</div>
	</div>
</section>
