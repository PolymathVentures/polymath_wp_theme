<?php array_walk($job['_embedded']['custom_fields'], 'published_on_website'); ?>

<article <?php post_class(); ?>>
  <header>
    <h2 class="entry-title"><?php echo $job['title']; ?></h2>
  </header>
  <div class="entry-summary">
    <?php echo $job['description']; ?>
  </div>
</article>