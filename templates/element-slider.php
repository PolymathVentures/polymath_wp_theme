<?php
$tabs = count($slides_object['slides']);
$offset = (12 - $tabs * 2) / 2;
$ajust_height = get_sub_field('type') == 'tab_slider' || get_sub_field('type') == 'timeline'
                ? 'adjust-height' : '';
?>


<?php if($slides_object['slides'][0]['icon']): ?>
<ul class="slider-tabs slick-control" role="tablist">
    <?php $i = 0; foreach($slides_object['slides'] as $tab): ?>
        <li role="presentation" class="col-xs-2 <?php echo $i == 0 ? 'active col-sm-offset-' . $offset: ''; ?>">
            <a href="#" role="tab" data-toggle="tab">
                <img src="<?php echo $tab['icon']['sizes']['medium']; ?>">
            </a>

            <?php if($tab['title']): ?>
                <span class="text-uppercase extra-letter-spacing"><?php echo $tab['icon_text']; ?></span>
            <?php endif; ?>
        </li>
    <?php $i++; endforeach; ?>
</ul>
<?php endif; ?>

<?php if(count($slides_object['slides']) > 0): ?>

    <div class="slick-container <?php the_sub_field('type'); ?> <?php echo $slides_object['arrows'] == 'true' ? 'arrows' : ''; ?>"
         style="background-image:url(<?php echo isset($slides_object['background_image']) ? $slides_object['background_image'] : ''; ?>)"
         data-arrow-bg="<?php echo $slides_object['arrow_background_color']; ?>">

         <?php if(get_sub_field('type') == 'personal_story'): ?>
         <div class="col-sm-6 col-sm-offset-6">
            <div class="content-padding-wrapper">
                <div class="slider-title content-padding h1 text-white text-bold"><?php echo $slides_object['post_title']; ?><br/>
                    <span class="small"><?php echo $slides_object['sub_title']; ?></span>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="slick" data-slick='{"arrows": <?php echo $slides_object['arrows']; ?>,
                                        "slidesToShow": <?php echo $slides_object['slides_to_show']; ?>,
                                        "slidesToScroll": 1}'>
            <?php foreach ($slides_object['slides'] as $slide): ?>
        		<div class="slide slick-slide">
                    <div class="slide-content"
                         style="height:<?php the_sub_field('height'); ?>px;
                                background-image: url(<?php echo isset($slide['image']) ? $slide['image'] : ''; ?>);">

					</div>
                    <div class="<?php echo $ajust_height; ?>">
                        <div class="caption content-padding-wrapper <?php the_sub_field('caption_background_color'); ?>">
                            <div class="content-padding">
                                <?php if($slide['title']): ?>
                                    <h3><?php echo $slide['title']; ?></h3>
                                <?php endif; ?>
                                <?php if($slide['description']): ?>
                                    <p><?php echo $slide['description']; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
            		</div>
        		</div>

            <?php endforeach; ?>
        </div>
    </div>


<? endif; ?>