<?php

$current_id = get_the_ID();

$args = array(
	'posts_per_page'   => -1,
	'orderby'          => 'post_title',
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
			<div class="col-xs-12">
				<div class="venture-logo" style="border-bottom: 4px solid <?php the_field('brand_color'); ?>;">
					<img src="<?php echo get_field('logo')['sizes']['post-list-thumb']; ?>"/>
					<a href="<?php the_permalink(); ?>">
						<div class="blog-post-more-button"><span class="plus text-center">+</span></div>
					</a>
				</div>
				<article class="white content-padding-wrapper">
					<div class="content-padding">
						<header>
							<h3 class="text-bold">
								<?php the_title(); ?><br />
								<span class="small">Launched: <?php the_field('year_launched'); ?></span>
							</h3>
						</header>
						<p><?php the_field('description'); ?></p>
					</div>
				</article>
			</div>
		</div>

		<?php $i++; if ($i % 3 == 0 || $i == $ventures->found_posts): ?>
	        </div>
	    <?php endif; ?>

	<?php endwhile; ?>

	</div>

<?php endif; ?>
<?php wp_reset_query(); ?>