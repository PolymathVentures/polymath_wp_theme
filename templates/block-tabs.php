<?php
$tabs = count(get_sub_field('tabs'));
$offset = (12 - $tabs * 2) / 2;
?>


<ul class="tabs" role="tablist">
    <?php $i = 0; foreach(get_sub_field('tabs') as $tab): ?>
        <li role="presentation" class="col-xs-2 <?php echo $i == 0 ? 'active col-sm-offset-' . $offset: ''; ?>">
            <a href="#tab-<?php echo $i; ?>" role="tab" data-toggle="tab">
                <img src="<?php echo $tab['icon']['sizes']['medium']; ?>">
            </a>

            <?php if($tab['icon_text']): ?>
                <span class="text-uppercase extra-letter-spacing"><?php echo $tab['icon_text']; ?></span>
            <?php endif; ?>
        </li>
    <?php $i++; endforeach; ?>
</ul>

<div class="tab-content">
    <?php $j = 0; foreach(get_sub_field('tabs') as $icon): ?>
        <div id="tab-<?php echo $j; ?>" tab-role="tabpanel" class="tab-pane fade <?php echo $j == 0 ? 'active in': ''; ?> <?php echo $icon['background_color']; ?>">

            <?php if($icon['image']): ?>

                <div class="image"
                     style="background-image: url(<?php echo $icon['image']['sizes']['large']; ?>); height: <?php echo $icon['image_height']; ?>px;">
                </div>

            <?php endif; ?>

            <div class="content-padding-wrapper">
                <div class="content-padding">
                    <?php if($icon['title']): ?>
                        <h3><?php echo $icon['title']; ?></h3>
                    <?php endif; ?>

                    <?php echo $icon['text']; ?>
                </div>
            </div>

        </div>
    <?php $j++; endforeach; ?>
</div>