<?php
/**
 * File responsible for registering custom ACF blocks and modifying core block arguments.
 *
 * @package lc-mjp2025
 */

/**
 * Registers custom ACF blocks.
 *
 * This function checks if the ACF plugin is active and registers custom blocks
 * for use in the WordPress block editor. Each block has its own name, title,
 * category, icon, render template, and supports various features.
 */
function acf_blocks() {
	if ( function_exists( 'acf_register_block_type' ) ) {

		// INSERT NEW BLOCKS HERE.

        acf_register_block_type(
            array(
                'name'            => 'lc_trust_icons',
                'title'           => __( 'LC Trust Icons' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'blocks/lc-trust-icons.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                    'align'     => true,
					'color'     => array(
						'text'       => true,
						'background' => true,
						'gradients'  => false,
					),
                ),
            )
        );

		acf_register_block_type(
			array(
				'name'            => 'lc_trust_bar',
				'title'           => __( 'LC Trust Bar' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/lc-trust-bar.php',
				'mode'            => 'edit',
				'supports'        => array(
					'mode'      => false,
					'anchor'    => true,
					'className' => true,
					'align'     => true,
					'color'     => array(
						'text'       => true,
						'background' => true,
						'gradients'  => false,
					),
				),
			)
		);

		acf_register_block_type(
			array(
				'name'            => 'lc_process_steps',
				'title'           => __( 'LC Process Steps' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/lc-process-steps.php',
				'mode'            => 'edit',
				'supports'        => array(
					'mode'      => false,
					'anchor'    => true,
					'className' => true,
					'align'     => true,
					'color'     => array(
						'text'       => true,
						'background' => true,
						'gradients'  => false,
					),
				),
			)
		);

		acf_register_block_type(
			array(
				'name'            => 'lc_related_case_studies',
				'title'           => __( 'LC Related Case Studies' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/lc-related-case-studies.php',
				'mode'            => 'edit',
				'supports'        => array(
					'mode'      => false,
					'anchor'    => true,
					'className' => true,
					'align'     => true,
				),
			)
		);

		acf_register_block_type(
			array(
				'name'            => 'lc_case_study_index',
				'title'           => __( 'LC Case Study Index' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/lc-case-study-index.php',
				'mode'            => 'edit',
				'supports'        => array(
					'mode'      => false,
					'anchor'    => true,
					'className' => true,
					'align'     => true,
				),
			)
		);

		acf_register_block_type(
			array(
				'name'            => 'lc_case_study_detail',
				'title'           => __( 'LC Case Study Detail' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/lc-case-study-detail.php',
				'mode'            => 'edit',
				'supports'        => array(
					'mode'      => false,
					'anchor'    => true,
					'className' => true,
					'align'     => true,
				),
			)
		);

		acf_register_block_type(
			array(
				'name'            => 'lc_team',
				'title'           => __( 'LC Team' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/lc-team.php',
				'mode'            => 'edit',
				'supports'        => array(
					'mode'      => false,
					'anchor'    => true,
					'className' => true,
					'align'     => true,
				),
			)
		);

		acf_register_block_type(
			array(
				'name'            => 'lc_child_cards',
				'title'           => __( 'LC Child Cards' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/lc-child-cards.php',
				'mode'            => 'edit',
				'supports'        => array(
					'mode'      => false,
					'anchor'    => true,
					'className' => true,
					'align'     => true,
				),
			)
		);

		acf_register_block_type(
			array(
				'name'            => 'lc_contact',
				'title'           => __( 'LC Contact' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/lc-contact.php',
				'mode'            => 'edit',
				'supports'        => array(
					'mode'      => false,
					'anchor'    => true,
					'className' => true,
					'align'     => true,
				),
			)
		);

		acf_register_block_type(
			array(
				'name'            => 'lc_feature_cards',
				'title'           => __( 'LC Feature Cards' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/lc-feature-cards.php',
				'mode'            => 'edit',
				'supports'        => array(
					'mode'      => false,
					'anchor'    => true,
					'className' => true,
					'align'     => true,
				),
			)
		);

		acf_register_block_type(
			array(
				'name'            => 'lc_why_mjp',
				'title'           => __( 'LC Why MJP' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/lc-why-mjp.php',
				'mode'            => 'edit',
				'supports'        => array(
					'mode'      => false,
					'anchor'    => true,
					'className' => true,
					'align'     => true,
				),
			)
		);

		acf_register_block_type(
			array(
				'name'            => 'lc_column_cards',
				'title'           => __( 'LC Column Cards' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/lc-column-cards.php',
				'mode'            => 'edit',
				'supports'        => array(
					'mode'      => false,
					'anchor'    => true,
					'className' => true,
					'align'     => true,
					'color'     => array(
						'text'       => true,
						'background' => true,
						'gradients'  => false,
					),
				),
			)
		);

		acf_register_block_type(
			array(
				'name'            => 'lc_page_hero',
				'title'           => __( 'LC Page Hero' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/lc-page-hero.php',
				'mode'            => 'edit',
				'supports'        => array(
					'mode'      => false,
					'anchor'    => true,
					'className' => true,
					'align'     => true,
				),
			)
		);

		acf_register_block_type(
			array(
				'name'            => 'lc_image_cta',
				'title'           => __( 'LC Image CTA' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/lc-image-cta.php',
				'mode'            => 'edit',
				'supports'        => array(
					'mode'      => false,
					'anchor'    => true,
					'className' => true,
					'align'     => true,
				),
			)
		);

		acf_register_block_type(
			array(
				'name'            => 'lc_testimonials',
				'title'           => __( 'LC Testimonials' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/lc-testimonials.php',
				'mode'            => 'edit',
				'supports'        => array(
					'mode'      => false,
					'anchor'    => true,
					'className' => true,
					'align'     => true,
				),
			)
		);

		acf_register_block_type(
			array(
				'name'            => 'lc_sectors_nav',
				'title'           => __( 'LC Sectors Nav' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/lc-sectors-nav.php',
				'mode'            => 'edit',
				'supports'        => array(
					'mode'      => false,
					'anchor'    => true,
					'className' => true,
					'align'     => true,
				),
			)
		);

		acf_register_block_type(
			array(
				'name'            => 'lc_recent_projects',
				'title'           => __( 'LC Recent Projects' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/lc-recent-projects.php',
				'mode'            => 'edit',
				'supports'        => array(
					'mode'      => false,
					'anchor'    => true,
					'className' => true,
					'align'     => true,
					'color'     => array(
						'text'       => true,
						'background' => true,
						'gradients'  => false,
					),
				),
			)
		);

		acf_register_block_type(
			array(
				'name'            => 'lc_service_cards',
				'title'           => __( 'LC Service Cards' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/lc-service-cards.php',
				'mode'            => 'edit',
				'supports'        => array(
					'mode'      => false,
					'anchor'    => true,
					'className' => true,
					'align'     => true,
				),
			)
		);

		acf_register_block_type(
			array(
				'name'            => 'lc_text_image',
				'title'           => __( 'LC Text Image' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/lc-text-image.php',
				'mode'            => 'edit',
				'supports'        => array(
					'mode'      => false,
					'anchor'    => true,
					'className' => true,
					'align'     => true,
					'color'     => array(
						'text'       => true,
						'background' => true,
						'gradients'  => false,
					),
				),
			)
		);

		acf_register_block_type(
			array(
				'name'            => 'lc_home_hero',
				'title'           => __( 'LC Home Hero' ),
				'category'        => 'layout',
				'icon'            => 'cover-image',
				'render_template' => 'blocks/lc-home-hero.php',
				'mode'            => 'edit',
				'supports'        => array(
					'mode'      => false,
					'anchor'    => true,
					'className' => true,
					'align'     => true,
				),
			)
		);

	}
}
add_action( 'acf/init', 'acf_blocks' );

// Auto-sync ACF field groups from acf-json folder.
add_filter(
	'acf/settings/save_json',
	function ( $path ) {
		return get_stylesheet_directory() . '/acf-json';
	}
);

add_filter(
	'acf/settings/load_json',
	function ( $paths ) {
		unset( $paths[0] );
		$paths[] = get_stylesheet_directory() . '/acf-json';
		return $paths;
	}
);

/**
 * Modifies the arguments for specific core block types.
 *
 * @param array  $args The block type arguments.
 * @param string $name The block type name.
 * @return array Modified block type arguments.
 */
function core_block_type_args( $args, $name ) {

	if ( 'core/paragraph' === $name ) {
		$args['render_callback'] = 'modify_core_add_container';
	}
	if ( 'core/heading' === $name ) {
		$args['render_callback'] = 'modify_core_add_container';
	}
	if ( 'core/list' === $name ) {
		$args['render_callback'] = 'modify_core_add_container';
	}

	return $args;
}
add_filter( 'register_block_type_args', 'core_block_type_args', 10, 3 );

/**
 * Helper function to detect if footer.php is being rendered.
 *
 * @return bool True if footer.php is being rendered, false otherwise.
 */
function is_footer_rendering() {
	$backtrace = debug_backtrace( DEBUG_BACKTRACE_IGNORE_ARGS );
	foreach ( $backtrace as $trace ) {
		if ( isset( $trace['file'] ) && basename( $trace['file'] ) === 'footer.php' ) {
			return true;
		}
	}
	return false;
}

/**
 * Adds a container div around the block content unless footer.php is being rendered.
 *
 * @param array  $attributes The block attributes.
 * @param string $content    The block content.
 * @return string The modified block content wrapped in a container div.
 */
function modify_core_add_container( $attributes, $content ) {
	if ( is_footer_rendering() ) {
		return $content;
	}

	ob_start();
	?>
	<div class="container">
		<?= wp_kses_post( $content ); ?>
	</div>
	<?php
	$content = ob_get_clean();
	return $content;
}
