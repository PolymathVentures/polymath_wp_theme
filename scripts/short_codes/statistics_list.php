<?php

// Add Shortcode
function statistics_list( $atts = array(), $content = null ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'filter' => false,
			'value' => false,
		), $atts )
	);


	$args = array(
		'posts_per_page'   => 3,
		'orderby'          => 'modified',
		'post_type'		   => 'statistics',
		'order'            => 'DESC',
		'meta_query' 	   => array(
								array(
								'key' => $filter,
								'value' => '"' . $value . '"',
								'compare' => 'LIKE'
								)
		),
		'post_status'      => 'publish',
	);

	$posts = new WP_query($args);

	ob_start();

	if( $posts->have_posts() ):
	?>

	<?php while( $posts->have_posts() ) : $posts->the_post(); ?>
		<?php get_template_part('templates/content', get_post_type()); ?>
	<?php endwhile; ?>

	<?php
	endif;

	wp_reset_query();
	return ob_get_clean();
}

add_shortcode( 'statistics_list', 'statistics_list' );