<?php
if($params['type'] == 'team') {

    if(!$params['people']):

        $args = array(
        	'posts_per_page'   => -1,
        	'orderby'          => 'published',
        	'post_type'		   => 'team_members',
        	'order'            => 'ASC',
        	'post_status'      => 'publish',
        );

        if($params['role']) {
            $args['tax_query'] = array(
    								array(
                                    'taxonomy' => $params['role']->taxonomy,
                                    'field' => 'id',
    								'terms' => $params['role']->term_id
    								)
    							);
        }

        if($params['category']) {
            $args['meta_query'] = 	array(
        								array(
                                        'key' => $params['category']->post_type,
        								'value' => '"' . $params['category']->ID . '"',
    								    'compare' => 'LIKE'
        								)
        							);
        }

        $people = new WP_query($args);
        $people = $people->posts;
    else:
        $people = $params['people'];
    endif;

    $slides = [];

    if( count($people) > 0 ):
    	foreach($people as $person):
            $p = formatPersonInfo($person);
            $p['description'] = '';
    		$slides[] = $p;
    	endforeach;
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

