<?php
add_action('init', 'sp_category_init', 0);
function sp_category_init() {
	register_taxonomy(
		'sp_category',
		array( 'sp_job' ),
		array(
			'hierarchical' => true,
			'labels' => array(
				'name' => __( 'Category', 'sptheme_admin' ),
				'singular_name' => __( 'Category', 'sptheme_admin' ),
				'search_items' =>  __( 'Search Category', 'sptheme_admin' ),
				'all_items' => __( 'All Categories', 'sptheme_admin' ),
				'parent_item' => __( 'Parent Category', 'sptheme_admin' ),
				'parent_item_colon' => __( 'Parent Category:', 'sptheme_admin' ),
				'edit_item' => __( 'Edit Category', 'sptheme_admin' ),
				'update_item' => __( 'Update Category', 'sptheme_admin' ),
				'add_new_item' => __( 'Add New Category', 'sptheme_admin' ),
				'new_item_name' => __( 'Category', 'sptheme_admin' )
			),
			'sort' => true,
			'rewrite' => array( 'slug' => 'category' )
		)
	);
}