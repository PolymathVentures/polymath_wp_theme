<?php

// Add Shortcode
function quote( $atts , $content = null ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'quote' => array()
		), $atts )
	);

	$quote = get_post_with_custom_fields($quote);
	$quote_team_member = get_post_with_custom_fields($quote['team_member']);

	$output = '';

	$output .= 	'<div class="col-md-12">' .
	    			'<h3>"' . $quote['post_title'] . '"</h3><br />';

	if ($quote_team_member['post_status'] == 'publish'):
		$output .= '<a href="' . get_permalink($quote_team_member['ID']) . '">' . $quote_team_member['post_title'] . '</a>';
	else:
		$output .= $quote_team_member['post_title'];
	endif;

	$output .= 	'<br />' .
				$quote_team_member['job_title'] .
				'</div>';

	return $output;

}
add_shortcode( 'quote', 'quote' );