<?php

/**
 * ----------------------------------------------------------------------------------------
 * Load Post type and Toxonomy
 * ----------------------------------------------------------------------------------------
 */

//Custom post WordPress admin menu position - 30, 33, 39, 42, 45, 48
if ( ! isset( $cp_menu_position ) )
	$cp_menu_position = array(
			//'menu_slideshow' => 30,
            'menu_job'       => 33,
            'menu_listing'   => 39,
            'menu_partner'   => 42
		);

//All custom posts
//load_template( SP_BASE_DIR . '/library/custom-posts/cp-slideshow.php' );
load_template( SP_BASE_DIR . '/library/custom-posts/cp-job.php' );
load_template( SP_BASE_DIR . '/library/custom-posts/cp-listing.php' );
load_template( SP_BASE_DIR . '/library/custom-posts/cp-partner.php' );

//Taxonomies
load_template( SP_BASE_DIR . '/library/custom-posts/taxonomy-category.php' );
load_template( SP_BASE_DIR . '/library/custom-posts/taxonomy-industry.php' );
load_template( SP_BASE_DIR . '/library/custom-posts/taxonomy-job-type.php' );
load_template( SP_BASE_DIR . '/library/custom-posts/taxonomy-location.php' );
load_template( SP_BASE_DIR . '/library/custom-posts/taxonomy-partner.php' );

/**
 * ----------------------------------------------------------------------------------------
 * Set Default Terms for your Custom Taxonomies
 * ----------------------------------------------------------------------------------------
 * @author    Michael Fields     http://wordpress.mfields.org/
 *
 * @since     2010-09-13
 * @alter     2010-09-14
 *
 * @license   GPLv2
 */
function sp_set_default_object_terms( $post_id, $post ) {
    if ( 'publish' === $post->post_status ) {
        $defaults = array(
            //'post_tag' => array( 'taco', 'banana' ),
            'sp_category' => array( 'Uncategorized' ),
            'sp_industry' => array( 'Uncategorized' ),
            'sp_location' => array( 'Phnom Penh' ),
            'sp_job_type' => array( 'Full Time' ),
            'partner_category' => array( 'Partner' )
            );
        $taxonomies = get_object_taxonomies( $post->post_type );
        foreach ( (array) $taxonomies as $taxonomy ) {
            $terms = wp_get_post_terms( $post_id, $taxonomy );
            if ( empty( $terms ) && array_key_exists( $taxonomy, $defaults ) ) {
                wp_set_object_terms( $post_id, $defaults[$taxonomy], $taxonomy );
            }
        }
    }
}
add_action( 'save_post', 'sp_set_default_object_terms', 100, 2 );