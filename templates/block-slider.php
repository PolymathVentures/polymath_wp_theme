<?php

if(get_sub_field('type') == 'team') {
    $args = array(
    	'posts_per_page'   => -1,
    	'orderby'          => 'post_title',
    	'post_type'		   => 'team_members',
    	'order'            => 'ASC',
    	'post_status'      => 'publish',
    );

    if (get_sub_field('category')) {
    	$args['meta_query'] = 	array(
    								array(
                                    'key' => get_sub_field('category')->post_type,
    								'value' => '"' . get_sub_field('category')->ID . '"',
								    'compare' => 'LIKE'
    								)
    							);
    }

    $people = new WP_query($args);

    $slides = [];
    if( $people->have_posts() ):
    	while( $people->have_posts() ) : $people->the_post();
    		$person = get_post_with_custom_fields(get_post());
    		$person['image'] = get_thumbnail_url(get_the_ID(), 'team-member-thumb');

    		$person['title'] = $person['post_title'] . '<br/><span class="small">' . $person['job_title'] . '</span>';
    		$slides[] = $person;
    	endwhile;
    endif;

    $slides_object = array(
        'slides' => $slides,
        'dots'  => 'false',
        'arrows' => 'true'
    );

    wp_reset_postdata();

} else {

    $slides_object = get_post_with_custom_fields(get_sub_field('slider'));
    $slides_object['dots'] = 'true';
    $slides_object['arrows'] = 'false';

}

$slides_object['slides_to_show'] = get_sub_field('slides_in_view');

?>

<?php include(locate_template('templates/element-slider.php')); ?>

