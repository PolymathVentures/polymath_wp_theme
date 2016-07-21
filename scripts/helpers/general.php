<?php

function get_or_empty($arr, $key, $empty='') {

    return isset($arr[$key]) ? $arr[$key] : $empty;

}

function css_gradient($color_1, $color_2) {

    $css = <<<EOD
        background: $color_1;
        background: -moz-linear-gradient(left,  $color_1 50%, $color_2 50%);
        background: -webkit-linear-gradient(left,  $color_1 50%,$color_2 50%);
        background: linear-gradient(to right,  $color_1 50%,$color_2 50%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='$color_1', endColorstr='$color_2',GradientType=1 );
EOD;

    return $css;

}


function get_ventures_from_roles($roles) {

    if(!$roles) return [];

    $ventures = array();
    foreach($roles as $role) {
        $venture = $role['venture'];
        if(in_array($venture, $ventures) || !$role['current']) continue;
        $ventures[] = $venture;
    }

    return $ventures;

}


function formatPersonInfo($person) {

    $person = get_post_with_custom_fields($person);
    $person['image'] = array('sizes' => format_attachment_sizes_array(get_post_thumbnail_id($person['ID'])));
    $person['icon'] = false;
    $person['title'] = $person['post_title'];

    if(isset($person['roles'][0])):
        $person['current_job_title'] = $person['roles'][0]['title'];
        $person['current_venture'] = get_the_title($person['roles'][0]['venture']);
        $person['title'] .= '<br/><span class="small">' . $person['current_job_title'] . ' @ ' .                                $person['current_venture'] . '</span>';
    endif;

    $person['full_description'] = $person['description'] .'<br/><br/>';

    $person['full_description'] .= '<a href="' . $person['linkedin'] . '" target="_blank">LinkedIn</a><br/><br/>';

    if(isset($person['roles']) && count($person['roles']) > 0) {
        for($i = 1; $i < count($person['roles']); $i++) {
            $venture = $person['roles'][$i]['venture'];
            if(get_post_status($venture) == 'publish') {
                $person['full_description'] .= '<span class="text-italic">' . $person['roles'][$i]['title'] . '</span> @ <a href="' . get_permalink($venture) . '" data-dismiss="modal">' . get_the_title($venture) . '</a><br/>';
            } else {
                $person['full_description'] .= '<span class="text-italic">' . $person['roles'][$i]['title'] . ' @ ' . get_the_title($venture) . '</a><br/>';
            }


        };
    }

    return $person;

}