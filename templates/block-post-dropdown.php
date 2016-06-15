<?php
$args = array(
	'posts_per_page'   => -1,
	'orderby'          => 'published',
	'post_type'		   => get_sub_field('post_type'),
	'order'            => 'DESC',
	'post_status'      => 'publish',
);

$items = new WP_query($args);

?>


<div class="btn-group">
    <button type="button" class="btn btn-default custom-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span><?php the_sub_field('dropdown_text'); ?></span>
		<!-- <span class="caret"></span> -->
    </button>
    <ul class="dropdown-menu bullet pull-center custom-dropdown">

        <?php if( $items->have_posts() ): ?>
            <?php while( $items->have_posts() ) : $items->the_post(); ?>
                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
            <?php endwhile; ?>
        <?php endif; ?>
    </ul>
</div>

<?php wp_reset_postdata(); ?>