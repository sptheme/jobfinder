<?php
add_action('init', 'sp_job_type_init', 0);
function sp_job_type_init() {
	register_taxonomy(
		'sp_job_type',
		array( 'sp_job' ),
		array(
			'hierarchical' => true,
			'labels' => array(
				'name' => __( 'Type', 'sptheme_admin' ),
				'singular_name' => __( 'Type', 'sptheme_admin' ),
				'search_items' =>  __( 'Search Type', 'sptheme_admin' ),
				'all_items' => __( 'All Types', 'sptheme_admin' ),
				'parent_item' => __( 'Parent Type', 'sptheme_admin' ),
				'parent_item_colon' => __( 'Parent Type:', 'sptheme_admin' ),
				'edit_item' => __( 'Edit Type', 'sptheme_admin' ),
				'update_item' => __( 'Update Type', 'sptheme_admin' ),
				'add_new_item' => __( 'Add New Type', 'sptheme_admin' ),
				'new_item_name' => __( 'Type', 'sptheme_admin' )
			),
			'sort' => true,
			'rewrite' => array( 'slug' => 'job_type' )
		)
	);
}