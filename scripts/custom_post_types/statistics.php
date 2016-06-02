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
		'supports'              => array( 'title', 'thumbnail', ),
		'taxonomies'            => array(),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'				=> true,
		'menu_position'         => 5,
		'capability_type'       => 'post',
	);
	register_post_type( 'statistics', $args );

}
add_action( 'init', 'statistics', 0 );

}