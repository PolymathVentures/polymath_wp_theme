<?php while (have_posts()) : the_post(); ?>
    <?php if(get_post_type() == 'post'): ?>
    <div class="container">
        <div class="row post-list">
            <div class="extra-padding-vertical">
                <?php get_template_part('templates/element-blog-post'); ?>
                <?php get_template_part('templates/element-blog-posts'); ?>
            </div>
        </div>
    </div>

<?php else: ?>
    <?php get_template_part('templates/pagebuilder'); ?>
<?php endif; ?>
<?php endwhile; ?>



