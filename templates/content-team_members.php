<?php
$tags = wp_get_post_terms(get_the_ID(), 'team_tag', array("fields" => "slugs"));
$tags = implode(' ', $tags);
?>

<div class="col-md-4 mix <?php echo $tags; ?>">
    <article <?php post_class(); ?>>
      <header>
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      </header>
      <div class="entry-summary">
        <?php the_field( "experience" ); ?>
      </div>
    </article>
</div>
