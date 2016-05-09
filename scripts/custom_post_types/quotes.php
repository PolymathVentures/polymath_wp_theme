<?php

if ( ! function_exists('quotes') ) {

// Register Custom Post Type
function quotes() {

	$labels = array(
		'name'                  => 'Quotes',
		'singular_name'         => 'Quote',
		'menu_name'             => 'Quotes',
		'name_admin_bar'        => 'Quote',
	);
	$args = array(
		'label'                 => 'Quote',
		'description'           => 'Quotes',
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
	register_post_type( 'quotes', $args );

}
add_action( 'init', 'quotes', 0 );

}