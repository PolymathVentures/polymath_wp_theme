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

		<div class="col-sm-4 post-list-item <?php echo $colors[$i]; ?>">
			<article class="<?php post_class(); ?> col-xs-12 text-center">
				<header>
					<div class="entry-title $title_class"><a href="<?php echo get_field( "link" ) ?: get_the_permalink(); ?>"><?php the_title(); ?></a></div>
				</header>
				<div class="entry-summary big">
					<?php echo get_field( "description" ) ?: get_the_excerpt(); ?><br />
					<a class="text-underline" href="<?php echo get_field( "link" ) ?: get_the_permalink(); ?>"><?php echo get_field( "button_text" ) ?: 'More'; ?></a>
					<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
				</div>
			</article>
			<?php if($show_images): ?>
                <div class="post-list-image" style="background-image: url(<?php the_post_thumbnail_url('post-list-thumb'); ?>)"></div>
            <?php endif; ?>
		</div>

    <?php $i++; if ($i % 3 == 0): ?>
        </div>
    <?php $i = 0; array_push($colors, array_shift($colors)); endif; ?>

<?php endwhile; ?>

<?php endif; ?>
<?php wp_reset_postdata(); ?>