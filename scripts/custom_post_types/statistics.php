<?php

if ( ! function_exists('statistics') ) {

// Register Custom Post Type
function statistics() {

	$labels = array(
		'name'                  => 'Statistics',
		'singular_name'         => 'Statistic',
		'menu_name'             => 'Statistics',
		'name_admin_bar'        => 'Statistic',
	);
	$args = array(
		'label'                 => 'Statistic',
		'description'           => 'Statistics',
		'labels'                => $labels,
		'supports'              => array( 'title', ),
		'taxonomies'            => array(),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'capability_type'       => 'post',
	);
	register_post_type( 'statistics', $args );

}
add_action( 'init', 'statistics', 0 );

}