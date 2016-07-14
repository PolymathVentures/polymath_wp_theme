<?php
$job = get_job(cats_jobs(), $wp_query->query_vars['job_id']);
$job['description'] = str_replace('<strong>', '<h3>', $job['description']);
$job['description'] = str_replace('</strong>', '</h3>', $job['description']);

$args = array(
	'posts_per_page'   => 1,
	'meta_key'         => 'catsone_id',
	'meta_value'       => $job['company_id'],
	'post_type'        => 'ventures',
	'post_status'      => array('publish', 'pending'),
);

$venture = get_post_with_custom_fields(get_posts( $args )[0]);
?>

<?php
$params = array(
    'background_image' => array('sizes' => format_attachment_sizes_array(get_post_thumbnail_id($venture['ID']))),
    'overlay_color' => 'overlay-dark-blue text-white',
    'alignment' => 'text-center',
    'title' => $venture['jobs_page_tagline'],
    'title_text_size' => 'extra-big',
    'text' => false,
    'button_link' => '',
    'button_text' => '',
);
 ?>

<?php include(locate_template('templates/block-full-width-image.php')); ?>

<div class="container">
    <div class="row">
		<div class="extra-padding-vertical">
	        <div class="col-sm-8 border-right">
	            <div class="border-bottom extra-padding-horizontal">
	            <div class="extra-padding-vertical">
	                <img class="pull-right" src="<?php echo $venture['logo']['sizes']['thumbnail']; ?>">
	                <h2 class="text-bold">
						<span class="small"><?php echo find_custom_field_value($job, '208901', true); ?></span><br/>
						<?php echo $job['title']; ?>
					</h2>
	                <h3>
	                    <?php echo $venture['post_title']; ?><br/>
	                    <span class="small"><?php echo $job['location']['city']; ?></span>
	                </h3>
	            </div>
	            </div>
				<div class="extra-padding-vertical extra-padding-horizontal">
					<?php echo $job['description']; ?>
		        </div>
	        </div>
			<div class="col-sm-4">
				<div class="extra-padding-vertical extra-padding-horizontal">
					<p><a class="btn btn-primary" href="#">Refer a friend</a></p><br/>
	            	<p><?php get_template_part('templates/element-share-buttons'); ?></p>
		            <p><a href="/about">About Polymath Ventures</a></p>
		            <p><a href="<?php echo $venture['website']; ?>" target="_blank"><?php echo $venture['website']; ?></a></p>
		            <p><a href="<?php the_permalink(); ?>">Back to jobs</a></p>

		            <a class="btn btn-danger" target="_blank" href="http://polymath.catsone.com/careers/index.php?m=portal&a=apply&jobOrderID=<?php echo $job['id']; ?>">
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
                    <p><?php echo $venture['description']; ?></p>
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
					<h2 class="text-bold text-center"><?php echo $venture['post_title']; ?> team</h2>
                    <div class="extra-padding-vertical">
                        <?php
                        $params = array(
                            'type' => 'team',
                            'category' => get_post($venture['ID']),
                            'arrows' => true,
                            'arrow_background_color' => 'dark-blue text-white',
                            'slides_in_view' => 3,
                            'height' => 400,
                            'caption_background_color' => 'none text-white',
							'people' => $venture['people']
                        );
                         ?>
                        <?php include(locate_template('templates/block-slider.php')); ?>

						<div class="block-content">
	                        <h2 class="text-bold text-center">Come work with us!</h2>
							<br/>
	                        <br/>
							<a class="btn btn-danger" target="_blank" href="http://polymath.catsone.com/careers/index.php?m=portal&a=apply&jobOrderID=<?php echo $job['id']; ?>">
				                Apply
				            </a>
	                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="block-promos"
         style="<?php echo css_gradient('#C2BEC7', '#49C3B1'); ?>">
    <div class="container text-center">
        <div class="row">
            <div class="col-xs-12">
                <?php
                $params = array(
					'promo_1_width' => 8,
					'promo_1_background_color' => 'lila text-white',
					'promo_1' => $venture['promo_1'],
					'promo_2_background_color' => 'aqua text-white',
					'promo_2' => $venture['promo_2']
                );
                 ?>
                <?php include(locate_template('templates/block-promos.php')); ?>
            </div>
        </div>
    </div>
</div>