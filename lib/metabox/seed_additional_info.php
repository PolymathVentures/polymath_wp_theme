<?php

namespace Roots\Sage\Metabox;

/**
 * Add Seed additional info metabox
 *
 * @param  mixed $metaboxes
 * @return null
 */
add_filter('rwmb_meta_boxes', __NAMESPACE__ . '\\seed_additional_info_meta_box');
function seed_additional_info_meta_box( $metaboxes ) {
  $prefix = 'seed_additional_info_';

  $metaboxes[] = [
    'id'         => 'seed-additional-info',
    'title'      => esc_html__('Additional info', 'seed_additional_info_meta_box'),
    'post_types' => ['seeds'],
    'context'    => 'side',
    'priority'   => 'default',
    'autosave'   => false,
    'fields'     => [
      [
        'id'         => $prefix . 'year',
        'type'       => 'number',
        'min'        => 2000,
        'max'        => 2100,
        'name'       => esc_html__('Year', 'seed_additional_info_meta_box'),
      ],
    ],
    'validation' => [
      'rules' => [
        $prefix . 'year' => [
          'required' => true,
          'min'      => 2000,
          'max'      => 2100,
        ],
      ],
    ],
  ];

  return $metaboxes;
}
