<div class="adjust-height text-left">
    <div class="col-sm-8 extra-padding-vertical extra-padding-horizontal <?php the_sub_field('promo_1_background_color'); ?>">
        <?php $promo = get_sub_field('promo_1') ?>
        <?php include(locate_template('templates/element-promo.php')); ?>
    </div>
    <div class="col-sm-4 extra-padding-vertical extra-padding-horizontal <?php the_sub_field('promo_2_background_color'); ?>">
        <?php $promo = get_sub_field('promo_2') ?>
        <?php include(locate_template('templates/element-promo.php')); ?>
    </div>
</div>