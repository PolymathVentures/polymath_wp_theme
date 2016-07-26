<ul>

<?php foreach ($jobs as $job): ?>

<li><a href="<?php echo get_job_url($job, $jobs_page_id); ?>"><?php echo $job['title']; ?> - <?php echo get_the_title($ventures[$job['company_id']]); ?></a>

<?php endforeach; ?>
</ul>