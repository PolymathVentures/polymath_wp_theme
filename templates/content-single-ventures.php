<div class="container text-center">
    <div class="row block-simple-text">
        <div class="adjust-height extra-padding-vertical content-row">
            <div class="col-sm-6">
                <div class="background-image responsive-bg"
                        data-bg-json='<?php echo json_encode(format_attachment_sizes_array(get_post_thumbnail_id())); ?>'>
                        &nbsp;
                </div>
            </div>
            <div class="col-sm-6">
                <div class="content-padding-wrapper">
                 	<div class="content-padding">
                        <img src="<?php echo get_field('logo')['sizes']['post_list_thumb']; ?>"/>
                            <p><?php the_field('description'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div style="background-color: <?php the_field('brand_color'); ?>">
    <div class="container text-center">
        <div class="row">
            <div class="col-xs-12">
                <?php
                $params = array(
                    'maximum_posts' => 4,
                    'posts_per_row' => 4,
                    'post_type' => 'promos',
                    'filter' => 'type',
                    'value' => 'statistic',
                    'category' => get_post(),
                    'show_images' => false,
                    'no_extra_padding' => true,
                    'alternating_colors' => false,
                    'post_background_color' => 'text-white',
                    'post_title_text_size' => 'super-big'
                );
                 ?>
                <?php include(locate_template('templates/block-posts.php')); ?>
            </div>
        </div>
    </div>
</div>
<div class="container text-center">
    <div class="row">
        <div class="col-xs-12">
            <div class="block-content">
                <h2 class="text-bold text-center">Building <?php the_title(); ?></h2>
                <div class="extra-padding-vertical">
                    <?php
                    $params = array(
                        'type' => 'timeline',
                        'slider' => get_field('venture_story'),
                        'arrows' => false,
                        'arrow_background_color' => false,
                        'slides_in_view' => 1,
                        'height' => 300,
                        'caption_background_color' => 'dark-blue text-white',
                    );
                     ?>
                    <?php include(locate_template('templates/block-slider.php')); ?>

                    <div class="block-content">
                        <h2 class="text-bold text-center">Want to learn more about <?php the_title(); ?>?</h2>
                        <a class="btn btn-primary" href="<?php the_field('website'); ?>" target="_blank">Visit website</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="white">
    <div class="container text-center">
        <div class="row">
            <div class="col-xs-12">
                <div class="block-content">
                    <?php $params = array(
                        'category' => get_post()
                    );
                    ?>
                    <?php include(locate_template('templates/block-team-matrix.php')); ?>
                </div>
            </div>
        </div>
    </div>
</div>