<?php
/**
 * Template for displaying single posts.
 *
 * @package lc-mjp2025
 */

defined( 'ABSPATH' ) || exit;
get_header();
?>
<main id="main" class="case-study">
	<section class="breadcrumbs fs-ui mb-4">
		<div class="container pt-4">
		<?php
		lc_breadcrumbs();
		?>
		</div>
	</section>
	<article>
		<?php
		// The gallery and services blocks sit below the card; everything else goes inside it.
		$after_card = array();
		?>
		<div class="container">
			<div class="case-study__card">
				<h1><?= esc_html( get_the_title() ); ?></h1>
				<?php
				foreach ( parse_blocks( get_the_content() ) as $block ) {
					if ( in_array( $block['blockName'], array( 'acf/lc-case-study-gallery', 'acf/lc-case-study-services' ), true ) ) {
						$after_card[] = $block;
						continue;
					}
					echo apply_filters( 'the_content', serialize_block( $block ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
				?>
			</div>
		</div>
		<?php
		foreach ( $after_card as $block ) {
			echo render_block( $block ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		?>
	</article>
	<section class="image-cta">
		<img src="<?= get_stylesheet_directory_uri() . '/img/cta-bg.jpg'; ?>" alt="" class="image-cta__image" />
		<div class="image-cta__overlay"></div>
		<div class="image-cta__content container">
			<div class="row h-100 align-items-center">
				<div class="col-md-7">
					<h2 class="h1 image-cta__title">Inspired by our recent projects?</h2>
					<div class="image-cta__description">If a design has caught your eye, we can create a tailored solution for your property. From gates to full entrance installations, our team is here to help.</div>
				</div>
				<div class="col-md-5 text-center my-auto">
					<a class="btn btn--primary" href="/contact/" target="_self">Contact us today</a>
				</div>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();
?>