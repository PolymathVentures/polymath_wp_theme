<?php
	$posts = new WP_Query([
		"posts_per_page" => 1,
		"orderby"        => "publish",
		"post_type"		   => "post",
		"order"          => "DESC",
		"post_status"    => "publish",
	]);
	$posts = array_map(function($post) {
		// Get the subtitle
		$subtitle = get_post_field("subtitle", $post->ID);
		if( !$subtitle ) {
			$subtitle = wp_strip_all_tags($post->post_content);
			$subtitle = substr($subtitle, 0, 140)."&hellip;";
		}

		// Get the post category
		$category = array_map(function($category) {
			return $category->name;
		}, get_the_category($post->ID))[0];

		return [
			"id"        => $post->ID,
			"url"       => "/".$post->post_name,
			"thumbnail" => get_the_post_thumbnail_url($post->ID),
			"category"  => $category,
			"title"     => $post->post_title,
			"subtitle"  => $subtitle,
			"date"      => date("M j, Y", strtotime($post->post_date))
		];
	}, $posts->posts)[0];
?>
<div id="blog-highlights">
	<div class="text-left" style="margin:-75px 0px -40px; font-size:20px; color:gray;">
		HIGHLIGHTS
	</div>
	<a href="<?= $post["url"] ?>" class="blog-post <?= strtolower($post["category"]) ?>">
		<div class="row" id="blog-post-<?= $post["id"] ?>">
			<div class="col-xs-4 thumbnail" style="background-image:url(<?= $post["thumbnail"] ?>);"></div>
			<div class="col-xs-8 content">
				<div>
					<span class="category"><?= $post["category"] ?></span>
					<h2><?= $post["title"] ?></h2>
					<h4 class="subtitle"><?= $post["subtitle"] ?></h4>
					<h4><?= $post["date"] ?></h4>
				</div>
			</div>
		</div>
	</a>
	<script type="text/javascript">
		jQuery(function() {
			jQuery(".blog-post:first-of-type").hide(250);
			jQuery(".blog-post .thumbnail, .blog-post .content").height(9*jQuery(".blog-post .thumbnail").width()/16);
		});
	</script>
	<style type="text/css">
		#blog-highlights {
			background:white;
		}
		.blog-post .row[id^=blog-post] {
			margin:50px 0px;
		}
		a.blog-post {
			display:block;
		}
		a.blog-post, a.blog-post * {
			color:#1f1a33;
		}
		.blog-post .thumbnail {
			margin:0px;
			padding:0px;
			border:none;
			border-radius:0px;
			background-size:cover;
			background-position:center;
		}
		.blog-post .content {
			display:table;
		}
		.blog-post .content>div {
			padding:10px;
			text-align:left;
			color:#1f1a33;
			vertical-align:middle;
			display:table-cell;
		}
		.blog-post .category {
			padding:5px 15px;
			color:white;
			text-transform:uppercase;
			letter-spacing:2px;
			background-color:gray;
		}
		a.entrepreneurship .category {
			background-color:#62c5bb;
		}
		a.methodology .category {
			background-color:#fecd34;
		}
		a.news .category {
			background-color:#f7403a;
		}
		.blog-post h2 {
			margin-top:5px;
			font-weight:normal;
		}
		.blog-post h4.subtitle {
			color:#595959;
			font-weight:400;
			text-transform:none;
		}
		.blog-post h4 {
			color:gray;
			text-transform:none;
		}
	</style>
</div>