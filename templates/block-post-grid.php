<?php
$args = array(
	'posts_per_page'   => get_sub_field('maximum_posts'),
	'orderby'          => 'published',
	'post_type'		   => get_sub_field('post_type'),
	'order'            => 'DESC',
	'post_status'      => 'publish',
);

$items = new WP_query($args);

if( $items->have_posts() ):

?>

<?php while( $items->have_posts() ) : $items->the_post(); ?>

	<div class="col-sm-4 col-xs-8 col-xs-offset-2 col-sm-offset-0 post-grid-item-wrapper-wrapper responsive-bg"
		 data-bg-json='<?php echo json_encode(format_attachment_sizes_array(get_post_thumbnail_id())); ?>'>
		<a href="<?php echo get_field( "link" ) ?: get_the_permalink(); ?>">
			<div class="post-grid-item-wrapper">
				<article class="post-grid-item">
					<header>
						<h2 class="text-bold extra-big">
							<?php the_title(); ?><br/>
							<span class="small">Seed <?php the_field('year'); ?></span><br/>
							<i class="icon-magnifier icons"></i>
						</h2>
					</header>
				</article>
			</div>
		</a>
	</div>

<?php endwhile; ?>

<?php endif; ?>
<?php wp_reset_postdata(); ?>