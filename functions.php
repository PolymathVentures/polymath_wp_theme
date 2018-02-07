<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = array_merge(
  glob(__DIR__.'/lib/*.php'),
  glob(__DIR__.'/lib/**/*.php')
);

foreach( $sage_includes as $file ) {
  $file = str_replace(__DIR__.'/', '', $file);
  if( !$filepath = locate_template($file) ) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

/**
 * Remove plugin capabilities
 *
 * @return null
 */
add_action('init', 'remove_plugin_capabilities');
function remove_plugin_capabilities() {
  global $wp_roles;
  $capabilities = [
    'upload_plugins',
    'delete_plugins',
    'edit_plugins',
    'install_plugins',
  ];

  foreach( array_keys($wp_roles->roles) as $role ) {
    $role = get_role($role);
    foreach( $capabilities as $cap )
      $role->remove_cap($cap);
  }
}
