<?php

$current_id = get_the_ID();

$args = array(
	'posts_per_page'   => -1,
	'orderby'          => 'post_title',
	'post_type'		   => 'post',
	'order'            => 'ASC',
	'post_status'      => 'publish',
);

$blog_posts = new WP_query($args);
?>
<?php if( $blog_posts->have_posts() ): ?>

	<?php $i = 0; while( $blog_posts->have_posts() ) : $blog_posts->the_post(); ?>

		<?php if($i % 3 == 0): ?>
	        <div class="<?php echo is_single() ? '' : 'row'; ?> post-list">
	    <?php endif; ?>

		<?php if($current_id == get_the_ID()) continue; ?>
		<?php $ventures = implode(' ', get_field( "ventures" ) ?: []); ?>
		<?php $seeds = implode(' ', get_field( "seeds" ) ?: []); ?>
		<?php $tags = implode(' ', array_map(function($tag) {return $tag->slug;}, get_the_tags() ?: [])); ?>

		<div class="col-sm-4 post-list-item margin-bottom">
			<div class="post-list-image responsive-bg"
				 data-bg-json='<?php echo json_encode(format_attachment_sizes_array(get_post_thumbnail_id())); ?>'>
				<a href="<?php the_permalink(); ?>" class="text-dark">
					<div class="blog-post-more-button"><span class="plus text-center">+</span></div>
				</a>
			</div>
			<article class="white text-left content-padding-wrapper">
				<div class="content-padding">
					<header>
						<div class="h2">
							<a href="<?php the_permalink(); ?>" class="text-dark">
								<?php the_title(); ?>
							</a>
						</div>
					</header>
				</div>
			</article>
		</div>

		<?php $i++; if ($i % 3 == 0 || $i == $blog_posts->found_posts): ?>
	        </div>
	    <?php endif; ?>

	<?php endwhile; ?>

<?php endif; ?>
<?php wp_reset_query(); ?>