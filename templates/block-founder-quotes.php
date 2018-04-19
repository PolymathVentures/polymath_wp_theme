<div id="block-founder-quotes">
<div class="carousel slide" id="carousel-founders">
	<ol class="carousel-indicators"></ol>
	<div class="carousel-inner" role="listbox"></div>
	<div class="quote-founder">
		<div>
			<img src="https://files.polymathv.com/assets/carousel-quote.png" class="quote-icon">
			<div class="quote-content"><i></i></div>
			<b class="quote-name"></b><br>
			<div class="quote-title"></div>
			<div class="quote-text"></div>
		</div>
	</div>
	<a class="left carousel-control hidden-xs hidden-sm" href="#carousel-founders" role="button" data-slide="prev">
		<img src="https://files.polymathv.com/assets/carousel-arrow-left.png" aria-hidden="true">
		<span class="sr-only">Previous</span>
	</a>
	<a class="right carousel-control hidden-xs hidden-sm" href="#carousel-founders" role="button" data-slide="next">
		<img src="https://files.polymathv.com/assets/carousel-arrow-right.png" aria-hidden="true">
		<span class="sr-only">Next</span>
	</a>
</div>

<script type="text/javascript" src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery("a").click(function() { window.location.href = jQuery(this).attr("href"); });
		var $QUOTES = [{
			"name": "Nicolás Azcuénaga",
			"background": "https://polymathv.com/wp-content/uploads/Nicolas_Azcuenaga.jpg",
			"quote": "I saw my learning curve decreasing in my previous job and I was motivated to innovate",
			"title": "Founder &amp; CEO at <a href=\"/ventures/autolab\" target=\"_self\">Autolab</a>",
			"text": "After many years of working in the corporate sector, occupying important roles at BP, Nicolás came back to Colombia in the search for change and innovation. He took on the challenge to change the way informal sectors like car repairs shops are managed in Colombia. Today, Autolab has served more than 14,000 customers and delivered more than 28,000 car repairs."
		},{
			"name": "Salomón Stroh",
			"background": "https://polymathv.com/wp-content/uploads/Salomónfounder.jpg",
			"quote": "Polymath Ventures came at a critical moment where I was contemplating leaving the entrepreneurial journey",
			"title": "Founder &amp; CPO at <a href=\"/ventures/taximo\" target=\"_self\">Táximo</a>",
			"text": "Salomón is a serial entrepreneur. He has founded several companies in various sectors including commerce, services, and flowers. At Polymath Ventures, Salomón found a solution for one of the biggest problems he came upon when building his own companies: creating a solid, high-output team. Today, at Táximo, he operates more than 700 vehicles across 4 cities in 2 countries in Latin America."
		}, {
			"name": "Ana Barrera",
			"background": "https://polymathv.com/wp-content/uploads/Aflore_story_5-1.jpg",
			"quote": "Today I can say that I am where I wanted to be",
			"title": "Founder &amp; CEO at <a href=\"/ventures/aflore\" target=\"_self\">Aflore</a>",
			"text": "After many years working in trading in the UK, Ana decided she wanted to come back to her home country to invest her time into something more impactful. Today, with Ana’s leadership, Aflore, a financial services company, manages a loan portfolio of over US $3M, providing needed loans to more than 4.000 clients."
		}];
		$QUOTES.forEach(function(quote, idx) {
			var background = "<div class=\"item-bg\" style=\"background-image: url(" + quote.background + ");\"></div>";
			var indicator = "<li data-target=\"#carousel-founders\" data-slide-to=\"" + idx + "\"" + (idx==0 ? " class=\"active\"" : "") + "></li>";
			jQuery("#carousel-founders .carousel-indicators").append(indicator);
			jQuery("#carousel-founders .carousel-inner").append("<div class=\"item" + (idx==0 ? " active" : "") + "\">" + background + "</div>");
		});

		function update_carousel_founders( idx ) {
			jQuery("#carousel-founders .quote-founder").data( $QUOTES[idx] );
			jQuery("#carousel-founders .quote-founder *").animate({"opacity": 0}, 100, function() {
				jQuery("#carousel-founders .quote-content i").html( jQuery("#carousel-founders .quote-founder").data("quote") + "\"" );
				jQuery("#carousel-founders .quote-name").html( jQuery("#carousel-founders .quote-founder").data("name") );
				jQuery("#carousel-founders .quote-title").html( jQuery("#carousel-founders .quote-founder").data("title") );
				jQuery("#carousel-founders .quote-text").html( jQuery("#carousel-founders .quote-founder").data("text") );

				jQuery("#carousel-founders .quote-founder *").animate({"opacity": 1}, 100);
			});
		}

		jQuery("#carousel-founders").carousel({"interval": 30000});
		jQuery("#carousel-founders").on("slide.bs.carousel", function(event) {
			update_carousel_founders( jQuery(event.relatedTarget).index() );
		});
		update_carousel_founders(0);

		jQuery(".ui-link[href=#]").click(function() {
			jQuery("html, body").animate({
				"scrollTop": jQuery(".block-founder-jobs").offset().top-65
			}, 1000);
		});

		if( window.outerWidth<768 ) {
			jQuery(".block-founder-quotes .carousel").swiperight(function() {
				jQuery(this).carousel("prev");
			});
			jQuery(".block-founder-quotes .carousel").swipeleft(function() {
				jQuery(this).carousel("next");
			});
		}
	});
