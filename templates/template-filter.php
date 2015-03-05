<?php
/*
Template Name: Filter Job
*/?>

<?php get_header(); ?>
	
	<?php get_template_part( 'templates/posts/filter-job-form' ); ?>
	
	<?php do_action( 'sp_start_content_wrap_html' ); ?>
		<div class="main">
			<header class="page-header">
				<h1 class="page-title">
			        <?php echo __('Result for:',SP_TEXT_DOMAIN)." ".$_GET['job_title']; ?>
			    </h1>
		    </header>
		    <?php
				// Start welcome message
				while ( have_posts() ) : the_post(); ?>
					
					<?php the_content(); ?>
					
			<?php endwhile; ?>

		    <p>Catgory: <?php echo $_GET['category']; ?></p>
		    <p>Catgory: <?php echo $_GET['location']; ?></p>


		</div><!-- #main -->
	<?php get_sidebar();?>
	<?php do_action( 'sp_end_content_wrap_html' ); ?>	

	
<?php get_footer(); ?>