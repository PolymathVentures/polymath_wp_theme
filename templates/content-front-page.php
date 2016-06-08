<div class="container">
    <div class="row extra-padding-vertical">
        <div class="col-md-12">
            <?php echo post_list(array('maximum' => 3,
                                       'filter' => 'type',
                                       'value' => 'Statistic',
                                       'post_type' => 'promos',
                                       'title_class' => 'extra-big text-center')); ?>
        </div>
    </div>
</div>

<div class="white">
    <div class="container">
        <div class="row extra-padding-vertical text-center">
            <div class="col-md-12">
                <h2 class="text-bold">HOW WE BUILD</h2>
                <p class="big">We're here to build incredible companies</p>

                <div class="row extra-padding-vertical">
                    <?php $icons = get_field('icons'); ?>
                    <?php $i = 0; foreach($icons as $icon) { ?>
                        <div class="col-sm-2 <?php echo $i == 0 ? 'col-sm-offset-1' : ''; ?> col-xs-6 text-uppercase extra-letter-spacing">
                            <img src="<?php echo $icon['icon']['sizes']['medium']; ?>" width="100%"><br /><br />
                            <?php echo $icon['title']; ?>
                        </div>
                    <?php $i++; }; ?>
                </div>
                <p class="extra-padding-vertical"><a href="<?php the_field('icons_link'); ?>" class="btn btn-primary"><?php the_field('icons_button_text'); ?></a></p>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row extra-padding-vertical text-center">
        <div class="col-md-12">
            <h2 class="text-bold">MEET THE TEAM</h2>
            <p class="big">We're here to build incredible companies</p>

            <div class="row extra-padding-vertical">
                <div class="col-md-12">
                    <?php echo team_members_slider(); ?>
                </div>
            </div>
            <p class="extra-padding-vertical text-center"><a href="<?php the_field('icons_link'); ?>" class="btn btn-primary"><?php the_field('icons_button_text'); ?></a></p>
        </div>
    </div>
</div>
<?php the_content(); ?>
