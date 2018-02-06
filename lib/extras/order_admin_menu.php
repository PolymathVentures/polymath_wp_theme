<?php

namespace Roots\Sage\Extras;

/**
 * Reorder the menu items in the WP Admin site
 *
 * @param  mixed $menu_order
 * @return null
 */
add_filter('custom_menu_order', __NAMESPACE__ . '\\custom_admin_menu_order');
add_filter('menu_order', __NAMESPACE__ . '\\custom_admin_menu_order');
function custom_admin_menu_order( $menu_order ) {
  if( !$menu_order )
    return true;

  return [
    'index.php',                       // Dashboard
    'separator1',                      // First separator
    'edit.php?post_type=page',         // Pages
    'edit.php',                        // Posts
    'edit.php?post_type=seeds',        // Seeds
    'edit.php?post_type=ventures',     // Ventures
    'edit.php?post_type=team-members', // Team members
    'upload.php',                      // Media
    'separator2',                      // Second separator
    'themes.php',                      // Appearance
    'plugins.php',                     // Plugins
    'users.php',                       // Users
    'tools.php',                       // Tools
    'options-general.php',             // Settings
    'separator-last',                  // Last separator
  ];
}

/**
 * Edit and remove menu items in the WP Admin site
 *
 * @return null
 */
add_action('admin_menu', __NAMESPACE__ . '\\edit_admin_menu');
function edit_admin_menu() {
  remove_menu_page('edit-comments.php');
}
