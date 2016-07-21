<?php $column_offset = (12 - $params['width']) / 2; ?>
<?php $column_class = 'col-sm-' . $params['width'] . ' col-sm-offset-' . $column_offset; ?>
<?php $sub_col_width = 12 / count($params['text_fields']); ?>

<div class="row">
    <div class="<?php echo $column_class; ?> <?php echo $params['alignment']; ?> <?php echo $params['text_size']; ?>">
        <div class="content-row">
            <?php foreach($params['text_fields'] as $text_field): ?>
                    <div class="col-sm-<?php echo $sub_col_width; ?> <?php echo $text_field['background_color']; ?> no-padding calc-height" data-height-group="simple-text">
                         <div class="content-padding-wrapper background-image responsive-bg calc-height"
                              data-bg-json='<?php echo json_encode($text_field['background_image']['sizes']); ?>'
                              data-height-group="simple-text">
                         	<div class="content-padding">
                                <?php if($text_field['title']): ?>
                                    <h2><?php echo $text_field['title']; ?></h2>
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