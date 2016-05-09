<?php
$ventures = '';
if (get_field( "ventures" )) {
    $ventures .= implode(' ', get_field( "ventures" ));
};

$seeds = '';
if (get_field( "seeds" )) {
    $seeds .= implode(' ', get_field( "seeds" ));
};
?>

<div class="col-md-3 col-sm-6 col-xs-12 mix <?php echo $ventures . ' ' . $seeds; ?>">
    <article <?php post_class(); ?>>
      <header>
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      </header>
      <div class="entry-summary">
        <?php the_field( "experience" ); ?>
      </div>
    </article>
</div>
