<?php
	// Get the first non-empty line for subtitle
	$subtitle = explode("\n", wp_strip_all_tags(get_the_content()));
	$subtitle = array_values(array_filter($subtitle, function($line) {
		return trim(trim($line, chr(0xC2).chr(0xA0)))!=="";
	}))[0];
	$subtitle = explode(". ", $subtitle)[0];

	// Get the post category
	$category = get_the_category(get_the_ID())[0];
?>
<style type="text/css">	
	.category {
		padding:5px 15px;
		color:white;
		text-transform:uppercase;
		letter-spacing:2px;
		background-color:gray;
	}
	.category.news {
		background-color:#f7403a;
	}
	.category.methodology {
		background-color:#fecd34;
	}
	.category.management {
		background-color:#62c5bb;
	}
	.category.people-culture {
		background-color:#a34bbf;
	}
</style>
<div class="share-float-buttons text-center hidden-xs">
	<a class="facebook-share" href="javascript:void(0);">
		<span class="fa-stack fa-fw fa-2x facebook">
			<i class="fa fa-circle-thin fa-stack-2x"></i>
			<i class="fa fa-circle fa-stack-2x"></i>
			<i class="fa fa-facebook fa-stack-1x"></i>
		</span>
	</a>
	<a class="twitter-share" href="javascript:void(0);">
		<span class="fa-stack fa-fw fa-2x twitter">
			<i class="fa fa-circle-thin fa-stack-2x"></i>
			<i class="fa fa-circle fa-stack-2x"></i>
			<i class="fa fa-twitter fa-stack-1x"></i>
		</span>
	</a>
	<a class="email-share" href="javascript:void(0);">
		<span class="fa-stack fa-fw fa-2x email">
			<i class="fa fa-circle-thin fa-stack-2x"></i>
			<i class="fa fa-circle fa-stack-2x"></i>
			<i class="fa fa-envelope fa-stack-1x"></i>
		</span>
	</a>
	<script type="text/javascript">
		jQuery(function() {
			jQuery("a.facebook-share").click(function() {
				var url = "<?php the_permalink() ?>";
				var img = "<?php the_post_thumbnail_url() ?>";
				window.open("https://facebook.com/sharer.php?u=" + url + "&picture=" + img,"facebook", "toolbar=0, status=0, width=600, height=400");
			});
			jQuery("a.twitter-share").click(function() {
				var url = "<?php the_permalink() ?>";
				var msg = "I just read an article at @polymathventure%0A%0A'<?php the_title() ?>' by <?= get_fields()["author_name"] ?>%0A";
				window.open("https://twitter.com/share?url=" + url + "&text=" + msg, "twitter", "toolbar=0, status=0, width=600, height=400");
			});
			jQuery("a.email-share").click(function() {
				var url     = "<?php the_permalink() ?>";
				var subject = "Check out this blog article from Polymath Ventures";
				var body    = "<?php the_title() ?>%0A<?= trim($subtitle) ?>%0A%0A<?php the_permalink() ?>";
				window.open("mailto:?subject=" + subject + "&body=" + body, "email", "toolbar=0, status=0, width=600, height=400");
			});

			jQuery(window).scroll(function() {
				var top    = (window.outerHeight*0.75 + 65)/2;
				var bottom = jQuery(".single-blog-content").outerHeight() + jQuery(".share-float-buttons").outerHeight();
				if( jQuery(window).scrollTop()>top && jQuery(window).scrollTop()<bottom )
					jQuery(".share-float-buttons").fadeIn(250);
				else
					jQuery(".share-float-buttons").fadeOut(250);
			}).scroll();
		});
	</script>
	<style type="text/css">
		.share-float-buttons {
			width:70px;
			padding:5px;
			position:fixed;
			top:50%;
			left:calc(50vw - 475px);
			transform:translate(0%, -50%);
			display:none;
		}
		.share-float-buttons span.fa-stack i.fa-circle {
			display:none;
		}
		.share-float-buttons span.fa-stack i.fa-circle-thin {
			display:inline;
		}
		.share-float-buttons span.fa-stack:hover i.fa-circle {
			display:inline;
		}
		.share-float-buttons span.fa-stack:hover i.fa-circle-thin {
			display:none;
		}
		.share-float-buttons span.fa-stack:hover i.fa-stack-1x {
			color:white;
		}
		.share-float-buttons span.fa-stack i.fa-stack-1x {
			position:relative;
		}
		.share-float-buttons span.fa-stack.email i.fa-stack-1x {
			font-size:23px;
			top:-3px;
		}
		.share-float-buttons span.fa-stack.facebook {
			color:#3b5998;
		}
		.share-float-buttons span.fa-stack.twitter {
			color:#1da1f2;
		}
		.share-float-buttons span.fa-stack.email {
			color:gray;
		}
	</style>
