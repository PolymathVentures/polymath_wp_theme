<ul>
<?php $jobs = array_slice(greenhouse_jobs(), 0, 10); ?>
<?php foreach ( $jobs as $job ): ?>

<li>
	<a href="<?=get_job_url($job)?>">
		<?=$job['title']?> - <?=$job['offices'][0]['name']?>
	</a>
</li>

<?php endforeach; ?>
</ul>
