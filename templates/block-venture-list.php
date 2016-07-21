<?php

$current_id = get_the_ID();

$args = array(
	'posts_per_page'   => -1,
	'orderby'          => 'publish',
	'post_type'		   => 'ventures',
	'order'            => 'ASC',
	'post_status'      => 'publish',
);

$ventures = new WP_query($args);
?>

<?php if( $ventures->have_posts() ): ?>

	<div class="post-list">

	<?php $i = 0; while( $ventures->have_posts() ) : $ventures->the_post(); ?>

		<?php if($i % 3 == 0): ?>
	        <div class="row">
	    <?php endif; ?>

		<?php if($current_id == get_the_ID()) continue; ?>

		<div class="col-sm-4 post-list-item margin-bottom">
				<div class="venture-logo" style="border-bottom: 4px solid <?php the_field('brand_color'); ?>;">
					<img src="<?php echo get_field('logo')['sizes']['post_list_thumb']; ?>"/>
					<a href="<?php the_permalink(); ?>">
						<div class="blog-post-more-button"><span class="plus text-center">+</span></div>
					</a>
				</div>
				<article class="white content-padding-wrapper calc-height" data-height-group="ventures">
					<div class="content-padding">
						<header>
							<h3 class="text-bold">
								<a href="<?php the_permalink(); ?>" class="text-dark">
									<?php the_title(); ?><br />
								</a>
								<span class="small">Launched: <span class="text-italic"><?php the_field('year_launched'); ?><span></span>
							</h3>
						</header>
						<p><?php the_field('description'); ?></p>
					</div>
				</article>
		</div>

		<?php $i++; if ($i % 3 == 0 || $i == $ventures->found_posts): ?>
	        </div>
	    <?php endif; ?>

	<?php endwhile; ?>

	</div>

<?php endif; ?>
<?php wp_reset_query(); ?>