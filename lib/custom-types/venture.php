<?php

namespace Roots\Sage\CustomTypes;

/**
 * Register 'Venture' custom type
 *
 * @return null
 */
add_action('init', __NAMESPACE__ . '\\register_venture_post_type', 0);
function register_venture_post_type() {
  $labels = [
    'name'                  => 'Ventures',
    'singular_name'         => 'Venture',
    'menu_name'             => 'Ventures',
    'name_admin_bar'        => 'Ventures',
    'archives'              => 'Venture Archives',
    'attributes'            => 'Venture Attributes',
    'all_items'             => 'All Ventures',
    'add_new_item'          => 'Add New Venture',
    'add_new'               => 'Add Venture',
    'new_item'              => 'New Venture',
    'edit_item'             => 'Edit Venture',
    'update_item'           => 'Update Venture',
    'view_item'             => 'View Venture',
    'view_items'            => 'View Venture',
    'search_items'          => 'Search Venture',
    'not_found'             => 'Venture not found',
    'not_found_in_trash'    => 'Venture not found in Trash',
    'featured_image'        => 'Featured Image',
    'set_featured_image'    => 'Set featured image',
    'remove_featured_image' => 'Remove featured image',
    'use_featured_image'    => 'Use as featured image',
    'insert_into_item'      => 'Insert into venture',
    'uploaded_to_this_item' => 'Uploaded to this venture',
    'items_list'            => 'Ventures list',
    'items_list_navigation' => 'Ventures list navigation',
    'filter_items_list'     => 'Filter ventures list',
  ];
  $args = [
    'label'                 => 'Venture',
    'labels'                => $labels,
    'supports'              => ['title', 'thumbnail'],
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'menu_icon'             => 'dashicons-chart-bar',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'post',
  ];
  register_post_type('ventures', $args);
}
