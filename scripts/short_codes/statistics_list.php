<?php

// Add Shortcode
function statistics_list( $atts = array(), $content = null ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'filter' => false,
			'value' => false,
		), $atts )
	);


	$args = array(
		'posts_per_page'   => 3,
		'orderby'          => 'modified',
		'post_type'		   => 'statistics',
		'order'            => 'DESC',
		'meta_query' 	   => array(
								array(
								'key' => $filter,
								'value' => '"' . $value . '"',
								'compare' => 'LIKE'
								)
		),
		'post_status'      => 'publish',
	);

	$posts = new WP_query($args);



	if( $posts->have_posts() ):

		$output = '';
		while( $posts->have_posts() ) : $posts->the_post();

		    $ventures = implode(' ', get_field( "ventures" ) ?: []);
		    $seeds = implode(' ', get_field( "seeds" ) ?: []);
			$number = get_field( "number" );
			$type = get_field( "type" );
			$title = get_field( "description" );

			switch ($type) {
				case 'currency':
					$stat = '$' . $number . ' ' . $title;
					break;
				case 'percentage':
					$stat = $number . '% ' . $title;
					break;
				default:
					$stat = $number . ' ' . $title;
			}

			$output .= <<<HTML
						<div class="col-md-4 col-sm-4 $ventures $seeds">
						    <h3>
						        $stat
						    </h3>
						</div>
HTML;

		endwhile;
	endif;

	wp_reset_query();
	return $output;
}

add_shortcode( 'statistics_list', 'statistics_list' );