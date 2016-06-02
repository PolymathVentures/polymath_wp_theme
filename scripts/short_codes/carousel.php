<?php

// Add Shortcode
function carousel( $atts , $content = null ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'items' => array(),
			'show' => 1,
			'height' => 'auto',
			'show_caption' => true,
			'background' => ''
		), $atts )
	);

	if (!$items) return;

	$i = 0;
	$slides = '';
	$controls = '';
	foreach ($items as $item) {
		$slides .= 	'<div class="slide slide--has-caption slick-slide" style="height: ' . $height . '">';
		$slides .= 	$item['image'] != '' ?
					'<img src="' . $item['image'] . '" alt="' . $item['title'] . '">' : '';

		if ($show_caption) {
			$slides .= 	'<div class="slide__caption"><div class="caption-content">' .
							'<h3>' . $item['title'] . '</h3>' .
							'<p>' . $item['description'] . '</p>' .
						'</div></div>';
		}

		$slides .= '</div>';

		$controls .= '<li class="slick-control"><a href="#">' . $item['title'] . '</a></li>'; // <ul class="links">$controls</ul>
		$i++;
	};


    $output = <<<HTML
	<div class="slick-container" style="background-image:url($background)">
        <div class="slick" data-slick='{"slidesToShow": $show, "slidesToScroll": 1}'>
			$slides
        </div>
    </div>
HTML;

	return $output;
}
add_shortcode( 'carousel', 'carousel' );