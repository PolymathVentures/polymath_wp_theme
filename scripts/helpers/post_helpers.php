<?php

function get_thumbnail_url($id, $size = 'large') {
    $thumb_id = get_post_thumbnail_id($id);
    $thumb_url_array = wp_get_attachment_image_src($thumb_id, $size, true);
    return $thumb_url_array[0];
}

function get_post_with_custom_fields($post_object) {

    $fields = [];

    if ($post_object) {
        $result = (array)$post_object;
        $fields = get_fields($post_object->ID);

        if ($fields) {
            $result = array_merge($result, $fields);
        }

        return $result;
    }
}

function get_offset_post($post_id, $query, $offset) {

    $posts = array();
    $i = 0;

    foreach($query->posts as $p) {

        if($p->ID == $post_id) {
            $post_index = $i;
        }

        $posts[$i] = $p;
        $i++;
    }

    return $posts[$post_index + $offset];

}
