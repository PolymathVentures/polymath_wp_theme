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
	#form-section .app-field textarea { height:100px; resize:none; }
	#form-section input[type=submit] { width:250px; font-weight:bold; }
	#form-section input[type=file] { width:0.1px; height:0.1px; opacity:0; overflow:hidden; position:absolute; z-index:-1; }
	#form-section .file-label img { width:25px; height:25px; margin:10px; cursor:pointer; }
</style>
<script type="text/javascript">
	jQuery(function() {
		jQuery("[data-toggle=tooltip]").tooltip();

	});
</script>
<form method="POST" action="<?=$green_url?>" enctype="multipart/form-data">
	<div class="row">
		<div class="col-xs-6 text-left">
			<h3 class="text-bold" style="margin:0px 0px 25px;">Apply for this job</h3>
		</div>
		<div class="col-xs-6 text-right">
			<b style="float:right;"><span class="text-red">*</span>&nbsp;Required</b>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-6 app-field">
			<label>First Name <span class="text-red">*</span></label>
			<input type="text" class="form-control" required>
		</div>
		<div class="col-xs-12 col-sm-6 app-field">
			<label>Last Name <span class="text-red">*</span></label>
			<input type="text" class="form-control" required>
		</div>
		<div class="col-xs-12 col-sm-6 app-field">
			<label>Email <span class="text-red">*</span></label>
			<input type="email" class="form-control" required>
		</div>
		<div class="col-xs-12 col-sm-6 app-field">
			<label>Phone <?=($phone["required"] ? "<span class=\"text-red\">*</span>" : "")?></label>
			<input type="text" class="form-control" <?=($phone["required"] ? "required" : "")?>>
		</div>
		<div class="col-xs-12 app-field">
			<label>LinkedIn Profile <?=($linkedin["required"] ? "<span class=\"text-red\">*</span>" : "")?></label>
			<input type="text" class="form-control" <?=($linkedin["required"] ? "required" : "")?>>
		</div>
		<div class="col-xs-12 col-sm-6 app-field">
			<label>Resume / CV <?=($resume["required"] ? "<span class=\"text-red\">*</span>" : "")?></label><br>
			<span class="file-option">
				<!-- FILE ATTACHMENT -->
				<input type="file" name="file-cv" id="file-cv">
				<label for="file-cv" class="file-label" data-toggle="tooltip" data-placement="bottom" title="Attach">
					<img src="<?php echo get_template_directory_uri(); ?>/dist/images/file-attach.png">
				</label>
			</span>
			<span class="file-option">
				<!-- PASTE ATTACHMENT -->
				<label class="file-label" data-toggle="tooltip" data-placement="bottom" title="Paste">
					<img src="<?php echo get_template_directory_uri(); ?>/dist/images/file-paste.png">
				</label>
				<textarea class="form-control" style="display:none;"></textarea>
			</span>
		</div>
		<div class="col-xs-12 col-sm-6 app-field">
			<label>Cover Letter <?=($cover["required"] ? "<span class=\"text-red\">*</span>" : "")?></label><br>
			<span class="file-option">
				<!-- FILE ATTACHMENT -->
				<input type="file" name="file-cover" id="file-cover">
				<label for="file-cover" class="file-label" data-toggle="tooltip" data-placement="bottom" title="Attach">
					<img src="<?php echo get_template_directory_uri(); ?>/dist/images/file-attach.png">
				</label>
			</span>
			<span class="file-option">
				<!-- PASTE ATTACHMENT -->
				<label class="file-label" data-toggle="tooltip" data-placement="bottom" title="Paste">
					<img src="<?php echo get_template_directory_uri(); ?>/dist/images/file-paste.png">
				</label>
				<textarea class="form-control" style="display:none;"></textarea>
			</span>
		</div>
	</div>
	<hr>
	<div class="row">
		<?php foreach( $form as $field ) { if( in_array(strtolower($field["label"]), $main_fields) ) continue; ?>
			<?php if( $field["type"]=="single_select" ) { ?><div class="col-xs-12 col-sm-6 app-field"><?php } else { ?><div class="col-xs-12 app-field"><?php } ?>
				<label><?=$field["label"]?> <?=($field["required"] ? "<span class=\"text-red\">*</span>" : "")?></label>
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
