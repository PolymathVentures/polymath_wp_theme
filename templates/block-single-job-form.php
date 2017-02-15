<?php
	$form     = get_greenhouse_form( $wp_query->query_vars['job_id'] );
	$phone    = array_values(array_filter($form, function($field) { return strcasecmp($field["label"], "Phone")===0; }))[0];
	$resume   = array_values(array_filter($form, function($field) { return strcasecmp($field["label"], "Resume/CV")===0; }))[0];
	$cover    = array_values(array_filter($form, function($field) { return strcasecmp($field["label"], "Cover Letter")===0; }))[0];
	$linkedin = array_values(array_filter($form, function($field) { return strcasecmp($field["label"], "LinkedIn Profile")===0; }))[0];

	$main_fields = ["first name", "last name", "email", "phone", "linkedin profile", "resume/cv", "cover letter"];
?>

<style type="text/css">
	#form-section hr {
		margin-top:0px;
	}
	#form-section .app-field {
		margin-bottom:15px;
	}
	#form-section .app-field label i {
		font-size:12px; font-weight:normal; color:gray;
	}
	#form-section .app-field textarea {
		height:100px; resize:none;
	}
	#form-section .form-control {
		color:black;
	}
	#form-section .app-field:not(.has-error) .form-control:focus {
		border-color:#49c3b1;
		box-shadow:inset 0 1px 1px rgba(0,0,0,0.075), 0 0 8px rgba(73,195,177,0.6);
		-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,0.075), 0 0 8px rgba(73,195,177,0.6);
		}
	#form-section #btn-submit {
		width:250px; font-weight:bold;
	}
	#form-section input[type=file] {
		width:0.1px; height:0.1px; opacity:0; overflow:hidden; position:absolute; z-index:-1;
	}
	#form-section .file-label img {
		width:25px; height:25px; margin:10px; cursor:pointer;
	}
	#form-section [id^=filename] {
		display:none; cursor:default;
	}
	#form-section .attach-icon {
		width:18px; height:18px; position:relative; top:-2px;
	}
	#form-section .file-clear {
		font-size:24px; line-height:18px; font-weight:bold; color:#49c3b1; position:relative; top:2px; right:5px; float:right; cursor:pointer;
	}
