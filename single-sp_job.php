<?php
/**
 * The template for displaying all pages.
 */
?>

<?php get_header(); ?>
	
	<header class="entry-header">
		<div class="container clearfix">
		<div class="three-fourth">
			<?php
				if ( is_single() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
				endif;
			?>
			<?php
				$job_type = sp_get_term_name_by_id( get_post_meta( $post->ID, 'sp_job_type', true ), 'sp_job_type' );
				$job_class = str_replace(' ', '-', strtolower($job_type))
			?>
			<div class="job-type <?php echo $job_class; ?>">
				<?php echo $job_type; ?>
			</div>

			<div class="job-location">
				<?php echo sp_get_term_name_by_id( get_post_meta( $post->ID, 'sp_job_location', true ), 'sp_location' ); ?>
			</div>
			
			<div class="entry-meta">
				<ul>
					<li><span class="attr">Posted on:</span> <?php echo get_the_date('j F, Y'); ?></li>
					<li><?php echo get_the_term_list( $post->ID, 'sp_category', '<span class="attr">Category:</span> ', ', ' ); ?></li>
					<li><?php echo get_the_term_list( $post->ID, 'sp_industry', '<span class="attr">Industry:</span> ', ', ' ); ?></li>
				</ul>
			</div><!-- .entry-meta -->
		</div> <!-- .three-fourth -->

		<div class="one-fourth last">
			<div class="closed-date"><?php echo date("j F, Y", strtotime(get_post_meta( $post->ID, 'sp_job_expire', true ))); ?><span>Close Date</span></div>
		</div> <!-- .one-fourth .last -->
		</div> <!-- .container .clearfix -->
		
	</header><!-- .entry-header -->

<?php do_action( 'sp_start_content_wrap_html' ); ?>
    <div id="main" class="main">
    	<?php
    		// Start the Loop.
			while ( have_posts() ) : the_post();
				/*
				 * Include the post format-specific template for the content. If you want to
				 * use this in a child theme, then include a file called called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */
				?>
				<div class="entry-content">
					<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', SP_TEXT_DOMAIN ) ); ?>
				</div><!-- .entry-content -->
		<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
			endwhile;	
		?>

		<center><a id="apply-job" href="#" class="button yellow">Apply for Job</a></center>
		
		<?php //get_template_part( 'templates/posts/sharing' ); ?>
		
	    <?php 
	    	$terms = get_the_terms( $post->ID, 'sp_category');
	    	if ( $terms && ! is_wp_error( $terms ) ) :
	    		$term_ids = array();
	    		foreach ($terms as $term) {
	    			$term_ids[] = $term->term_id;
	    		}
	    		$term_ids_join = join(', ', $term_ids);
	    	endif;

	    	$args = array(
	    		'post_type' => 'sp_job',
				'tax_query' => array(
							array(
								'taxonomy' => 'sp_category',
								'field'    => 'term_id',
								'terms'    => array($term_ids_join),
							)
						),
				'meta_query' 			=> array(
											array(
												'key'     => 'sp_job_expire',
												'value'   => date('Y-m-d'),
												'type' 	  => 'DATE',
												'compare' => '>',
											),
										),
				'orderby' 				=> 'meta_value_num',
	    		'order' 				=> 'ASC'
	    	);	

		?>
	    
	    <section class="related-jobs">
	    	<h4 class="heading">Related Jobs</h4>
	    	<?php echo sp_get_post_job( 3, $args ); ?>
	    </section>

	</div><!-- #main -->
	<?php get_sidebar();?>
	<?php do_action( 'sp_end_content_wrap_html' ); ?>
<?php get_footer(); ?>