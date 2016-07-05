<?php

$args = array(
	'posts_per_page'   => -1,
	'orderby'          => 'post_title',
	'post_type'		   => 'team_members',
	'order'            => 'ASC',
	'post_status'      => 'publish',
);

if ($params['category']) {
	$args['meta_query'] = 	array(
								array(
								'key' => $params['category']->post_type,
								'value' => '"' . $params['category']->ID . '"',
								'compare' => 'LIKE'
								)
							);
}

$people = new WP_query($args);
?>

<?php

$args = array(
	'posts_per_page'   => -1,
	'orderby'          => 'post_title',
	'order'            => 'ASC',
	'post_type'        => 'ventures',
	'post_status'      => array('publish', 'pending'),
);

$items = get_posts( $args );
$items[0]->button_text = 'Ventures';
?>

Filter by: <br/>
<?php include(locate_template('templates/element-matrix-filter.php')); ?><span class="custom-button">&middot;</span>

<?

$items = get_terms( array(
	'taxonomy' => 'job_role',
) );
$items[0]->button_text = 'Role';
?>

<?php include(locate_template('templates/element-matrix-filter.php')); ?>

<?php if( $people->have_posts() ): ?>

<div class="mixitup-container">

	<?php while( $people->have_posts() ) : $people->the_post(); ?>

		<?php $ventures = implode(' ', get_field( "ventures" ) ?: []); ?>
		<?php $seeds = implode(' ', get_field( "seeds" ) ?: []); ?>
		<?php $roles = implode(' ', array_map(function($role) {return $role->slug;}, get_the_terms(get_the_ID(), 'job_role') ?: [])); ?>

		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mix responsive-bg <?php echo $ventures; ?> <?php echo $seeds; ?> <?php echo $roles; ?>"
             data-bg-json='<?php echo json_encode(format_attachment_sizes_array(get_post_thumbnail_id())); ?>'>
			 <span id="person-<?php the_ID(); ?>" class="anchor"></span>
				 <article class="team-member-info-overlay content-padding-wrapper">
				 <div class="content-padding">
				  	 <header>
						<h2 class="entry-title">
							<?php the_title(); ?><br />
							<span class="small"><?php the_field( "job_title" ); ?></span>
						</h2>
					  </header>
					  <div class="entry-summary">
						<?php the_field( "description" ); ?>
					</div><br/>
					  <a href="<?php the_field('linkedin'); ?>" target="_blank">LinkedIn</a>
			  		</div>
				</article>
		</div>

	<?php endwhile; ?>

</div>

<?php endif; ?>
<?php wp_reset_query(); ?>