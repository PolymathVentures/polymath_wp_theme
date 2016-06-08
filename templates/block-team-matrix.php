<?php

$args = array(
	'posts_per_page'   => -1,
	'orderby'          => 'post_title',
	'post_type'		   => 'team_members',
	'order'            => 'ASC',
	'post_status'      => 'publish',
);

if (get_sub_field('category')) {
	$args['meta_query'] = 	array(
								array(
								'key' => get_sub_field('category')->post_type,
								'value' => '"' . get_sub_field('category')->ID . '"',
								'compare' => 'LIKE'
								)
							);
}

$people = new WP_query($args);
?>


<?php if( $people->have_posts() ): ?>

<div class="mixitup-container">

	<?php while( $people->have_posts() ) : $people->the_post(); ?>

		<?php $ventures = implode(' ', get_field( "ventures" ) ?: []); ?>
		<?php $seeds = implode(' ', get_field( "seeds" ) ?: []); ?>
		<?php $roles = implode(' ', array_map(function($role) {return $role->slug;}, get_the_terms(get_the_ID(), 'job_role') ?: [])); ?>

		<div class="col-md-3 col-sm-6 col-xs-12 mix <?php echo $ventures; ?> <?php echo $seeds; ?> <?php echo $roles; ?>"
             style="background-image: url(<?php echo get_thumbnail_url(get_the_ID(), 'team-member-thumb'); ?>)">
			<article class="team-member-info-overlay">
			  <header>
				<h2 class="entry-title">
					<?php the_title(); ?><br />
					<span class="small"><?php the_field( "job_title" ); ?></span>
				</h2>
			  </header>
			  <div class="entry-summary">
				<?php the_field( "description" ); ?>
			  </div>
			</article>
		</div>

	<?php endwhile; ?>

</div>

<?php endif; ?>
<?php wp_reset_query(); ?>