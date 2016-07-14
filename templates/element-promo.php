<div class="content-padding-wrapper">
	<div class="content-padding">
		<p class="h2"><?php echo $promo['post_title']; ?></p>
		<p class="big">
			<?php if(isset($promo['description'])): ?>
				<?php echo $promo['description']; ?>
				<br />
			<?php endif; ?>

			<?php if(isset($promo['team_member'])): ?>
				<a href="<?php echo get_home_url() . '/team/#person-' . $promo['team_member']->ID; ?>" class="text-uppercase text-underline"><?php echo $promo['team_member']->post_title; ?></a>
			<?php endif; ?>
	        <?php if($promo['link']): ?>
	            <br/>
	            <a class = "btn btn-primary" href="<?php echo $promo['link']; ?>">
	                <?php echo $promo['button_text']; ?>
	            </a>
			<?php endif; ?>
		</p>
	</div>
</div>