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
	$quote_person_name = get_field('person_name');

	$output = '';

	$output .= 	'<div>' .
	    			'<p class="text-bold h3">"' . $quote['post_title'] . '"</p>';

	if ($quote_team_member || $quote_person_name):
		$output .= '<p class="big">- ';
		if ($quote_team_member['post_status'] == 'publish'):
			$output .= '<a href="' . get_permalink($quote_team_member['ID']) . '">' . $quote_team_member['post_title'] . '</a>';
		else:
			$output .= $quote_team_member['post_title'];
		endif;

		$output .= 	', ' . $quote_team_member['job_title'] .
					'</p>';
	endif;

	$output .= '</div>';

	return $output;

}
add_shortcode( 'quote', 'quote' );