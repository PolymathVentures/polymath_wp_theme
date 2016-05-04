<?php

function cats_get_jobs() {
    // 100 is the maximum number of jobs per page
    $url = 'https://api.catsone.com/v3/jobs?per_page=100';

    $args = array(
        'timeout'     => 15,
        'headers'     => array(
            'authorization' => 'Token 28421c7b223d709c69cc2c5353c827f9'
        )
    );

    $response = wp_remote_get($url, $args);

    if (!isset($response['body'])) return array();

    $jobs = json_decode($response['body'], true);
    $jobs = $jobs['_embedded']['jobs'];

    $job_array = [];
    $sort_array = [];
    foreach ($jobs as $job) {
        if (is_published_on_website($job)) {
            $job_array[$job['id']] = $job;
            $sort_array[] = find_custom_field($job, '164169');
        }
    };

    array_multisort($sort_array, $job_array);
    return $job_array;

};

function is_published_on_website($job) {
    if (!isset($job['_embedded']['custom_fields'])) return false;

    return find_custom_field($job, '173304') == '373878';
};

function find_custom_field($job, $custom_field_id) {
    foreach ($job['_embedded']['custom_fields'] as $item) {
        if($item['id'] == $custom_field_id) {
            return $item['value'];
        }
    }
}
