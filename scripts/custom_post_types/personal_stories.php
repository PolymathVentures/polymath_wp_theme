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
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'personal_stories', $args );

}
add_action( 'init', 'personal_stories', 0 );

}