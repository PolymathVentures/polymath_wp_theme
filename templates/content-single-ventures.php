<div class="container text-center">
    <div class="row block-simple-text">
        <div class="extra-padding-vertical content-row">
            <div class="col-sm-6">
                <div class="background-image responsive-bg calc-height"
                        data-bg-json='<?php echo json_encode(format_attachment_sizes_array(get_post_thumbnail_id())); ?>'
                        data-height-group="venture-intro">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="content-padding-wrapper calc-height" data-height-group="venture-intro">
                 	<div class="content-padding">
                        <img src="<?php echo get_field('logo')['sizes']['post_list_thumb']; ?>"
                             width="<?php echo get_field('logo')['sizes']['post_list_thumb-width']; ?>"
                             height="<?php echo get_field('logo')['sizes']['post_list_thumb-height']; ?>"/>
                            <p class="big text-light"><?php the_field('description'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$args = array(
	'post_type'		   => 'promos',
	'post_status'      => 'publish',
    'meta_query'       => array(
                                array(
                                    'key' => 'type',
                                    'value' => 'statistic',
                                    'compare' => 'LIKE'
                                ),
                                array(
                                    'key' => 'ventures',
    								'value' => '"' . get_the_ID() . '"',
    								'compare' => 'LIKE')
                            )
);

$stat_count = new WP_query($args);
$stat_count = $stat_count->found_posts;
?>

<?php if($stat_count > 0): ?>
<div class="aqua">
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
<?php endif; ?>
<div class="container text-center">
    <div class="row">
        <div class="col-xs-12">
            <div class="block-content">
                <h2 class="text-bold text-center">Building <?php the_title(); ?></h2>
                <p class="big">The journey from MVP to operations to growth</p>
                <div class="extra-padding-vertical">
                    <?php
                    $params = array(
                        'type' => 'timeline',
                        'slider' => get_field('venture_story'),
                        'arrows' => false,
                        'arrow_background_color' => false,
                        'slides_in_view' => 1,
                        'height' => 400,
                        'autoplay' => 'false',
                        'arrows' => true,
                        'arrow_background_color' => 'text-white',
                        'caption_background_color' => 'dark-blue text-white',
                    );
                     ?>
                    <?php include(locate_template('templates/block-slider.php')); ?>

                    <div class="block-content">
                        <h2 class="text-center">Want to learn more about <?php the_title(); ?>?</h2>
                        <br/>
                        <br/>
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
                    <h2 class="text-bold text-center">Meet some of our team</h2>
                    <div class="extra-padding-vertical">
                        <?php
                        $params = array(
                            'type' => 'team',
                            'category' => get_post(),
                            'arrows' => true,
                            'arrow_background_color' => 'lila text-white',
                            'slides_in_view' => 4,
                            'height' => 350,
                            'caption_background_color' => 'none text-white',
                            'people' => get_field('people')
                        );
                         ?>
                        <?php include(locate_template('templates/block-slider.php')); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="block-promos"
         style="<?php echo css_gradient('#C2BEC7', '#49C3B1'); ?>">
    <div class="container text-center">
        <div class="row">
            <div class="col-xs-12">
                <?php

                $args = array(
                	'posts_per_page'   => 1,
                	'orderby'          => 'publish',
                	'post_type'		   => 'post',
                	'order'            => 'DESC',
                	'post_status'      => 'publish',
                    'meta_query'       => array(
                								array(
                								'key' => 'ventures',
                								'value' => '"' . get_the_ID() . '"',
                								'compare' => 'LIKE'
                								)
                                            )
                );

                $featured_post = new WP_query($args);

                if($featured_post->found_posts > 0):
                    $featured_post = $featured_post->posts[0];
                    $featured_post->link = get_the_permalink($featured_post->ID);
                    $featured_post->button_text = 'Read more';
                else:
                    $featured_post = get_field('promo_2');
                endif;

                $params = array(
					'promo_1_width' => 8,
					'promo_1_background_color' => 'lila text-white',
					'promo_1' => get_field('promo_1'),
					'promo_2_background_color' => 'aqua text-white',
					'promo_2' => $featured_post
                );
                 ?>

                <?php include(locate_template('templates/block-promos.php')); ?>
            </div>
        </div>
    </div>
</div>