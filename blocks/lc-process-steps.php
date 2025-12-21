<?php
/**
 * Block template for LC Process Steps.
 *
 * @package lc-mjp2025
 */

defined( 'ABSPATH' ) || exit;

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

?>
<section class="process-steps <?= esc_attr( implode( ' ', $classes ) ); ?> py-5">
	<div class="container">
		<?php
		if ( have_rows( 'steps' ) ) {
			$c = 1;
			echo '<div class="row g-4">';
			while ( have_rows( 'steps' ) ) {
				the_row();
				$title       = get_sub_field( 'title' );
				$description = get_sub_field( 'description' );
				?>
				<div class="col-md-6 col-lg-3">
					<div class="process-step text-center h-100 p-4">
						<div class="has-accent-400-color display-4 fw-bold mb-2"><?= esc_html( $c ); ?></div>
						<?php
						if ( $title ) {
							echo '<h3 class="h3 mb-3">' . esc_html( $title ) . '</h3>';
						}
						if ( $description ) {
							echo '<div class="step-description">' . wp_kses_post( wpautop( $description ) ) . '</div>';
						}
						?>
					</div>
				</div>
				<?php
				++$c;
			}
			echo '</div>';
		} else {
			echo '<p>No steps defined.</p>';
		}
		?>
	</div>
</section>