<?php

$jobs = cats_get_jobs();

if (isset($_GET["id"]) && isset($jobs[$_GET["id"]])):
    $job = $jobs[$_GET["id"]];

    //Used this instead of get_template_part to make $job available in job-single.php
    include_once(locate_template('templates/job-single.php'));
else:
?>

    <?php foreach ($jobs as $job): ?>
        <article <?php post_class(); ?>>
          <header>
            <h2 class="entry-title"><?php echo $job['title']; ?></h2>
          </header>
          <div class="entry-summary">
            <?php echo $job['description']; ?>
          </div>
        </article>
    <?php endforeach; ?>

<?php endif; ?>
