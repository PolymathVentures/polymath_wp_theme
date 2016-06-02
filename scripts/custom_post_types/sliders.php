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
		'supports'              => array( 'title', ),
		'taxonomies'            => array(),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'				=> true,
		'menu_position'         => 5,
		'capability_type'       => 'post',
	);
	register_post_type( 'sliders', $args );

}
add_action( 'init', 'sliders', 0 );

}