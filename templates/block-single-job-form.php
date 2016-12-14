<?php
	$form     = get_greenhouse_form( $wp_query->query_vars['job_id'] );
	$phone    = array_values(array_filter($form, function($field) { return strcasecmp($field["label"], "Phone")===0; }))[0];
	$resume   = array_values(array_filter($form, function($field) { return strcasecmp($field["label"], "Resume")===0; }))[0];
	$cover    = array_values(array_filter($form, function($field) { return strcasecmp($field["label"], "Cover Letter")===0; }))[0];
	$linkedin = array_values(array_filter($form, function($field) { return strcasecmp($field["label"], "LinkedIn Profile")===0; }))[0];

	$main_fields = ["first name", "last name", "email", "phone", "linkedin profile", "resume", "cover letter"];
?>

<style type="text/css">
	#form-section hr { margin-top:0px; } #form-section .app-field { margin-bottom:15px; }
	#form-section .app-field label i { font-size:12px; font-weight:normal; color:gray; }
	#form-section .app-field textarea { height:100px; resize:none; }
	#form-section .form-control { color:black; }
	#form-section .form-control:focus { border-color:#49c3b1; -webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,0.075), 0 0 8px rgba(73,195,177,0.6); box-shadow:inset 0 1px 1px rgba(0,0,0,0.075), 0 0 8px rgba(73,195,177,0.6); }
	#form-section input[type=submit] { width:250px; font-weight:bold; }
	#form-section input[type=file] { width:0.1px; height:0.1px; opacity:0; overflow:hidden; position:absolute; z-index:-1; }
	#form-section .file-label img { width:25px; height:25px; margin:10px; cursor:pointer; }
	#form-section [id^=filename] { display:none; cursor:default; }
	#form-section .attach-icon { width:18px; height:18px; position:relative; top:-2px; }
	#form-section .file-clear { font-size:24px; line-height:18px; font-weight:bold; color:#49c3b1; position:relative; top:2px; right:5px; float:right; cursor:pointer; }
</style>
<script type="text/javascript">
	jQuery(function() {
		jQuery("[data-toggle=tooltip]").tooltip();

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

		jQuery(".file-clear").click(function(event) {
			var field_id = jQuery(event.target).parents(".file-option").find("input").attr("id").replace("file-", "");
			jQuery("#file-" + field_id).wrap("<form>").closest("form").get(0).reset(); jQuery("#file-" + field_id).unwrap();

			jQuery("#filename-" + field_id).hide();
			jQuery("label[for=file-" + field_id + "]").show();
			jQuery(event.target).parents(".app-field").find(".file-option").show();

			event.stopPropagation(); event.preventDefault();
		});

		jQuery(".paste-option").click(function(event) {
			var field = jQuery(event.target).parents(".file-option").find("textarea");
			if( field.css("display")==="none" ) {
				field.show(250, function() { field.focus(); });
			} else {
				field.hide(250);
			}
		});
	});
</script>
<form method="POST" action="<?=$green_url?>" enctype="multipart/form-data">
	<h3 class="text-bold" style="margin:0px 0px 25px;">Apply for this job</h3>
	<div class="row">
		<div class="col-xs-12 col-sm-6 app-field">
			<label>First Name</label>
			<input type="text" class="form-control" required>
		</div>
		<div class="col-xs-12 col-sm-6 app-field">
			<label>Last Name</label>
			<input type="text" class="form-control" required>
		</div>
		<div class="col-xs-12 col-sm-6 app-field">
			<label>Email</label>
			<input type="email" class="form-control" required>
		</div>
		<div class="col-xs-12 col-sm-6 app-field">
			<label>Phone <?=($phone["required"] ? "" : "&nbsp;&nbsp;<i>Optional</i>")?></label>
			<input type="text" class="form-control" <?=($phone["required"] ? "required" : "")?>>
		</div>
		<div class="col-xs-12 app-field">
			<label>LinkedIn Profile <?=($linkedin["required"] ? "" : "&nbsp;&nbsp;<i>Optional</i>")?></label>
			<input type="text" class="form-control" <?=($linkedin["required"] ? "required" : "")?>>
		</div>
		<div class="col-xs-12 col-sm-6 app-field">
			<label>Resume / CV <?=($resume["required"] ? "" : "&nbsp;&nbsp;<i>Optional</i>")?></label><br>
			<span class="file-option">
				<!-- FILE ATTACHMENT -->
				<input type="file" name="file-cv" id="file-cv" accept=".pdf, .doc, .docx, .txt, .rtf">
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
				<textarea class="form-control" style="display:none;"></textarea>
			</span>
		</div>
		<div class="col-xs-12 col-sm-6 app-field">
			<label>Cover Letter <?=($cover["required"] ? "" : "&nbsp;&nbsp;<i>Optional</i>")?></label><br>
			<span class="file-option">
				<!-- FILE ATTACHMENT -->
				<input type="file" name="file-cover" id="file-cover" accept=".pdf, .doc, .docx, .txt, .rtf">
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
				<textarea class="form-control" style="display:none;"></textarea>
			</span>
		</div>
	</div>
	<hr>
	<div class="row">
		<?php foreach( $form as $field ) { if( in_array(strtolower($field["label"]), $main_fields) ) continue; ?>
			<?php if( $field["type"]=="single_select" ) { ?><div class="col-xs-12 col-sm-6 app-field"><?php } else { ?><div class="col-xs-12 app-field"><?php } ?>
				<label><?=$field["label"]?> <?=($field["required"] ? "" : "&nbsp;&nbsp;<i>Optional</i>")?></label>
				<?php if( $field["type"]=="single_select" ) { ?>
					<select class="form-control" <?=($field["required"] ? "required" : "")?>>
						<option value="">Please select</option>
						<?php foreach( $field["values"] as $option ) { ?>
							<option value="<?=$option["value"]?>"><?=$option["label"]?></option>
						<?php } ?>
					</select>
				<?php } else if( $field["type"]=="long_text" ) { ?>
					<textarea class="form-control" <?=($field["required"] ? "required" : "")?>></textarea>
				<?php } else if( $field["type"]=="short_text" ) { ?>
					<input type="text" class="form-control" <?=($field["required"] ? "required" : "")?>>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
	<div class="row">
		<div class="col-xs-12 text-right" style="margin-top:25px;">
			<input type="submit" class="btn btn-danger" value="SUBMIT APPLICATION">
		</div>
	</div>
</form>
