<!-- HEADER -->
<div class="featured-image responsive-bg" data-bg-json="{
	&quot;thumbnail&quot;:&quot;http:\/\/dev.polymathv.com\/wp-content\/uploads\/Mariana_postits-150x150.jpg&quot;,
	&quot;thumbnail-width&quot;:150, &quot;thumbnail-height&quot;:150,
	&quot;medium&quot;:&quot;http:\/\/dev.polymathv.com\/wp-content\/uploads\/Mariana_postits-300x205.jpg&quot;,
	&quot;medium-width&quot;:300, &quot;medium-height&quot;:205,
	&quot;medium_large&quot;:&quot;http:\/\/dev.polymathv.com\/wp-content\/uploads\/Mariana_postits-702x480.jpg&quot;,
	&quot;medium_large-width&quot;:702, &quot;medium_large-height&quot;:480,
	&quot;large&quot;:&quot;http:\/\/dev.polymathv.com\/wp-content\/uploads\/Mariana_postits-1024x700.jpg&quot;,
	&quot;large-width&quot;:1024, &quot;large-height&quot;:700,
	&quot;post_list_thumb&quot;:&quot;http:\/\/dev.polymathv.com\/wp-content\/uploads\/Mariana_postits-380x260.jpg&quot;,
	&quot;post_list_thumb-width&quot;:380, &quot;post_list_thumb-height&quot;:260,
	&quot;team_member_thumb&quot;:&quot;http:\/\/dev.polymathv.com\/wp-content\/uploads\/Mariana_postits-285x400.jpg&quot;,
	&quot;team_member_thumb-width&quot;:285, &quot;team_member_thumb-height&quot;:400,
	&quot;blog_post_image&quot;:&quot;http:\/\/dev.polymathv.com\/wp-content\/uploads\/Mariana_postits-700x400.jpg&quot;,
	&quot;blog_post_image-width&quot;:700, &quot;blog_post_image-height&quot;:400,
	&quot;extra_large&quot;:&quot;http:\/\/dev.polymathv.com\/wp-content\/uploads\/Mariana_postits-1600x1094.jpg&quot;,
	&quot;extra_large-width&quot;:1600, &quot;extra_large-height&quot;:1094}" style="height:350px;">
	<div class="featured-image-inner overlay-dark-blue text-white">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<div class="extra-padding-horizontal extra-padding-vertical">
						<h1 class="huge text-italic extra-letter-spacing">BLOG</h1>
						<!--<p class="big">Fresh updates and insights from the Polymath universe</p>-->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- POSTS -->
<?php
	$current_id = get_the_ID();
	$args = [
		"posts_per_page" => -1,
		"orderby"        => "publish",
		"post_type"		   => "post",
		"order"          => "DESC",
		"post_status"    => "publish",
		"tag"            => "Medium"
	];
	$blog_posts = new WP_query($args);
?>
<div class="none block-blog">
	<div class="container">
		<div class="row text-center">
			<div class="col-xs-12">
				<div class="block-content">
					<div class="extra-padding-vertical">
						<div class="mixitup-container post-list">
							<?php if( $blog_posts->have_posts() ): ?>
								<?php $i = 0; while( $blog_posts->have_posts() ) : $blog_posts->the_post(); ?>
									<?php if($i % 3 == 0): ?>
										<div class="<?php echo is_single() ? '' : 'row'; ?> post-list">
									<?php endif; ?>

									<?php if($current_id == get_the_ID()) continue; ?>
									<?php $ventures = implode(' ', get_field( "ventures" ) ?: []); ?>
									<?php $seeds = implode(' ', get_field( "seeds" ) ?: []); ?>
									<?php $tags = implode(' ', array_map(function($tag) {return $tag->slug;}, get_the_tags() ?: [])); ?>

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
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
