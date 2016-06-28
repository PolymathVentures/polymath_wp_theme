<?php

$promo_1_width = 'col-sm-' . get_sub_field('promo_1_width');
$promo_2_width = 'col-sm-' . (12 - get_sub_field('promo_1_width'));

?>

<div class="adjust-height text-left">
    <div class="<?php echo $promo_1_width; ?> <?php the_sub_field('promo_1_background_color'); ?> no-padding">
        <?php $promo = get_sub_field('promo_1') ?>
        <?php include(locate_template('templates/element-promo.php')); ?>
    </div>
    <?php if($promo_2_width != 'col-sm-0'): ?>
    <div class="<?php echo $promo_2_width; ?> <?php the_sub_field('promo_2_background_color'); ?> no-padding">
        <?php $promo = get_sub_field('promo_2') ?>
        <?php include(locate_template('templates/element-promo.php')); ?>
    </div>
    <?php endif; ?>
</div>