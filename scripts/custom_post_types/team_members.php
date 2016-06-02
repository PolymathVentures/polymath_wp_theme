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
			'taxonomies'            => array( 'post_tag' ),
			'hierarchical'          => false,
			'public'                => false,
			'show_ui'				=> true,
			'menu_position'         => 5,
			'capability_type'       => 'post',
		);
		register_post_type( 'team_members', $args );

	}
	add_action( 'init', 'team_members', 0 );

}