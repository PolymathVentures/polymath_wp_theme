<div class="btn-group">
    <button type="button" class="btn custom-button" data-label="<?php echo $items[0]->button_text; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span><?php echo $items[0]->button_text; ?></span>
    </button>
    <ul class="dropdown-menu bullet pull-center custom-dropdown show-selected">
        <?php foreach($items as $item): ?>
			<? $key = isset($item->ID) ? $item->ID : $item->slug;
			   $val = isset($item->post_title) ? $item->post_title : $item->name; ?>
            <li><a href="#" class="filter" data-filter=".<?php echo $key; ?>"><?php echo $val; ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>