<?php
	$current_id = get_the_ID();

	$args = [
		"posts_per_page" => -1,
		"orderby"        => "publish",
		"post_type"		   => "post",
		"order"          => "DESC",
		"post_status"    => "publish",
	];
	if( isset($params) and isset($params["include_tags"]) and $params["include_tags"]!=="" )
		$args["tag_slug__in"] = explode(";", $params["include_tags"]);

	$blog_posts = new WP_query($args);
?>
<div class="mixitup-container post-list">
	<?php if( $blog_posts->have_posts() ): ?>
		<?php $i = 0; while( $blog_posts->have_posts() ) : $blog_posts->the_post(); ?>
			<?php if($i % 3 == 0): ?>
				<div class="<?php echo is_single() ? '' : 'row'; ?> post-list">
			<?php endif; ?>

			<?php if($current_id == get_the_ID()) continue; ?>
			<?php $ventures = implode(' ', get_field( "ventures" ) ?: []); ?>
			<?php $seeds = implode(' ', get_field( "seeds" ) ?: []); ?>
			<?php $tags = implode(' ', array_map(function($tag) { return $tag->slug; }, get_the_tags() ?: [])); ?>
			<?php
				if( isset($params) and isset($params["exclude_tags"]) and $params["exclude_tags"]!=="" ) {
					$continue = false; foreach( explode(";", strtolower($params["exclude_tags"])) as $exclude ) {
						if( strpos($tags, $exclude)!==false ) $continue = true;
					}
					if( $continue ) continue;
				}
			?>

			<div class="col-xs-12 col-sm-4 post-list-item margin-bottom">
				<a href="<?php the_permalink(); ?>" class="text-dark">
				<div class="blog-list-image responsive-bg"
					 data-bg-json='<?php echo json_encode(format_attachment_sizes_array(get_post_thumbnail_id())); ?>'>
					 <div class="blog-post-more-button"><span class="plus text-center">+</span></div>
				</div>
				<article class="white text-left content-padding-wrapper calc-height" data-height-group="blog-post-excerpt">
					<div class="content-padding">
						<header>
							<div class="h2">
									<?php the_title(); ?>
								<br/>
								<span class="small text-light"><?php the_date(); ?></span>
							</div>
						</header>
					</div>
				</article>
				</a>
			</div>

			<?php $i++; if ($i % 3 == 0 || $i == $blog_posts->found_posts): ?>
				</div>
			<?php endif; ?>

		<?php endwhile; ?>

	<?php endif; ?>
	<?php wp_reset_query(); ?>
</div>
