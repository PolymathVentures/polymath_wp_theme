<?php
/**
 * Template Name: About template
 */
?>

<div class="row">
    <?php $slides_post = get_post_with_custom_fields(get_field('story')); ?>
    <?php echo carousel(array(  'items' => $slides_post['slides'],
                                'show' => $slides_post['slides_in_view'],
                                'center_mode' => true,
                                'height' => '400px',
                                'center_mode' => true,
                                'background' => $slides_post['background_image'])); ?>
</div>
