<?php
/**
 * Template Name: Team template
 */
?>

<div class="row">
    <div class="col-md-12">
        <button class="btn btn-primary filter" data-filter="all">All</button>
        <?php echo post_buttons(array('post_type' => 'ventures')); ?>
        <?php echo post_buttons(array('post_type' => 'seeds')); ?>
    </div>
</div>

<div class="row">
    <?php echo team_members_matrix(); ?>
</div>
