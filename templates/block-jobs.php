<?php

$jobs = cats_jobs();

$args = array(
	'posts_per_page'   => -1,
	'orderby'          => 'post_title',
	'post_type'		   => 'ventures',
	'order'            => 'ASC',
	'post_status'      => array('publish', 'pending'),
);

$result = new WP_query($args);

$ventures = [];

foreach($result->posts as $r) {

    $catsone_id = get_field('catsone_id', $r->ID);

    if($catsone_id) {
        $ventures[$catsone_id] = $r->ID;
    }

};

?>

<?php if (is_user_logged_in()): ?>
    <a href="<?php echo get_permalink() . '?refresh=true'; ?>">
        refresh
    </a><br/>
<?php endif; ?>

Filter by: <br />

<?php
$items = $result->posts;
$items[0]->button_text = 'Venture';
?>

<?php include(locate_template('templates/element-matrix-filter.php')); ?><span class="custom-button">&middot;</span>

<?php
// $items = custom_field_options('208901');
// array_unshift($items, 'Expertise');
?>
<?php // include(locate_template('templates/element-matrix-filter.php')); ?>

<div class="post-list mixitup-container">

<?php foreach ($jobs as $job): ?>

<div class="col-sm-4 post-list-item margin-bottom mix <?php echo find_custom_field_value($job, '208901'); ?> <?php echo $ventures[$job['company_id']]; ?>">
    <div class="col-xs-12">
        <div class="venture-logo" style="border-bottom: 4px solid <?php the_field('brand_color', $ventures[$job['company_id']]); ?>;">
            <img src="<?php echo get_field('logo', $ventures[$job['company_id']])['sizes']['post_list_thumb']; ?>"/>
            <a href="<?php echo get_permalink() . $job['id'] . '/' . urlencode($job['title']); ?>">
                <div class="blog-post-more-button"><span class="plus text-center">+</span></div>
            </a>
        </div>
        <article class="white content-padding-wrapper">
            <div class="content-padding text-left">
                <header>
                    <h3 class="text-bold">
						<a href="<?php echo get_permalink() . $job['id'] . '/' . urlencode($job['title']); ?>">
	                        <?php echo $job['title']; ?><br />
						</a>
                        <span class="small"><?php echo get_field('post_title', $ventures[$job['company_id']]); ?></span>
                        <span class="small text-title"><?php echo $job['location']['city']; ?></span>
                    </h3>
                </header>
            </div>
        </article>
    </div>
</div>

<?php endforeach; ?>
</div>