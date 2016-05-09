<?php

// Add Shortcode
function post_buttons( $atts , $content = null ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'post_type' => '',
		), $atts )
	);

	$args = array(
		'posts_per_page'   => -1,
		'orderby'          => 'post_title',
		'order'            => 'ASC',
		'post_type'        => $post_type,
		'post_status'      => array('publish', 'pending'),
	);

	$posts = get_posts( $args );

	$buttons = '';
	foreach($posts as $post) {
		$buttons .= ' <button class="btn btn-primary filter" data-filter=".' . $post->ID . '">' . $post->post_title . '</button>';
	};

	return $buttons;
}

add_shortcode( 'post_buttons', 'post_buttons' );