</style>
<script type="text/javascript">
	jQuery(function() {
		if( /#(.*)$/.test(window.location.href) ) {
			var utm   = window.location.href.match(/#(.*)$/)[1];
			var input = "<input type=\"hidden\" name=\"mapped_url_token\" value=\"" + utm + "\">";
			jQuery("#application-form").prepend( input );
		}

		// File fields tooltips
		jQuery("[data-toggle=tooltip]").tooltip();

		// File fields change event
		jQuery(".file-option input[type=file]").change(function(event) {
			var field_id = jQuery(event.target).attr("id").replace("file-", "");
			if( jQuery(event.target)[0].files.length!=1 ) {
				jQuery("#filename-" + field_id + " .file-clear").click(); return;
			}

			var filename = jQuery(event.target)[0].files[0].name;
			if( !/\.(pdf|doc|docx|txt|rtf)$/.test(filename) ) {
				alert("Invalid file format selected!\n\nAllowed formats are: pdf, doc, docx, txt, rtf");
				jQuery("#filename-" + field_id + " .file-clear").click(); return;
			}

			jQuery(event.target).parents(".app-field").find(".file-option").hide();
			jQuery("label[for=file-" + field_id + "]").hide();
			jQuery(event.target).parents(".file-option").show();
			jQuery("#filename-" + field_id + " .filename").html( filename );
			jQuery("#filename-" + field_id).show();
		});

		// File fields clear event
		jQuery(".file-clear").click(function(event) {
			var field_id = jQuery(event.target).parents(".file-option").find("input").attr("id").replace("file-", "");
			jQuery("#file-" + field_id).wrap("<form>").closest("form").get(0).reset(); jQuery("#file-" + field_id).unwrap();

			jQuery("#filename-" + field_id).hide();
			jQuery("label[for=file-" + field_id + "]").show();
			jQuery(event.target).parents(".app-field").find(".file-option").show();

			event.stopPropagation(); event.preventDefault();
		});

		// File fields paste event
		jQuery(".paste-option").click(function(event) {
			var field = jQuery(event.target).parents(".file-option").find("textarea");
			if( field.css("display")==="none" ) {
				field.show(250, function() { field.focus(); });
			} else {
				field.hide(250);
			}
		});

		// Form submit event
		jQuery("#application-form #btn-submit").click(function(event) {
			var invalid = false; jQuery(".app-field").removeClass("has-error");
			jQuery("#application-form").find("input[required], textarea[required], select[required]").each(function(idx, element) {
				if( !jQuery(element).val() ) {
					jQuery(element).parents(".app-field").addClass("has-error");
					if( !invalid ) jQuery(element).focus();
					invalid = true;
				}
			});
			if( invalid ) { event.preventDefault(); return; }
		});
	});
</script>
<form id="application-form" method="POST" action="//scripts.polymathv.com/apply" enctype="multipart/form-data">
	<input type="hidden" name="jobid" value="<?=$wp_query->query_vars['job_id']?>">
	<h3 class="text-bold" style="margin:0px 0px 25px;">Apply for this job</h3>
	<div class="row">
		<div class="col-xs-12 col-sm-6 app-field">
			<label>First Name</label>
			<input type="text" name="first_name" class="form-control" required>
		</div>
		<div class="col-xs-12 col-sm-6 app-field">
			<label>Last Name</label>
			<input type="text" name="last_name" class="form-control" required>
		</div>
		<div class="col-xs-12 col-sm-6 app-field">
			<label>Email</label>
			<input type="email" name="email" class="form-control" required>
		</div>
		<div class="col-xs-12 col-sm-6 app-field">
			<label>Phone <?=($phone["required"] ? "" : "&nbsp;&nbsp;<i>Optional</i>")?></label>
			<input type="text" name="phone" class="form-control" <?=($phone["required"] ? "required" : "")?>>
		</div>
		<div class="col-xs-12 app-field">
			<label>LinkedIn Profile <?=($linkedin["required"] ? "" : "&nbsp;&nbsp;<i>Optional</i>")?></label>
			<input type="text" name="<?=$linkedin["fields"][0]["name"]?>" class="form-control" <?=($linkedin["required"] ? "required" : "")?>>
		</div>
		<div class="col-xs-12 col-sm-6 app-field">
			<label>Resume / CV <?=($resume["required"] ? "" : "&nbsp;&nbsp;<i>Optional</i>")?></label><br>
			<span class="file-option">
				<!-- FILE ATTACHMENT -->
				<input type="file" name="resume" id="file-cv" accept=".pdf, .doc, .docx, .txt, .rtf">
				<label for="file-cv" class="file-label" data-toggle="tooltip" data-placement="bottom" title="Attach">
					<img src="<?php echo get_template_directory_uri(); ?>/dist/images/file-attach.png" class="attach-option">
				</label>
				<span id="filename-cv">
					<img src="<?php echo get_template_directory_uri(); ?>/dist/images/file-attach.png" class="attach-icon">&nbsp;
					<span class="filename"></span>&nbsp;
					<span class="file-clear">&times;</span>
				</span>
			</span>
			<span class="file-option">
				<!-- PASTE ATTACHMENT -->
				<label class="file-label" data-toggle="tooltip" data-placement="bottom" title="Paste">
					<img src="<?php echo get_template_directory_uri(); ?>/dist/images/file-paste.png" class="paste-option">
				</label>
				<textarea name="resume_text" class="form-control" style="display:none;"></textarea>
			</span>
		</div>
		<div class="col-xs-12 col-sm-6 app-field">
			<label>Cover Letter <?=($cover["required"] ? "" : "&nbsp;&nbsp;<i>Optional</i>")?></label><br>
			<span class="file-option">
				<!-- FILE ATTACHMENT -->
				<input type="file" name="cover_letter" id="file-cover" accept=".pdf, .doc, .docx, .txt, .rtf">
				<label for="file-cover" class="file-label" data-toggle="tooltip" data-placement="bottom" title="Attach">
					<img src="<?php echo get_template_directory_uri(); ?>/dist/images/file-attach.png" class="attach-option">
				</label>
				<span id="filename-cover">
					<img src="<?php echo get_template_directory_uri(); ?>/dist/images/file-attach.png" class="attach-icon">&nbsp;
					<span class="filename"></span>&nbsp;
					<span class="file-clear">&times;</span>
				</span>
			</span>
			<span class="file-option">
				<!-- PASTE ATTACHMENT -->
				<label class="file-label" data-toggle="tooltip" data-placement="bottom" title="Paste">
					<img src="<?php echo get_template_directory_uri(); ?>/dist/images/file-paste.png" class="paste-option">
				</label>
				<textarea name="cover_letter_text" class="form-control" style="display:none;"></textarea>
			</span>
		</div>
	</div>
	<hr>
	<div class="row">
		<?php foreach( $form as $field ) { ?>
			<?php if( in_array(strtolower($field["label"]), $main_fields) ) continue; ?>
			<?php
				if( $field["fields"][0]["type"]=="multi_value_single_select" ) { ?>
					<div class="col-xs-12 col-sm-6 app-field">
				<?php } else { ?>
					<div class="col-xs-12 app-field">
				<?php } ?>
				<label><?=$field["label"]?> <?=($field["required"] ? "" : "&nbsp;&nbsp;<i>Optional</i>")?></label>
				<?php if( $field["fields"][0]["type"]=="multi_value_single_select" ) { ?>
					<select name="<?=$field["fields"][0]["name"]?>" class="form-control" <?=($field["required"] ? "required" : "")?>>
						<option value="">Please select</option>
						<?php foreach( $field["fields"][0]["values"] as $option ) { ?>
							<option value="<?=$option["value"]?>"><?=$option["label"]?></option>
						<?php } ?>
					</select>
				<?php } else if( $field["fields"][0]["type"]=="textarea" ) { ?>
					<textarea name="<?=$field["fields"][0]["name"]?>" class="form-control" <?=($field["required"] ? "required" : "")?>></textarea>
				<?php } else if( $field["fields"][0]["type"]=="input_text" ) { ?>
					<input type="text" name="<?=$field["fields"][0]["name"]?>" class="form-control" <?=($field["required"] ? "required" : "")?>>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
	<div class="row">
		<div class="col-xs-12 text-right" style="margin-top:25px;">
			<button class="btn btn-danger" id="btn-submit">SUBMIT APPLICATION</button>
		</div>
	</div>
</form>
