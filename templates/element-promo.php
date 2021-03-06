<div class="content-padding-wrapper">
	<div class="content-padding">
		<div class="calc-height" data-height-group="promos">
			<?php if(isset($promo['post_title'])): ?>
				<p class="h2">
					<span class="text-uppercase small">
						<?php if($promo['post_type'] == 'post'): ?>
							News
						<?php elseif($promo['team_member']): ?>
							Team
						<?php else: ?>
							Learn more
						<?php endif; ?>
					</span><br/>
					<?php echo $promo['post_title']; ?>
				</p>
			<?php endif; ?>
			<?php if($promo['description']): ?>
				<p class="big">
					<?php echo $promo['description']; ?>
					<br />
				</p>
			<?php endif; ?>

			<?php if($promo['team_member']): ?>
				<?php $person = formatPersonInfo($promo['team_member']); ?>

				<a href="#" class="text-uppercase show-person-modal big"
					data-title="<?php echo htmlspecialchars($person['title']); ?>"
					data-description="<?php echo htmlspecialchars($person['full_description']); ?>"
					data-picture="<?php echo $person['image']['sizes']['original']; ?>">

					<?php echo $promo['team_member']->post_title; ?> - <?php echo $person['current_job_title'] . ' @ ' . $person['current_venture']; ?>
				</a>

				<br />
			<?php endif; ?>
		</div>
		<?php if($promo['link']): ?>
			<br />
			<a class = "btn btn-primary" href="<?php echo $promo['link']; ?>">
				<?php echo $promo['button_text']; ?>
			</a>
		<?php elseif($promo['button_text']): ?>
			<br>
			<a class="btn btn-primary" href="<?= explode(',', $promo['button_text'])[1] ?>">
				<?= explode(',', $promo['button_text'])[0] ?>
			</a>
		<?php endif; ?>
	</div>
</div>