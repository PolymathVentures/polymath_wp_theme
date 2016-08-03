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

<?php
$args = array(
	'posts_per_page'   => -1,
	'orderby'          => 'published',
	'post_type'		   => 'seeds',
	'order'            => 'DESC',
	'post_status'      => 'publish',
);

$items = new WP_query($args);

$prev = get_offset_post(get_the_id(), $items, -1) ?: false;
$next = get_offset_post(get_the_id(), $items, 1) ?: false;

?>

<div class="aqua">

    <div class="container">
        <?php if($prev): ?>
            <a class="pull-left text-white h4" href="<?php echo get_the_permalink($prev->ID); ?>">
                < Previous: <?php echo get_the_title($prev->ID); ?>
            </a>
        <?php endif; ?>

        <?php if($next): ?>
        <a class="pull-right text-white h4" href="<?php echo get_the_permalink($next->ID); ?>">
            Next: <?php echo get_the_title($next->ID); ?> >
        </a>
        <?php endif; ?>
    </div>

</div>