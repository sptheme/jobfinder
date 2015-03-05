<?php
/**
 * The default template for displaying job item
 *
 */
?>

<div id="filter-wrap" class="filter-wrap">
	<div class="container clearfix">
		<?php $filter_page = ot_get_option( 'filter-job' ); ?>
		<form action="<?php echo get_page_link($filter_page); ?>" id="filter-job-form" method="get">
			<input type="text" name="job_title" value="<?php if(!empty($_GET['job_title'])) echo $_GET['job_title']; ?>" placeholder="Any job title">
			<?php
				(!empty($_GET['category'])) ? $cat_selected = $_GET['category'] : $cat_selected = '';
				(!empty($_GET['location'])) ? $loc_selected = $_GET['location'] : $loc_selected = '';

				$args = array(
					'show_option_none' 	=> __( 'All Categories' ),
					'orderby'          	=> 'name',
					'hide_empty'		=> 1,
					'name'              => 'category',
					'id'                => 'job-category',
					'class'             => 'job-category',
					'selected'			=> $cat_selected,
					'taxonomy'			=> 'sp_category'
				);
			?>
			<?php wp_dropdown_categories( $args ); ?>
			<?php
				$args = array(
					'show_option_none' 	=> __( 'All Categories' ),
					'orderby'          	=> 'name',
					'hide_empty'		=> 1,
					'name'              => 'location',
					'id'                => 'job-location',
					'class'             => 'job-location',
					'selected'			=> $loc_selected,
					'taxonomy'			=> 'sp_location'
				);
			?>
			<?php wp_dropdown_categories( $args ); ?>
			<input type="submit" value="Filter" id="filter-submit">
		</form>
	</div>
</div>
