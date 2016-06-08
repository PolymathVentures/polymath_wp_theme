<?php if(count($slides_object['slides']) > 0): ?>
    <div class="slick-container <?php the_sub_field('type'); ?>"
         style="background-image:url(<?php echo isset($slides_object['background_image']) ? $slides_object['background_image'] : ''; ?>)">
        <div class="slick" data-slick='{"arrows": <?php echo $slides_object['arrows']; ?>,
                                        "dots": <?php echo $slides_object['dots']; ?>,
                                        "slidesToShow": <?php echo $slides_object['slides_to_show']; ?>,
                                        "slidesToScroll": 1}'>
            <?php foreach ($slides_object['slides'] as $slide): ?>
        		<div class="slide slick-slide">
                        <div class="slide-content"
                             style="height:<?php the_sub_field('height'); ?>px;
                                    background-image: url(<?php echo isset($slide['image']) ? $slide['image'] : ''; ?>);">
                            <div class="caption">
            					<h3><?php echo $slide['title']; ?></h3>
            					<p><?php echo $slide['description']; ?></p>
                            </div>
    					</div>
        		</div>

            <?php endforeach; ?>
        </div>
    </div>
<? endif; ?>