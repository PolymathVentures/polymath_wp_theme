<?php
$params = array(
    'background_image' => array('sizes' => format_attachment_sizes_array(get_post_thumbnail_id())),
    'overlay_color' => 'overlay-dark-blue text-white',
    'alignment' => 'text-center',
    'title' => get_the_title(),
    'title_text_size' => 'super-big',
    'text' => 'Seed ' . get_field('year'),
    'button_link' => '',
    'button_text' => '',
);
 ?>
<?php include(locate_template('templates/block-full-width-image.php')); ?>


<div class="container text-center">
    <div class="row">
        <div class="col-xs-12">
            <div class="block-content">
                <div class="extra-padding-vertical">
                    <?php
                    $params = array(
                        'type' => 'timeline',
                        'slider' => get_field('seed_story'),
                        'arrows' => false,
                        'arrow_background_color' => false,
                        'slides_in_view' => 1,
                        'height' => 300,
                        'caption_background_color' => 'dark-blue text-white',
                    );
                     ?>
                    <?php include(locate_template('templates/block-slider.php')); ?>

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
                    <div class="extra-padding-vertical">
                        <?php
                        $params = array(
                            'type' => 'team',
                            'category' => get_post(),
                            'arrows' => true,
                            'arrow_background_color' => 'dark-blue',
                            'slides_in_view' => 3,
                            'height' => 350,
                            'caption_background_color' => '',
                        );
                         ?>
                        <?php include(locate_template('templates/block-slider.php')); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>