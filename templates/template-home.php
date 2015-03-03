<?php
/*
Template Name: Home
*/?>

<?php get_header(); ?>
	
	<?php // get all home meta
		$home_meta  = get_post_meta( $post->ID ); ?>

	<!-- Start Slideshow -->
	<?php $meta_slides = explode( ',', get_post_meta( $post->ID, 'sp_page_gallery', true ) ); if ( !empty($meta_slides) ) : ?>
	<div id="slideshow-section">
		<div class="container clearfix">
			<?php 
				$slide_effect = get_post_meta( $post->ID, 'sp_slide_effect', true );
				echo sp_get_meta_slideshow( $meta_slides, $slide_effect ); 
			?>
		</div>
	</div> <!-- #home-slider-section -->	
	<?php endif; ?>	

	<?php do_action( 'sp_start_content_wrap_html' ); ?>
		<div class="main">
	
	<?php
		// Start welcome message
		while ( have_posts() ) : the_post(); ?>
			
			<?php the_content(); ?>
			
	<?php endwhile; ?>

		</div><!-- #main -->
	<?php get_sidebar();?>
	<?php do_action( 'sp_end_content_wrap_html' ); ?>	

	
<?php get_footer(); ?>