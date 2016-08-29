<?php

$args = array(
	'posts_per_page'   => -1,
	'orderby'          => 'meta_value_num title',
	'meta_key'		   => 'order',
	'post_type'		   => 'team_members',
	'order'            => 'ASC',
	'post_status'      => 'publish',
);

if($params['role']) {
	$args['tax_query'] = array(
							array(
							'taxonomy' => $params['role']->taxonomy,
							'field' => 'id',
							'terms' => $params['role']->term_id
							)
						);
}

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

<?php if(!$params['category']): ?>
	<?php include(locate_template('templates/element-matrix-filter.php')); ?>
<?php endif; ?>


<?php if(!$params['category'] && !$params['role']): ?>
	<span class="custom-button">&middot;</span>
<?php endif; ?>

<?php

$items = get_terms( array(
	'taxonomy' => 'job_role',
) );
$items[0]->button_text = 'Role';
$excluded = ['management'];
?>

<?php if(!$params['role']): ?>
	<?php include(locate_template('templates/element-matrix-filter.php')); ?>
<?php endif; ?>

<span class="custom-button">&middot;</span>
<button type="button" class="btn custom-button filter" data-filter="all">
    <span>Clear filters</span>
</button>

<br/>
<br/>
<br/>

<?php if( $people->have_posts() ): ?>

<div class="mixitup-container">

	<?php while( $people->have_posts() ) : $people->the_post(); ?>

		<?php if(!get_field('order')) continue; ?>

		<?php $person = formatPersonInfo(get_post()); ?>
		<?php $ventures = implode(' ', get_field( "ventures" ) ?: []); ?>
		<?php $seeds = implode(' ', get_field( "seeds" ) ?: []); ?>
		<?php $roles = implode(' ', array_map(function($role) {return $role->slug;}, get_the_terms(get_the_ID(), 'job_role') ?: [])); ?>

		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mix team-member responsive-bg <?php echo $ventures; ?> <?php echo $seeds; ?> <?php echo $roles; ?>"
             data-bg-json='<?php echo json_encode(format_attachment_sizes_array(get_post_thumbnail_id())); ?>'>
			 <span id="person-<?php the_ID(); ?>" class="anchor"></span>
				 <article class="team-member-info-overlay content-padding-wrapper show-person-modal"
						  data-title="<?php echo htmlspecialchars($person['title']); ?>"
						  data-description="<?php echo htmlspecialchars($person['full_description']); ?>"
						  data-picture="<?php echo $person['image']['sizes']['original']; ?>">
				 <div class="content-padding">
						 <h3><?php echo $person['title']; ?></h3>
			  		</div>
				</article>
		</div>

	<?php endwhile; ?>

</div>

<?php endif; ?>
<?php wp_reset_query(); ?>