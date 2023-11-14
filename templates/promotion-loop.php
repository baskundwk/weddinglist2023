<?php defined('ABSPATH') || exit; ?>

<div class="wdl-archive <?php echo esc_attr($atts['class']); ?>">

	<?php if ($posts->have_posts()): ?>

		<div class="row row-cols-1 row-cols-md-2 row-cols-lg-auto gy-3">
			<?php while ($posts->have_posts()): ?>
				<?php $posts->the_post(); ?>

				<div class="col-auto">
					<div id="wdl-post-<?php the_ID(); ?>" class="card wdl-archive-card <?php echo esc_attr($atts['class_single']); ?> p-2 wdl-archive-card-blog gap-2">

						<?php if (has_post_thumbnail(get_the_ID())): ?>
							<a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail('medium_large') ?>
							</a>
						<?php endif; ?>

						<div class="card-body wdl-archive-card-body">
							<h3 class="wdl-archive-title text-sm"><a href="<?php the_permalink(); ?>">
									<?php echo wp_trim_words(get_the_title(), 65); ?>
								</a></h3>
							<?php
							$date = get_field('Date');
							if ($date): ?>
								<div class="wdl-badge-container mb-2">
									<span class="badge wdl-badge-sm-primary">
										<?php the_field('Date') ?>
									</span>
								</div>
							<?php endif; ?>
							<?php
							$relatedVenue = get_field('RelatedVenue');
							if ($relatedVenue):
								foreach ($relatedVenue as $venue):
									$venuePermalink = get_permalink($venue->ID);
									$venueTitle = get_the_title($venue->ID); ?>
									<p class="wdl-archive-location mb-0"><a href="<?php echo esc_html($venuePermalink) ?>">
											<?php echo esc_html($venueTitle); ?>
										</a></p>
								<?php endforeach; endif; ?>

						</div>

					</div>
				</div>

			<?php endwhile; ?>
		</div>

	<?php else: ?>
		<div class="row">
			<div class="col">
				<h4>
					<?php esc_html_e('ไม่พบโพสต์ในหมวดหมู่ดังกล่าว', 'Post not found'); ?>
				</h4>
			</div>
		</div>
	<?php endif; ?>

</div>