<div class="content-padding-wrapper">
	<div class="content-padding">
		<div class="calc-height" data-height-group="promos">
			<?php if(isset($promo['post_title'])): ?>
				<p class="h2"><?php echo $promo['post_title']; ?></p>
			<?php endif; ?>
			<?php if($promo['description']): ?>
				<p class="big">
					<?php echo $promo['description']; ?>
					<br />
				</p>
			<?php endif; ?>

			<?php if(isset($promo['team_member'])): ?>
				<?php $person = formatPersonInfo($promo['team_member']); ?>

				<a href="#" class="text-uppercase show-person-modal big"
					data-title="<?php echo htmlspecialchars($person['title']); ?>"
					data-description="<?php echo htmlspecialchars($person['full_description']); ?>"
					data-picture="<?php echo $person['image']['sizes']['original']; ?>"><?php echo $promo['team_member']->post_title; ?> - <?php echo $person['current_job_title'] . ' @ ' . $person['current_venture']; ?></a>
				<br />
			<?php endif; ?>
		</div>
		<?php if($promo['link']): ?>
			<br />
			<br />
			<a class = "btn btn-primary" href="<?php echo $promo['link']; ?>">
				<?php echo $promo['button_text']; ?>
			</a>
		<?php endif; ?>
	</div>
</div>