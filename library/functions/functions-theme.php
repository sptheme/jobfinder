<?php

/**
 * ----------------------------------------------------------------------------------------
 * Makes some changes to the <title> tag, by filtering the output of wp_title()
 * ----------------------------------------------------------------------------------------
 */
if( !function_exists('sp_filter_wp_title')) {

	function sp_filter_wp_title( $title, $separator ) {

		if ( is_feed() ) return $title;

		global $paged, $page;

		if ( is_search() ) {
			$title = sprintf(__('Search results for %s', SP_TEXT_DOMAIN), '"' . get_search_query() . '"');

			if ( $paged >= 2 )
				$title .= " $separator " . sprintf(__('Page %s', SP_TEXT_DOMAIN), $paged);

			$title .= " $separator " . get_bloginfo('name', 'display');

			return $title;
		}

		$title .= get_bloginfo('name', 'display');
		$site_description = get_bloginfo('description', 'display');

		if ( $site_description && ( is_home() || is_front_page() ) )
			$title .= " $separator " . $site_description;

		if ( $paged >= 2 || $page >= 2)
			$title .= " $separator " . sprintf(__('Page %s', SP_TEXT_DOMAIN), max($paged, $page) );

		return $title;

	}
	add_filter('wp_title', 'sp_filter_wp_title', 10, 2);

}

/**
 * ----------------------------------------------------------------------------------------
 * Customizable size of gallery thumbnail wp core
 * ----------------------------------------------------------------------------------------
 */
function sp_gallery_atts( $out, $pairs, $atts ) {
	$atts = shortcode_atts( array(
	'columns' => '3',
	'size' => 'medium',
	), $atts );
	 
	$out['columns'] = $atts['columns'];
	$out['size'] = $atts['size'];
	 
	return $out;
 
}
add_filter( 'shortcode_atts_gallery', 'sp_gallery_atts', 10, 3 );

/**
 * ----------------------------------------------------------------------------------------
 * Excerpt ending
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'sp_excerpt_more' ) ) {

	add_filter( 'excerpt_more', 'sp_excerpt_more' );

	function sp_excerpt_more( $more ) {
		global $post;
   		$out = ' &#46;&#46;&#46;';
   		$out .= '<a class="more" href="'. get_permalink($post->ID) . '">' . __( 'Read More', SP_TEXT_DOMAIN ) . '</a>';

   		return $out;
	}
	
}

/**
 * ----------------------------------------------------------------------------------------
 * Excerpt length
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'sp_excerpt_length' ) ) {

	add_filter( 'excerpt_length', 'sp_excerpt_length', 999 );

	function sp_excerpt_length( $length ) {
		return ot_get_option('excerpt-length',$length);
	}
	
}

/**
 * ----------------------------------------------------------------------------------------
 * Facebook content sharing
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'sp_facbook_content_sharing' ) ) {

	add_filter( 'wp_head', 'sp_facbook_content_sharing', 1 );

	function sp_facbook_content_sharing( $length ) {
		global $post;
		
		// facebook sharing fix for videos, we add the custom meta data
        if (has_post_thumbnail($post->ID)) {
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
            if (!empty($image[0])) {
                echo '<meta property="og:image" content="' .  $image[0] . '" />';
            }
        } else {
        	echo '<meta property="og:image" content="' .  ot_get_option('custom-ipad-icon144') . '" />'; 
        }
	}
	
}



/**
 * ----------------------------------------------------------------------------------------
 * Start content wrap
 * ----------------------------------------------------------------------------------------
 */
if ( !function_exists('sp_start_content_wrap') ) {

	add_action( 'sp_start_content_wrap_html', 'sp_start_content_wrap' );

	function sp_start_content_wrap() {
		echo '<section id="content"><div class="container clearfix">';
	}
	
}

/**
 * ----------------------------------------------------------------------------------------
 * End content wrap
 * ----------------------------------------------------------------------------------------
 */
if ( !function_exists('sp_end_content_wrap') ) {

	add_action( 'sp_end_content_wrap_html', 'sp_end_content_wrap' );

	function sp_end_content_wrap() {
		echo '</div></section> <!-- #content .container .clearfix -->';
	}

}

