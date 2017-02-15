<div class="featured-image responsive-bg"
     data-bg-json='<?php echo json_encode($params['background_image']['sizes']); ?>'
     style="height:<?php echo $params['height']; ?>px;">
    <div class="featured-image-inner <?php echo $params['overlay_color']; ?>">
        <div class="container">
            <div class="row">
                <div class="<?php echo $params['alignment']; ?>">
                    <div class="extra-padding-horizontal extra-padding-vertical">
                        <?php if($params['title']): ?>
                            <h1 class="<?php echo $params['title_size']; ?> extra-letter-spacing"><?php echo $params['title']; ?></h1>
                        <?php endif; ?>

                        <?php if($params['text']): ?>
                            <p class="big"><?php echo $params['text']; ?></p>
                        <?php endif; ?>

                        <?php if($params['button_link']): ?>
                            <p class="big extra-padding-vertical">
                                <a class="btn btn-primary" href="<?php echo $params['button_link']; ?>">
                                   <?php echo $params['button_text']; ?>
                                </a>
                           </p>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>