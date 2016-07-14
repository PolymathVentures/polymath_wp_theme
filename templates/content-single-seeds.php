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