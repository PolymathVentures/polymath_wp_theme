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
	register_post_type( 'promos', $args );

}
add_action( 'init', 'promos', 0 );

}