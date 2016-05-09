<?php

// Add Shortcode
function team_members_matrix( $atts = array(), $content = null ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'filter' => false,
			'value' => false,
		), $atts )
	);

	if ($filter) {
		$args = array(
			'posts_per_page'   => -1,
			'orderby'          => 'post_title',
			'post_type'		   => 'team_members',
			'order'            => 'ASC',
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
	} else {
		global $wp_query;
		$posts = $wp_query;
	}
	ob_start();

	if( $posts->have_posts() ):
	?>

	<div class="mixitup-container row">
		<?php while( $posts->have_posts() ) : $posts->the_post(); ?>
			<?php get_template_part('templates/content', get_post_type()); ?>
		<?php endwhile; ?>
	</div>

	<?php
	endif;

	wp_reset_query();
	return ob_get_clean();
}

add_shortcode( 'team_members_matrix', 'team_members_matrix' );