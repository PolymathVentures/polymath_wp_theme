<?php
	$posts = new WP_Query([
		"posts_per_page" => -1,
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
	}, $posts->posts);
	
	$categories = array_map(function($category) {
		return trim(wp_strip_all_tags(trim($category)));
	}, explode("\n", $params["categories"]));
	$categories = array_values(array_filter($categories, function($category) {
		return $category!="";
	}));
?>
<div id="blog-categories">
	<ul class="nav nav-pills">
		<li role="presentation" id="latest"><a>Latest</a></li>
		<?php foreach( $categories as $category ) { ?>
			<li role="presentation" id="<?= str_replace(" & ", "-", strtolower($category)) ?>">
				<a><?= $category ?></a>
			</li>
		<?php } ?>
	</ul>
	<script type="text/javascript">
		jQuery(function() {
			jQuery("#blog-categories").insertBefore(jQuery(".block-blog-last-post"));
			jQuery("#blog-categories li").click(function(event) {
				if( jQuery(event.currentTarget).hasClass("active") )
					return;
				var category = jQuery(event.currentTarget).attr("id");
				
				// Move active label
				jQuery("#blog-categories li").removeClass("active");
				jQuery(event.currentTarget).addClass("active");
				
				// Show or hide latest post
				if( category=="latest" ) {
					jQuery(".blog-post, #mailchimp-signup, #blog-overview").hide(250);
					jQuery(".block-blog-last-post").show(250);
					jQuery(".blog-post").slice(1, 7).show(250);
					jQuery(".blog-post").slice(8, 9).show(250, function() {
						move_sections(); show_more();
					});
				} else {
					jQuery(".blog-post, #mailchimp-signup, #blog-overview").hide(250);
					jQuery(".block-blog-last-post").hide(250);
					jQuery(".blog-post." + category).slice(0, -1).show(250);
					if( jQuery(".blog-post." + category).length>8 ) {	
						jQuery(".blog-post." + category).slice(-1).hide(250, function() {
							move_sections(); show_more(); always_top();
						});
					} else {
						jQuery(".blog-post." + category).slice(-1).show(250, function() {
							move_sections(); show_more(); always_top();
						});
					}
				}
				
				function move_sections() {
					var idx = jQuery(".blog-post:visible").length>5 ? 4 : -1;
					var el  = jQuery(".blog-post:visible").get(idx);
					jQuery("#blog-overview").insertAfter( el ).show();
					
					idx = jQuery(".blog-post:visible").length>3 ? 2 : -1;
					el  = jQuery(".blog-post:visible").get(idx);
					jQuery("#mailchimp-signup").insertAfter( el ).show();
				}
				function show_more() {
					var category = jQuery("#blog-categories li.active").attr("id");
					category = category=="latest" ? "" : "."+category;
					if( category=="" && (jQuery(".blog-post").length-jQuery(".blog-post:visible").length)>1 )
						jQuery(".load-more").show();
					else if( category!="" && (jQuery(".blog-post" + category).length-jQuery(".blog-post" + category + ":visible").length)>0 )
						jQuery(".load-more").show();
					else
						jQuery(".load-more").hide();
				}
				function always_top() {
					jQuery("html, body").animate({"scrollTop":350}, 500);
				}
			});
			
			jQuery("#blog-categories li#latest").click();
		});
	</script>
	<style type="text/css">
		.block-blog-last-post .block-content,
		.block-blog-last-post .extra-padding-vertical {
			margin:15px 0px;
		}
		#blog-categories {
			margin:-15px 0px 15px;
			padding:15px 15px 25px;
			background:white;
		}
		#blog-categories .nav-pills>li>a {
			margin:0px 5px;
			padding:5px;
			border-bottom:1px solid #1f1a33;
			border-radius:0px;
			color:#1f1a33;
			background:transparent;
			text-transform:uppercase;
			letter-spacing:0.1em;
			cursor:pointer;
		}
		#blog-categories .nav-pills>li>a:focus,
		#blog-categories .nav-pills>li>a:hover,
		#blog-categories .nav-pills>li.active>a,
		#blog-categories .nav-pills>li.active>a:focus,
		#blog-categories .nav-pills>li.active>a:hover {
			border-bottom:1px solid #49c3b1;
			color:#1f1a33;
			background:transparent;
		}
		@media(min-width:768px) {
			#blog-categories {
				margin:-15px 0px 30px;
				padding:15px calc(50vw - 575px) 25px;
			}
		}
	</style>
