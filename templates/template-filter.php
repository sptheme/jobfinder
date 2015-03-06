<?php
/*
Template Name: Filter Job
*/?>

<?php get_header(); ?>
	
	<?php get_template_part( 'templates/posts/filter-job-form' ); ?>
	
	<?php do_action( 'sp_start_content_wrap_html' ); ?>
		<div class="main">
			
			<?php 
		    	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

		    	$job_cat = $_GET['category'];
		    	$job_loc = $_GET['location'];

		    	$defaults = array(
		    			'post_type' 	=> 	'sp_job', 
					    's' 			=> 	$_GET['job_title'], 
					    'meta_query' 	=> 	array(
													array(
														'key'     => 'sp_job_expire',
														'value'   => date('Y-m-d'),
														'type' 	  => 'DATE',
														'compare' => '>',
													)
										),
					    'paged' 		=> $paged
		    		);
		    	
		    	$args = array();
		    	if ( ($job_cat != -1) && ($job_loc == -1) ) {
					$args = array (
			    			'tax_query' 	=> 	array(
													array(
														'taxonomy' => 'sp_category',
														'field'    => 'term_id',
														'terms'    => array($job_cat),
													),
												)
			    		);
				} elseif ( ($job_loc != -1) && ($job_cat == -1) ) {
					$args = array (
			    			'tax_query' 	=> 	array(
													array(
														'taxonomy' => 'sp_location',
														'field'    => 'term_id',
														'terms'    => array($job_loc),
													),
												)
			    		);
				} elseif ( ($job_cat != -1) && ($job_loc != -1) ) {
			    	$args = array (
			    			'tax_query' 	=> 	array(
			    									'relation' => 'AND',
			    									array(
														'taxonomy' => 'sp_category',
														'field'    => 'term_id',
														'terms'    => array($job_cat),
													),
													array(
														'taxonomy' => 'sp_location',
														'field'    => 'term_id',
														'terms'    => array($job_loc),
													),
												)
			    		);
				} 	
		    	
				$args = wp_parse_args( $args, $defaults );
				extract( $args );

		    	$query = new WP_Query( $args );
		    ?>
		    <?php if ( $query->have_posts() ) : ?>
		    <header class="page-header">
				<h1 class="page-title">
					<?php 
						if ( ! empty($_GET['job_title']) ) : 
			        		echo __('Result for:',SP_TEXT_DOMAIN)." ".$_GET['job_title'];
			    		else:
			        		the_title();
			        	endif;
			        ?>
			    </h1>
		    </header>
		    <div class="entry-content">	
		    	<?php the_content(); ?>
		    </div>
		    <div class="filter-job-result">
		    <?php 
                
                // Start the Loop.
                while ( $query->have_posts() ) : $query->the_post();

                    /*
                     * Include the post format-specific template for the content. If you want to
                     * use this in a child theme, then include a file called called content-___.php
                     * (where ___ is the post format) and that will be used instead.
                     */
                    get_template_part( 'templates/posts/job-item' );

                endwhile;
            
                    // Pagination
                    if(function_exists('wp_pagenavi'))
                        wp_pagenavi();
                    else 
                        echo sp_pagination( $query->max_num_pages );
            ?>
            </div>
		    <?php else : ?>
		    	<header class="page-header <?php echo $header_style;?>">
				    <h1 class="page-title"><span><?php _e( 'Oops! That page can&rsquo;t be found.', SP_TEXT_DOMAIN ); ?></span></h1>                  
				</header><!-- .page-header -->                     
				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps filter job again, can help.', SP_TEXT_DOMAIN ); ?></p>
		    <?php endif; wp_reset_postdata(); ?>

		</div><!-- #main -->
	<?php get_sidebar();?>
	<?php do_action( 'sp_end_content_wrap_html' ); ?>	

	
<?php get_footer(); ?>