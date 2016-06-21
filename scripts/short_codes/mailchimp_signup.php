<?php
function mailchimp_signup() {

    ob_start();
    get_template_part('templates/element-mailchimp-signup');
    $form = ob_get_clean();

	return $form;
    
}
add_shortcode( 'mailchimp_signup', 'mailchimp_signup' );