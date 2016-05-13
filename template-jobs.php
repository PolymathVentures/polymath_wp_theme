<?php
/**
 * Template Name: Jobs Template
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/jobs', 'page'); ?>
<?php endwhile; ?>