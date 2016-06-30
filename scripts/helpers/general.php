<?php

function get_or_empty($arr, $key, $empty='') {

    return isset($arr[$key]) ? $arr[$key] : $empty;

}