</div>
<div id="blog-posts">
	<div class="section-title text-left">
		Previous publications
	</div>
	<?php foreach( $posts as $post ) { ?>
		<a href="<?= $post["url"] ?>" class="blog-post <?= str_replace(" &amp; ", "-", strtolower($post["category"])) ?>">
			<div class="row text-left">
				<div class="col-xs-4 thumbnail hidden-xs">
					<div class="thumbnail-inner" style="background-image:url(<?= $post["thumbnail"] ?>);"></div>
				</div>
				<div class="col-xs-8 content hidden-xs">
					<div>
						<span class="category"><?= $post["category"] ?></span>
						<h2 class="title"><?= $post["title"] ?></h2>
						<h4 class="subtitle"><?= $post["subtitle"] ?></h4>
						<h4><?= $post["date"] ?></h4>
					</div>
				</div>
				<div class="col-xs-12 text-left visible-xs-inline-block">
					<div class="thumbnail" style="background-image:url(<?= $post["thumbnail"] ?>);"></div>
					<br><span class="category"><?= $post["category"] ?></span><br>
					<h4 class="title"><b><?= $post["title"] ?></b></h4>
					<span class="subtitle"><?= $post["subtitle"] ?></span>
				</div>
			</div>
			<!-- <hr class="visible-xs-block" style="width:100vw; margin-top:17px; margin-left:-15px; margin-bottom:30px; border-top-color:#ccc;"> -->
		</a>
	<?php } ?>
	<script type="text/javascript">
		jQuery(function() {
			jQuery(".blog-post:first-of-type").hide(250);
			jQuery(".blog-post .thumbnail-inner, .blog-post .content").height(
				9*jQuery(".blog-post .thumbnail-inner").width()/16
			);
			jQuery(".blog-post .visible-xs-inline-block .thumbnail").height(
				9*jQuery(".blog-post .visible-xs-inline-block .thumbnail").width()/16
			);
			jQuery(".blog-post .category").click(function(event) {
				event.preventDefault();
				var category = jQuery(event.currentTarget).parents(".blog-post").attr("class").replace("blog-post ", "");
				jQuery("#blog-categories li#" + category).click();
			});
		});
	</script>
	<style type="text/css">
		#blog-posts .section-title {
			margin-top:-50px;
		}
		.blog-post>.row {
			margin:0px;
			transition:background 0.4s;
		}
		a.blog-post {
			padding:0px 0px 50px;
			display:block;
		}
		a.blog-post .visible-xs-inline-block {
			padding:0px;
		}
		.blog-post .thumbnail, .blog-post .thumbnail-inner {
			margin:0px;
			padding:0px;
			border:none;
			border-radius:0px;
			background-size:cover;
			background-position:center;
			background-repeat:no-repeat;
			overflow:hidden;
		}
		.blog-post .content {
			display:table;
		}
		.blog-post .content>div {
			padding:10px;
			text-align:left;
			vertical-align:middle;
			display:table-cell;
		}
		.blog-post .category {
			padding:5px 7px;
			color:white;
			text-transform:uppercase;
			letter-spacing:2px;
			background:gray;
			transition:background 0.2s;
		}
		a.news .category {
			background:#f7403a;
		}
		a.news .category:hover {
			background:#d93d37;
		}
		a.methodology .category {
			background:#fecd34;
		}
		a.methodology .category:hover {
			background:#e8bc31;
		}
		a.management .category {
			background:#62c5bb;
		}
		a.management .category:hover {
			background:#5ab4ab;
		}
		a.people-culture .category {
			background:#a34bbf;
		}
		a.people-culture .category:hover {
			background:#874b93;
		}
		.blog-post .thumbnail-inner {
			transition:transform 0.7s;
			transform:scale(1);
		}
		.blog-post .title {
			margin-top:10px;
			font-size:25px;
			font-weight:normal;
			color:#000;
			text-transform:uppercase;
			transition:color 0.2s;
		}
		.blog-post .subtitle {
			color:#555;
			font-size:15px;
			font-weight:100;
			line-height:0;
			text-transform:none;
			transition:color 0.2s;
		}
		.blog-post h4 {
			color:gray;
			text-transform:none;
		}
		.blog-post:hover>.row {
			background:rgba(21,36,51,.03);
		}
		.blog-post:hover .thumbnail-inner {
			transform:scale(1.01);
		}
		.blog-post:hover .title, .blog-post:hover .subtitle {
			color:#000;
		}
		@media(min-width:768px) {
			#blog-post .section-title {
				margin-top:-75px;
			}
			a.blog-post {
				padding:0px 15px 50px;
			}
			.blog-post .category {
				padding:5px 15px;
			}
			.blog-post .title {
				margin-top:5px;
				font-size:22px;
				color:#555;
			}
			.blog-post .subtitle {
				color:#777;
				font-size:18px;
				line-height:19.8px;
			}
		}
	</style>
