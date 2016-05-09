<?php

if ( ! function_exists('seeds') ) {

// Register Custom Post Type
function seeds() {

	$labels = array(
		'name'                  => 'Seeds',
		'singular_name'         => 'Seed',
		'menu_name'             => 'Seeds',
		'name_admin_bar'        => 'Seed',
	);
	$args = array(
		'label'                 => 'Seed',
		'description'           => 'Seeds',
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
	register_post_type( 'seeds', $args );

}
add_action( 'init', 'seeds', 0 );

}