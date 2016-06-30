<?php

function responsive_background_image_style($image, $default) {

    $image_set = [];

    $i = 0;

    foreach($image['sizes'] as $key => $val) {

        if(strpos($key, '-')) continue;

        $image_set[] = 'url(' . $val . ') ' . $i . 'x';
        $i++;

    }

    $image_set = implode(', ', $image_set);
    $bg = 'background-image: url(' . $image['sizes'][$default] . '); ';
    $bg .= 'background-image: image-set(' . $image_set . '); ';
    $bg .= 'background-image: -webkit-image-set(' . $image_set . ');';

    return $bg;

}


function format_attachment_sizes_array($id) {

    $meta = wp_get_attachment_metadata($id);
    if(!$meta) { return null; }

    $sizes = get_or_empty($meta, 'sizes', []);

    $formatted = [];

    $folder = explode('/', wp_get_attachment_url($id));
    array_pop($folder);
    $folder = implode('/', $folder);

    $formatted['original'] = content_url() . '/uploads/' . $meta['file'];
    $formatted['original-width'] = $meta['width'];
    $formatted['original-height'] = $meta['height'];

    foreach($sizes as $key => $val) {
        $formatted[$key] = $folder . '/' . $val['file'];
        $formatted[$key . '-width'] = $val['width'];
        $formatted[$key . '-height'] = $val['height'];
    }

    return $formatted;

}
