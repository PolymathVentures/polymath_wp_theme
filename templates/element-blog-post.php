<div class="col-sm-8">
    <div class="white text-left extra-padding-horizontal extra-padding-vertical">
        <?php the_post_thumbnail(); ?>
        <h2><?php the_title(); ?></h2>
        <?php get_template_part('templates/entry-meta'); ?>
        <div class="entry-content">
            <?php the_content(); ?>
        </div>
        <?php get_template_part('templates/element-share-buttons'); ?>
    </div>
</div>
