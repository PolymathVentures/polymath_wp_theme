<?php $column_offset = (12 - $params['width']) / 2; ?>
<?php $column_class = 'col-sm-' . $params['width'] . ' col-sm-offset-' . $column_offset; ?>

<div class="row">
    <div class="<?php echo $column_class; ?> <?php echo $params['alignment']; ?> <?php echo $params['text_size']; ?>">
        <div class="post-list">
            <?php $i = 0; foreach($params['text_fields'] as $text_field): ?>
              <div class="post-list-item flex gutter-bottom">
                <article class="col-sm-6 <?php echo $text_field['background_color']; ?> <?php echo $text_field['text_side']; ?>">
                     	<div class="content-padding">
                            <?php if($text_field['title']): ?>
                                <h2><?php echo $text_field['title']; ?></h2>
                            <?php endif; ?>
                            <?php if($text_field['text']): ?>
                                <?php echo do_shortcode($text_field['text']); ?>
                            <?php endif; ?>
                        </div>
                  </article>
                  <div class="col-sm-6">
                    <img src="<?php echo $text_field['image']['sizes']['large'] ?>" />
                  </div>
                </div>
            <?php $i++; endforeach; ?>
        </div>
    </div>
</div>