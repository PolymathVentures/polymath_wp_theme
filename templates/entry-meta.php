<p class="byline author vcard text-gray">
    <?php $ventures = array_map(function($v) { return get_the_title($v); }, get_field( "ventures" ) ?: []); ?>
    <?php $seeds = array_map(function($s) { return get_the_title($s); }, get_field( "seeds" ) ?: []); ?>
    <?php $tags = array_map(function($t) { return $t->name; }, get_the_tags() ?: []); ?>
    <i class="icon-user icons"></i> <?= get_the_author(); ?> &nbsp;&nbsp;&nbsp;
    <i class="icon-clock icons"></i> <time class="updated" datetime="<?= get_post_time('c', true); ?>"><?= get_the_date(); ?></time> &nbsp;&nbsp;&nbsp;
    <i class="icon-tag icons"></i> <?php echo implode(', ', array_merge($ventures, $seeds, $tags)); ?>

</p>
