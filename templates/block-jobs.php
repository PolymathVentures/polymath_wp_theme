<?php

$jobs = cats_jobs();

$result = get_ventures();
$ventures = get_cats_venture_map($result);

?>

<?php
$items = $result->posts;
$items[0]->button_text = 'Venture';
?>

<?php include(locate_template('templates/element-matrix-filter.php')); ?><span class="custom-button">&middot;</span>

<?php
$items = custom_field_options($jobs[0], '208901');
$items['button_text'] = 'Expertise';
?>
<?php include(locate_template('templates/element-matrix-filter.php')); ?><span class="custom-button">&middot;</span>

<button type="button" class="btn custom-button filter" data-filter="all">
    <span>Clear filters</span>
</button>

<br/>
<br/>
<br/>

<div class="post-list mixitup-container row" data-start-filter="<?php echo $_GET['start_filter'] ? '.' . $_GET['start_filter'] : 'all'; ?>">

<?php foreach ($jobs as $job): ?>

<div class="col-md-3 mix col-sm-6 col-xs-12 post-list-item adjust-height calc-height margin-bottom <?php echo find_custom_field_value($job, '208901'); ?> <?php echo $ventures[$job['company_id']]; ?>"  data-height-group="jobs">
	<div class="white">
        <a href="<?php echo get_job_url($job); ?>" class="text-dark">
        <div class="venture-logo" style="border-bottom: 4px solid <?php the_field('brand_color', $ventures[$job['company_id']]); ?>;">
            <img src="<?php echo get_field('logo', $ventures[$job['company_id']])['sizes']['post_list_thumb']; ?>"
                 width="<?php echo get_field('logo', $ventures[$job['company_id']])['sizes']['post_list_thumb-width']; ?>"
                 height="<?php echo get_field('logo', $ventures[$job['company_id']])['sizes']['post_list_thumb-height']; ?>"/>
            <div class="blog-post-more-button"><span class="plus text-center">+</span></div>
        </div>
        <article class="content-padding-wrapper">
            <div class="content-padding text-left">
                <header>
                    <h3 class="text-bold">
                        <span class="small"><?php echo find_custom_field_value($job, '208901', true); ?></span><br/><br/>
	                        <?php echo $job['title']; ?><br />
                        <span class="small"><?php echo get_the_title($ventures[$job['company_id']]); ?>, </span>
                        <span class="small text-title"><?php echo $job['location']['city']; ?></span>
                    </h3>
                </header>
            </div>
        </article>
    </a>
	</div>
</div>

<?php endforeach; ?>
</div>