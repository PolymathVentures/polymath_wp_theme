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
 * @param  string $post_type
 * @return null
 */
add_action('add_meta_boxes', __NAMESPACE__ . '\\post_add_excerpt_meta_box');
function post_add_excerpt_meta_box( $post_type ) {
  if( $post_type=='post' ) {
    add_meta_box(
      'post_postexcerpt',
      __('Excerpt', 'polymathv'),
      'post_excerpt_meta_box',
      $post_type,
      'after_title',
      'high'
    );
  }
}
