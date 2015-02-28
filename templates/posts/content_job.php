<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php if ( is_search() || is_archive() || is_category() ) : ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', SP_TEXT_DOMAIN ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<center><a id="apply-job" href="#" class="button">Apply for Job</a></center>

</article><!-- #post-## -->