/**
 * ----------------------------------------------------------------------------------------
 * Displays a page pagination
 * ----------------------------------------------------------------------------------------
 */

if ( !function_exists('sp_pagination') ) {

	function sp_pagination( $pages = '', $range = 2 ) {

		$showitems = ( $range * 2 ) + 1;

		global $paged, $wp_query;

		if( empty( $paged ) )
			$paged = 1;

		if( $pages == '' ) {

			$pages = $wp_query->max_num_pages;

			if( !$pages )
				$pages = 1;

		}

		if( 1 != $pages ) {

			$output = '<nav class="pagination">';

			// if( $paged > 2 && $paged >= $range + 1 /*&& $showitems < $pages*/ )
				// $output .= '<a href="' . get_pagenum_link( 1 ) . '" class="next">&laquo; ' . __('First', 'sptheme_admin') . '</a>';

			if( $paged > 1 /*&& $showitems < $pages*/ )
				$output .= '<a href="' . get_pagenum_link( $paged - 1 ) . '" class="next">&larr; ' . __('Previous', SP_TEXT_DOMAIN) . '</a>';

			for ( $i = 1; $i <= $pages; $i++ )  {

				if ( 1 != $pages && ( !( $i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems ) )
					$output .= ( $paged == $i ) ? '<span class="current">' . $i . '</span>' : '<a href="' . get_pagenum_link( $i ) . '">' . $i . '</a>';

			}

			if ( $paged < $pages /*&& $showitems < $pages*/ )
				$output .= '<a href="' . get_pagenum_link( $paged + 1 ) . '" class="prev">' . __('Next', SP_TEXT_DOMAIN) . ' &rarr;</a>';

			// if ( $paged < $pages - 1 && $paged + $range - 1 <= $pages /*&& $showitems < $pages*/ )
				// $output .= '<a href="' . get_pagenum_link( $pages ) . '" class="prev">' . __('Last', 'sptheme_admin') . ' &raquo;</a>';

			$output .= '</nav>';

			return $output;

		}

	}

}

/**
 * ----------------------------------------------------------------------------------------
 * Comment Template
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'sp_comment_template' ) ) {

	function sp_comment_template( $comment, $args, $depth ) {
		global $retina;
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case '' :
		?>

		<li id="comment-<?php comment_ID(); ?>" class="comment clearfix">

			<?php $av_size = isset($retina) && $retina === 'true' ? 96 : 48; ?>
			
			<div class="user"><?php echo get_avatar( $comment, $av_size, $default=''); ?></div>

			<div class="message">
				
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => 3 ) ) ); ?>

				<div class="info">
					<h4><?php echo (get_comment_author_url() != '' ? comment_author_link() : comment_author()); ?></h4>
					<span class="meta"><?php echo comment_date('F jS, Y \a\t g:i A'); ?></span>
				</div>

				<?php comment_text(); ?>
				
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="await"><?php _e( 'Your comment is awaiting moderation.', 'goodwork' ); ?></em>
				<?php endif; ?>

			</div>

		</li>

		<?php
			break;
			case 'pingback'  :
			case 'trackback' :
		?>
		
		<li class="post pingback">
			<p><?php _e( 'Pingback:', 'goodwork' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'goodwork'), ' ' ); ?></p></li>
		<?php
				break;
		endswitch;
	}
	
}

/**
 * ----------------------------------------------------------------------------------------
 * Ajaxify Comments
 * ----------------------------------------------------------------------------------------
 */

add_action('comment_post', 'ajaxify_comments',20, 2);
function ajaxify_comments($comment_ID, $comment_status){
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	//If AJAX Request Then
		switch($comment_status){
			case '0':
				//notify moderator of unapproved comment
				wp_notify_moderator($comment_ID);
			case '1': //Approved comment
				echo "success";
				$commentdata=&get_comment($comment_ID, ARRAY_A);
				$post=&get_post($commentdata['comment_post_ID']); 
				wp_notify_postauthor($comment_ID, $commentdata['comment_type']);
			break;
			default:
				echo "error";
		}
		exit;
	}
}

/**
 * ----------------------------------------------------------------------------------------
 * Get thumbnail post
 * ----------------------------------------------------------------------------------------
 */
