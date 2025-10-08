<?php
/**
 * Custom Post Types Registration
 *
 * This file contains the code to register custom post types for the theme.
 *
 * @package lc-mjp2025
 */

/**
 * Register custom post types for the theme.
 *
 * This function registers a custom post type called 'people'.
 * The post type is set to be publicly queryable, has a UI in the admin,
 * and supports REST API.
 *
 * @return void
 */
function lc_register_post_types() {

	register_post_type(
		'person',
		array(
			'labels'          => array(
				'name'               => 'People',
				'singular_name'      => 'Person',
				'add_new_item'       => 'Add New Person',
				'edit_item'          => 'Edit Person',
				'new_item'           => 'New Person',
				'view_item'          => 'View Person',
				'search_items'       => 'Search People',
				'not_found'          => 'No people found',
				'not_found_in_trash' => 'No people in trash',
			),
			'has_archive'     => true,
			'public'          => false,
			'show_ui'         => true,
			'show_in_menu'    => true,
			'show_in_rest'    => true,
			'menu_position'   => 25,
			'menu_icon'       => 'dashicons-feedback',
			'supports'        => array( 'title', 'editor' ),
			'capability_type' => 'post',
			'map_meta_cap'    => true,
			'rewrite'         => false,
		)
	);
}
add_action( 'init', 'lc_register_post_types' );
