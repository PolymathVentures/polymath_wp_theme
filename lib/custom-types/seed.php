<?php

namespace Roots\Sage\CustomTypes;

/**
 * Register 'Seed' custom type
 *
 * @return null
 */
add_action('init', __NAMESPACE__ . '\\register_seed_post_type', 0);
function register_seed_post_type() {
  $labels = [
    'name'                  => 'Seeds',
    'singular_name'         => 'Seed',
    'menu_name'             => 'Seeds',
    'name_admin_bar'        => 'Seeds',
    'archives'              => 'Seed Archives',
    'attributes'            => 'Seed Attributes',
    'all_items'             => 'All Seeds',
    'add_new_item'          => 'Add New Seed',
    'add_new'               => 'Add Seed',
    'new_item'              => 'New Seed',
    'edit_item'             => 'Edit Seed',
    'update_item'           => 'Update Seed',
    'view_item'             => 'View Seed',
    'view_items'            => 'View Seed',
    'search_items'          => 'Search Seed',
    'not_found'             => 'Seed not found',
    'not_found_in_trash'    => 'Seed not found in Trash',
    'featured_image'        => 'Featured Image',
    'set_featured_image'    => 'Set featured image',
    'remove_featured_image' => 'Remove featured image',
    'use_featured_image'    => 'Use as featured image',
    'insert_into_item'      => 'Insert into seed',
    'uploaded_to_this_item' => 'Uploaded to this seed',
    'items_list'            => 'Seeds list',
    'items_list_navigation' => 'Seeds list navigation',
    'filter_items_list'     => 'Filter seeds list',
  ];
  $args = [
    'label'                 => 'Seed',
    'labels'                => $labels,
    'supports'              => ['title', 'editor', 'thumbnail'],
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'menu_icon'             => 'dashicons-format-status',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'post',
  ];
  register_post_type('seeds', $args);
}
