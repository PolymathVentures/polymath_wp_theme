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

    //Code
    /* Turn on buffering */
	ob_start(); ?>

	<div class="col-md-12">
	    <h3><?php echo $quote['post_title']; ?></h3><br />

		<?php if ($quote_team_member['post_status'] == 'publish'): ?>
			<a href="<?php the_permalink($quote_team_member['ID']); ?>"><?php echo $quote_team_member['post_title'] ?></a>
		<?php else: ?>
			<?php echo $quote_team_member['post_title'] ?>
		<?php endif; ?>
			<br />
			<?php echo $quote_team_member['job_title'] ?>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'quote', 'quote' );