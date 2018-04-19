<?php
	$highlights = new WP_Query([
		"posts_per_page" => 1,
		"orderby"        => "publish",
		"post_type"		   => "post",
		"order"          => "DESC",
		"post_status"    => "publish",
	]);
	$post = $highlights->posts[0];

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

	$post = [
		"id"        => $post->ID,
		"url"       => "/".$post->post_name,
		"thumbnail" => get_the_post_thumbnail_url($post->ID),
		"category"  => $category,
		"title"     => $post->post_title,
		"subtitle"  => $subtitle,
		"date"      => date("M j, Y", strtotime($post->post_date))
	];
?>
<div id="blog-highlights">
	<div class="text-left" style="font-size:20px; color:gray;">
		HIGHLIGHTS
	</div>
	<a href="<?= $post["url"] ?>" class="<?= strtolower($post["category"]) ?> hidden-xs">
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
	<a href="<?= $post["url"] ?>" class="visible-xs-inline-block text-left">
		<div class="col-xs-12 col-sm-6">
			<div class="thumbnail" style="background-image:url(<?= $post["thumbnail"] ?>);"></div>
			<h4><b><?= $post["title"] ?></b></h4>
			<span class="subtitle"><?= $post["subtitle"] ?></span>
		</div>
	</a>
	<script type="text/javascript">
		jQuery(function() {
			jQuery("a.visible-xs-inline-block .thumbnail").height(9*jQuery("a.visible-xs-inline-block .thumbnail").width()/16);
			jQuery("a.hidden-xs .thumbnail, a.hidden-xs .content").height(9*jQuery("a.hidden-xs .thumbnail").width()/16);
		});
	</script>
	<style type="text/css">
		#blog-highlights {
			margin:-60px -15px 15px;
			padding:15px 15px 25px;
			background:white;
		}
		a.hidden-xs .row[id^=blog-post] {
			margin:25px 0px;
		}
		a.hidden-xs {
			display:block;
		}
		a.hidden-xs, a.hidden-xs * {
			color:#1f1a33;
		}
		a.hidden-xs .thumbnail {
			margin:0px;
			padding:0px;
			border:none;
			border-radius:0px;
			background-size:cover;
			background-position:center;
		}
		a.hidden-xs .content {
			display:table;
		}
		a.hidden-xs .content>div {
			padding:10px;
			text-align:left;
			color:#1f1a33;
			vertical-align:middle;
			display:table-cell;
		}
		a.hidden-xs .category {
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
		a.hidden-xs h2 {
			margin-top:5px;
			font-weight:normal;
		}
		a.hidden-xs h4.subtitle {
			color:#595959;
			font-weight:400;
			text-transform:none;
		}
		a.hidden-xs h4 {
			color:gray;
			text-transform:none;
		}
		a.visible-xs-inline-block .thumbnail {
			margin:15px 0px 15px;
			padding:0px;
			border:none;
			border-radius:0px;
			background-size:cover;
			background-position:center;
		}
		a.visible-xs-inline-block, a.visible-xs-inline-block * {
			color:#1f1a33;
		}
		a.visible-xs-inline-block .subtitle {
			position:relative;
			top:-7px;
		}
		@media(min-width:992px) {
			#blog-highlights {
				margin:-90px calc(575px - 50vw) -65px;
				padding:15px calc(50vw - 575px) 25px;
			}
		}
	</style>
</div>