if( !function_exists('sp_post_thumbnail') ) {

	function sp_post_thumbnail( $size = 'thumbnail'){
			global $post;
			$thumb = '';

			//get the post thumbnail;
			$thumb_id = get_post_thumbnail_id($post->ID);
			$thumb_url = wp_get_attachment_image_src($thumb_id, $size);
			$thumb = $thumb_url[0];
			if ($thumb) return $thumb;
	}		

}

/**
 * ----------------------------------------------------------------------------------------
 * Get images attached info by attached id
 * ----------------------------------------------------------------------------------------
 */
if ( !function_exists('sp_get_post_attachment') ) {

	function sp_get_post_attachment( $attachment_id ) {

		$attachment = get_post( $attachment_id );
		return array(
			'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
			'caption' => $attachment->post_excerpt,
			'description' => $attachment->post_content,
			'href' => get_permalink( $attachment->ID ),
			'src' => $attachment->guid,
			'title' => $attachment->post_title
		);
	}

}

/**
 * ----------------------------------------------------------------------------------------
 * Switch column number to grid base class
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'sp_column_class' ) ) {
	function sp_column_class( $column = 'none' ){
		switch ( $column ) {
			case 2:
				$out = 'two-fourth';
				break;
			case 3:
				$out = 'one-third';
				break;
			case 4:
				$out = 'one-fourth';
				break;	
			default:
				$out = 'column-none';	
		}

		return $out;
	}
}

/**
 * ----------------------------------------------------------------------------------------
 * Print HTML with meta information for the current post-date/time and author
 * ----------------------------------------------------------------------------------------
 */
if ( !function_exists('sp_meta_posted_on') ) {

	function sp_meta_posted_on() {
		printf( __( '<i class="icon icon-calendar-1"></i><a href="%1$s" title="%2$s"><time class="entry-date" datetime="%3$s"> %4$s</time></a><span class="by-author"> by </span><span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span><span class="posted-in"> in </span><i class="icon icon-tag"> </i> %8$s ', SP_TEXT_DOMAIN ),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', SP_TEXT_DOMAIN ), get_the_author() ) ),
			get_the_author(),
			get_the_category_list( ', ' )
		);
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) )  : ?>
				<span class="with-comments"><?php _e( ' with ', SP_TEXT_DOMAIN ); ?></span>
				<span class="comments-link"><?php comments_popup_link( '<span class="leave-reply">' . __( '0 Comments', SP_TEXT_DOMAIN ) . '</span>', __( '1 Comment', SP_TEXT_DOMAIN ), __( '<i class="icon icon-comment-1"></i> % Comments', SP_TEXT_DOMAIN ) ); ?></span>
		<?php endif; // End if comments_open() ?>
		<?php edit_post_link( __( 'Edit', SP_TEXT_DOMAIN ), '<span class="sep"> | </span><span class="edit-link">', '</span>' );
	}
}

/**
 * ----------------------------------------------------------------------------------------
 * Embeded add video from youtube, vimeo and dailymotion
 * ----------------------------------------------------------------------------------------
 */
