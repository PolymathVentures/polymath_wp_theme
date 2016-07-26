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
        $job['description'] = strip_tags($job['description'],
                                '<p><ul><ol><li><br><br/><h1><h2><h3><h4><h5><a><b><strong>');

        $job['description'] = preg_replace('/style=".*?"/i', '', $job['description']);

        $job_array[] = $job;
        $sort_array[] = find_custom_field_value($job, '164169');
    }

    array_multisort($sort_array, $job_array);
    return $job_array;
};


/**
 * Gets a job from a Cats job list
 */
function get_job($id) {
    $jobs = cats_jobs();
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
        $url = 'https://api.catsone.com/v3/portals/38546/jobs?per_page=100';

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
 * Gets the value of a custom field from a job in cats
 * Returns the value or null if it doesn't exist
 */
function find_custom_field($job, $custom_field_id) {
    foreach ($job['_embedded']['custom_fields'] as $item) {
        if($item['id'] == $custom_field_id) {
            return $item;
        }
    }
};

function find_custom_field_value($job, $custom_field_id, $label=false) {

    $cf = find_custom_field($job, $custom_field_id);

    if(!$cf['value']) return '';

    if($label) {
        return custom_field_options($job, $custom_field_id)[$cf['value']];
    }

    return $cf['value'];
};

function custom_field_options($job, $custom_field_id) {
    $cf = find_custom_field($job, $custom_field_id);

    $labels = array();
    foreach($cf['_embedded']['definition']['field']['selections'] as $option) {
        $labels[$option['id']] = $option['label'];
    }

    return $labels;
}


function get_job_url($job, $page_id='') {
    return get_permalink($page_id) . $job['id'] . '/' . urlencode($job['title']);
};


function get_ventures() {

    $args = array(
        'posts_per_page'   => -1,
        'orderby'          => 'post_title',
        'post_type'		   => 'ventures',
        'order'            => 'ASC',
        'post_status'      => array('publish', 'pending'),
    );

    return new WP_query($args);

}


function get_cats_venture_map($result=false) {

    if(!$result) {
        $result = get_ventures();
    }

    $ventures = [];

    foreach($result->posts as $r) {

        $catsone_id = get_field('catsone_id', $r->ID);

        if($catsone_id) {
            $ventures[$catsone_id] = $r->ID;
        }

    };

    return $ventures;

}


/**
 * Register the custom query params "job_id" and "job_title" and rewrite the url so it's pretty
 */
function register_job_params() {
    add_rewrite_tag('%job_id%', '([^&]+)');
    add_rewrite_tag('%job_title%', '([^&]+)');

    $pages = get_pages();
    foreach($pages as $page){

        $meta = get_post_meta($page->ID);
        if(!isset($meta['content'])) continue;
        if(!strpos($meta['content'][0], 'jobs')) continue;
        add_rewrite_rule($page->post_name . '/([^/]*)/([^/]*)/?',
                         'index.php?page_id=' . $page->ID . '&job_id=$matches[1]&job_title=$matches[2]',
                         'top');
    }
}
add_action('init', 'register_job_params', 10, 0);

/**
 * Redirect single job to single-job template
 */
function prefix_url_rewrite_templates() {

    $job = get_job(get_query_var('job_id'));

    if (get_query_var( 'job_id' )) {

        $template =  $job ? '/templates/content-single-job.php' : '/404.php';

        add_filter( 'template_include', function() use ($template) {
            return get_template_directory() . $template;
        });
    }

}

add_action( 'template_redirect', 'prefix_url_rewrite_templates' );

/**
 * Change Meta info (OG and twitter) for single job pages
 */
function job_meta_info(){
    if(get_query_var('job_id')) {
        $job = get_job(get_query_var('job_id'));

        add_action('wpseo_title', function() {
            return urldecode(get_query_var('job_title'));
        });

        add_action('wpseo_canonical',function() use ($job) {
            return get_job_url($job);
        });

        add_action('wpseo_opengraph_image',function() use ($job) {
            $venture = get_cats_venture_map()[$job['company_id']];
            return wp_get_attachment_url(get_post_thumbnail_id($venture));
        });

    }
}

add_action('wp', 'job_meta_info');
