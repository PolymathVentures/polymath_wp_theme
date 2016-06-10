<?php
$icons = get_sub_field('icons');
$count = count($icons);
$offset = (12 - $count * 2) / 2;
?>

<?php $i = 0; foreach($icons as $icon): ?>
    <div class="col-sm-2 <?php echo $i == 0 ? 'active col-sm-offset-' . $offset: ''; ?> col-xs-6 text-uppercase extra-letter-spacing">

        <?php if(get_sub_field('link')): ?>
            <a href="<?php the_sub_field('link'); ?>">
        <?php endif; ?>

            <img src="<?php echo $icon['image']['sizes']['medium']; ?>" width="100%"><br /><br />

        <?php if(get_sub_field('link')): ?>
            </a>
        <?php endif; ?>

        <?php echo $icon['text']; ?>
    </div>
<?php $i++; endforeach; ?>