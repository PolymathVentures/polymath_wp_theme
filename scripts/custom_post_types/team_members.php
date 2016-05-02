<?php

if ( ! function_exists('team_members') ) {

// Register Custom Post Type
function team_members() {

	$labels = array(
		'name'                  => 'Team Members',
		'singular_name'         => 'Team Member',
		'menu_name'             => 'Team Members',
		'name_admin_bar'        => 'Team Member',
		'archives'              => '',
		'parent_item_colon'     => '',
		'all_items'             => 'All Team Members',
		'add_new_item'          => 'Add New Team Member',
		'add_new'               => 'Add New Team Member',
		'new_item'              => 'New Team Member',
		'edit_item'             => 'Edit Team Member',
		'update_item'           => 'Update Team Member',
		'view_item'             => 'View Team Member',
		'search_items'          => 'Search Team Member',
		'not_found'             => 'Not found',
		'not_found_in_trash'    => 'Not found in Trash',
		'featured_image'        => 'Picture',
		'set_featured_image'    => 'Set picture',
		'remove_featured_image' => 'Remove picture',
		'use_featured_image'    => 'Use as picture',
		'insert_into_item'      => 'Insert into item',
		'uploaded_to_this_item' => 'Uploaded to this item',
		'items_list'            => 'Team Member list',
		'items_list_navigation' => 'Team Member navigation',
		'filter_items_list'     => 'Filter items list',
	);
	$args = array(
		'label'                 => 'Team Member',
		'description'           => 'Polymath team members',
		'labels'                => $labels,
		'supports'              => array( 'title', ),
		'taxonomies'            => array( 'post_tag' ),
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

// Register custom fields on custom post type (Needs plugin Advanced custom fields)
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_team-member-info',
		'title' => 'Team member info',
		'fields' => array (
			array (
				'key' => 'field_57192e7c22ed1',
				'label' => 'Experience',
				'name' => 'experience',
				'type' => 'textarea',
				'instructions' => 'Please provide a short description of work history for this person. Max length 300 characters.',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => 300,
				'rows' => '',
				'formatting' => 'br',
			),
			array (
				'key' => 'field_57192d87b224e',
				'label' => 'Email',
				'name' => 'email',
				'type' => 'email',
				'instructions' => 'Please provide a correct email address of this person.',
				'default_value' => '',
				'placeholder' => 'Email',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_57192f1322ed3',
				'label' => 'Linkedin url',
				'name' => 'linkedin_url',
				'type' => 'text',
				'instructions' => 'Please provide public url of linkedin profile.',
				'required' => 1,
				'default_value' => '',
				'placeholder' => 'https://co.linkedin.com/in/ralph-van-krimpen-4075632a',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'team_members',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'permalink',
				1 => 'the_content',
				2 => 'excerpt',
				3 => 'custom_fields',
				4 => 'discussion',
				5 => 'comments',
				6 => 'revisions',
				7 => 'slug',
				8 => 'author',
				9 => 'format',
				10 => 'categories',
				11 => 'send-trackbacks',
				12 => 'tags'
			),
		),
		'menu_order' => 0,
	));
}

// Custom tag system for team members
if ( ! function_exists( 'team_tags' ) ) {

// Register Custom Taxonomy
function team_tags() {

	$labels = array(
		'name'                       => _x( 'Team Tags', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Team Tag', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Team Tags', 'text_domain' ),
		'all_items'                  => __( 'All Items', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Item Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Item', 'text_domain' ),
		'edit_item'                  => __( 'Edit Item', 'text_domain' ),
		'update_item'                => __( 'Update Item', 'text_domain' ),
		'view_item'                  => __( 'View Item', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'team_tag', array( 'team_members' ), $args );

}
add_action( 'init', 'team_tags', 0 );

}