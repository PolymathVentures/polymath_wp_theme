<?php

// Add Shortcode
function promo( $atts , $content = null ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'promo' => array()
		), $atts )
	);

	$promo = get_post_with_custom_fields($promo);

	$output = '';

	$output .= 	'<div class="col-md-12">' .
	    			'<h3>' . $promo['post_title'] . '</h3><br />';

	$output .= $promo['description'] ? '<p>' . $promo['description'] . '</p>' : '';

	if ($promo['link']) {
		$output .= '<a class = "btn btn-primary" href="' . $promo['link'] . '">' . $promo['button_text'] . '</a>';
	}

	return $output;

}
add_shortcode( 'promo', 'promo' );