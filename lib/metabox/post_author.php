<?php

namespace Roots\Sage\Metabox;

/**
 * Add Post author metabox
 *
 * @param  mixed $metaboxes
 * @return null
 */
add_filter('rwmb_meta_boxes', __NAMESPACE__ . '\\post_author_meta_box');
function post_author_meta_box( $metaboxes ) {
  $prefix = 'post_author_';

  $metaboxes[] = [
    'id'         => 'post-author',
    'title'      => esc_html__('Author', 'post_author_meta_box'),
    'post_types' => ['post'],
    'context'    => 'side',
    'priority'   => 'high',
    'autosave'   => false,
    'fields'     => [
      [
        'id'   => $prefix . 'name',
        'type' => 'text',
        'name' => esc_html__('Name', 'post_author_meta_box'),
        'desc' => esc_html__('The author name', 'post_author_meta_box'),
      ],
      [
        'id'   => $prefix . 'profile_url',
        'type' => 'url',
        'name' => esc_html__('Profile URL', 'post_author_meta_box'),
        'desc' => esc_html__('The author profile URL', 'post_author_meta_box'),
      ],
      [
        'id'   => $prefix . 'profile_text',
        'type' => 'text',
        'name' => esc_html__('Profile text', 'post_author_meta_box'),
        'desc' => esc_html__('The text to anchor to the profile URL', 'post_author_meta_box'),
      ],
    ],
    'validation' => [
      'rules' => [
        $prefix . 'name' => [
          'required' => true,
        ],
        $prefix . 'profile_url' => [
          'url' => true,
        ],
      ],
    ],
  ];

  return $metaboxes;
}
