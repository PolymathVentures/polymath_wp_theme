<?php

// Add Shortcode
function carousel( $atts , $content = null ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'id' => '',
			'items' => array(),
			'show' => 1,
			'height' => 'auto'
		), $atts )
	);

	$show = wp_is_mobile() ? 1 : $show;

	if (!$items) return;

	$i = 0;
	$indicators = '';
	$slides = '';
	foreach ($items as $item) {
		$slides .= 	'<div class="slide slide--has-caption slick-slide" style="height: ' . $height . '">';
		$slides .= 	isset($item['image']) ? '<img src="' . $item['image'] . '" alt="' . $item['title'] . '">' : '';
		$slides .= 	'<div class="slide__caption">' .
					'<h3>' . $item['title'] . '</h3>' .
						'<p>' . $item['description'] . '</p>' .
					'</div>' .
					'</div>';
		$i++;
	};


    //Code
    /* Turn on buffering */
	ob_start(); ?>

    <div id="<?php echo $id; ?>" class="slick-container col-md-12">
        <div class="slick" data-slick='{"slidesToShow": <?php echo $show; ?>, "slidesToScroll": 1}'>
			<?php echo $slides; ?>
        </div>
        <!-- Controls -->
        <a class="left carousel-control prev" href="#" role="button">
	        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	        <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control next" href="#" role="button">
	        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	        <span class="sr-only">Next</span>
        </a>
    </div>

	<?php
	// return ob_get_clean();
}
add_shortcode( 'carousel', 'carousel' );