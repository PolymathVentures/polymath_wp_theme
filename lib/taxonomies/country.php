<?php

namespace Roots\Sage\Taxonomies;

/**
 * Register 'Country' taxonomy
 *
 * @return null
 */
add_action('init', __NAMESPACE__ . '\\register_country_taxonomy', 0);
function register_country_taxonomy() {
  $labels = [
    'name'                       => 'Countries',
    'singular_name'              => 'Country',
    'menu_name'                  => 'Countries',
    'all_items'                  => 'All Countries',
    'new_item_name'              => 'New Country Name',
    'add_new_item'               => 'Add New Country',
    'edit_item'                  => 'Edit Country',
    'update_item'                => 'Update Country',
    'view_item'                  => 'View Country',
    'separate_items_with_commas' => 'Separate countries with commas',
    'add_or_remove_items'        => 'Add or remove countries',
    'choose_from_most_used'      => 'Choose from the most used',
    'popular_items'              => 'Popular Countries',
    'search_items'               => 'Search Countries',
    'not_found'                  => 'Country Not Found',
    'no_terms'                   => 'No countries',
    'items_list'                 => 'Countries list',
    'items_list_navigation'      => 'Countries list navigation',
  ];
  $rewrite = [
    'slug'                       => 'country',
    'with_front'                 => true,
    'hierarchical'               => false,
  ];
  $capabilities = [
    'manage_terms'               => 'manage_countries',
    'edit_terms'                 => 'manage_countries',
    'delete_terms'               => 'manage_countries',
    'assign_terms'               => 'edit_posts',
  ];
  $args = [
    'labels'                     => $labels,
    'hierarchical'               => false,
    'public'                     => false,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => false,
    'query_var'                  => 'country',
    'rewrite'                    => $rewrite,
    'capabilities'               => $capabilities,
  ];
  register_taxonomy('country', ['seeds', 'ventures', 'team-members'], $args);
}

/**
 * Add capabilities to Administrators
 *
 * @return null
 */
add_action('admin_init', __NAMESPACE__ . '\\add_country_capabilities');
function add_country_capabilities() {
  $role = get_role('administrator');
  $role->add_cap('manage_countries');
}
