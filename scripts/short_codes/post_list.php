<?php

// Add Shortcode
function post_list( $atts = array(), $content = null ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'filter' => false,
			'value' => false,
			'maximum' => -1,
			'post_type' => 'post',
			'show_image' => true,
			'title_class' => ''
		), $atts )
	);

	$args = array(
		'posts_per_page'   => $maximum,
		'orderby'          => 'published',
		'post_type'		   => $post_type,
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

			$post_class = implode(' ', get_post_class());
			$title = get_the_title();
			$permalink = get_field( "link" ) ?: get_the_permalink();
			$button_text = get_field( "button_text" ) ?: 'More';
			$excerpt = get_field( "description" ) ?: get_the_excerpt();
			$thumb_url = has_post_thumbnail() ?
							get_thumbnail_url(get_the_ID(), 'post-list-thumb') :
							"http://www.polymathv.com/wp-content/uploads/2014/09/Polymath_Logo_transparent.png";

			$image = $show_image ? '<div class="post-list-image" style="background-image: url(' . $thumb_url . ')"></div>' : '';
			$output .= $i % 3 == 0 ? '<div class="post-list">' : '';
			$output .= 	<<<HTML
						<div class="col-sm-4 post-list-item $colors[$i]">
							<article class="$post_class col-xs-12 text-center">
								<header>
									<div class="entry-title $title_class"><a href="$permalink">$title</a></div>
								</header>
								<div class="entry-summary big">
									$excerpt<br />
									<a class="text-underline" href="$permalink">$button_text</a>
									<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
								</div>
							</article>
							$image
						</div>
HTML;

			$i++;
			if ($i % 3 == 0 || $i + 1 == $posts->found_posts) {
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