<?php
/**
 * Block template for CB Case Study Detail.
 *
 * @package lc-mjp2025
 */

defined( 'ABSPATH' ) || exit;

?>
<section class="cs-detail my-5 has-navy-background-color has-background has-white-color">
	<div class="container py-5">
		<?php
		if ( get_field( 'cs_title' ) ) {
			?>
		<h2 class="h4 mb-3"><?= esc_html( get_field( 'cs_title' ) ); ?></h2>
			<?php
		}
		?>
		<div class="cs-detail__grid g-4">
			<?php
			while ( have_rows( 'cs_rows' ) ) {
				the_row();
				?>
			<div class="fw-bold"><?= esc_html( get_sub_field( 'title' ) ); ?></div>
			<div><?= esc_html( get_sub_field( 'content' ) ); ?></div>
			<div class="cs-detail__divider"></div>
				<?php
			}
			?>
		</div>
	</div>
</section>