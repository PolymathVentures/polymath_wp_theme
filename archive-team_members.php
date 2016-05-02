<?php get_template_part('templates/page', 'header'); ?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<button class="btn btn-primary filter" data-filter="all">All</button>

<?php
$tags = get_terms( 'team_tag', array(
    'hide_empty' => true,
));

foreach($tags as $tag) { ?>

    <button class="btn btn-primary filter" data-filter=".<?php echo $tag->slug; ?>"><?php echo $tag->name; ?></button>

<?php }; ?>


<div id="mixitup-container">
    <?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
    <?php endwhile; ?>
</div>

<?php the_posts_navigation(); ?>
