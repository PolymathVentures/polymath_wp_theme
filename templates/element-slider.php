<?php
$tabs = count($slides_object['slides']);
$offset = (12 - $tabs * 2) / 2;
$ajust_height = $params['type'] == 'tab_slider' || $params['type'] == 'timeline'
                ? 'adjust-height' : '';
?>


<?php if($slides_object['slides'][0]['icon']): ?>
<ul class="slider-tabs slick-control" role="tablist">
    <?php $i = 0; foreach($slides_object['slides'] as $tab): ?>
        <li role="presentation" class="col-xs-12 col-sm-2 <?php echo $i == 0 ? 'active col-sm-offset-' . $offset: ''; ?>">
            <a href="#" role="tab" data-toggle="tab">
                <img src="<?php echo $tab['icon']['sizes']['medium']; ?>">
            </a><br/><br/>

            <?php if($tab['icon_text']): ?>
                <span class="text-uppercase extra-letter-spacing"><?php echo $tab['icon_text']; ?></span>
            <?php endif; ?>

            <div class="visible-xs-block"><?php echo $tab['description']; ?><br/><br/><br/></div>

        </li>
    <?php $i++; endforeach; ?>
</ul>
<?php endif; ?>

<?php if(count($slides_object['slides']) > 0): ?>
    <div class="slick-container <?php echo $params['type'] == 'tab_slider' ? 'hidden-xs' : ''; ?> <?php echo $params['type']; ?> <?php echo $slides_object['arrows'] == 'true' ? 'arrows' : ''; ?>
    <?php echo explode(' ', $params['caption_background_color'])[1]; ?> responsive-bg"
         data-bg-json='<?php echo json_encode(get_or_empty($slides_object, 'background_image', array('sizes' => null))['sizes']); ?>'
         data-arrow-bg="<?php echo get_or_empty($params, 'arrow_background_color'); ?>">

         <?php if($params['type'] == 'personal_story'): ?>
         <div class="col-sm-6 col-sm-offset-6">
            <div class="content-padding-wrapper">
                <?php if($params['show_title']): ?>
                    <div class="slider-title content-padding h1 text-white text-bold"><?php echo $slides_object['post_title']; ?><br/>
                        <span class="small"><?php echo $slides_object['sub_title']; ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
        <div class="slick" data-slick='{"arrows": <?php echo $slides_object['arrows']; ?>,
                                        "slidesToShow": <?php echo $slides_object['slides_to_show']; ?>,
                                        "fade": <?php echo $params['animation'] ?: 'false'; ?>,
                                        "autoplay": <?php echo $params['autoplay'] ?: 'true'; ?>,
                                        "slidesToScroll": 1}'>
            <?php foreach ($slides_object['slides'] as $slide): ?>
        		<div class="slide slick-slide">
                    <div class="slide-content responsive-bg"
                         data-bg-json='<?php echo json_encode($slide['image']['sizes']); ?>'
                         style="height:<?php echo $params['height']; ?>px;">

					</div>
                    <?php if($params['type'] !== 'team'): ?>
                        <div class="row">
                        <div class="<?php the_sub_field('caption_column_width'); ?>">
                    <? endif; ?>
                        <div class="<?php echo $ajust_height; ?>">
                            <div class="caption content-padding-wrapper
                                        <?php echo $params['caption_background_color']; ?>
                                        <?php echo $params['type'] == 'team' ? 'show-person-modal' : ''; ?>"
                                 data-title="<?php echo htmlspecialchars($slide['title']); ?>"
                                 data-description="<?php echo htmlspecialchars($slide['full_description']); ?>"
                                 data-picture="<?php echo $slide['image']['sizes']['original']; ?>">
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
                        <?php if($params['type'] !== 'team'): ?>
            		      </div>
            		      </div>
                        <?php endif; ?>
        		</div>

            <?php endforeach; ?>
        </div>
    </div>


<? endif; ?>
