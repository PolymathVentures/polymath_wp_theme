<?php

$promo = get_post_with_custom_fields($promo);

?>
<div>
	<p class="text-bold h2"><?php echo $promo['post_title']; ?></p>
	<p class="big">
		<?php echo $promo['description']; ?>
		<br />

		<?php echo isset($promo['person_name']) ? $promo['person_name'] : ''; ?>
        <?php if($promo['link']): ?>
            <br/>
            <a class = "btn btn-primary" href="<?php echo $promo['link']; ?>">
                <?php echo $promo['button_text']; ?>
            </a>
		<?php endif; ?>
	</p>
</div>