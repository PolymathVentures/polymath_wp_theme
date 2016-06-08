<?php $column_offset = (12 - get_sub_field('width')) / 2; ?>
<?php $column_class = 'col-sm-' . get_sub_field('width') . ' col-sm-offset-' . $column_offset; ?>

<div class="row">
    <div class="<?php echo $column_class; ?> <?php the_sub_field('alignment'); ?>">
        <?php the_sub_field('text'); ?>
    </div>
</div>
