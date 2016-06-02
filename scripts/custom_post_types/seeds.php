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
		'menu_position'         => 5,
		'capability_type'       => 'post',
	);
	register_post_type( 'seeds', $args );

}
add_action( 'init', 'seeds', 0 );

}