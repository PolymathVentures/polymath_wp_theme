<?php

// Add Shortcode
function post_buttons( $atts , $content = null ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'title' => '',
			'post_type' => false,
			'taxonomy' => false,
		), $atts )
	);

	if($post_type) {

		$args = array(
			'posts_per_page'   => -1,
			'orderby'          => 'post_title',
			'order'            => 'ASC',
			'post_type'        => $post_type,
			'post_status'      => array('publish', 'pending'),
		);

		$list = get_posts( $args );

	} else if($taxonomy) {

		$list = get_terms( array(
		    'taxonomy' => $taxonomy,
		) );

	}

	$buttons = <<<HTML
					<div class="btn-group">
  			   			<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							$title
						</button>
						<ul class="dropdown-menu">
HTML;


	foreach($list as $item) {
		$key = isset($item->ID) ? $item->ID : $item->slug;
		$val = isset($item->post_title) ? $item->post_title : $item->name;
		$buttons .= '<li><a href="#" class="filter" data-filter=".' . $key . '">' . $val . '</a></li>';
	};

	$buttons .= '</ul></div>';

	return $buttons;
}

add_shortcode( 'post_buttons', 'post_buttons' );