<?php

if ( ! function_exists('personal_stories') ) {

// Register Custom Post Type
function personal_stories() {

	$labels = array(
		'name'                  => 'Personal Stories',
		'singular_name'         => 'Personal Story',
		'menu_name'             => 'Personal Stories',
		'name_admin_bar'        => 'Personal Story',
	);
	$args = array(
		'label'                 => 'Personal Story',
		'description'           => 'Personal Stories',
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail', ),
		'taxonomies'            => array(),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'				=> true,
		'menu_position'         => 5,
		'capability_type'       => 'post',
	);
	register_post_type( 'personal_stories', $args );

}
add_action( 'init', 'personal_stories', 0 );

}