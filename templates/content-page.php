<?php
if( have_rows('content') ):

    while ( have_rows('content') ) : the_row();

    $template_name = 'block-' . str_replace('_', '-', get_row_layout());
?>

    <?php if(strpos($template_name, 'full-width') > 0): ?>

        <?php get_template_part('templates/' . $template_name); ?>

    <?php else: ?>

        <div class="<?php the_sub_field('background_color'); ?> <?php echo $template_name; ?>">
            <div class="container">
                <?php if(get_sub_field('title')): ?>
                    <div class="row extra-padding-vertical text-center">
                        <div class="col-xs-12">

                            <h2 class="text-bold"><?php the_sub_field('title'); ?></h2>

                            <?php if(get_sub_field('sub_title')): ?>
                                <p class="big"><?php the_sub_field('sub_title'); ?></p>
                            <? endif; ?>

                        </div>
                    </div>
                <? endif; ?>
                <div class="row extra-padding-vertical text-center">
                    <div class="col-xs-12">
                        <?php get_template_part('templates/' . $template_name); ?>
                    </div>
                </div>

                <?php if(get_sub_field('button_text')): ?>
                    <div class="row extra-padding-vertical text-center">
                        <div class="col-xs-12">
                            <p>
                                <a href="<?php the_sub_field('button_link'); ?>" class="btn btn-primary">
                                    <?php the_sub_field('button_text'); ?>
                                </a>
                            </p>
                        </div>
                    </div>
                <? endif; ?>
            </div>
        </div>

<?php

        endif;
    endwhile;
else:

    the_content();
    wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']);

endif;

?>
