<?php

// Add Shortcode
function team_members_matrix( $atts = array(), $content = null ) {

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

	if( $posts->have_posts() ):

	$output = '';

	$output .= '<div class="mixitup-container">';

		while( $posts->have_posts() ) : $posts->the_post();

			$ventures = implode(' ', get_field( "ventures" ) ?: []);
			$seeds = implode(' ', get_field( "seeds" ) ?: []);
			$title = get_the_title();
			$permalink = get_the_permalink();
			$experience = get_field( "experience" );

			$output .= <<<HTML
				<div class="col-md-3 col-sm-6 col-xs-12 mix $ventures $seeds">
					<article class="implode(' ', get_post_class())">
					  <header>
						<h2 class="entry-title"><a href="$permalink">$title</a></h2>
					  </header>
					  <div class="entry-summary">
						$experience
					  </div>
					</article>
				</div>
HTML;

		endwhile;

	$output .= '</div>';

	endif;

	wp_reset_query();
	return $output;
}

add_shortcode( 'team_members_matrix', 'team_members_matrix' );