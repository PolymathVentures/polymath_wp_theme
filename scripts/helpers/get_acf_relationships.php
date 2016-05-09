<?php

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
