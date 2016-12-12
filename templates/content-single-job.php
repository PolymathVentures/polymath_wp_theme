<?php
$job = get_greenhouse_job( $wp_query->query_vars['job_id'] );

$job['content'] = str_replace('<strong>', '<h3>', $job['content']);
$job['content'] = str_replace('</strong>', '</h3>', $job['content']);

$args = array(
	'name'           => $job['offices'][0]['name'],
	'posts_per_page' => 1,
	'post_type'      => 'ventures',
	'post_status'    => array('publish', 'pending'),
);

$venture = get_post_with_custom_fields(get_posts( $args )[0]);

//$cats_url = 'http://polymath.catsone.com/careers/index.php?m=portal&a=apply&jobOrderID=' . $job['id'];
$green_url = 'https://boards.greenhouse.io/polymathventures/jobs/'.$job['id'];
?>

<?php
$params = array(
	'background_image' => array('sizes' => format_attachment_sizes_array(get_post_thumbnail_id($venture['ID']))),
	'overlay_color'    => 'overlay-dark-blue text-white',
	'alignment'        => 'text-center',
	'title'            => $venture['jobs_page_tagline'],
	'title_text_size'  => 'extra-big',
	'text'             => false,
	'button_link'      => '',
	'button_text'      => '',
);
?>

<?php include(locate_template('templates/block-full-width-image.php')); ?>

<div class="container">
	<div class="row">
		<div class="extra-padding-vertical">
			<div class="col-sm-8 border-right" id="job-column">
				<div class="border-bottom extra-padding-horizontal">
					<div class="extra-padding-vertical">
						<img class="pull-right" src="<?php echo $venture['logo']['sizes']['thumbnail']; ?>">
						<h2 class="text-bold">
							<span class="small"><?=$job['departments'][0]['name']?></span><br/>
							<?php echo $job['title']; ?>
						</h2>
						<h3>
							<?php echo $venture['post_title']; ?><br/>
							<span class="small"><?=$job['location']['name']?></span>
						</h3>
					</div>
				</div>
				<div class="border-bottom extra-padding-vertical extra-padding-horizontal">
					<?=html_entity_decode($job['content'])?><br><br>
				</div>
				<div class="extra-padding-horizontal" id="form-section" style="margin-bottom:25px;">
					<?php include(locate_template("templates/block-single-job-form.php")); ?>
				</div>
			</div>
			<div class="col-sm-4" id="float-column">
				<div class="extra-padding-vertical extra-padding-horizontal">
					<p><button class="btn btn-primary" id="tell-friend-button" data-toggle="modal" data-target="#tell-friend-modal">Tell a friend</button></p><br/>
					<?php $share_url = get_job_url($job); ?>
					<p><?php include(locate_template('templates/element-share-buttons.php')); ?></p>
					<p><a href="/about">About Polymath Ventures</a></p>
					<p><a href="<?php echo $venture['website']; ?>" target="_blank"><?php echo $venture['website']; ?></a></p>
					<p><a href="<?php the_permalink(); ?>#block-7">Back to jobs</a></p><br/>
					<a class="btn btn-danger" target="_blank"
						onclick="__gaTracker('send', 'event', 'outbound-article', '<?php echo $green_url; ?>', '<?php echo $job['title']; ?>');"
						href="javascript:scroll_to_form();">
						Apply
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="white">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3 text-center">
				<div class="extra-padding-vertical">
					<h2 class="text-bold">About <?php echo $venture['post_title']; ?></h2>
					<p class="big"><?php echo $venture['description']; ?></p>

					<?php if(get_post_status($venture['ID']) == 'publish'): ?>
						<br/><br/><a href="<?php the_permalink($venture['ID']); ?>" class="btn btn-primary">More about <?php echo $venture['post_title']; ?></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="red">
	<div class="container">
		<?php
			$params = array(
				'maximum_posts' => 4,
				'post_type' => 'promos',
				'filter' => 'type',
				'value' => 'statistic',
				'category' => get_post($venture['ID']),
				'alternating_colors' => false,
				'post_background_color' => 'red',
				'show_images' => false,
				'post_title_text_size' => 'super-big',
				'posts_per_row' => 4,
			);
		?>
		<?php include(locate_template('templates/block-posts.php')); ?>
	</div>
</div>

<div class="white">
	<div class="container text-center">
		<div class="row">
			<div class="col-xs-12">
				<div class="block-content">
					<h2 class="text-bold text-center"><?php echo $venture['post_title']; ?> management team</h2>
					<div class="extra-padding-vertical">
						<?php
							$params = array(
								'type' => 'team',
								'category' => get_post($venture['ID']),
								'role' => (object) array('taxonomy' => 'job_role', 'term_id' => '19'),
								'arrows' => true,
								'arrow_background_color' => 'dark-blue text-white',
								'slides_in_view' => 4,
								'height' => 350,
								'caption_background_color' => 'none text-white',
								'people' => $venture['people']
							);
						?>
						<?php include(locate_template('templates/block-slider.php')); ?>

						<div class="block-content">
							<h2 class="text-bold text-center">Come work with us!</h2><br/><br/>
							<a class="btn btn-danger" target="_blank"
								onclick="__gaTracker('send', 'event', 'outbound-article', '<?php echo $green_url; ?>', '<?php echo $job['title']; ?>');"
								href="javascript:scroll_to_form();">
								Apply
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	jQuery(function() {
		jQuery(window).scroll(function() {
			var job_offset  = jQuery("#job-column").offset().top-jQuery(window).scrollTop();
			var form_offset = jQuery("#form-section").offset().top-jQuery(window).scrollTop();

			if( job_offset>=91 )
				jQuery("#float-column").css("top", "0px");
			else if( form_offset>531 )
				jQuery("#float-column").css("top", jQuery(window).scrollTop()-363 + "px");
		}).scroll();
	});
	
	var scroll_to_form = function() { jQuery("html, body").animate({"scrollTop":jQuery("#form-section").offset().top-151}, 500); };
</script>
