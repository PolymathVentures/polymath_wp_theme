<?php

if ( ! function_exists('ventures') ) {

// Register Custom Post Type
function ventures() {

	$labels = array(
		'name'                  => 'Ventures',
		'singular_name'         => 'Venture',
		'menu_name'             => 'Ventures',
		'name_admin_bar'        => 'Venture',
		'archives'              => '',
		'parent_item_colon'     => '',
		'all_items'             => 'All Ventures',
		'add_new_item'          => 'Add New Venture',
		'add_new'               => 'Add New Venture',
		'new_item'              => 'New Venture',
		'edit_item'             => 'Edit Venture',
		'update_item'           => 'Update Venture',
		'view_item'             => 'View Venture',
		'search_items'          => 'Search Venture',
		'not_found'             => 'Not found',
		'not_found_in_trash'    => 'Not found in Trash',
		'featured_image'        => 'Logo',
		'set_featured_image'    => 'Set logo',
		'remove_featured_image' => 'Remove logo',
		'use_featured_image'    => 'Use as logo',
		'insert_into_item'      => 'Insert into item',
		'uploaded_to_this_item' => 'Uploaded to this item',
		'items_list'            => 'Venture list',
		'items_list_navigation' => 'Venture navigation',
		'filter_items_list'     => 'Filter items list',
	);
	$args = array(
		'label'                 => 'Venture',
		'description'           => 'Polymath ventures',
		'labels'                => $labels,
		'supports'              => array( 'title', ),
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

// Register custom fields on custom post type (Needs plugin Advanced custom fields)
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_57294ff5eaca2',
	'title' => 'Venture fields',
	'fields' => array (
		array (
			'key' => 'field_5729500d1176d',
			'label' => 'Milestones',
			'name' => 'milestones',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => 'field_572950911176f',
			'min' => '',
			'max' => '',
			'layout' => 'block',
			'button_label' => 'Add milestone',
			'sub_fields' => array (
				array (
					'key' => 'field_572950321176e',
					'label' => 'date',
					'name' => 'date',
					'type' => 'date_picker',
					'instructions' => 'Date of the milestone (estimate)',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'display_format' => 'Y-m-d',
					'return_format' => 'd/m/Y',
					'first_day' => 1,
				),
				array (
					'key' => 'field_572950911176f',
					'label' => 'Title',
					'name' => 'title',
					'type' => 'text',
					'instructions' => 'Title of the milestone',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => 50,
					'readonly' => 0,
					'disabled' => 0,
				),
				array (
					'key' => 'field_572950be11770',
					'label' => 'Description',
					'name' => 'description',
					'type' => 'textarea',
					'instructions' => 'Description of the milestone',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'maxlength' => 300,
					'rows' => '',
					'new_lines' => '',
					'readonly' => 0,
					'disabled' => 0,
				),
			),
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'ventures',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'seamless',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
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
		10 => 'page_attributes',
		11 => 'featured_image',
		12 => 'categories',
		13 => 'tags',
		14 => 'send-trackbacks',
	),
	'active' => 1,
	'description' => '',
));

endif;

// Custom tag system for team members
