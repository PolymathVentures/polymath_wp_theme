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

	<div class="col-sm-4 post-grid-item-wrapper-wrapper" style="background-image: url('<?php the_post_thumbnail_url('medium'); ?>');">
		<a href="<?php echo get_field( "link" ) ?: get_the_permalink(); ?>">
			<div class="post-grid-item-wrapper">
				<article class="post-grid-item">
					<header>
						<h2 class="text-bold">
							<?php the_title(); ?><br/>
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