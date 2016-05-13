<?php

// Add Shortcode
function carousel_shortcode( $atts , $content = null ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'id' => '',
			'items' => array()
		), $atts )
	);

	if (!$items) return;

	$i = 0;
	$indicators = '';
	$slides = '';
	foreach ($items as $item) {
		$indicators .= 	'<li data-target="#' . $id . '" data-slide-to="' . $i . '"' .
						'class="' . ($i == 0 ? 'active' : '') . '"></li>';

		$slides .= 	'<div class="item ' . ($i == 0 ? 'active' : '') . '">' .
						'<img src="' . $item['image'] . '" alt="' . $item['title'] . '">' .
						'<div class="carousel-caption">' .
							'<h3>' . $item['title'] . '</h3>' .
							'<p>' . $item['description'] . '</p>' .
						'</div>' .
					'</div>';
		$i++;
	};


    //Code
    /* Turn on buffering */
	ob_start(); ?>

    <div id="<?php echo $id; ?>" class="carousel slide col-md-12" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
			<?php echo $indicators; ?>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
			<?php echo $slides; ?>
        </div>
        <!-- Controls -->
        <a class="left carousel-control" href="#<?php echo $id; ?>" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#<?php echo $id; ?>" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
        </a>
    </div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'carousel', 'carousel_shortcode' );