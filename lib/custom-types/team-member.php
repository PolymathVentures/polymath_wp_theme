<?php

namespace Roots\Sage\CustomTypes;

/**
 * Register 'Team member' custom type
 *
 * @return null
 */
add_action('init', __NAMESPACE__ . '\\register_team_member_post_type', 0);
function register_team_member_post_type() {
  $labels = [
    'name'                  => 'Team members',
    'singular_name'         => 'Team member',
    'menu_name'             => 'Team members',
    'name_admin_bar'        => 'Team members',
    'archives'              => 'Team member Archives',
    'attributes'            => 'Team member Attributes',
    'all_items'             => 'All Team members',
    'add_new_item'          => 'Add New Team member',
    'add_new'               => 'Add Team member',
    'new_item'              => 'New Team member',
    'edit_item'             => 'Edit Team member',
    'update_item'           => 'Update Team member',
    'view_item'             => 'View Team member',
    'view_items'            => 'View Team member',
    'search_items'          => 'Search Team member',
    'not_found'             => 'Team member not found',
    'not_found_in_trash'    => 'Team member not found in Trash',
    'featured_image'        => 'Featured Image',
    'set_featured_image'    => 'Set featured image',
    'remove_featured_image' => 'Remove featured image',
    'use_featured_image'    => 'Use as featured image',
    'insert_into_item'      => 'Insert into team member',
    'uploaded_to_this_item' => 'Uploaded to this team member',
    'items_list'            => 'Team members list',
    'items_list_navigation' => 'Team members list navigation',
    'filter_items_list'     => 'Filter team members list',
  ];
  $args = [
    'label'                 => 'Team member',
    'labels'                => $labels,
    'supports'              => ['title', 'thumbnail'],
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'menu_icon'             => 'dashicons-groups',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'post',
  ];
  register_post_type('team-members', $args);
}
