<?php

namespace Roots\Sage\Extras;

/**
 * Removes the regular excerpt box.
 *
 * @return null
 */
function post_remove_normal_excerpt() {
  remove_meta_box( 'postexcerpt' , 'post' , 'normal' );
}
add_action('admin_menu', __NAMESPACE__ . '\\post_remove_normal_excerpt');

/**
 * Add the excerpt meta box back in with a custom screen location.
 *
 * @return null
 */
function post_add_excerpt_meta_box( $post_type ) {
  if( $post_type=='post' ) {
    add_meta_box(
      'post_postexcerpt',
      __( 'Excerpt', 'polymathv-theme' ),
      'post_excerpt_meta_box',
      $post_type,
      'after_title',
      'high'
    );
  }
}
add_action('add_meta_boxes', __NAMESPACE__ . '\\post_add_excerpt_meta_box');

/**
 * Register a custom screen location for the meta box.
 *
 * @return null
 */
function post_run_after_title_meta_boxes() {
  global $post, $wp_meta_boxes;
  # Output the `below_title` meta boxes:
  do_meta_boxes( get_current_screen(), 'after_title', $post );
}
add_action('edit_form_after_title', __NAMESPACE__ . '\\post_run_after_title_meta_boxes');