</div>
<div class="single-blog">
	<?php $mobile_image = get_fields()["mobile_featured_image"] ? get_fields()["mobile_featured_image"] : get_post_thumbnail_id(); ?>
	<div class="blog-image responsive-bg hidden-xs"
		data-bg-json='<?php echo json_encode(format_attachment_sizes_array(get_post_thumbnail_id())); ?>'>
	</div>
	<div class="blog-image responsive-bg visible-xs-block"
		data-bg-json='<?php echo json_encode(format_attachment_sizes_array($mobile_image)); ?>'>
	</div>
	<div class="single-blog-title">
		<span class="category <?= str_replace(" &amp; ", "-", strtolower($category->name)) ?>"><?= $category->name ?></span>
		<h1><?php the_title() ?></h1>
		<h2><?= get_fields()["subtitle"] ?></h2>
	</div>
	<div class="single-blog-container">
		<div class="author-date">
			<span>By: <?= get_fields()["author_name"] ?></span>
			&nbsp;|&nbsp;
			<span><?= date("M j, Y", strtotime(get_the_date())) ?></span>
		</div>
		<div class="single-blog-content">
			<?php the_content() ?>
		</div>
		<hr class="ellipsis">
		<div class="row" style="margin-bottom:30px;">
			<div class="col-xs-4">
				<a class="facebook-share" href="javascript:void(0);">
					<div class="share facebook">
						<i class="fa fa-fw fa-facebook"></i>
						<span class="hidden-xs">&nbsp;Share This</span>
					</div>
				</a>
			</div>
			<div class="col-xs-4">
				<a class="twitter-share" href="javascript:void(0);">
					<div class="share twitter">
						<i class="fa fa-fw fa-twitter"></i>
						<span class="hidden-xs">&nbsp;Tweet This</span>
					</div>
				</a>
			</div>
			<div class="col-xs-4">
				<a class="email-share" href="javascript:void(0);">
					<div class="share email">
						<i class="fa fa-fw fa-envelope"></i>
						<span class="hidden-xs">&nbsp;Email This</span>
					</div>
				</a>
			</div>
		</div>
	</div>
	<style type="text/css">
		#wtr-progress {
			box-shadow:none;
			opacity:1 !important;
			z-index:2000;
		}
		.single-blog, .single-blog-title, .single-blog-container {
			background:white;
		}
		.blog-image {
			height:56.25vw;
			background-size:cover;
		}
		.single-blog-title, .single-blog-container {
			width:100vw;
			margin:0px;
			padding:50px 15px 30px;
		}
		.single-blog-title h1 {
			margin-top:15px;
			font-size:50px;
			font-weight:bold;
		}
		.author-date {
			margin-bottom:15px;
			font-size:16px;
			color:#a0a0a0;
		}
		.single-blog-container hr.ellipsis {
			margin:-20px auto 75px;
			text-align:center;
			border:none;
		}
		.single-blog-container hr.ellipsis:before {
			content:'...';
			margin-left:3em;
			font-size:25px;
			letter-spacing:3em;
		}
		.single-blog-container .share {
			margin:0px auto;
			padding:7.5px;
			text-align:center;
			font-weight:bold;
			color:white;
		}
		.single-blog-container .share .fa {
			background:none;
		}
		.single-blog-container .share.facebook {
			background:#3b5998;
		}
		.single-blog-container .share.twitter {
			background:#1da1f2;
		}
		.single-blog-container .share.email {
			background:gray;
		}
		.single-blog-content {
			padding:25px 0px;
		}
		.single-blog-content h3 {
			font-size:28px;
			text-transform:none;
		}
		.single-blog-content h4 {
			font-size:18px;
			text-transform:none;
		}
		.single-blog-content p {
			font-size:18px;
			line-height:25px;
			margin-bottom:7px;
		}
		.single-blog-content ol, .single-blog-content ul {
			font-size:18px;
			margin-top:18px;
			padding:15px 0px 15px 25px;
			border-left:8px solid #eaeaea;
		}
		.single-blog-content blockquote {
			border-left-color:#fecd34;
		}
		.single-blog-content blockquote p {
			font-size:30px;
			line-height:35px;
		}
		.single-blog-content figure {
			width:calc(100vw - 30px) !important;
			max-width:none;
			margin:0px 0px 30px;
			padding:0px;
			border:none;
			border-bottom:1px solid #a0a0a0;
			border-radius:0px;
		}
		.single-blog-content figure img {
			width:100%;
		}
		.single-blog-content figure figcaption {
			padding:5px 0px;
			font-size:16px;
			font-style:italic;
			color:#a0a0a0;
		}
		@media(min-width:768px) {
			.blog-image {
				height:75vh;
			}
			.single-blog-title, .single-blog-container {
				max-width:740px;
			}
			.single-blog-title {
				padding:50px 30px 15px;
				position:absolute;
				left:calc(50vw - 370px);
				bottom:calc(25vh - 65px);
			}
			.single-blog-container {
				margin:0px calc(50vw - 370px);
				padding:15px 30px 30px;
			}
			.single-blog-content {
				padding:0px 0px 25px;
			}
			.single-blog-content p {
				font-size:20px;
				line-height:30px;
				margin-bottom:30px;
			}
			.single-blog-content figure {
				width:800px !important;
				margin:30px -60px;
			}
			.single-blog-content figure img {
				width:calc(100vw - 30px);
				max-width:800px;
			}
		}
	</style>
