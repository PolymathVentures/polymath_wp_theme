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

<div class="col-md-4 col-sm-4 <?php echo $ventures . ' ' . $seeds; ?>">
    <h3>
        <?php
        if (get_field( "type" ) == 'currency'):
            echo '$' . get_field( "number" ) . ' ' . get_the_title();
        elseif (get_field( "type" ) == 'percentage'):
            echo get_field( "number" ) . '% ' . get_the_title();
        elseif (get_field( "type" ) == 'number'):
            echo get_field( "number" ) . ' ' . get_the_title();
        endif;
        ?>
    </h3>
</div>
