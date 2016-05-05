<?php

// Add Shortcode
function carousel_shortcode( $atts , $content = null ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'category' => false,
			'items' => array()
		), $atts )
	);

	$i = 0;
	$indicators = '';
	$slides = '';
	foreach ($items as $val) {
		$indicators .= 	'<li data-target="#' . $category . '" data-slide-to="' . $i . '"' .
						'class="' . ($i == 0 ? 'active' : '') . '"></li>';

		$slides .= 	'<div class="item ' . ($i == 0 ? 'active' : '') . '">' .
						'<img src="http://www.polymathv.com/wp-content/uploads/2014/02/Homepage_Slider_11.jpg" alt="' . $val['title'] . '">' .
						'<div class="carousel-caption">' .
							'<h3>' . $val['title'] . '</h3>' .
							'<p>' . $val['description'] . '</p>' .
						'</div>' .
					'</div>';
		$i++;
	};


    //Code
    /* Turn on buffering */
	ob_start(); ?>

    <div id="<?php echo $category; ?>" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
			<?php echo $indicators; ?>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
			<?php echo $slides; ?>
        </div>
        <!-- Controls -->
        <a class="left carousel-control" href="#<?php echo $category; ?>" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#<?php echo $category; ?>" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
        </a>
    </div>

	<?php
	/* Get the buffered content into a var */
	$sc = ob_get_contents();

	/* Clean buffer */
	ob_end_clean();

	/* Return the content as usual */
	return $sc;
}
add_shortcode( 'carousel', 'carousel_shortcode' );