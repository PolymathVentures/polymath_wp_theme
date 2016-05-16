<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>
    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>

<div class="row">
    <?php $slides_post = get_post_with_custom_fields(get_field('milestones')); ?>
    <?php echo carousel(array('id' => 'venture-slider', 'items' => $slides_post['slides'], 'show' => $slides_post['slides_in_view'])); ?>
</div>

<div class="row">
    <?php echo team_members_matrix(array('filter' => 'ventures', 'value' => get_the_ID())); ?>
</div>

<div class="row">
    <?php echo quote(array('quote' => get_field('quote'))); ?>
</div>

<div class="row">
    <?php echo statistics_list(array('filter' => 'ventures', 'value' => get_the_ID())); ?>
</div>



