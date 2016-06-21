<div class="featured-image" style="background-image:url(<?php echo get_sub_field('background_image')['sizes']['large']; ?>)">
    <div class="featured-image-inner <?php the_sub_field('overlay_color'); ?>">
        <div class="container">
            <div class="row">
                <div class="<?php echo get_sub_field('alignment'); ?>">
                    <div class="extra-padding-horizontal extra-padding-vertical">
                        <?php if(get_sub_field('title')): ?>
                            <h1 class="<?php the_sub_field('title_size'); ?> extra-letter-spacing"><?php the_sub_field('title'); ?></h1>
                        <?php endif; ?>

                        <?php if(get_sub_field('text')): ?>
                            <p class="big"><?php the_sub_field('text'); ?></p>
                        <?php endif; ?>

                        <?php if(get_sub_field('button_link')): ?>
                            <p class="big extra-padding-vertical">
                                <a class="btn btn-primary" href="<?php the_sub_field('button_link'); ?>">
                                   <?php the_sub_field('button_text'); ?>
                                </a>
                           </p>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>