</script>

<style type="text/css">
	@keyframes pulsed {
		from {
			transform: scale3d(1, 1, 1);
		}
		50% {
			transform: scale3d(1.05, 1.05, 1.05);
		}
		to {
			transform: scale3d(1, 1, 1);
		}
	}

	.block-founder-quotes .container {
		width: 100vw;
		padding: 0px;
		background: white;
	}
	.block-founder-quotes .block-content,
	.block-founder-quotes .extra-padding-vertical {
		margin: 0px;
	}
	.block-founder-quotes .carousel-indicators {
		top: 10px;
	}
	.block-founder-quotes .carousel-indicators li {
		margin: 1px 5px;
	}
	.block-founder-quotes .carousel-indicators :not(.active) {
		border: #ccc;
		background: #ccc;
	}
	.block-founder-quotes .item-bg {
		width: 100vw;
		height: 85vw;
		background-size: cover;
		background-position: center top;
	}
	.block-founder-quotes .quote-founder {
		width: 95vw;
		min-height: 365px;
		margin: -50px 2.5vw 2.5vw;
		padding: 0px 15px 15px;
		text-align: left;
		font-size: 14px;
		text-transform: none;
		color: white;
		background: #62c5bb;
		position: relative;
	}
	.block-founder-quotes .quote-icon {
		width: 18px;
		display: inline-block;
		position: relative;
		top: 15px;
	}
	.block-founder-quotes .quote-content {
		width: calc(100% - 30px);
		margin-left: 23px;
		margin-bottom: 20px;
		font-size: 20px;
		line-height: 20px;
		display: inline-block;
	}
	.block-founder-quotes .quote-name {
		font-size: 20px;
	}
	.block-founder-quotes .quote-title {
		font-size: 15px;
		line-height: 20px;
	}
	.block-founder-quotes .quote-title a {
		color: white;
		text-decoration: underline;
	}
	.block-founder-quotes .quote-title a:hover {
		opacity: 0.8 !important;
	}
	.block-founder-quotes .quote-text {
		margin-top: 20px;
		font-size: 14px;
		line-height: 20px;
	}
	.block-founder-quotes .carousel-control {
		width: 25px;
		background-image: none;
		opacity: 1;
		animation-name: pulsed;
		animation-duration: 1.5s;
		animation-iteration-count: infinite;
	}
	.block-founder-quotes .carousel-control img {
		display: inline-block;
		position: absolute;
		top: 50%;
		transform: translateY(-50%);
	}
	@media(min-width:768px) {
		.block-founder-quotes .carousel-indicators {
			display: none;
		}
		.block-founder-quotes .item-bg,
		.block-founder-quotes .carousel-overlay {
			width: 70vw;
			height: 500px;
		}
		.block-founder-quotes .quote-founder {
			width: 60vw;
			height: 400px;
			min-height: unset;
			margin: 0px;
			padding: 15px 50px;
			display: table;
			position: absolute;
			top: 50px;
			right: 0px;
		}
		.block-founder-quotes .quote-founder>div {
			display: table-cell;
			vertical-align: middle;
			position: relative;
			top: -10px;
		}
		.block-founder-quotes .quote-content i {
			font-size: 24px;
			letter-spacing: 2px;
		}
		.block-founder-quotes .quote-title,
		.block-founder-quotes .quote-text {
			font-size: 18px;
		}
		.block-founder-quotes .carousel-control.left {
			left: 2.5vw;
		}
		.block-founder-quotes .carousel-control.right {
			right: 60vw;
		}
	}
	@media(min-width:992px) {
		.block-founder-quotes .quote-founder {
			width: 50vw;
			height: 400px;
		}
		.block-founder-quotes .carousel-control.right {
			right: 50vw;
		}
	}
	@media(min-width:1200px) {
		.block-founder-quotes .quote-founder {
			width: 40vw;
			height: 400px;
		}
		.block-founder-quotes .carousel-control.right {
			right: 40vw;
		}
	}
</style>
</div>
