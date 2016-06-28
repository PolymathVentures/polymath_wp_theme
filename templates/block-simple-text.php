<?php $column_offset = (12 - get_sub_field('width')) / 2; ?>
<?php $column_class = 'col-sm-' . get_sub_field('width') . ' col-sm-offset-' . $column_offset; ?>
<?php $sub_col_width = 12 / count(get_sub_field('text_fields')); ?>

<div class="row">
    <div class="<?php echo $column_class; ?> <?php the_sub_field('alignment'); ?> <?php the_sub_field('text_size'); ?>">
        <div class="adjust-height content-row">
            <?php foreach(get_sub_field('text_fields') as $text_field): ?>
                    <div class="col-sm-<?php echo $sub_col_width; ?> <?php echo $text_field['background_color']; ?> no-padding">
                         <div class="content-padding-wrapper background-image"
                              style="background-image: url(<?php echo $text_field['background_image']['sizes']['large']; ?>);">
                         	<div class="content-padding">
                                <?php if($text_field['title']): ?>
                                    <h3><?php echo $text_field['title']; ?></h3>
                                <?php endif; ?>
                                <?php if($text_field['text']): ?>
                                    <p><?php echo $text_field['text']; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>