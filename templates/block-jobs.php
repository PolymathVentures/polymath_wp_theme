<?php
$jobs     = greenhouse_jobs();
$result   = get_ventures();
$ventures = get_greenhouse_venture_map($result);

$items    = $result->posts;
$items[0]->button_text = "Venture";
include(locate_template("templates/element-matrix-filter.php"));
?>

<span class="custom-button">&middot;</span>

<?php
$items    = get_greenhouse_expertise($jobs);
$items["button_text"]  = "Expertise";
include(locate_template("templates/element-matrix-filter.php"));
?>

<span class="custom-button">&middot;</span>

<button type="button" class="btn custom-button filter" data-filter="all">
  <span>Clear filters</span>
</button>

<br><br><br>

<div class="post-list mixitup-container row" data-start-filter="<?=($_GET['start_filter'] ? '.'.$_GET['start_filter'] : 'all')?>">

<?php foreach( $jobs as $job ): ?>
  <div class="col-md-3 mix col-sm-6 col-xs-12 post-list-item adjust-height calc-height margin-bottom <?=$job['departments'][0]['id']?> <?=$ventures[$job['offices'][0]['name']]?>" data-height-group="jobs">
    <div class="white">
      <a href="<?=get_job_url($job)?>" class="text-dark">
        <div class="venture-logo" style="border-bottom: 4px solid <?php the_field('brand_color', $ventures[$job['offices'][0]['name']]);?>;">
          <img src="<?=get_field('logo', $ventures[$job['offices'][0]['name']])['sizes']['post_list_thumb']?>"
            width="<?=get_field('logo', $ventures[$job['offices'][0]['name']])['sizes']['post_list_thumb-width']?>"
            height="<?=get_field('logo', $ventures[$job['offices'][0]['name']])['sizes']['post_list_thumb-height']?>">
          <div class="blog-post-more-button"><span class="plus text-center">+</span></div>
        </div>
        <article class="content-padding-wrapper">
          <div class="content-padding text-left">
            <header>
              <h3 class="text-bold">
                <span class="small"><?=$job['departments'][0]['name']?></span><br><br>
                <?=$job['title']?><br>
                <span class="small"><?=$job['offices'][0]['name']?>, </span>
                <span class="small text-title"><?=$job['location']['name']?></span>
              </h3>
            </header>
          </div>
        </article>
      </a>
    </div>
  </div>
<?php endforeach; ?>

</div>
