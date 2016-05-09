<?php

if ( ! function_exists('ventures') ) {

// Register Custom Post Type
function ventures() {

	$labels = array(
		'name'                  => 'Ventures',
		'singular_name'         => 'Venture',
		'menu_name'             => 'Ventures',
		'name_admin_bar'        => 'Venture',
	);
	$args = array(
		'label'                 => 'Venture',
		'description'           => 'Polymath ventures',
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
	register_post_type( 'ventures', $args );

}
add_action( 'init', 'ventures', 0 );

}