</div>
<div class="more-from-category">
	<?php
		wp_reset_query();
		$args = [
			"posts_per_page" => 3,
			"orderby"        => "publish",
			"post_type"		   => "post",
			"order"          => "DESC",
			"post_status"    => "publish",
			"category_name"  => $category->slug,
		];
		$more = new WP_query($args);
		$more = array_filter($more->posts, function($post) {
			return $post->ID!=get_the_ID();
		});
		$more = array_map(function($post) {
			// Get the first non-empty line for subtitle
			$subtitle = explode("\n", wp_strip_all_tags($post->post_content));
			$subtitle = array_values(array_filter($subtitle, function($line) {
				return trim(trim($line, chr(0xC2).chr(0xA0)))!=="";
			}))[0];
			$subtitle = explode(". ", $subtitle)[0];

			return [
				"id"        => $post->ID,
				"url"       => "/".$post->post_name,
				"thumbnail" => get_the_post_thumbnail_url($post->ID),
				"title"     => $post->post_title,
				"subtitle"  => $subtitle
			];
		}, array_slice($more, 0, 2));
	?>
	<div class="row">
		<div class="col-xs-12">
			<span style="font-size:16px; color:gray;">More from</span>&nbsp;
			<span class="category <?= strtolower($category->name) ?>"><?= $category->name ?></span>
		</div>
	</div>
	<div class="row">
		<?php foreach( $more as $post ) { ?>
			<a href="<?= $post["url"] ?>">
				<div class="col-xs-12 col-sm-6">
					<div class="thumbnail" style="background-image:url(<?= $post["thumbnail"] ?>);"></div>
					<h4><b><?= $post["title"] ?></b></h4>
					<span class="subtitle"><?= $post["subtitle"] ?></span>
				</div>
			</a>
		<?php } ?>
	</div>
	<script type="text/javascript">
		jQuery(function() {
			jQuery(".more-from-category .thumbnail").height(9*jQuery(".more-from-category .thumbnail").width()/16);
		});
	</script>
	<style type="text/css">
		.more-from-category {
			padding:50px 0px;
			background:#f3f3f5;
		}
		.more-from-category>.row {
			max-width:740px;
			margin:0px auto;
		}
		.more-from-category .thumbnail {
			margin:15px 0px 15px;
			padding:0px;
			border:none;
			border-radius:0px;
			background-size:cover;
			background-position:center;
		}
		.more-from-category a, .more-from-category a * {
			color:#1f1a33;
		}
		.more-from-category .subtitle {
			position:relative;
			top:-7px;
		}
	</style>
