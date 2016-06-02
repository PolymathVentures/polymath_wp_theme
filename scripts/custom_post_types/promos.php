<?php

if ( ! function_exists('promos') ) {

// Register Custom Post Type
function promos() {

	$labels = array(
		'name'                  => 'Promos',
		'singular_name'         => 'Promo',
		'menu_name'             => 'Promos',
		'name_admin_bar'        => 'Promo',
	);
	$args = array(
		'label'                 => 'Promo',
		'description'           => 'Promos',
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail', ),
		'taxonomies'            => array(),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'				=> true,
		'menu_position'         => 5,
		'capability_type'       => 'post',
	);
	register_post_type( 'promos', $args );

}
add_action( 'init', 'promos', 0 );

}