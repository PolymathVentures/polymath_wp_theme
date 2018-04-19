<?php
$ventures = get_greenhouse_venture_map( get_ventures() );
$jobs     = array_map(function($job) use ($ventures) {
	$venture   = $job["offices"][0]["name"];
	$location  = $job["location"]["name"];
	$countries = [];
	if( strpos($location, "Colombia")!==false )
		$countries[] = "Colombia";
	if( strpos($location, "Mexico")!==false )
		$countries[] = "Mexico";
	if( strpos($location, "China")!==false )
		$countries[] = "China";
	
	if( substr(strtolower($job["offices"][0]["name"]), 0, strlen("polymath")) === "polymath" ) {
		$venture      = "Polymath Ventures";
		$venture_name = "Polymath";
	} else {
		$venture      = $job["offices"][0]["name"];
		$venture_name = $job["offices"][0]["name"];
	}
	
	return [
		"id"        => $job["id"],
		"title"     => $job["title"],
		"venture"   => [
			"name"  => $venture,
			"color" => get_field("brand_color", $ventures[$venture_name]),
			"logo"  => get_field("logo", $ventures[$venture_name])["sizes"]["post_list_thumb"]
		],
		"expertise" => [
			"id"   => $job["departments"][0]["id"],
			"name" => $job["departments"][0]["name"]
		],
		"location"  => $location,
		"countries" => $countries
	];
}, greenhouse_jobs());

$venture_list   = []; 
$expertise_list = [];
$country_list   = [];
foreach( $jobs as $job ) {
	$venture_list[] = $job["venture"]["name"];
	if( $job["expertise"]["name"] )
		$expertise_list[] = $job["expertise"]["id"].",".$job["expertise"]["name"];
	foreach( $job["countries"] as $country )
		$country_list[] = $country;
}
$venture_list   = array_unique($venture_list);
$expertise_list = array_map(function($expertise) {
	$expertise = explode(",", $expertise);
	return [
		"id" => $expertise[0],
		"name" => $expertise[1]
	];
}, array_unique($expertise_list));
$country_list  = array_unique($country_list);
?>
<div class="text-left" id="jobs">
	<div class="row" id="filters">
		<div class="col-xs-4">
			<div class="btn-group" id="filter-ventures">
				<button type="button" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown"
					aria-haspopup="true" aria-expanded="false">
					<span class="filter-title">Venture</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<span class="filter-icon">
						<i class="fa fa-fw fa-caret-down"></i>
					</span>
				</button>
				<ul class="dropdown-menu"></ul>
			</div>
		</div>
		<div class="col-xs-4">
			<div class="btn-group" id="filter-expertises">
				<button type="button" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown"
					aria-haspopup="true" aria-expanded="false">
					<span class="filter-title">Expertise</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<span class="filter-icon">
						<i class="fa fa-fw fa-caret-down"></i>
					</span>
				</button>
				<ul class="dropdown-menu"></ul>
			</div>
		</div>
		<div class="col-xs-4">
			<div class="btn-group" id="filter-countries">
				<button type="button" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown"
					aria-haspopup="true" aria-expanded="false">
					<span class="filter-title">Country</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<span class="filter-icon">
						<i class="fa fa-fw fa-caret-down"></i>
					</span>
				</button>
				<ul class="dropdown-menu"></ul>
			</div>
		</div>
	</div>
	<div id="filters-border"></div>
	<?php foreach( $jobs as $job ): ?>
		<?php
			$countries = implode(" ", array_map(function($country) {
				return "country-".strtolower($country);
			}, $job["countries"]));
			$venture   = "venture-".strtr(strtolower($job["venture"]["name"]), [" " => "_", "á" => "a"]);
			$expertise = "";
			if( isset($job["expertise"]["name"]) )
				$expertise = "expertise-".strtolower($job["expertise"]["id"]);
		?>
		<a href="<?= get_job_url($job) ?>" class="row job <?= $countries ?> <?= $venture ?> <?= $expertise ?>">
			<div class="venture-image" style="background:url(<?= $job["venture"]["logo"] ?>)"></div>
			<div class="job-data">
				<div class="xs-data">
					<b class="title"><?= $job["title"] ?></b><br>
					<span class="venture"><?= $job["venture"]["name"] ?></span><br>
					<?php if( isset($job["expertise"]["name"]) ) { ?>
						<span class="expertise"><?= $job["expertise"]["name"] ?></span><br>
					<?php } ?>
					<span class="location"><?= $job["location"] ?></span>
				</div>
				<div class="sm-data-40">
					<b class="title"><?= $job["title"] ?></b><br>
					<span class="venture"><?= $job["venture"]["name"] ?></span>
				</div>
				<div class="sm-data-30">
					<?php if( isset($job["expertise"]["name"]) ) { ?>
						<span class="expertise"><?= $job["expertise"]["name"] ?></span><br>
					<?php } ?>
				</div>
				<div class="sm-data-30">
					<span class="location"><?= implode(", ", $job["countries"]) ?></span>
				</div>
			</div>
		</a>
	<?php endforeach; ?>
