<?php
add_action('init', 'sp_location_init', 0);
function sp_location_init() {
	register_taxonomy(
		'sp_location',
		array( 'sp_job', 'sp_listing' ),
		array(
			'hierarchical' => true,
			'labels' => array(
				'name' => __( 'Location', 'sptheme_admin' ),
				'singular_name' => __( 'Location', 'sptheme_admin' ),
				'search_items' =>  __( 'Search Location', 'sptheme_admin' ),
				'all_items' => __( 'All Locations', 'sptheme_admin' ),
				'parent_item' => __( 'Parent Location', 'sptheme_admin' ),
				'parent_item_colon' => __( 'Parent Location:', 'sptheme_admin' ),
				'edit_item' => __( 'Edit Location', 'sptheme_admin' ),
				'update_item' => __( 'Update Location', 'sptheme_admin' ),
				'add_new_item' => __( 'Add New Location', 'sptheme_admin' ),
				'new_item_name' => __( 'Location', 'sptheme_admin' )
			),
			'sort' => true,
			'rewrite' => array( 'slug' => 'location' )
		)
	);
}