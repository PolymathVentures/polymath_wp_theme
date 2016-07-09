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
    $person['title'] = $person['post_title'] . '<br/><span class="small">' . $person['roles'][0]['title'] . ' @ ' . get_the_title($person['roles'][0]['venture']) . '</span>';

    $person['full_description'] = $person['description'] .'<br/><br/>';

    if(isset($person['previous_roles']) && count($person['previous_roles']) > 0) {
        foreach($person['previous_roles'] as $role) {
            $person['full_description'] .= '<span class="text-italic">' . $role['role'] . '</span> @ <a href="' . get_permalink($role['venture']) . '">' . get_the_title($role['venture']) . '</a><br/>';
        };
    }

    return $person;

}