</div>
<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function() {
		var ventures   = <?= json_encode(array_values($venture_list)) ?>;
		var expertises = <?= json_encode(array_values($expertise_list)) ?>;
		var countries  = <?= json_encode(array_values($country_list)) ?>;
		ventures.forEach(function(venture) {
			var jobs = jQuery(".job.venture-" + venture.toLowerCase().replace(" ", "_").replace("á", "a") + ":visible").length;
			var data = venture + "," + venture.split(" ")[0];
			jQuery("#filter-ventures .dropdown-menu").append(
				"<li><a filter-type=\"venture\" filter-data=\"" + data + "\">" + venture + " (" + jobs + ")</a></li>"
			);
		});
		expertises.forEach(function(expertise) {
			var jobs = jQuery(".job.expertise-" + expertise.id + ":visible").length;
			var data = expertise.id + "," + expertise.name;
			jQuery("#filter-expertises .dropdown-menu").append(
				"<li><a filter-type=\"expertise\" filter-data=\"" + data + "\">" + expertise.name + " (" + jobs + ")</a></li>"
			);
		});
		countries.forEach(function(country) {
			var jobs = jQuery(".job.country-" + country.toLowerCase() + ":visible").length;
			var data = country + "," + country;
			jQuery("#filter-countries .dropdown-menu").append(
				"<li><a filter-type=\"country\" filter-data=\"" + data + "\">" + country + " (" + jobs + ")</a></li>"
			);
		});
		function update_filters() {
			ventures.forEach(function(venture) {
				var jobs = jQuery(".job.venture-" + venture.toLowerCase().replace(" ", "_").replace("á", "a") + ":visible").length;
				var data = venture + "," + venture.split(" ")[0];
				if( jobs>0 ) {
					jQuery("#filter-ventures a[filter-data='" + data + "']").html(venture + " (" + jobs + ")").show();
				} else {
					jQuery("#filter-ventures a[filter-data='" + data + "']").hide();
				}
			});
			expertises.forEach(function(expertise) {
				var jobs = jQuery(".job.expertise-" + expertise.id + ":visible").length;
				var data = expertise.id + "," + expertise.name;
				if( jobs>0 ) {
					jQuery("#filter-expertises a[filter-data='" + data + "']").html(expertise.name + " (" + jobs + ")").show();
				} else {
					jQuery("#filter-expertises a[filter-data='" + data + "']").hide();
				}
			});
			countries.forEach(function(country) {
				var jobs = jQuery(".job.country-" + country.toLowerCase() + ":visible").length;
				var data = country + "," + country;
				if( jobs>0 ) {
					jQuery("#filter-countries a[filter-data='" + data + "']").html(country + " (" + jobs + ")").show();
				} else {
					jQuery("#filter-countries a[filter-data='" + data + "']").hide();
				}
			});
		}
		
		jQuery(".dropdown-menu a").click(function(event) {
			event.preventDefault();
			var element = jQuery(event.currentTarget);
			var button = element.parents(".btn-group").find("button");
			var title = element.attr("filter-data").split(",")[1];
			if( title.length>9 )
				title = title.substr(0, 9) + "&hellip;";
			button.find(".filter-title").html( title );
			button.find(".filter-icon").html("<i class=\"fa fa-fw fa-times\"></i>");
			button.addClass("active").removeAttr("data-toggle")
				.attr("filter-type", element.attr("filter-type"))
				.attr("filter-data", element.attr("filter-data"));
			
			var clss = "." + element.attr("filter-type") + "-" + element.attr("filter-data").split(",")[0];
			jQuery(".job:visible:not(" + clss.toLowerCase().replace(" ", "_").replace("á", "a") + ")").hide(250);
			jQuery(window).scrollTop(jQuery("#jobs").offset().top-jQuery("nav.navbar").height());
			setTimeout(update_filters, 500);
		});
		jQuery("#filters .dropdown-toggle").off("click").click(function(event) {
			event.preventDefault();
			var button = jQuery(event.currentTarget);
			if( !button.find(".filter-icon .fa").hasClass("fa-times") )
				return;
			
			var clss = "", type = button.attr("filter-type");
			var venture = jQuery("#filter-ventures button").attr("filter-data");
			if( venture && type!=="venture" )
				clss += ".venture-" + venture.split(",")[0];
			var expertise = jQuery("#filter-expertises button").attr("filter-data");
			if( expertise && type!=="expertise" )
				clss += ".expertise-" + expertise.split(",")[0];
			var country   = jQuery("#filter-countries button").attr("filter-data");
			if( country && type!=="country" )
				clss += ".country-" + country.split(",")[0];
			
			button.find(".filter-title").html( type.charAt(0).toUpperCase() + type.slice(1) );
			button.find(".filter-icon").html("<i class=\"fa fa-fw fa-caret-down\"></i>");
			button.removeClass("active").removeAttr("filter-type").removeAttr("filter-data").blur();
			jQuery(".job" + clss.toLowerCase().replace(" ", "_").replace("á", "a")).show(250);
			jQuery(window).scrollTop(jQuery("#jobs").offset().top-jQuery("nav.navbar").height());
			setTimeout(function() {
				update_filters(); button.attr("data-toggle", "dropdown").blur();
			}, 500);
		});
	});
	jQuery(function() {
		jQuery(window).scroll(function() {
			var offset = jQuery("#jobs").offset().top-jQuery(window).scrollTop();
			var limit  = jQuery("nav.navbar").height()+jQuery("#filters").height()-jQuery("#jobs").height();
			if( offset<=50 && offset>=limit ) {
				jQuery("#filters").css("top", (50-offset)+"px");
				jQuery("#filters-border").css("marginTop", (20-offset)+"px");
			} else {
				jQuery("#filters").css("top", "0px");
				jQuery("#filters-border").css("marginTop", "-30px");
			}
		}).scroll();
	});
