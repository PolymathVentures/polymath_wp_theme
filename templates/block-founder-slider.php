<?php
$founders = new WP_query([
	"posts_per_page" => -1,
	"orderby"        => "meta_value_num title",
	"meta_key"		   => "order",
	"post_type"		   => "team_members",
	"order"          => "ASC",
	"post_status"    => "publish",
	"tax_query"      => [[
		"taxonomy" => "job_role",
		"field"    => "id",
		"terms"    => 20
	]]
]);
$founders = array_filter($founders->posts, function($founder) {
	return get_post_field("order", $founder->ID);
});
?>
<div id="block-founder-slider">
<?php for( $i=0; $i<2; $i++ ) { ?>
<?php foreach( $founders as $founder ) { ?>

<?php $person    = formatPersonInfo( $founder ); ?>
<?php $countries = implode(" ", array_map(function($tag) { return strtolower($tag->name); }, wp_get_post_tags($founder->ID)) ?: []); ?>
<?php $country   = "<span class=\"small\" style=\"opacity:0.6; position:relative; top:-5px;\">".strtoupper($countries)."</span>"; ?>
<?php
	if( $founder->post_title=="Edgar Aguilar" )
		$person["title"] = $founder->post_title."<br><span class=\"small\">Venture Founder @ Polymath</span>";
?>

<div class="team-member responsive-bg"
	data-bg-json='<?= json_encode(format_attachment_sizes_array(get_post_thumbnail_id($founder->ID))) ?>'>
	<span id="person-<?= $founder->ID ?>" class="anchor"></span>
	<article class="team-member-info-overlay content-padding-wrapper show-person-modal"
		data-title="<?= htmlspecialchars($person["title"]); ?><?= strpos($countries, " ")===false ? "<br>".htmlspecialchars($country) : "" ?>"
		data-description="<?= htmlspecialchars($person["full_description"]) ?>"
		data-picture="<?= $person["image"]["sizes"]["original"] ?>">
		<div class="content-padding">
			<h3><?= $person["title"] ?></h3>
		</div>
	</article>
</div>

<?php } } ?>

<script type="text/javascript">
	jQuery(function() {
		// Person modal start/stop
		jQuery(".modal#person-modal").on("show.bs.modal", function() {
			jQuery(".block-founder-slider #block-founder-slider").addClass("pause");
		}).on("shown.bs.modal", function() {
			jQuery(".block-founder-slider #block-founder-slider").addClass("pause");
		}).on("hidden.bs.modal", function() {
			jQuery(".block-founder-slider #block-founder-slider").removeClass("pause");
		});
	});
</script>

<style type="text/css">
	@-webkit-keyframes slider-xs {
		from { transform: translateX(0vw); }
		to { transform: translateX(-250vw); }
	}
	@-moz-keyframes slider-xs {
		from { transform: translateX(0vw); }
		to { transform: translateX(-250vw); }
	}
	@-o-keyframes slider-xs {
		from { transform: translateX(0vw); }
		to { transform: translateX(-250vw); }
	}
	@keyframes slider-xs {
		from { transform: translateX(0vw); }
		to { transform: translateX(-250vw); }
	}
	@-webkit-keyframes slider-md {
		from { transform: translateX(0vw); }
		to { transform: translateX(-125vw); }
	}
	@-moz-keyframes slider-md {
		from { transform: translateX(0vw); }
		to { transform: translateX(-125vw); }
	}
	@-o-keyframes slider-md {
		from { transform: translateX(0vw); }
		to { transform: translateX(-125vw); }
	}
	@keyframes slider-md {
		from { transform: translateX(0vw); }
		to { transform: translateX(-125vw); }
	}
	.block-founder-slider .container {
		width: 100vw;
		padding: 0px;
		background: white;
	}
	.block-founder-slider .block-content,
	.block-founder-slider .extra-padding-vertical {
		margin: 0px;
	}
	.block-founder-slider #block-founder-slider {
		width: 100vw;
		position: relative;
	}
	.block-founder-slider #block-founder-slider.pause,
	.block-founder-slider #block-founder-slider:hover {
		animation-play-state: paused;
	}
	.block-founder-slider .team-member:nth-of-type(n+<?= count($founders)+1 ?>) {
		display: none;
	}
	.block-founder-slider .team-member,
	.block-founder-slider .team-member article {
		width: 20vw;
		height: 30vw;
		padding: 10px;
		overflow: hidden;
	}
	.block-founder-slider .team-member article .content-padding {
		margin: 0px;
		padding: 0px;
	}
	.block-founder-slider .team-member article h3 {
		font-size: 20px;
	}
	.block-founder-slider .team-member {
		float: left;
		background-size: cover;
		background-position: center;
		display: inline-block;
		position: relative;
	}
	.block-founder-slider .team-member article {
		position: absolute;
		top: 0px;
		right: 0px;
		bottom: 0px;
		left: 0px;
	}
	.block-founder-slider .team-member article * {
		display: none;
	}
	@media(min-width: 768px) {
		.block-founder-slider #block-founder-slider {
			width: 250vw;
			-webkit-animation: slider-md 15s linear infinite;
			-moz-animation:    slider-md 15s linear infinite;
			-o-animation:      slider-md 15s linear infinite;
			animation:         slider-md 15s linear infinite;
		}
		.block-founder-slider .team-member:nth-of-type(n+<?= count($founders->posts) ?>) {
			display: initial;
		}
		.block-founder-slider .team-member,
		.block-founder-slider .team-member article {
			width: 12.5vw;
			height: 18.75vw;
		}
		.block-founder-slider .team-member article * {
			display: initial;
		}
	}
</style>
</div>