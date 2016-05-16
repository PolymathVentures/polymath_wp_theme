<?php

// Add Shortcode
function post_list( $atts = array(), $content = null ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'filter' => false,
			'value' => false,
			'maximum' => -1,
		), $atts )
	);

	$args = array(
		'posts_per_page'   => $maximum,
		'orderby'          => 'published',
		'post_type'		   => 'post',
		'order'            => 'DESC',
		'post_status'      => 'publish',
	);

	if ($filter) {
		$args['meta_query'] = array(
								array(
									'key' => $filter,
									'value' => '"' . $value . '"',
									'compare' => 'LIKE'
								));
	};

	$posts = new WP_query($args);
	if( $posts->have_posts() ):

	$i = 0;
	$colors = array('red', 'dark-blue', 'aqua');
	$output = '';
	while( $posts->have_posts() ) : $posts->the_post();
		if ($i % 3 == 0) {
			$output .= '<div class="post-list">';
		}

		$thumb = get_thumbnail_url(get_the_ID(), 'post-list-thumb');
		$output .= '<div class="col-sm-4 post-list-item ' . $colors[$i] . '">';
		$output .= 	'<article class="' . implode(' ', get_post_class()) . '">' .
						'<header>' .
							'<h4 class="entry-title">' . get_the_title() . '</h4>' .
						'</header>' .
						'<div class="entry-summary">' .
							get_the_excerpt() .
						'</div>' .
						'<span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>' .
					'</article>' .
					'<img src="' . $thumb . '">' .
					'</div>';

		$i++;
		if ($i % 3 == 0) {
			$output .= '</div>';
			$i = 0;
			array_push($colors, array_shift($colors));
		}
	endwhile;

	endif;

	wp_reset_query();

	return $output;
}

add_shortcode( 'post_list', 'post_list' );