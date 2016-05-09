<?php

if ( ! function_exists('team_members') ) {

	// Register Custom Post Type
	function team_members() {

		$labels = array(
			'name'                  => 'Team Members',
			'singular_name'         => 'Team Member',
			'menu_name'             => 'Team Members',
			'name_admin_bar'        => 'Team Member',
		);
		$args = array(
			'label'                 => 'Team Member',
			'description'           => 'Polymath team members',
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
		register_post_type( 'team_members', $args );

	}
	add_action( 'init', 'team_members', 0 );

}