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