</div>
<div id="mailchimp-signup">
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-sm-offset-6 text-left">
			<h1>BE THE FIRST TO READ WHAT WE'RE SAYING</h1>
			<span>get notified directly to your inbox</span>
			<div class="input-group">
				<input type="text" class="form-control" placeholder="your@emailaddress.com">
				<span class="input-group-btn hidden-xs">
					<button type="button" class="btn btn-default">
						<span>Subscribe</span>
						<i class="fa fa-fw fa-check" style="display:none;"></i>
					</button>
				</span>
			</div>
			<div class="text-center visible-xs-block" style="margin:15px;">
				<button type="button" class="btn btn-default">
					<span>Subscribe</span>
					<i class="fa fa-fw fa-check" style="display:none;"></i>
				</button>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		jQuery(function() {
			jQuery("#mailchimp-signup button").click(function() {
				var EMAIL = jQuery("#mailchimp-signup input").val();
				if( !/(\w|-|\.)+@(\w+\.)+[a-z]+/.test(EMAIL) ) {
					alert("Invalid email!"); return;
				}
				
				jQuery("#mailchimp-signup input, #mailchimp-signup button").attr("disabled", "disabled");
				var URL = "https://scripts-dev.polymathv.com/helpers/mailchimp.php?subscribe=newsletter";
				jQuery.post(URL, {"email":EMAIL}, function(response) {
					setTimeout(function() {
						jQuery("#mailchimp-signup input").val("Successfully subscribed!");
						jQuery("#mailchimp-signup button i").show();
						jQuery("#mailchimp-signup button span").hide();
					}, 1000);
				});
			});
		});
	</script>
	<style type="text/css">	
		#mailchimp-signup {
			margin-bottom:50px;
			padding:20px;
			color:white;
			background:#fecd34;
		}
		#mailchimp-signup h1 {
			font-style:italic;
			font-weight:bold;
		}
		#mailchimp-signup span {
			font-size:20px;
		}
		#mailchimp-signup .input-group {
			width:100%;
			border:none;
		}
		#mailchimp-signup .input-group input {
			padding:20px 10px;
			font-size:16px;
			text-align:center;
			color:#1f1a33;
			border:none;
			border-bottom:1px solid #1f1a33;
			border-radius:0px;
			background:transparent;
			box-shadow:none;
		}
		#mailchimp-signup .input-group input::placeholder {
			color:rgba(32,27,61,0.5);
		}
		#mailchimp-signup button {
			width:125px;
			margin-right:-1px;
			padding:7px 15px;
			font-size:18px;
			letter-spacing:2px;
			text-transform:none;
			border:1px solid #1f1a33;
			border-radius:0px;
			color:white;
			background:#1f1a33;
		}
		#mailchimp-signup button span {
			font-size:18px;
		}
		#mailchimp-signup button:disabled {
			color:lightgray;
			opacity:1;
		}
		#mailchimp-signup input:disabled, #mailchimp-signup button:disabled {
			cursor:default;
		}
		@media(min-width:768px) {
			#mailchimp-signup {
				padding:50px;
				background:url(/wp-content/uploads/subscribeimage.jpg);
				background-size:cover;
			}
			#mailchimp-signup .input-group input {
				text-align:left;
			}
		}
	</style>
</div>
<div class="load-more">
	LOAD MORE
	<script type="text/javascript">
		jQuery(function() {
			jQuery(".load-more").click(function() {
				var category = jQuery("#blog-categories li.active").attr("id");
				category = category=="latest" ? "" : "."+category;
				var visible = jQuery(".blog-post:visible").length;
				for( var i = visible+1; i<=visible+9; i++ )
					jQuery(".blog-post" + category + ":nth-of-type(" + (i+1) + ")").show(250);
				
				setTimeout(function() {
					var category = jQuery("#blog-categories li.active").attr("id");
					category = category=="latest" ? "" : "."+category;
					if( category=="" && (jQuery(".blog-post").length-jQuery(".blog-post:visible").length)>1 )
						jQuery(".load-more").show();
					else if( category!="" && (jQuery(".blog-post" + category).length-jQuery(".blog-post" + category + ":visible").length)>0 )
						jQuery(".load-more").show();
					else
						jQuery(".load-more").hide();
				}, 1000);
			});
		})
	</script>
	<style type="text/css">
		.load-more, .load-more * {
			cursor:pointer;
		}
		.load-more {
			margin:25px;
			padding:25px;
			font-size:15px;
			font-weight:bold;
			letter-spacing:2px;
			border:1px solid #d1d1d1;
			color:#777777;
			background:#e2e2e2;
			transition:background 0.2s;
		}
		.load-more:hover {
			background:#d7d8d7;
		}
	</style>
</div>
