<?php get_template_part('templates/page', 'header'); ?>

<button class="btn btn-primary filter" data-filter="all">All</button>
<?php echo post_buttons(array('post_type' => 'ventures')); ?>
<?php echo post_buttons(array('post_type' => 'seeds')); ?>

<?php echo team_members_matrix(); ?>

<?php the_posts_navigation(); ?>
