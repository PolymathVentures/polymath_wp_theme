<?php
/**
 * Template Name: Team template
 */
?>

<div class="container extra-padding-vertical text-center">
        <?php echo post_buttons(array('title' => 'Ventures', 'post_type' => 'ventures')); ?>
        <?php echo post_buttons(array('title' => 'Seeds', 'post_type' => 'seeds')); ?>
        <?php echo post_buttons(array('title' => 'Roles', 'taxonomy' => 'job_role')); ?>
        <span role="button" class="filter text-underline small" data-filter="all">clear filters</a>
</div>

<div class="container extra-padding-vertical">
        <?php echo team_members_matrix(); ?>
</div>


<div class="white">
    <div class="container extra-padding-vertical text-center">
                <?php $slider = get_post_with_custom_fields(get_field('slider')); ?>
                <?php echo carousel(array('items' => $slider['slides'],
                                          'show' => $slider['slides_in_view'],
                                          'height' => '300px',
                                          'background' => $slider['background_image'],
                                          'type' => $slider['type'])); ?>
                <p class="extra-padding-vertical"><a href="<?php the_field('icons_link'); ?>" class="btn btn-primary"><?php the_field('icons_button_text'); ?></a></p>
    </div>
</div>