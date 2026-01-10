<?php
/**
 * Block template for LC Recent Projects.
 *
 * @package lc-mjp2025
 */

defined( 'ABSPATH' ) || exit;

$work_type = get_field( 'work_type' );

$args = array(
	'post_type'      => 'casestudy',
	'post_status'    => 'publish',
	'posts_per_page' => 12,
	'orderby'        => 'date',
	'order'          => 'DESC',
);

// If a specific term is chosen, filter by it.
// Otherwise, make sure attachments must have *some* term.
if ( $work_type ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'work_type',
			'field'    => 'term_id',
			'terms'    => $work_type,
		),
	);
} else {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'work_type',
			'operator' => 'EXISTS',
		),
	);
}

// Support Gutenberg color picker.
$bg = ! empty( $block['backgroundColor'] ) ? 'has-' . $block['backgroundColor'] . '-background-color' : '';
$fg = ! empty( $block['textColor'] ) ? 'has-' . $block['textColor'] . '-color' : '';

$classes = array();
if ( $bg ) {
	$classes[] = sanitize_html_class( $bg );
}
if ( $fg ) {
	$classes[] = sanitize_html_class( $fg );
}

$query = new WP_Query( $args );

if ( $query->have_posts() ) {
	// Collect all images from case studies
	$all_images = array();
	while ( $query->have_posts() ) {
		$query->the_post();
		$gallery = get_field( 'case_study_gallery', get_the_ID() );
		if ( $gallery && is_array( $gallery ) && ! empty( $gallery ) ) {
			$all_images[] = array(
				'images' => $gallery,
				'post_url' => get_permalink( get_the_ID() ),
			);
		}
	}
	wp_reset_postdata();

	// Build final image list with minimum 8 images
	$final_images = array();
	$min_images = 8;
	
	if ( ! empty( $all_images ) ) {
		$case_study_count = count( $all_images );
		$current_index = 0;
		
		// Interleave images from all case studies
		while ( count( $final_images ) < $min_images ) {
			$case_study = $all_images[ $current_index % $case_study_count ];
			
			// Get next available image from this case study
			$image_index = floor( $current_index / $case_study_count ) % count( $case_study['images'] );
			$image_id = $case_study['images'][ $image_index ];
			
			$final_images[] = array(
				'image_id' => $image_id,
				'post_url' => $case_study['post_url'],
			);
			
			$current_index++;
			
			// Safety check to prevent infinite loop
			if ( $current_index > $min_images * $case_study_count * 10 ) {
				break;
			}
		}
	}

	if ( ! empty( $final_images ) ) {
	?>
<section class="recent-projects py-5 <?= esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="container">
		<?php
		if ( get_field( 'title' ) ) {
			?>
		<h2 class="text-center"><?= esc_html( get_field( 'title' ) ); ?></h2>
			<?php
		}
		if ( get_field( 'intro' ) ) {
			?>
		<div class="recent-projects__intro text-center mx-auto w-constrained-md mb-4"><?= esc_html( get_field( 'intro' ) ); ?></div>
			<?php
		}
		echo '<div class="recent-projects__attachments swiper mb-4">';
		echo '<div class="swiper-wrapper pt-2 pb-3">';

		foreach ( $final_images as $item ) {
			echo '<a class="swiper-slide image-16x9" href="' . esc_url( $item['post_url'] ) . '">';
			echo wp_get_attachment_image( $item['image_id'], 'medium', false, array( 'class' => 'img-fluid mb-3' ) );
			echo '</a>';
		}
		
		echo '</div>';
		echo '</div>';
		?>
		<div class="text-center"><a href="/projects/" class="btn btn--primary">View more projects</a></div>
	</div>
</section>
	<?php
	}
}
add_action(
	'wp_footer',
	function () {
		?>
<script>
document.addEventListener('DOMContentLoaded', function() {
	var swiper = new Swiper('.recent-projects__attachments.swiper', {
		loop: true,
		autoplay: {
			delay: 2500,
			disableOnInteraction: false,
		},
		slidesPerView: 1,
		spaceBetween: 24,
		breakpoints: {
			768: {
				slidesPerView: 3,
			},
			992: {
				slidesPerView: 4,
			}
		},
	});
});
</script>
		<?php
	}
);