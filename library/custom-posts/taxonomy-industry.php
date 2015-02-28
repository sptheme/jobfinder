<?php
add_action('init', 'sp_industry_init', 0);
function sp_industry_init() {
	register_taxonomy(
		'sp_industry',
		array( 'sp_job' ),
		array(
			'hierarchical' => true,
			'labels' => array(
				'name' => __( 'Industry', 'sptheme_admin' ),
				'singular_name' => __( 'Industry', 'sptheme_admin' ),
				'search_items' =>  __( 'Search Industry', 'sptheme_admin' ),
				'all_items' => __( 'All Industries', 'sptheme_admin' ),
				'parent_item' => __( 'Parent Industry', 'sptheme_admin' ),
				'parent_item_colon' => __( 'Parent Industry:', 'sptheme_admin' ),
				'edit_item' => __( 'Edit Industry', 'sptheme_admin' ),
				'update_item' => __( 'Update Industry', 'sptheme_admin' ),
				'add_new_item' => __( 'Add New Industry', 'sptheme_admin' ),
				'new_item_name' => __( 'Industry', 'sptheme_admin' )
			),
			'sort' => true,
			'rewrite' => array( 'slug' => 'industry' )
		)
	);
}