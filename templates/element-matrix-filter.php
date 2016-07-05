<?php

if(is_object(reset($items))) {
    $button = $items[0]->button_text;

    $labels = array();

    foreach($items as $item) {
        $key = isset($item->ID) ? $item->ID : $item->slug;
        $val = isset($item->post_title) ? $item->post_title : $item->name;

        $labels[$key] = $val;
    }
} else {

    $labels = $items;
    $button = array_pop($labels);

}

?>

<div class="btn-group">
    <button type="button" class="btn custom-button" data-label="<?php echo $button; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span><?php echo $button; ?></span>
    </button>
    <ul class="dropdown-menu bullet pull-center custom-dropdown show-selected">
        <?php foreach($labels as $key => $val): ?>

            <li><a href="#" class="filter" data-filter=".<?php echo $key; ?>"><?php echo $val; ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>