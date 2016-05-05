<?php if (is_user_logged_in()): ?>
    <a href="<?php echo get_permalink() . '?refresh=true'; ?>">
        refresh
    </a>
<?php endif; ?>

<?php

$jobs = cats_jobs();

if (isset($_GET["id"])):
    $job = get_job($jobs, $_GET["id"]);
endif;

if (isset($job)):
    //Used this instead of get_template_part to make $job available in job-single.php
    include_once(locate_template('templates/job-single.php'));
else:

    foreach ($jobs as $job): ?>
        <article <?php post_class(); ?>>
          <header>
            <h2 class="entry-title">
                <a href="<?php echo get_permalink() . '?id=' . $job['id']; ?>">
                    <?php echo $job['title']; ?>
                </a>
            </h2>
          </header>
          <div class="entry-summary">
              <!-- Custom field 161876 is a summary of the job -->
              <?php echo find_custom_field($job, '161876'); ?>
          </div>
        </article>
    <?php endforeach; ?>

<?php endif; ?>