</script>
<style type="text/css">
	body {
		overflow-x: hidden;
	}
	#jobs {
		max-width: 992px;
		margin: 0px -15px;
		padding: 15px 0px 0px;
		background: white;
		overflow: hidden;
	}
	#filters {
		padding: 0px 30px 14px;
		margin-bottom: 16px;
		position: relative;
		z-index: 1030;
	}
	#filters, #filters * {
		background: white;
	}
	#filters-border {
		height:15px;
		margin-top:-30px;
		border-bottom:1px solid #e0e0e0;
		-webkit-box-shadow: 0px 3px 5px 0px rgba(0,0,0,0.1);
		-moz-box-shadow: 0px 3px 5px 0px rgba(0,0,0,0.1);
		box-shadow: 0px 3px 5px 0px rgba(0,0,0,0.1);
		position: absolute;
		width: 300vw;
		left: -150vw;
		z-index: 1029;
	}
	#filters [class^=col-] {
		padding:0px;
		text-align:center;
	}
	#filters [id^=filter-], #filters [id^=filter-] * {
		cursor:pointer;
	}
	#filters button {
		font-size:16px;
		text-align:left;
		text-transform:none;
		letter-spacing:0px;
		border:none;
		box-shadow:none;
	}
	#filters button:focus,
	#filters button.active,
	#filters .open>.btn-default.dropdown-toggle,
	#filters .btn-group>.btn:active {
		font-weight:bold;
	}
	#filters button:focus,
	#filters button.active,
	#filters .open>.btn-default.dropdown-toggle,
	#filters .btn-group>.btn:active,
	#filters .btn-group>.btn:hover {
		outline:none !important;
		background:white !important;
	}
	#filters .dropdown-menu {
		border:none;
		border-radius:2px;
		font-size:16px;
	}
	#filters .dropdown-menu a {
		padding:5px 20px;
	}
	.job {
		margin:0px;
		padding:5px 0px;
		border:none;
		border-bottom:1px solid #e0e0e0;
		border-left-width:2.5px;
		border-left-style:solid;
		display:block;
	}
	.job.venture-polymath_ventures {
		border-left-color:#f7403a;
	}
	.job.venture-aflore {
		border-left-color:#50c700;
	}
	.job.venture-autolab {
		border-left-color:#00c473;
	}
	.job.venture-mesa {
		border-left-color:#fbb943;
	}
	.job.venture-taximo {
		border-left-color:#000000;
	}
	.job.venture-vincuventas {
		border-left-color:#019da3;
	}
	.job .venture-image {
		width:30%;
	}
	.job .job-data {
		width:70%;
	}
	.job .venture-image, .job .job-data {
		height:125px;
		padding:5px 0px;
		position:relative;
		float:left;
	}
	.job .venture-image {
		background:white;
		background-size:70% !important;
		background-position:center !important;
		background-repeat:no-repeat !important;
	}
	.job .job-data {
		padding-right:15px;
		display:table;
	}
	.job .job-data>div {
		line-height:17px;
		vertical-align:middle;
	}
	.job .job-data>.xs-data {
		display:table-cell;
	}
	.job .job-data>[class^=sm-data-] {
		display:none;
	}
	.job .title {
		color:#666;
		font-size:18px;
		text-transform:uppercase;
	}
	.job .venture {
		color:#888;
		font-size:16px;
	}
	.job .expertise, .job .location {
		color:#888;
		font-size:14px;
	}
	@media(min-width:800px) {
		#jobs {
			margin:0px auto;
		}
		#filters .col-xs-4 {
			text-align:left;
		}
		#filters .col-xs-4:nth-of-type(1) {
			width:34%;
			margin-right:7.5px;
			margin-left:calc(15% - 7.5px);
		}
		#filters .col-xs-4:nth-of-type(2) {
			width:25.5%;
		}
		#filters .col-xs-4:nth-of-type(3) {
			width:calc(25.5% - 7.5px);
			margin-left:7.5px;
		}
		#filters button {
			padding:9px 0px;
			font-size:18px;
		}
		.job {
			padding:10px 0px;
			border-top:1px solid transparent;
			border-left-color:white !important;
		}
		.job.venture-polymath_ventures .venture-image {
			border-left:2.5px solid #f7403a;
		}
		.job.venture-aflore .venture-image {
			border-left:2.5px solid #50c700;
		}
		.job.venture-autolab .venture-image {
			border-left:2.5px solid #00c473;
		}
		.job.venture-mesa .venture-image {
			border-left:2.5px solid #fbb943;
		}
		.job.venture-taximo .venture-image {
			border-left:2.5px solid #000000;
		}
		.job.venture-vincuventas .venture-image {
			border-left:2.5px solid #019da3;
		}
		.job .venture-image, .job .job-data {
			height:75px;
			padding:5px 0px;
			position:relative;
			float:left;
		}
		.job .venture-image {
			width:15%;
		}
		.job .job-data {
			width:85%;
		}
		.job .job-data>.xs-data {
			display:none;
		}
		.job .job-data>[class^=sm-data-] {
			vertical-align:middle;
			display:table-cell;
		}
		.sm-data-40 {
			width:40%;
		}
		.sm-data-40:hover .title, .sm-data-40:hover .venture {
			color:#000;
		}
		.sm-data-30 {
			width:30%;
		}
		.job .expertise, .job .location {
			font-size:16px;
		}
	}
</style>
</div>
