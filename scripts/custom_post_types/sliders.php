<?php

if ( ! function_exists('sliders') ) {

// Register Custom Post Type
function sliders() {

	$labels = array(
		'name'                  => 'Sliders',
		'singular_name'         => 'Slider',
		'menu_name'             => 'Sliders',
		'name_admin_bar'        => 'Slider',
	);
	$args = array(
		'label'                 => 'Slider',
		'description'           => 'Sliders',
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail'),
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
	register_post_type( 'sliders', $args );

}
add_action( 'init', 'sliders', 0 );

}