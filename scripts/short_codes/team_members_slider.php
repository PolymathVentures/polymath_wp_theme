<?php

// Add Shortcode
function team_members_slider( $atts = array(), $content = null ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'filter' => false,
			'value' => false,
		), $atts )
	);

	$args = array(
		'posts_per_page'   => -1,
		'orderby'          => 'post_title',
		'post_type'		   => 'team_members',
		'order'            => 'ASC',
		'post_status'      => 'publish',
	);

	if ($filter) {
		$args['meta_query'] = 	array(
									array(
									'key' => $filter,
									'value' => '"' . $value . '"',
									'compare' => 'LIKE'
									)
								);
	}

	$posts = new WP_query($args);

	$items = [];
	if( $posts->have_posts() ):
		while( $posts->have_posts() ) : $posts->the_post();
			$person = get_post_with_custom_fields(get_post());
			$person['image'] = get_thumbnail_url(get_the_ID(), 'large');
			$person['title'] = $person['post_title'];
			$items[] = $person;
		endwhile;
	endif;

	wp_reset_query();
	return carousel(array('id' => 'team_slider', 'items' => $items, 'show' => 4, 'height' => '300px'));
}

add_shortcode( 'team_members_slider', 'team_members_slider' );