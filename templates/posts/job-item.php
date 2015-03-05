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
			<?php echo get_the_term_list( $post->ID, 'sp_location', '', ', ' ); ?>
		</div>
		<div class="two-fourth last">	
			<?php echo sp_get_job_type( $post->ID ); ?>
			<div class="closed-date"><span>Close Date</span><?php echo date("j M, Y", strtotime(get_post_meta( $post->ID, 'sp_job_expire', true ))); ?></div>
		</div>
	</div>
</article>
