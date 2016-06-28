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

<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <div class="extra-padding-vertical">
                <img class="pull-right" src="<?php echo $venture['logo']['sizes']['thumbnail']; ?>">
                <h2 class="text-bold"><?php echo $job['title']; ?></h2>
                <h3>
                    <?php echo $venture['post_title']; ?><br/>
                    <span class="small"><?php echo $job['location']['city']; ?></span>
                </h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <?php echo $job['description']; ?>
        </div>
        <div class="col-sm-4">
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

<div class="white">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3 text-center">
                <div class="extra-padding-vertical">
                    <h2 class="text-bold">About <?php echo $venture['post_title']; ?></h2>
                    <p><?php echo $venture['jobs_page_tagline']; ?></p>
                </div>
            </div>
        </div>
		<?php
		$posts_args = array(
			'maximum_posts' => 3,
			'post_type' => 'promos',
			'filter' => 'type',
			'value' => 'statistic',
			'alternating_colors' => false,
			'post_background_color' => 'red'
		);
		 ?>
		<?php include(locate_template('templates/block-posts.php')); ?>
    </div>
</div>