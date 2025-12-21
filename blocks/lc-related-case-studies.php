<?php
/**
 * Block template for CB Related Case Studies.
 *
 * @package lc-mjp2025
 */

defined( 'ABSPATH' ) || exit;

$sectors  = get_field( 'sectors' );
$services = get_field( 'services' );

// Only bail if BOTH are empty; allow querying with either taxonomy.
if ( empty( $sectors ) && empty( $services ) ) {
	return;
}


$tax_query = array( 'relation' => 'OR' );
if ( $sectors ) {
	$tax_query[] = array(
		'taxonomy' => 'sectors',
		'field'    => 'term_id',
		'terms'    => $sectors,
	);
}
if ( $services ) {
	$tax_query[] = array(
		'taxonomy' => 'services',
		'field'    => 'term_id',
		'terms'    => $services,
	);
}
$q = new WP_Query(
	array(
		'post_type'      => 'casestudy',
		'posts_per_page' => 3,
		'tax_query'      => $tax_query, // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	)
);
if ( $q->have_posts() ) {
	?>
<section class="related-cs my-5">
	<div class="container">
		<?php
		if ( get_field( 'title' ) ) {
			?>
		<h2 class="h3 mb-4"><?= esc_html( get_field( 'title' ) ); ?></h2>
			<?php
		}
		?>
		<div class="row g-4">
			<?php
			while ( $q->have_posts() ) {
				$q->the_post();
				$thumb_id = get_post_thumbnail_id( get_the_ID() );
				?>
			<div class="col-lg-6">
				<a href="<?= esc_url( get_permalink() ); ?>" class="related-cs__item">
					<div class="row">
						<div class="col-md-6">
							<h3 class="h5 mb-2"><?= esc_html( get_the_title() ); ?></h3>
							<div class="cs-index__thumb mb-3">
								<?= wp_get_attachment_image( $thumb_id, 'large' ); ?>
							</div>
						</div>
						<div class="col-md-6">
							<?php
							// Extract the repeater data (not rendering the block).
							$post_content   = get_post_field( 'post_content', get_the_ID() );
							$content_blocks = parse_blocks( $post_content );
							$stack          = $content_blocks;
							$data           = array();
							while ( ! empty( $stack ) ) {
								$block = array_shift( $stack );
								if ( isset( $block['blockName'] ) && 'acf/cb-case-study-detail' === $block['blockName'] ) {
									if ( ! empty( $block['attrs']['data'] ) && is_array( $block['attrs']['data'] ) ) {
										$data = $block['attrs']['data'];
									}
									break;
								}
								if ( ! empty( $block['innerBlocks'] ) ) {
									$stack = array_merge( $stack, $block['innerBlocks'] );
								}
							}

							// Fallback: parse JSON directly from the ACF block comment if parse_blocks didn't provide attrs.data.
							if ( empty( $data ) ) {
								if ( preg_match( '/<!--\s*wp:acf\/cb-case-study-detail\s*(\{.*?\})\s*(?:\/)?-->+/s', $post_content, $m ) ) {
									$json  = trim( $m[1] );
									$attrs = json_decode( $json, true );
									if ( json_last_error() === JSON_ERROR_NONE && ! empty( $attrs['data'] ) && is_array( $attrs['data'] ) ) {
										$data = $attrs['data'];
									}
								}
							}

							if ( ! empty( $data ) ) {
								// Determine prefix and recompose rows as a structured array.
								$prefix = null;
								foreach ( array_keys( $data ) as $key ) {
									if ( preg_match( '/^([a-z0-9_]+)_\d+_(title|content)$/i', $key, $m ) ) {
										$prefix = $m[1];
										break;
									}
								}

								if ( ! $prefix ) {
									$prefix = isset( $data['cs_rows'] ) ? 'cs_rows' : ( isset( $data['rows'] ) ? 'rows' : null );
								}

								if ( $prefix ) {
									$rows_struct = array();
									foreach ( $data as $key => $value ) {
										if ( preg_match( '/^' . preg_quote( $prefix, '/' ) . '_(\d+)_(title|content)$/i', $key, $m ) ) {
											$idx   = intval( $m[1] );
											$field = strtolower( $m[2] );

											$rows_struct[ $idx ][ $field ] = $value;
										}
									}
									ksort( $rows_struct );

									// Output ALL rows in order (title + content if present).
									foreach ( $rows_struct as $row ) {
										$line = '';
										if ( ! empty( $row['title'] ) ) {
											$line .= '<strong>' . esc_html( $row['title'] ) . '</strong><br>';
										}
										if ( ! empty( $row['content'] ) ) {
											$line .= ( $line ? ' ' : '' ) . wp_kses_post( $row['content'] );
										}
										if ( $line ) {
											echo wp_kses_post( '<p class="mb-2">' . $line . '</p>' );
										}
									}
								}
							}
							?>

						</div>
					</div>
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