<?php

/*  Initialize the meta boxes.
/* ------------------------------------ */
add_action( 'admin_init', '_custom_meta_boxes' );

function _custom_meta_boxes() {

	$prefix = 'sp_';
  
/*  Custom meta boxes
/* ------------------------------------ */
$page_layout_options = array(
	'id'          => 'page-options',
	'title'       => 'Page Options',
	'desc'        => '',
	'pages'       => array( 'page', 'post' ),
	'context'     => 'normal',
	'priority'    => 'default',
	'fields'      => array(
		array(
			'label'		=> 'Primary Sidebar',
			'id'		=> $prefix . 'sidebar_primary',
			'type'		=> 'sidebar-select',
			'desc'		=> 'Overrides default'
		),
		array(
			'label'		=> 'Layout',
			'id'		=> $prefix . 'layout',
			'type'		=> 'radio-image',
			'desc'		=> 'Overrides the default layout option',
			'std'		=> 'inherit',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> 'Inherit Layout',
					'src'		=> SP_ASSETS . '/images/admin/layout-off.png'
				),
				array(
					'value'		=> 'col-1c',
					'label'		=> '1 Column',
					'src'		=> SP_ASSETS . '/images/admin/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> '2 Column Left',
					'src'		=> SP_ASSETS . '/images/admin/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> '2 Column Right',
					'src'		=> SP_ASSETS . '/images/admin/col-2cr.png'
				)
			)
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Post Format: video
/* ---------------------------------------------------------------------- */
$post_format_video = array(
	'id'          => 'format-video',
	'title'       => 'Format: Video',
	'desc'        => 'These settings enable you to embed videos into your posts.',
	'pages'       => array( 'post' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> 'Video URL',
			'id'		=> $prefix . 'video_url',
			'type'		=> 'text',
			'desc'		=> 'Enter Video Embed URL from youtube, vimeo or dailymotion'
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Post Format: Audio
/* ---------------------------------------------------------------------- */
$post_format_audio = array(
	'id'          => 'format-audio',
	'title'       => 'Format: Audio',
	'desc'        => 'These settings enable you to embed audio into your posts. You must provide both .mp3 and .ogg/.oga file formats in order for self hosted audio to function accross all browsers.',
	'pages'       => array( 'post' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> 'Audio URL',
			'id'		=> $prefix . 'audio_url',
			'type'		=> 'upload',
			'desc'		=> 'You can get sound or audio URL from soundcloud'
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Post Format: Gallery
/* ---------------------------------------------------------------------- */
$post_format_gallery = array(
	'id'          => 'format-gallery',
	'title'       => 'Format: Gallery',
	'desc'        => 'Standard post galleries.</i>',
	'pages'       => array( 'post' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> 'Upload photo',
			'id'		=> $prefix . 'post_gallery',
			'type'		=> 'gallery',
			'desc'		=> 'Upload photos'
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Post Format: Chat
/* ---------------------------------------------------------------------- */
$post_format_chat = array(
	'id'          => 'format-chat',
	'title'       => 'Format: Chat',
	'desc'        => 'Input chat dialogue.',
	'pages'       => array( 'post' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> 'Chat Text',
			'id'		=> $prefix . 'chat',
			'type'		=> 'textarea',
			'rows'		=> '2'
		)
	)
);
/* ---------------------------------------------------------------------- */
/*	Post Format: Link
/* ---------------------------------------------------------------------- */
$post_format_link = array(
	'id'          => 'format-link',
	'title'       => 'Format: Link',
	'desc'        => 'Input your link.',
	'pages'       => array( 'post' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> 'Link Title',
			'id'		=> $prefix . 'link_title',
			'type'		=> 'text'
		),
		array(
			'label'		=> 'Link URL',
			'id'		=> $prefix . 'link_url',
			'type'		=> 'text'
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Post Format: quote
/* ---------------------------------------------------------------------- */
$post_format_quote = array(
	'id'          => 'format-quote',
	'title'       => 'Format: Quote',
	'desc'        => 'Input your quote.',
	'pages'       => array( 'post' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> 'Quote',
			'id'		=> $prefix . 'quote',
			'type'		=> 'textarea',
			'rows'		=> '2'
		),
		array(
			'label'		=> 'Quote Author',
			'id'		=> $prefix . 'quote_author',
			'type'		=> 'text'
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Post Type Job
/* ---------------------------------------------------------------------- */
$post_type_job = array(
	'id'          => 'job-settings',
	'title'       => 'Job Settings',
	'desc'        => '',
	'pages'       => array( 'sp_job' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> 'Company/Orgainzation',
			'id'		=> $prefix . 'company',
			'type'		=> 'custom-post-type-select',
			'post_type'	=> 'sp_listing',
			'desc'		=> '<a href="'. get_admin_url() .'edit.php?post_type=sp_listing">Manage Listing</a>'
		),
		array(
			'label'		=> 'Type',
			'id'		=> $prefix . 'job_type',
			'type'		=> 'taxonomy-select',
			'taxonomy'	=> 'sp_job_type'
		),
		array(
			'label'		=> 'Location',
			'id'		=> $prefix . 'job_location',
			'type'		=> 'taxonomy-select',
			'taxonomy'	=> 'sp_location'
		),
		array(
			'label'		=> 'Expire Date',
			'id'		=> $prefix . 'job_expire',
			'type'		=> 'date-picker'
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Listing Post Type
/* ---------------------------------------------------------------------- */
$post_type_listing = array(
	'id'          => 'listing-settings',
	'title'       => 'Communication Info',
	'desc'        => '',
	'pages'       => array( 'sp_listing' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> 'Address',
			'id'		=> $prefix . 'lt_address',
			'type'		=> 'textarea',
			'rows'		=> '2',
			'desc'		=> 'Ex: No. 31, Oknha Chun (St. 240), near Royal Palace, Phnom Penh'
		),
		array(
			'label'		=> 'Email',
			'id'		=> $prefix . 'lt_mail',
			'type'		=> 'text'
		),
		array(
			'label'		=> 'Tel',
			'id'		=> $prefix . 'lt_tel',
			'type'		=> 'text',
			'desc'		=> 'Ex: 023 830 139 / 023 830 139 / 023 240 638'
		),
		array(
			'label'		=> 'Phone',
			'id'		=> $prefix . 'lt_phone',
			'type'		=> 'text',
			'desc'		=> 'Ex: 012 830 139 / 012 830 139 / 089 240 638'
		)
	)
);




/*  Register meta boxes
/* ------------------------------------ */
	ot_register_meta_box( $page_layout_options );
	ot_register_meta_box( $post_format_audio );
	ot_register_meta_box( $post_format_chat );
	ot_register_meta_box( $post_format_gallery );
	ot_register_meta_box( $post_format_link );
	ot_register_meta_box( $post_format_quote );
	ot_register_meta_box( $post_format_video );
	ot_register_meta_box( $post_type_listing );
	ot_register_meta_box( $post_type_job );
}