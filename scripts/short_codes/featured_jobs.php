<?php
function featured_jobs($atts) {

    extract( shortcode_atts(
		array(
			'category' => '',
            'jobs_page_id' => false,
            'custom_field' => '208901'
		), $atts )
	);

    $jobs = cats_jobs();
    $ventures = get_cats_venture_map();

    $jobs = array_filter($jobs, function($job) use($category, $custom_field) {
        return find_custom_field_value($job, $custom_field, true) == $category;
    });

    ob_start();
    include(locate_template('templates/element-featured-jobs.php'));
    $content = ob_get_clean();

	return $content;

}
add_shortcode( 'featured_jobs', 'featured_jobs' );