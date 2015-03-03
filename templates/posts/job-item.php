<?php
/**
 * The default template for displaying job item
 *
 */
?>

<article id="post-<?php the_ID(); ?>" class="job-item">
	<div class="two-third">	
		<h3><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
		<div class="entry-meta">
			<div class="two-fourth">
				<?php echo get_the_term_list( $post->ID, 'sp_category', '<span class="attr">Category:</span> ', ', ' ); ?>
			</div>
			<div class="two-fourth last">
				<?php echo get_the_term_list( $post->ID, 'sp_industry', '<span class="attr">Industry:</span> ', ', ' ); ?>
			</div>
		</div>
	</div>

	<div class="one-third last">
		<div class="job-location two-fourth">
			<?php echo sp_get_term_name_by_id( get_post_meta( $post->ID, 'sp_job_location', true ), 'sp_location' ); ?>
		</div>
		<div class="two-fourth last">	
			<?php
				$job_type = sp_get_term_name_by_id( get_post_meta( $post->ID, 'sp_job_type', true ), 'sp_job_type' );
				$job_class = str_replace(' ', '-', strtolower($job_type))
			?>
			<div class="job-type <?php echo $job_class; ?>">
				<?php
					$job_type = sp_get_term_name_by_id( get_post_meta( $post->ID, 'sp_job_type', true ), 'sp_job_type' );
					$job_class = str_replace(' ', '-', strtolower($job_type))
				?>
				<?php echo $job_type; ?>
			</div>
			<div class="closed-date"><span>Close Date</span><?php echo date("j M, Y", strtotime(get_post_meta( $post->ID, 'sp_job_expire', true ))); ?></div>
		</div>
	</div>
</article>
