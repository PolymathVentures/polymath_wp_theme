<?php
	$args = [
		"posts_per_page" => 1,
		"orderby"        => "publish",
		"post_type"		   => "post",
		"order"          => "DESC",
		"post_status"    => "publish",
	];
	$latest = new WP_query($args); $latest->the_post();

	// Get the first non-empty line for subtitle
	$subtitle = explode("\n", wp_strip_all_tags(get_the_content()));
	$subtitle = array_values(array_filter($subtitle, function($line) {
		return trim(trim($line, chr(0xC2).chr(0xA0)))!=="";
	}))[0];

	// Get the post category
	$category = array_map(function($category) {
		return $category->name;
	}, get_the_category(get_the_ID()))[0];
?>
<style type="text/css">
	.section-title {
		margin-bottom:10px; font-size:20px; font-weight:100; color:gray;
	}
	#blog-last-post {
		height:300px; overflow:hidden; display:block;
	}
	#blog-last-post div.featured-image, #blog-last-post div.featured-image-inner {
		transition:transform 0.35s, background 0.35s;
		transform:scale(1);
	}
	#blog-last-post div.featured-image-inner {
		background:rgba(0,0,0,0.5);
	}
	#blog-last-post:hover div.featured-image {
		transform:scale(1);
	}
	#blog-last-post:hover div.featured-image-inner {
		transform:scale(1.02);
		background:rgba(0,0,0,0.75);
	}
	#blog-last-post .featured-image-inner {
		position:relative; top:-350px;
	}
	#blog-last-post .container>div {
		position:absolute; left:15px; bottom:15px;
	}
	#blog-last-post .category {
		padding:5px 15px;
		color:white;
		text-transform:uppercase;
		letter-spacing:2px;
		background-color:gray;
	}
	#blog-last-post .category.news {
		background-color:#f7403a;
	}
	#blog-last-post .category.methodology {
		background-color:#fecd34;
	}
	#blog-last-post .category.management {
		background-color:#62c5bb;
	}
	#blog-last-post .category.people-culture {
		background-color:#a34bbf;
	}
	@media(min-width:768px) {
		#blog-last-post,
		#blog-last-post .featured-image,
		#blog-last-post .featured-image-inner {
			height:350px;
		}
		#blog-last-post .container>div {
			position:absolute; left:50px; bottom:35px; right:80px;
		}
	}
</style>
<div class="section-title text-left">
	Last publication
</div>
<a href="<?= the_permalink() ?>" id="blog-last-post">
	<div class="featured-image responsive-bg" style="height:350px;"
		data-bg-json='<?= json_encode(format_attachment_sizes_array(get_post_thumbnail_id())) ?>'>
	</div>
	<div class="featured-image-inner">
		<div class="container text-left text-white" style="height:350px; position:relative;">
			<div>
				<span class="category <?= str_replace(" &amp; ", "-", strtolower($category)) ?>">
					<?= $category ?>
				</span>
				<h1 class="extra-big"><?= the_title() ?></h1>
				<h1 class="big hidden-xs" style="text-transform:capitalize;"><?= strtolower($subtitle) ?></h1>
				<h1 class="big" style="text-transform:none;"><?= date("M j, Y", strtotime(get_the_date())) ?></h1>
			</div>
		</div>
	</div>
</a>
<?php wp_reset_query() ?>
