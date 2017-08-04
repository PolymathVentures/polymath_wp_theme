<div class="modal fade" id="modal-mc-newsletter" tabindex="-1" role="dialog" data-backdrop="false">
	<style type="text/css">
		.modal#modal-mc-newsletter {
			text-align:center;
			font-size:2.5vh;
			color:white;
			background:rgba(0,0,0,0.75);
		}
		.modal#modal-mc-newsletter:before {
			height:100%;
			margin-right:-5px;
			vertical-align:middle;
			display:inline-block;
			content:" ";
		}
		.modal#modal-mc-newsletter .modal-dialog {
			text-align:left;
			vertical-align:middle;
			display:inline-block;
		}
		.modal#modal-mc-newsletter .modal-content {
			border:none;
			border-radius:0px;
			outline:none;
			box-shadow:none;
			background:#62c5bb;
		}
		.modal#modal-mc-newsletter .modal-body {
			padding:5vh;
		}
		.modal#modal-mc-newsletter h1 {
			margin:0px;
			font-size:4vh;
			font-style:italic;
			font-weight:bold;
		}
		.modal#modal-mc-newsletter #mc-form {
			margin-bottom:10vh;
		}
		.modal#modal-mc-newsletter #mc-form * {
			width:100%;
			margin:0px;
		}
		.modal#modal-mc-newsletter #mc-form input {
			margin:1vh 0px 1.5vh;
			padding:0.5vh 1vh;
			color:#201b3d;
			border:1px solid rgba(32,27,61,0.5);
			border-radius:0px;
			outline:none;
			box-shadow:none;
			background:transparent;
		}
		.modal#modal-mc-newsletter #mc-form button {
			padding:1vh;
			font-size:3vh;
			font-weight:bold;
			color:#62c5bb;
			text-transform:uppercase;
			border:none;
			border-radius:0px;
			outline:none;
			background:white;
		}
		.modal#modal-mc-newsletter #mc-form input::placeholder {
			color:rgba(32,27,61,0.5);
		}
		.modal#modal-mc-newsletter .modal-body .modal-dismiss {
			font-size:2vh;
			text-decoration:underline;
			cursor:pointer;
			position:absolute;
			left:2.5vh;
			bottom:2.5vh;
		}
		@media(min-width:768px) {
			.modal#modal-mc-newsletter .modal-body {
				padding:7.5vh 10vh;
			}
			.modal#modal-mc-newsletter h1 {
				font-size:6vh;
			}
			.modal#modal-mc-newsletter #mc-form {
				margin-bottom:5.5vh;
				border-bottom:1px solid #201b3d;
			}
			.modal#modal-mc-newsletter #mc-form input {
				width:65%;
				margin:0px;
				text-align:left;
				font-size:3vh;
				border:none;
			}
			.modal#modal-mc-newsletter #mc-form button {
				width:calc(35% - 0.5vh);
				margin:0px;
				padding:5px 15px;
				color:white;
				font-weight:bold;
				text-transform:none;
				background:#201b3d;
			}
		}
	</style>
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<h1>
					GET OUR NEWSLETTER<br>
					BE THE FIRST TO READ WHAT WE'RE SAYING
				</h1>
				<span>Don't worry, we won't spam you.</span><br><br>
				<div id="mc-form">
					<input type="email" placeholder="your@emailaddress.com">
					<button type="button">Subscribe</button>
				</div>
				<div class="modal-dismiss">No thanks, I don't want information about entrepreneurship.</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		jQuery(function() {
			var mc_newsletter; document.cookie.split(";").some(function(cookie) {
				if( cookie.trim().split("=")[0]==="mc_newsletter" ) {
					mc_newsletter = cookie.trim().split("=")[1]; return true;
				}
			});
			var timeout = 30;
			if( mc_newsletter && mc_newsletter!=="infinite" && Date.now()>=mc_newsletter )
				timeout = 1;
			setTimeout(function() {
				jQuery("html").css("overflow", "hidden");
				jQuery(".modal#modal-mc-newsletter").modal();
			}, timeout*1000);

			jQuery(".modal#modal-mc-newsletter .modal-dismiss").click(function() {
				var d = new Date(); d.setTime(d.getTime() + 7*24*60*60*1000);
				document.cookie = "mc_newsletter=" + d.getTime() + ";expires=" + d.toUTCString();
				jQuery(".modal#modal-mc-newsletter").modal("hide");
				jQuery("html").css("overflow", "");
			});
			jQuery(".modal#modal-mc-newsletter #mc-form button").click(function() {
				var EMAIL = jQuery(".modal#modal-mc-newsletter #mc-form input").val();
				if( !/(\w|-|\.)+@(\w+\.)+[a-z]+/.test(EMAIL) ) {
					alert("Invalid email!"); return;
				}

				var URL = "http://scripts.polymathv.com/helpers/mailchimp.php?subscribe=newsletter";
				jQuery.post(URL, {"email":EMAIL}, function(response) {
					document.cookie = "mc_newsletter=" + Date.now() + ";expires=Tue, 19 Jan 2038 00:00:00 GMT;"
					jQuery(".modal#modal-mc-newsletter").modal("hide");
					jQuery("html").css("overflow", "");
				});
			});
		});
	</script>
</div>
