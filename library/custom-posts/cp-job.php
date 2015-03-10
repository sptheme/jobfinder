<?php
/*
*****************************************************
* Job custom post
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
		add_action( 'init', 'sp_job_cp_init' );
		
		//CP list table columns
		add_action( 'manage_posts_custom_column', 'sp_job_cp_custom_column' );

		// Remove/Unset Job taxonomy
		add_action( 'admin_init', 'sp_remove_job_taxonomy' );

		// Save Job post
		add_action( 'save_post', 'sp_save_job' );

	//FILTERS
		//CP list table columns
		add_filter( 'manage_edit-sp_job_columns', 'sp_job_cp_columns' );

		//CP columns as sortable
		//add_filter( 'manage_edit-sp_job_sortable_columns', 'sp_job_manage_sortable_columns' );




/*
*****************************************************
*      2) CREATING A CUSTOM POST
*****************************************************
*/
	/*
	* Custom post registration
	*/
	if ( ! function_exists( 'sp_job_cp_init' ) ) {
		function sp_job_cp_init() {
			global $cp_menu_position;

			
			$labels = array(
				'name'               => __( 'Jobs', 'sptheme_admin' ),
				'singular_name'      => __( 'Job', 'sptheme_admin' ),
				'add_new'            => __( 'Add New', 'sptheme_admin' ),
				'all_items'          => __( 'Jobs', 'sptheme_admin' ),
				'add_new_item'       => __( 'Add New Job', 'sptheme_admin' ),
				'new_item'           => __( 'Add New Job', 'sptheme_admin' ),
				'edit_item'          => __( 'Edit Job', 'sptheme_admin' ),
				'view_item'          => __( 'View Job', 'sptheme_admin' ),
				'search_items'       => __( 'Search Job', 'sptheme_admin' ),
				'not_found'          => __( 'No Job found', 'sptheme_admin' ),
				'not_found_in_trash' => __( 'No Job found in trash', 'sptheme_admin' ),
				'parent_item_colon'  => __( 'Parent Job', 'sptheme_admin' ),
			);	

			$role     = 'post'; // page
			$slug     = 'job';
			$supports = array('title', 'editor'); // 'title', 'editor', 'thumbnail'

			$args = array(
				'labels' 				=> $labels,
				'rewrite'               => array( 'slug' => $slug ),
				'menu_position'         => $cp_menu_position['menu_job'],
				'menu_icon'           	=> 'dashicons-businessman',
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
			register_post_type( 'sp_job' , $args );
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
	if ( ! function_exists( 'sp_job_cp_columns' ) ) {
		function sp_job_cp_columns( $columns ) {

			unset( $columns['date'] );
			
			$columns['cb']                   	= '<input type="checkbox" />';
			$columns['title']                	= __( 'Title', 'sptheme_admin' );
			$columns['revealid_id'] 			= __( 'ID' );
			$columns['job_category']            = __( 'Category', 'sptheme_admin' );
			$columns['job_industry']            = __( 'Industry', 'sptheme_admin' );
			$columns['job_type']            	= __( 'Type', 'sptheme_admin' );
			$columns['job_location']            = __( 'Location', 'sptheme_admin' );
			$columns['job_expire']		 		= __( 'Expire Date', 'sptheme_admin' );

			return $columns;
		}
	}

	/*
	* Outputting values for the custom columns in the table
	*
	* $Col = TEXT [column id for switch]
	*/
	if ( ! function_exists( 'sp_job_cp_custom_column' ) ) {
		function sp_job_cp_custom_column( $column ) {
			global $post;

			switch ( $column ) {
				
				case "revealid_id":
					echo $post->ID; 
					break;

				case "job_category":
					the_terms( $post->ID, 'sp_category' );
					break;

				case "job_industry":
					the_terms( $post->ID, 'sp_industry' );
					break;

				case "job_type":
					the_terms( $post->ID, 'sp_job_type' );
					break;

				case "job_location":
					the_terms( $post->ID, 'sp_location' );
					break;

				case "job_expire":
					echo get_post_meta( $post->ID, 'sp_job_expire', true );
					break;	

				default:
				break;
			}
		}
	} // /sp_job_cp_custom_column


/*
*****************************************************
*      4) CUSTOM POST MANAGE SORTABLE COLUMN
*****************************************************
*/
	/*
	* Registration of the sortable columns
	*
	* $Cols = ARRAY [array of columns]
	*/
	/*if ( ! function_exists( 'sp_job_manage_sortable_columns' ) ) {
		function sp_job_manage_sortable_columns( $sortable_columns ) {
			
			$sortable_columns[ 'revealid_id_column' ] = 'revealid_id';

			return $sortable_columns;

		}
	}*/	

	/*
	* Custom function
	*
	*/
	if ( ! function_exists( 'sp_remove_job_taxonomy' ) ) {
		function sp_remove_job_taxonomy(){
			remove_meta_box( 'sp_job_typediv', 'sp_job', 'side' );
			remove_meta_box( 'sp_locationdiv', 'sp_job', 'side' );
		}
	}

	/*
	* Update meta position value on position term
	* 
	*/
	if ( ! function_exists( 'sp_save_job' ) ) {
		function sp_save_job( $post_id ) {
			global $post;
			if (get_post_type() == 'sp_job') {
				if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
				wp_set_post_terms( $post->ID, $_POST['sp_job_type'], 'sp_job_type' );
				wp_set_post_terms( $post->ID, $_POST['sp_job_location'], 'sp_location' );
			}
		}
	}

	