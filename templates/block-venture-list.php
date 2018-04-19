<?php
	$current_id = get_the_ID();

	$args = [
		"posts_per_page" => -1,
		"orderby"        => "publish",
		"post_type"		   => "ventures",
		"order"          => "ASC",
		"post_status"    => "publish",
	];
	$ventures = new WP_query($args);
?>

<?php if( $ventures->have_posts() ): ?>
	<div class="post-list">
	<?php $i = 0; while( $ventures->have_posts() ) : $ventures->the_post(); ?>
		<?php if($current_id == get_the_ID()) continue; ?>
		<?php if( get_the_title() == "Polymath" ) continue; ?>
		<?php
			if( isset($params) and isset($params["filter_by"]) ) {
				if( $params["filter_by"]=="Active" and get_field("month_stopped")!=="" )
					continue;
				else if( $params["filter_by"]=="Stopped" and get_field("month_stopped")==="" )
					continue;
				else if( in_array(get_the_title(), explode(",", $params["exclude"])) )
					continue;
			}
		?>
		<?php if($i % 3 == 0): ?>
			<div class="row">
		<?php endif; ?>

		<div class="col-sm-4 post-list-item margin-bottom">
			<?php if( $params["filter_by"]=="Active" ) { ?>
				<a href="<?php the_permalink(); ?>" class="text-dark">
			<?php } ?>
				<div class="venture-logo" style="border-bottom: 4px solid <?php the_field('brand_color'); ?>;">
					<img src="<?php echo get_field('logo')['sizes']['post_list_thumb']; ?>"/>
					<div class="blog-post-more-button"><span class="plus text-center">+</span></div>
				</div>
				<article class="white content-padding-wrapper calc-height" data-height-group="ventures">
					<div class="content-padding">
						<header>
							<h3 class="text-bold">
								<?php the_title(); ?><br />
								<span class="small">Launched: <span class="text-italic">
									<?php
										if( $params["filter_by"]=="Active" ) {
											echo explode(" ", get_field('month_launched'))[1];
										} else if( $params["filter_by"]=="Stopped" ) {
											$year_start = explode(" ", get_field('month_launched'))[1];
											$year_stop  = explode(" ", get_field('month_stopped'))[1];
											if( $year_start==$year_stop )
												the_field("month_launched");
											else
												echo explode(" ", get_field('month_launched'))[1];
										}
									?>
								</span></span>
								<?php if( $params["filter_by"]=="Stopped" ) { ?>
									<br><span class="small">Stopped: <span class="text-italic">
										<?php
											$year_start = explode(" ", get_field('month_launched'))[1];
											$year_stop  = explode(" ", get_field('month_stopped'))[1];
											if( $year_start==$year_stop )
												the_field("month_stopped");
											else
												echo explode(" ", get_field('month_stopped'))[1];
										?>
									</span></span>
								<?php } ?>
							</h3>
						</header>
						<p><?php the_field('description'); ?></p>
					</div>
				</article>
			<?php if( $params["filter_by"]=="Active" ) { ?>
				</a>
			<?php } ?>
		</div>

		<?php $i++; if ($i % 3 == 0 || $i == $ventures->found_posts): ?>
			</div>
		<?php endif; ?>
	<?php endwhile; ?>
	</div>
<?php endif; ?>
<?php wp_reset_query(); ?>