function sp_get_video_img($url) {
	
	$video_url = @parse_url($url);
	$output = '';

	if ( $video_url['host'] == 'www.youtube.com' || $video_url['host']  == 'youtube.com' ) {
		parse_str( @parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
		$video_id =  $my_array_of_vars['v'] ;
		$output .= 'http://img.youtube.com/vi/'.$video_id.'/0.jpg';
	}elseif( $video_url['host'] == 'www.youtu.be' || $video_url['host']  == 'youtu.be' ){
		$video_id = substr(@parse_url($url, PHP_URL_PATH), 1);
		$output .= 'http://img.youtube.com/vi/'.$video_id.'/0.jpg';
	}
	elseif( $video_url['host'] == 'www.vimeo.com' || $video_url['host']  == 'vimeo.com' ){
		$video_id = (int) substr(@parse_url($url, PHP_URL_PATH), 1);
		$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$video_id.php"));
		$output .=$hash[0]['thumbnail_large'];
	}
	elseif( $video_url['host'] == 'www.dailymotion.com' || $video_url['host']  == 'dailymotion.com' ){
		$video = substr(@parse_url($url, PHP_URL_PATH), 7);
		$video_id = strtok($video, '_');
		$output .='http://www.dailymotion.com/thumbnail/video/'.$video_id;
	}

	return $output;
	
}

/**
 * ----------------------------------------------------------------------------------------
 * Embeded add video from youtube, vimeo and dailymotion
 * ----------------------------------------------------------------------------------------
 */
function sp_add_video ($url, $width = 620, $height = 349) {

	$video_url = @parse_url($url);
	$output = '';

	if ( $video_url['host'] == 'www.youtube.com' || $video_url['host']  == 'youtube.com' ) {
		parse_str( @parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
		$video =  $my_array_of_vars['v'] ;
		$output .='<iframe width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$video.'?rel=0" frameborder="0" allowfullscreen></iframe>';
	}
	elseif( $video_url['host'] == 'www.youtu.be' || $video_url['host']  == 'youtu.be' ){
		$video = substr(@parse_url($url, PHP_URL_PATH), 1);
		$output .='<iframe width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$video.'?rel=0" frameborder="0" allowfullscreen></iframe>';
	}
	elseif( $video_url['host'] == 'www.vimeo.com' || $video_url['host']  == 'vimeo.com' ){
		$video = (int) substr(@parse_url($url, PHP_URL_PATH), 1);
		$output .='<iframe src="http://player.vimeo.com/video/'.$video.'" width="'.$width.'" height="'.$height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
	}
	elseif( $video_url['host'] == 'www.dailymotion.com' || $video_url['host']  == 'dailymotion.com' ){
		$video = substr(@parse_url($url, PHP_URL_PATH), 7);
		$video_id = strtok($video, '_');
		$output .='<iframe frameborder="0" width="'.$width.'" height="'.$height.'" src="http://www.dailymotion.com/embed/video/'.$video_id.'"></iframe>';
	}

	return $output;
}

/**
 * ----------------------------------------------------------------------------------------
 * Embeded soundcloud
 * ----------------------------------------------------------------------------------------
 */

function sp_soundcloud($url , $autoplay = 'false' ) {
	return '<iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url='.$url.'&amp;auto_play='.$autoplay.'&amp;show_artwork=true"></iframe>';
}

function sp_portfolio_grid( $col = 'list', $posts_per_page = 5 ) {
	
	$temp ='';
	$output = '';
	
	$args = array(
			'posts_per_page' => (int) $posts_per_page,
			'post_type' => 'portfolio',
			);
			
	$post_list = new WP_Query($args);
		
	ob_start();
	if ($post_list && $post_list->have_posts()) {
		
		$output .= '<ul class="portfolio ' . $col . '">';
		
		while ($post_list->have_posts()) : $post_list->the_post();
		
		$output .= '<li>';
		$output .= '<div class="two-fourth"><div class="post-thumbnail">';
		$output .= '<a href="'.get_permalink().'"><img src="' . sp_post_thumbnail('portfolio-2col') . '" /></a>';
		$output .= '</div></div>';
		
		$output .= '<div class="two-fourth last">';
		$output .= '<a href="'.get_permalink().'" class="port-'. $col .'-title">' . get_the_title() .'</a>';
		$output .= '</div>';	
		
		$output .= '</li>';	
		endwhile;
		
		$output .= '</ul>';
		
	}
	$temp = ob_get_clean();
	$output .= $temp;
	
	wp_reset_postdata();
	
	return $output;
	
}

/**
 * ----------------------------------------------------------------------------------------
 * Get Most Racent posts from Category
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'sp_last_posts_cat' ) ) {
	function sp_last_posts_cat( $post_num = 5 , $thumb = true , $category = 1 ) {

		global $post;
		
		$out = '';
		if ( is_singular() ) :
			$args = array( 'cat' => $category, 'posts_per_page' => (int) $post_num, 'post__not_in' => array($post->ID) );	
		else : 
			$args = array( 'cat' => $category, 'posts_per_page' => (int) $post_num, 'post__not_in' => get_option( 'sticky_posts' ) );
		endif;
		

		$custom_query = new WP_Query( $args );

		$out .= '<section class="custom-posts clearfix">';
		if( $custom_query->have_posts() ) :
			while ( $custom_query->have_posts() ) : $custom_query->the_post();

			$out .= '<article>';
			$out .= '<a href="' . get_permalink() . '" class="clearfix">';
			if ( $thumb ) :
				if ( has_post_thumbnail() ) {
					$out .= get_the_post_thumbnail();
				} else {
					$out .= '<img class="wp-image-placeholder" src="' . SP_ASSETS .'/images/placeholder/thumbnail-300x225.gif">';	
				}
			endif;
			$out .= '<h5>' . get_the_title() . '</h5>';
			$out .= '<span class="time">' . get_the_time('j M, Y') . '</span>';
			$out .= '</a>';
			$out .= '</article>';

			endwhile; wp_reset_postdata();
		endif;
		$out .= '<a href="' . esc_url(get_category_link( $category )) . '" class="more">' . __('More news', SP_TEXT_DOMAIN) .'</a>';
		$out .= '</section>';

		return $out;
	}
}


/**
 * ----------------------------------------------------------------------------------------
 * Get term name by term_id
 * ----------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'sp_get_term_name_by_id' ) ) {
	function sp_get_term_name_by_id( $term_id, $taxonomy ){
		$term = get_term_by( 'id', $term_id, $taxonomy );
		return ( $term ) ? $term->name : 'null';
	}
}

/* ---------------------------------------------------------------------- */               							
/*  Get post related by taxonomy
/* ---------------------------------------------------------------------- */
if ( !function_exists('sp_get_related_posts_by_taxonomy') ) {
	function sp_get_related_posts_by_taxonomy( $post_id, $args=array(), $heading = 'Related Post' ) {
		
		$post = get_post($post_id);
		$post_type = $post->post_type;
		$taxonomy = get_object_taxonomies( $post_type );
		$terms = wp_get_post_terms($post_id, $taxonomy[0], array("fields" => "ids"));
		
		$defaults = array(
				'post_type' => $post_type, 
				'post__not_in' => array($post_id),
				'orderby' => 'rand',
				'posts_per_page' => 3,
				'tax_query' => array(
		  			array(
						'taxonomy' => $taxonomy[0],
						'field' => 'term_id',
		  				'terms' => $terms
					))
			);
		$args = wp_parse_args( $args, $defaults );
		extract( $args );
		$custom_query = new WP_Query($args);
		if ( $custom_query->have_posts() ):
			$out = '<section class="related-posts sp-posts">';
			$out .= '<h4 class="heading">' . $heading . '</h4>';
			while ( $custom_query->have_posts() ) : $custom_query->the_post();
				$out .= sp_job_item_html( get_the_ID() );
			endwhile;
			$out .= '</section>';
			wp_reset_postdata();
		else :
			$out = 'There is no related post.';
		endif; 
		return $out;
	}	
}

/**
 * ----------------------------------------------------------------------------------------
 * Get Sticky Job post
 * ----------------------------------------------------------------------------------------
 */
if ( !function_exists('sp_get_post_job') ) {

	function sp_get_post_job( $post_num, $args ) {

		$args = wp_parse_args($args,array(
			'post_type'				=> 'sp_job',
			'posts_per_page'		=> -1,
			'post_status'   		=> 'publish',
			'orderby' 				=> 'meta_value_num',
    		'order' 				=> 'ASC',
		));
		
		$custom_query = new WP_Query($args);

		$out = '';

		if( $custom_query->have_posts() ) :
			
			while ( $custom_query->have_posts() ) : $custom_query->the_post();
			 	$out .= sp_job_item_html( get_the_ID() );
			endwhile; wp_reset_postdata();
		endif;

		return $out;
	}

}

/**
 * ----------------------------------------------------------------------------------------
 * Render HTML Job item
 * ----------------------------------------------------------------------------------------
 *
 * @return 	string
 *
 */

if ( ! function_exists( 'sp_job_item_html' ) ) {
	function sp_job_item_html( $post_id ) {
		
		$out =  '<article id="post-' . $post_id . '" class="job-item">';	
		
		$out .= '<div class="two-third">';
		$out .= '<h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
		$out .= '<div class="entry-meta">';
		$out .= '<div class="two-fourth">';
		$out .= get_the_term_list( $post_id, 'sp_category', '<span class="attr">Category:</span> ', ', ' );
		$out .= '</div>';
		$out .= '<div class="two-fourth last">';
		$out .= get_the_term_list( $post_id, 'sp_industry', '<span class="attr">Industry:</span> ', ', ' );
		$out .= '</div>';
		$out .= '</div> <!-- .entry-meta -->';
		$out .= '</div> <!-- .two-third -->';

		$out .= '<div class="one-third last">';
		$out .= '<div class="job-location two-fourth">';
		$out .= sp_get_term_name_by_id( get_post_meta( $post_id, 'sp_job_location', true ), 'sp_location' );
		$out .= '</div>';
		$out .= '<div class="two-fourth last">';
		$out .= sp_get_job_type( $post_id ); 
		$out .= '<div class="closed-date"><span>Close Date</span>' . date("j M, Y", strtotime(get_post_meta( $post_id, 'sp_job_expire', true ))) . '</div>';
		$out .= '</div>';
		$out .= '</div> <!-- .one-third .last -->';
		
		$out .= '</article>';

		return $out;
	}
}

/**
 * ----------------------------------------------------------------------------------------
 * Render HTML Meta Slideshow in Home template
 * ----------------------------------------------------------------------------------------
 *
 * @return 	string
 *
 */

if ( ! function_exists( 'sp_get_job_type' ) ) {
	function sp_get_job_type( $post_id ) {
		$job_type = sp_get_term_name_by_id( get_post_meta( $post_id, 'sp_job_type', true ), 'sp_job_type' );
		$job_class = str_replace(' ', '-', strtolower($job_type));

		$out = '<div class="job-type ' . $job_class . '">';
		$out .= $job_type;
		$out .= '</div>';

		return $out;
	}
}

/**
 * ----------------------------------------------------------------------------------------
 * Render Partner Post Type 
 * ----------------------------------------------------------------------------------------
 *
 * @return 	string
 *
 */
 
if ( !function_exists('sp_get_partner_post') ) {
	function sp_get_partner_post( $args = array() ) {

		$defaults = array(
				'post_type' => 'sp_partner',
				'posts_per_page' => -1
			);
		$args = wp_parse_args( $args, $defaults );
		extract( $args );

		$custom_query = new WP_Query($args);

		if ( $custom_query->have_posts() ):
			$out = '<div class="partner-post">';
			while ( $custom_query->have_posts() ) : $custom_query->the_post();
				
				$partner_url = get_post_meta( get_the_ID(), 'sp_partner_link', true );
				$thumb_url = sp_post_thumbnail('medium');
		        $image_url = aq_resize( $thumb_url, '132' );
				
				$out .= '<article id="post-' . get_the_ID() . '">';
				if ( $partner_url ) {
					$out .= '<a href="'.$partner_url.'" target="_blank"><img src="' . $image_url . '" /></a>';
				} else {
					$out .= '<img src="' . $image_url . '" />';
				}
				$out .= '</article>';

			endwhile;
			wp_reset_postdata();
			$out .= '</div>';
		endif;

		return $out;
	}	
}

/**
 * ----------------------------------------------------------------------------------------
 * Render HTML Meta Slideshow in Home template
 * ----------------------------------------------------------------------------------------
 *
 * @return 	string
 *
 */

if ( ! function_exists( 'sp_get_meta_slideshow' ) ) {
	function sp_get_meta_slideshow( $meta_slide = array(), $effect = 'fade' ) {
		global $post;

		?>

		<script type="text/javascript">
			jQuery(document).ready(function($){
				$("#home-slider").flexslider({
					animation: "<?php echo $effect; ?>",
					slideshowSpeed: 5000,
					animationDuration: 200,
					animationLoop: true,
					pauseOnAction: true,
					pauseOnHover: true,
					smoothHeight: false,
					controlNav: true
				});
			});		
		</script>
		
		<?php
	    $out = '<div id="home-slider" class="flexslider">';
	    $out .= '<ul class="slides">';
	    foreach ($meta_slide as $image ) :  
	        
	        $images = sp_get_post_attachment( $image );
	        $image_url = aq_resize( $images['src'], '940', '420', true);

	        $out .= '<li>';
	        $out .= '<img src="' . $image_url . '">';
	        $out .= '</li>';
	    endforeach;
	    wp_reset_postdata();

	    $out .= '</ul>';
	    $out .= '</div>';

		return $out;	
	}
}
