<div class="col-sm-8">
    <div class="white text-left content-padding-wrapper">
        <article class="content-padding">
            <h2><?php the_title(); ?></h2>
            <?php get_template_part('templates/entry-meta'); ?>
            <hr/>
            <div class="blog-image responsive-bg"
                 data-bg-json='<?php echo json_encode(format_attachment_sizes_array(get_post_thumbnail_id())); ?>'
                 style="height:300px !important;">
            </div>
            <br/>
            <br/>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
            <hr/>
            <?php get_template_part('templates/element-share-buttons'); ?>
        </article>
    </div>
</div>
