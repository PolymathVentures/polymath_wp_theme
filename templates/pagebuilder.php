<?php
if( have_rows('content') ):

    $content_block_index = 0;
    while ( have_rows('content') ) : the_row();

    $template_name = 'block-' . str_replace('_', '-', get_row_layout());
?>
    <span id="block-<?php echo $content_block_index + 1; ?>" class="anchor"></span>
    <?php $params = get_fields()['content'][$content_block_index]; ?>
    <?php if(strpos($template_name, 'full-width') > 0 || get_sub_field('full_width') ): ?>

            <?php if(get_sub_field('title') && get_sub_field('full_width')): ?>
                <div class="text-center extra-padding-vertical">

                <h2 class="text-bold"><?php the_sub_field('title'); ?></h2>

                <?php if(get_sub_field('sub_title')): ?>
                    <p class="big"><?php the_sub_field('sub_title'); ?></p>
                <? endif; ?>
            </div>
            <? endif; ?>

        <?php include(locate_template('templates/' . $template_name . '.php')); ?>

    <?php else: ?>

        <div class="<?php the_sub_field('background_color'); ?> <?php echo $template_name; ?>"
             <?php if(get_sub_field('background_color') == 'gradient'): ?>
                 style="<?php echo css_gradient(get_sub_field('gradient_color_1'), get_sub_field('gradient_color_2')); ?>"
             <?php endif; ?>>
            <div class="container">
                <div class="row text-center">
                    <div class="col-xs-12">
                        <?php if(!get_sub_field('no_extra_padding')): ?>
                            <div class="block-content">
                        <?php endif; ?>
                        <?php if(get_sub_field('title')): ?>

                            <h2 class="text-bold"><?php the_sub_field('title'); ?></h2>

                            <?php if(get_sub_field('sub_title')): ?>
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <p class="big"><?php the_sub_field('sub_title'); ?></p>
                                    </div>
                                </div>
                            <? endif; ?>

                        <? endif; ?>
                        <?php if(!get_sub_field('no_extra_inner_padding')): ?>
                            <div class="extra-padding-vertical">
                        <?php endif; ?>
                            <?php include(locate_template('templates/' . $template_name . '.php')); ?>
                        <?php if(!get_sub_field('no_extra_inner_padding')): ?>
                            </div>
                        <?php endif; ?>
                        <?php if(get_sub_field('button_text')): ?>
                            <div class="extra-padding-vertical">
                                <p>
                                    <a href="<?php the_sub_field('button_link'); ?><?php the_sub_field('button_link_extras'); ?>" class="btn btn-primary">
                                        <?php the_sub_field('button_text'); ?>
                                    </a>
                                </p>
                            </div>
                        <? endif; ?>
                        <?php if(!get_sub_field('no_extra_padding')): ?>
                            </div>
                        <? endif; ?>
                    </div>
                </div>
            </div>
        </div>

<?php

        endif;

        $content_block_index++;
    endwhile;
else:

    wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']);

endif;

?>
