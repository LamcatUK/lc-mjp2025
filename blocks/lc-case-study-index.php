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

if ( ! $q->have_posts() ) {
	return;
}

// Fetch all work_type terms for filter dropdown.
$terms = get_terms(
	array(
		'taxonomy'   => 'work_type',
		'hide_empty' => true,
	)
);
?>
<section class="cs-index">
	<div class="container pb-5">
		<?php if ( $terms && ! is_wp_error( $terms ) ) : ?>
			<div class="cs-index__filter py-5">
				<label for="workTypeFilter" class="mb-2 d-block">Filter by Work Type:</label>
				<select class="form-select w-md-50" id="workTypeFilter">
					<option value="">All Work Types</option>
					<?php foreach ( $terms as $term ) : ?>
						<option value="<?= esc_attr( $term->slug ); ?>">
							<?= esc_html( $term->name ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</div>
		<?php endif; ?>

		<div class="row g-4">
			<?php
			while ( $q->have_posts() ) {
				$q->the_post();
				$work_type_terms = get_the_terms( get_the_ID(), 'work_type' );
				$work_type_slugs = array();
				
				if ( $work_type_terms && ! is_wp_error( $work_type_terms ) ) {
					foreach ( $work_type_terms as $work_term ) {
						$work_type_slugs[] = esc_attr( $work_term->slug );
					}
				}
				
				$data_attr = ! empty( $work_type_slugs ) ? 'data-work-type="' . implode( ' ', $work_type_slugs ) . '"' : '';
				?>
				<div class="col-md-4 cs-index__item" <?= wp_kses_post( $data_attr ); ?>>
					<a href="<?= esc_url( get_permalink() ); ?>" class="cs-index__item-link">
						<div class="cs-index__thumb">
							<?= get_the_post_thumbnail( get_the_ID(), 'large' ); ?>
						</div>
						<h3 class="cs-index__item-title mt-3"><?= esc_html( get_the_title() ); ?></h3>
					</a>
				</div>
				<?php
			}
			wp_reset_postdata();
			?>
		</div>
	</div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
	var filterSelect = document.getElementById('workTypeFilter');
	if (!filterSelect) return;
	
	var items = document.querySelectorAll('.cs-index__item');

	function getUrlParam(param) {
		var urlParams = new URLSearchParams(window.location.search);
		return urlParams.get(param);
	}

	function filterItems(selectedValue) {
		items.forEach(function(item) {
			if (!selectedValue) {
				item.style.display = '';
			} else {
				var workTypes = item.getAttribute('data-work-type');
				if (workTypes && workTypes.split(' ').includes(selectedValue)) {
					item.style.display = '';
				} else {
					item.style.display = 'none';
				}
			}
		});
	}

	filterSelect.addEventListener('change', function() {
		filterItems(this.value);
	});

	// Initialize filter from URL parameter
	var initialValue = getUrlParam('work_type') || '';
	filterSelect.value = initialValue;
	filterItems(initialValue);
});
</script>