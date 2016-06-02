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
	$title = '<p class="text-bold h1">' . $promo['post_title'] . '</p>';
	$description = $promo['description'];

	$quote_team_member = get_post_with_custom_fields($quote['team_member']);
	$person = $quote_team_member['post_status'] == 'publish' ?
			  '<a href="' . get_permalink($quote_team_member['ID']) . '">' . $quote_team_member['post_title'] . '</a>' :
			  '';
	$link = $promo['link'] ? '<a class = "btn btn-primary" href="' . $promo['link'] . '">' . $promo['button_text'] . '</a>' : '';

	$output = <<<HTML
					<div>
		    			$title
						<p class="big">
							$description
							$person
							$link
						</p>
					</div>
HTML;

	return $output;

}
add_shortcode( 'promo', 'promo' );