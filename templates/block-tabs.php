<?php
$tabs = count(get_sub_field('tabs'));
$offset = (12 - $tabs * 2) / 2;
?>


<div class="row">
    <ul class="tabs" role="tablist">
        <?php $i = 0; foreach(get_sub_field('tabs') as $tab): ?>
            <li role="presentation" class="col-sm-2 <?php echo $i == 0 ? 'active col-sm-offset-' . $offset: ''; ?>">
                <a href="#tab-<?php echo $i; ?>" role="tab" data-toggle="tab">
                    <img src="<?php echo $tab['icon']['sizes']['medium']; ?>">
                </a>
            </li>
        <?php $i++; endforeach; ?>
    </ul>
</div>

<div class="tab-content">
    <?php $j = 0; foreach(get_sub_field('tabs') as $icon): ?>
        <div id="tab-<?php echo $j; ?>" tab-role="tabpanel" class="tab-pane fade <?php echo $j == 0 ? 'active in': ''; ?>">

            <?php if($icon['slider']): ?>
                <?php $slides_object = get_post_with_custom_fields($icon['slider']); ?>
                <?php $slides_object['dots'] = 'true'; ?>
                <?php $slides_object['arrows'] = 'true'; ?>
                <?php include(locate_template('templates/element-slider.php')); ?>
            <?php endif; ?>

            <?php if($icon['text']): ?>
                <?php echo $icon['text']; ?>
            <?php endif; ?>
        </div>
    <?php $j++; endforeach; ?>
</div>