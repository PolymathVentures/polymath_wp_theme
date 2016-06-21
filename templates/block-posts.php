<?php
$args = array(
	'posts_per_page'   => get_sub_field('maximum_posts'),
	'orderby'          => 'published',
	'post_type'		   => get_sub_field('post_type'),
	'order'            => 'DESC',
	'post_status'      => 'publish',
);

if (get_sub_field('filter')) {
	$args['meta_query'] = array(
							array(
								'key' => get_sub_field('filter'),
								'value' => get_sub_field('value'),
								'compare' => 'LIKE'
							));
};

$items = new WP_query($args);

if( $items->have_posts() ):

$i = 0;
$colors = array('red', 'dark-blue', 'aqua');
$show_images = get_sub_field('show_images');
?>

<?php while( $items->have_posts() ) : $items->the_post(); ?>

	<?php if($i % 3 == 0): ?>
        <div class="post-list">
    <?php endif; ?>

	<?php $color = get_sub_field('alternating_colors') ? $colors[$i % 3] : get_sub_field('post_background_color'); ?>
		<div class="col-sm-4 post-list-item <?php echo $color; ?> text-white">
			<article class="col-xs-12 text-center no-padding">
				<div class="content-padding-wrapper">
					<div class="content-padding">
						<header>
							<div class="h2 <?php the_sub_field('post_title_size'); ?>"><a href="<?php echo get_field( "link" ) ?: get_the_permalink(); ?>"><?php the_title(); ?></a></div>
						</header>
						<div class="entry-summary big">
							<?php echo get_field( "description" ) ?: get_the_excerpt(); ?><br />
							<a class="text-underline" href="<?php echo get_field( "link" ) ?: get_the_permalink(); ?>"><?php echo get_field( "button_text" ) ?: 'More'; ?></a>
							<i class="icon-arrow-right icons text-extra-small"></i>
						</div>
					</div>
				</div>
			</article>
			<?php if($show_images): ?>
                <div class="post-list-image" style="background-image: url(<?php the_post_thumbnail_url('post-list-thumb'); ?>)">
					<span class="arrow text-<?php echo explode(' ', $color)[0]; ?>"></span>
				</div>
            <?php endif; ?>
		</div>

    <?php $i++; if ($i % 3 == 0 || $i == $items->found_posts): ?>
        </div>
    <?php array_push($colors, array_shift($colors)); endif; ?>

<?php endwhile; ?>

<?php endif; ?>
<?php wp_reset_postdata(); ?>