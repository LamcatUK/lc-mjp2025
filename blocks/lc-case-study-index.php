<?php
/**
 * Block template for LC Case Study Index.
 *
 * @package lc-mjp2025
 */

defined( 'ABSPATH' ) || exit;

$q = new WP_Query(
	array(
		'post_type'      => 'casestudy',
		'posts_per_page' => -1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	)
);
if ( $q->have_posts() ) {
	?>
<section class="cs-index">
	<div class="container py-5">
		<div class="row g-4">
			<?php
			while ( $q->have_posts() ) {
				$q->the_post();
				$thumb_id = get_post_thumbnail_id( get_the_ID() );
				?>
			<div class="col-md-6 col-lg-4">
				<a href="<?= esc_url( get_permalink() ); ?>" class="d-flex flex-column text-decoration-none cs-index__item">
					<div class="cs-index__thumb mb-3">
						<?= wp_get_attachment_image( $thumb_id, 'large' ); ?>
					</div>
					<h3 class="h5 mb-2"><?= esc_html( get_the_title() ); ?></h3>
				</a>
			</div>
				<?php
			}
			?>
		</div>
	</div>
</section>
	<?php
}
wp_reset_postdata();