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
			'menu_position'         => 5,
			'capability_type'       => 'post',
		);
		register_post_type( 'ventures', $args );

	}
add_action( 'init', 'ventures', 0 );

}