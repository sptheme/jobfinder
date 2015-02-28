<?php
/*
*****************************************************
* listing custom post
*
* CONTENT:
* - 1) Actions and filters
* - 2) Creating a custom post
* - 3) Custom post list in admin
*****************************************************
*/





/*
*****************************************************
*      1) ACTIONS AND FILTERS
*****************************************************
*/
	//ACTIONS
		//Registering CP
		add_action( 'init', 'sp_listing_cp_init' );
		
		//CP list table columns
		add_action( 'manage_posts_custom_column', 'sp_listing_cp_custom_column' );

	//FILTERS
		//CP list table columns
		add_filter( 'manage_edit-sp_listing_columns', 'sp_listing_cp_columns' );




/*
*****************************************************
*      2) CREATING A CUSTOM POST
*****************************************************
*/
	/*
	* Custom post registration
	*/
	if ( ! function_exists( 'sp_listing_cp_init' ) ) {
		function sp_listing_cp_init() {
			global $cp_menu_position;

			
			$labels = array(
				'name'               => __( 'Listings', 'sptheme_admin' ),
				'singular_name'      => __( 'Listing', 'sptheme_admin' ),
				'add_new'            => __( 'Add New', 'sptheme_admin' ),
				'all_items'          => __( 'Listings', 'sptheme_admin' ),
				'add_new_item'       => __( 'Add New Listing', 'sptheme_admin' ),
				'new_item'           => __( 'Add New Listing', 'sptheme_admin' ),
				'edit_item'          => __( 'Edit Listing', 'sptheme_admin' ),
				'view_item'          => __( 'View Listing', 'sptheme_admin' ),
				'search_items'       => __( 'Search Listing', 'sptheme_admin' ),
				'not_found'          => __( 'No Listing found', 'sptheme_admin' ),
				'not_found_in_trash' => __( 'No Listing found in trash', 'sptheme_admin' ),
				'parent_item_colon'  => __( 'Parent Listing', 'sptheme_admin' ),
			);	

			$role     = 'post'; // page
			$slug     = 'listing';
			$supports = array('title', 'editor'); // 'title', 'editor', 'thumbnail'

			$args = array(
				'labels' 				=> $labels,
				'rewrite'               => array( 'slug' => $slug ),
				'menu_position'         => $cp_menu_position['menu_listing'],
				'menu_icon'           	=> 'dashicons-location-alt',
				'supports'              => $supports,
				'capability_type'     	=> $role,
				'query_var'           	=> true,
				'hierarchical'          => false,
				'public'                => true,
				'show_ui'               => true,
				'show_in_nav_menus'	    => false,
				'publicly_queryable'	=> true,
				'exclude_from_search'   => false,
				'has_archive'			=> true,
				'can_export'			=> true
			);
			register_post_type( 'sp_listing' , $args );
		}
	} 


/*
*****************************************************
*      3) CUSTOM POST LIST IN ADMIN
*****************************************************
*/
	/*
	* Registration of the table columns
	*
	* $Cols = ARRAY [array of columns]
	*/
	if ( ! function_exists( 'sp_listing_cp_columns' ) ) {
		function sp_listing_cp_columns( $columns ) {
			
			$columns['cb']                   	= '<input type="checkbox" />';
			$columns['title']                	= __( 'Title', 'sptheme_admin' );
			$columns['address']                	= __( 'Address', 'sptheme_admin' );
			$columns['listing_town']            = __( 'Towns/Cities', 'sptheme_admin' );
			$columns['date']		 			= __( 'Date', 'sptheme_admin' );

			return $columns;
		}
	}

	/*
	* Outputting values for the custom columns in the table
	*
	* $Col = TEXT [column id for switch]
	*/
	if ( ! function_exists( 'sp_listing_cp_custom_column' ) ) {
		function sp_listing_cp_custom_column( $column ) {
			global $post;

			switch ( $column ) {
				
				case "listing_town":
					the_terms( $post->ID, 'sp_city' );
					break;

				case "address":
					echo get_post_meta( $post->ID, 'sp_lt_address', true );
					break;

				default:
				break;
			}
		}
	} // /sp_listing_cp_custom_column

	