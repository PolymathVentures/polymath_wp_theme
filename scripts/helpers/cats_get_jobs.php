<?php

/**
 * Massages the cats job into the right format for templates to use
 * Returns the ['_embedded']['jobs'] part from the wp_remote_get request
 */
function cats_jobs() {
    $result = get_cats_jobs();
    $jobs = json_decode($result, true);
    $jobs = $jobs['_embedded']['jobs'];

    $job_array = [];
    $sort_array = [];
    foreach ($jobs as $job) {
        if (is_published_on_website($job)) {

            $job['description'] = strip_tags($job['description'],
                                    '<p><ul><ol><li><br><br/><h1><h2><h3><h4><h5><a><b><strong>');

            $job['description'] = preg_replace('/style=".*?"/i', '', $job['description']);

            $job_array[] = $job;
            $sort_array[] = find_custom_field($job, '164169');
        }
    }

    array_multisort($sort_array, $job_array);
    return $job_array;
};


/**
 * Gets a job from a Cats job list
 */
function get_job($jobs, $id) {
    foreach ($jobs as $job) {
        if ($job['id'] == $id) {
            return $job;
        }
    }
}


/**
 * Gets jobs from Cats API or as a transient, and stores it as a transient.
 * Returns the ['body'] from the wp_remote_get request
 */
function get_cats_jobs() {

    $result = get_transient('cats_jobs');

    if ( false === $result || (is_user_logged_in() && isset($_GET["refresh"]))) {
        error_log('getting jobs from cats');


        // Also clear the WP Super Cache for this page on refresh. Important to specify 'refresh=true' in the
        // list of non cached urls in the 'Advanced' tab of WP Super Cache plugin.
        if (function_exists ('wp_cache_post_change')) {
            wp_cache_post_change(get_the_ID());
        };

        // TODO: 100 is the maximum number of jobs per page. This should loop through all pages
        $url = 'https://api.catsone.com/v3/jobs?per_page=100';

        $args = array(
            'timeout'     => 15,
            'headers'     => array(
                'authorization' => 'Token 28421c7b223d709c69cc2c5353c827f9'
            )
        );

        $result = wp_remote_get($url, $args)['body'];

        set_transient('cats_jobs', $result, 12 * HOUR_IN_SECONDS);
    }

    return $result;
}


/**
 * Checks if a job is published based on a custom field set in cats_jobs.
 * Returns a boolean.
 */
function is_published_on_website($job) {
    if (!isset($job['_embedded']['custom_fields'])) return false;
    return find_custom_field($job, '173304') == '373878';
};


/**
 * Gets the value of a custom field from a job in cats
 * Returns the value or null if it doesn't exist
 */
function find_custom_field($job, $custom_field_id) {
    foreach ($job['_embedded']['custom_fields'] as $item) {
        if($item['id'] == $custom_field_id) {
            return $item['value'];
        }
    }
};
