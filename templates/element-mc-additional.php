<?php
define(MAILCHIMP_LIST, "");
define(MAILCHIMP_KEY, "");

function get_mailchimp_interests() {
	$curl = curl_init( "https://us3.api.mailchimp.com/3.0/lists/".MAILCHIMP_LIST."132f3e9bde/merge-fields" );
	curl_setopt($curl, CURLOPT_USERPWD, ":".MAILCHIMP_KEY);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$resp = json_decode(curl_exec($curl), true)["merge_fields"]; curl_close( $curl );
	
	return array_values(array_filter($resp, function($field) {
		return $field["tag"]==="BACKGROUND";
	}))[0]["options"]["choices"];
}
$interests = get_mailchimp_interests();
?>
<div class="modal fade" id="modal-mc-additional" tabindex="-1" role="dialog" data-backdrop="false" data-keyboard="false">
	<style type="text/css">
		.modal#modal-mc-additional {
			text-align:center;
			font-size:2.5vh;
			color:white;
			background:rgba(0,0,0,0.75);
		}
		.modal#modal-mc-additional:before {
			height:100%;
			margin-right:-5px;
			vertical-align:middle;
			display:inline-block;
			content:" ";
		}
		.modal#modal-mc-additional .modal-dialog {
			text-align:left;
			vertical-align:middle;
			display:inline-block;
		}
		.modal#modal-mc-additional .modal-content {
			border:none;
			border-radius:0px;
			outline:none;
			box-shadow:none;
			background:#62c5bb;
		}
		.modal#modal-mc-additional .modal-body {
			padding:5vh;
		}
		.modal#modal-mc-additional h1 {
			margin:0px;
			font-size:4vh;
			font-style:italic;
			font-weight:bold;
		}
		.modal#modal-mc-additional h2 {
			margin:0px;
			font-size:3.5vh;
			font-style:italic;
			font-weight:normal;
		}
		.modal#modal-mc-additional #mc-form {
			margin-bottom:10vh;
		}
		.modal#modal-mc-additional #mc-form * {
			width:100%;
			margin:0px;
		}
		.modal#modal-mc-additional #mc-form input,
		.modal#modal-mc-additional #mc-form select {
			margin:1vh 0px 1.5vh;
			padding:0.65vh 1vh;
			color:#201b3d;
			border:1px solid rgba(32,27,61,0.5);
			border-radius:0px;
			outline:none;
			box-shadow:none;
			background:transparent;
		}
		.modal#modal-mc-additional #mc-form select {
			margin:0vh 0px 2.5vh;
		}
		.modal#modal-mc-additional #mc-form select option {
			font-size:14px;
			background:#62c5bb;
		}
		.modal#modal-mc-additional #mc-form button {
			padding:1vh;
			font-size:3vh;
			font-weight:bold;
			color:#62c5bb;
			text-transform:uppercase;
			float:right;
			border:none;
			border-radius:0px;
			outline:none;
			background:white;
		}
		.modal#modal-mc-additional #mc-form input::placeholder,
		.modal#modal-mc-additional #mc-form select {
			color:rgba(32,27,61,0.5);
		}
		.modal#modal-mc-additional .modal-body .modal-dismiss {
			font-size:2vh;
			text-decoration:underline;
			cursor:pointer;
			position:absolute;
			left:2.5vh;
			bottom:2.5vh;
		}
		@media(min-width:768px) {
			.modal-dialog {
				width:55%;
			}
			.modal#modal-mc-additional .modal-body {
				padding:7.5vh 5vh;
			}
			.modal#modal-mc-additional h1 {
				font-size:6vh;
			}
			.modal#modal-mc-additional h2 {
				font-size:5vh;
			}
			.modal#modal-mc-additional #mc-form {
				margin-bottom:5.5vh;
			}
			.modal#modal-mc-additional #mc-form input {
				margin-bottom:5vh;
				border:1px solid transparent;
				border-bottom:1px solid #201b3d;
			}
			.modal#modal-mc-additional #mc-form select {
				width:calc(65% - 0.5vh);
				margin:0px;
				padding:5.5px;
				text-align:left;
				font-size:3vh;
				border:1px solid #201b3d;
			}
			.modal#modal-mc-additional #mc-form button {
				width:calc(35% - 0.5vh);
				margin:0px;
				padding:5px 15px;
				color:white;
				font-weight:bold;
				text-transform:none;
				background:#201b3d;
			}
			.modal#modal-mc-additional #mc-form button:disabled {
				color:lightgray;
				opacity:1;
			}
			.modal#modal-mc-additional #mc-form input:disabled, .modal#modal-mc-additional #mc-form button:disabled {
				cursor:default;
			}
		}
	</style>
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<h1>
					JUST ONE MORE THING
				</h1>
				<span>In order to give you more detailed information, we need to know something about you</span><br><br>
				<div id="mc-form">
					<input type="text" placeholder="LinkedIn (https://linkedin.com/in/your-name)">
					<select name="interest">
						<option disabled selected>What's your background? (choose one)</option>
						<?php foreach( $interests as $interest ) { ?>
							<option value="<?= $interest ?>"><?= $interest ?></option>
						<?php } ?>
					</select>
					<button type="button">
						<span>CONFIRM</span>
						<i class="fa fa-fw fa-check" style="display:none;"></i>
					</button>
				</div>
				<div class="modal-dismiss">No thanks, I don't want front-row seats.</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		jQuery(function() {
			function submit( DATA ) {
				if( !/(\w|-|\.)+@(\w+\.)+[a-z]+/.test(DATA.email) ) {
					alert("Invalid email!"); return;
				}
				
				jQuery(".modal[id^=modal-mc] input, .modal[id^=modal-mc] button").attr("disabled", "disabled");
				var URL = "https://scripts.polymathv.com/helpers/mailchimp.php?subscribe=newsletter";
				jQuery.post(URL, DATA, function(response) {
					document.cookie = "mc_newsletter=infinite;expires=Tue, 01 Jan 2038 00:00:00 GMT;path=/";
					jQuery(".modal#modal-mc-additional select").hide();
					jQuery(".modal#modal-mc-additional input").val("Successfully subscribed!");
					jQuery(".modal#modal-mc-additional button i").show();
					jQuery(".modal#modal-mc-additional button span").hide();
					setTimeout(function() {
						jQuery(".modal#modal-mc-additional").modal("hide");
						jQuery("html").css("overflow", "");
					}, 5000);
				});
			}
			function submit_email() {
				submit({
					"email": jQuery(".modal#modal-mc-newsletter #mc-form input").val()
				});
			}
			function submit_interests() {
				submit({
					"email": jQuery(".modal#modal-mc-newsletter #mc-form input").val(),
					"linkedin": jQuery(".modal#modal-mc-additional #mc-form input").val(),
					"interest": jQuery(".modal#modal-mc-additional #mc-form select").val()
				});
			}
			
			jQuery(".modal#modal-mc-additional .modal-dismiss").click(function() {
				submit_email();
			});
			jQuery(".modal#modal-mc-additional #mc-form button").click(function() {
				var regex = /^((https?:)(\/\/\/?)([\w]*(?::[\w]*)?@)?([\d\w\.-]+)(?::(\d+))?)?([\/\\\w\.()-]*)?(?:([?][^#]*)?(#.*)?)*/gmi;
				var LINKEDIN = jQuery(".modal#modal-mc-additional #mc-form input").val();
				if( !regex.test(LINKEDIN) || !/.*?linkedin\.com\/.*?/.test(LINKEDIN) ) {
					alert("Invalid URL!"); return;
				}
				var INTEREST = jQuery(".modal#modal-mc-additional #mc-form select").val();
				if( !INTEREST ) {
					alert("Select one interest!"); return;
				}
				
				submit_interests();
			});
		});
	</script>
</div>
