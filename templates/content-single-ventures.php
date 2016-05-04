<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>
    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>

<?php

$items = array();

// check if the repeater field has rows of data
if( have_rows('milestones') ):

 	// loop through the rows of data
    while ( have_rows('milestones') ) : the_row();

        $items[] = array('title' => get_sub_field('title'),
                         'description' => get_sub_field('description'));

    endwhile;

else :

endif;


echo carousel_shortcode(array('category' => 'venture-slider', 'items' => $items)); 

?>
