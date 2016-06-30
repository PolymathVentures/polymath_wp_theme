<?php
if($params['type'] == 'team') {
    $args = array(
    	'posts_per_page'   => -1,
    	'orderby'          => 'published',
    	'post_type'		   => 'team_members',
    	'order'            => 'ASC',
    	'post_status'      => 'publish',
    );

    if ($params['category']) {
    	$args['meta_query'] = 	array(
    								array(
                                    'key' => $params['category']->post_type,
    								'value' => '"' . $params['category']->ID . '"',
								    'compare' => 'LIKE'
    								)
    							);
    }

    $people = new WP_query($args);

    $slides = [];
    if( $people->have_posts() ):
    	while( $people->have_posts() ) : $people->the_post();
    		$person = get_post_with_custom_fields(get_post());
    		$person['image'] = array('sizes' => format_attachment_sizes_array(get_post_thumbnail_id()));
            $person['icon'] = false;
    		$person['title'] = $person['post_title'] . '<br/><span class="small">' . $person['job_title'] . '</span>';
            $person['description'] = '<a href="' . get_home_url() . '/team#' . $person['ID'] . '">' .
                                     'more <i class="icon-arrow-right icons text-extra-small"></i></a>';
    		$slides[] = $person;
    	endwhile;
    endif;

    $slides_object = array(
        'slides' => $slides,
        'arrows' => 'true'
    );

    wp_reset_postdata();

} else {

    $slides_object = get_post_with_custom_fields($params['slider']);
    $slides_object['arrows'] = $params['arrows'] ? 'true' : 'false';
    $slides_object['arrow_background_color'] = $params['arrow_background_color'];

}

$slides_object['slides_to_show'] = $params['slides_in_view'];

?>

<?php include(locate_template('templates/element-slider.php')); ?>