</div>
<div class="banner-apply-now">
	<a href="//polymathv.com/join-us">
		<div class="apply-now">
			<h1><b>WE'RE LOOKING FOR TALENT</b></h1>
			<h2>TO HELP US BUILD AMAZING COMPANIES</h2>
			<div class="link text-center">
				Apply Now
			</div>
		</div>
	</a>
	<style type="text/css">
		.banner-apply-now {
			padding:50px 0px 25px;
			background:white;
		}
		.apply-now {
			width:calc(100vw - 10px);
			margin:0px auto;
			padding:25px 15px;
			text-align:left;
			color:white !important;
			background:#62c5bb;
		}
		.apply-now h1 {
			margin:5px 0px;
			font-size:25px;
		}
		.apply-now h2 {
			margin:5px 0px;
			font-size:19px;
		}
		.apply-now .link {
			width:135px;
			margin:20px auto 0px;
			padding:5px;
			font-size:20px;
			border:2px solid white;
		}
		.apply-now .link:hover {
			color:#62c5bb;
			background:white;
		}
		@media(min-width:768px) {
			.apply-now {
				max-width:740px;
				padding:25px;
				text-align:center;
			}
			.apply-now h1 {
				font-size:40px;
			}
			.apply-now h2 {
				font-size:30px;
			}
			.apply-now .link {
				width:200px;
				font-size:25px;
			}
		}
	</style>
</div>
<div class="recommended">
	<?php
		wp_reset_query();
		$args = [
			"posts_per_page" => 4,
			"orderby"        => "publish",
			"post_type"		   => "post",
			"order"          => "DESC",
			"post_status"    => "publish",
		];
		$recommended = new WP_query($args);
		$recommended = array_filter($recommended->posts, function($post) {
			return $post->ID!=get_the_ID();
		});
		$recommended = array_map(function($post) {
			// Get the first non-empty line for subtitle
			$subtitle = explode("\n", wp_strip_all_tags($post->post_content));
			$subtitle = array_values(array_filter($subtitle, function($line) {
				return trim(trim($line, chr(0xC2).chr(0xA0)))!=="";
			}))[0];
			$subtitle = explode(". ", $subtitle)[0];

			return [
				"id"        => $post->ID,
				"url"       => "/".$post->post_name,
				"thumbnail" => get_the_post_thumbnail_url($post->ID),
				"title"     => $post->post_title,
				"subtitle"  => $subtitle
			];
		}, array_slice($recommended, 0, 3));
	?>
	<div class="row">
		<div class="col-xs-12">
			<span style="font-size:16px; color:gray;">Recommended posts</span>
		</div>
	</div>
	<div class="row">
		<?php foreach( $recommended as $post ) { ?>
			<a href="<?= $post["url"] ?>">
				<div class="col-xs-12 col-sm-4">
					<div class="thumbnail" style="background-image:url(<?= $post["thumbnail"] ?>);"></div>
					<h4><b><?= $post["title"] ?></b></h4>
					<span class="subtitle"><?= $post["subtitle"] ?></span>
				</div>
			</a>
		<?php } ?>
	</div>
	<script type="text/javascript">
		jQuery(function() { 
			jQuery(".recommended .thumbnail").height(9*jQuery(".recommended .thumbnail").width()/16);
		});
	</script>
	<style type="text/css">
		.recommended {
			padding:25px 0px 50px;
			background:white;
		}
		.recommended a, .recommended a * {
			color:#1f1a33;
		}
		.recommended>.row {
			max-width:740px;
			margin:0px auto;
		}
		.recommended .thumbnail {
			margin:15px 0px 15px;
			padding:0px;
			border:none;
			border-radius:0px;
			background-size:cover;
			background-position:center;
		}
		.recommended .subtitle {
			position:relative;
			top:-7px;
		}
	</style>
</div>
