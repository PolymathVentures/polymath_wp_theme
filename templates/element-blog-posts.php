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

		<?php if($current_id == get_the_ID()) continue; ?>
		<?php $ventures = implode(' ', get_field( "ventures" ) ?: []); ?>
		<?php $seeds = implode(' ', get_field( "seeds" ) ?: []); ?>
		<?php $tags = implode(' ', array_map(function($tag) {return $tag->slug;}, get_the_tags() ?: [])); ?>

		<?php //if($i == 0): ?>
			<?php //include(locate_template('templates/element-blog-post.php')); ?>
		<?php //else: ?>
		<div class="col-sm-4 post-list-item margin-bottom">
			<div class="col-xs-12">
				<div class="post-list-image" style="background-image: url(<?php the_post_thumbnail_url('post-list-thumb'); ?>)"></div>
                <a href="<?php the_permalink(); ?>">
	                <div class="blog-post-more-button"><span class="plus text-center">+</span></div>
                </a>
				<article class="white text-left content-padding-wrapper">
					<div class="content-padding">
						<header>
							<div class="h2"><?php the_title(); ?></div>
						</header>
	                    <?php get_template_part('templates/element-share-buttons'); ?>
					</div>
				</article>
			</div>
		</div>
		<?php //endif; ?>
	<?php $i++; endwhile; ?>

<?php endif; ?>
<?php wp_reset_query(); ?>