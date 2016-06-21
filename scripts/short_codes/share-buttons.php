<?php
function share_buttons($atts) {

	extract( shortcode_atts(
		array(
			'share_url' => false
		), $atts )
	);

    ob_start();
    include(locate_template('templates/element-share-buttons.php'));
    $buttons = ob_get_clean();

	return $buttons;
    
}
add_shortcode( 'share_buttons', 'share_buttons' );