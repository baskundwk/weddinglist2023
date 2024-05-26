<?php defined('ABSPATH') || exit; ?>

<div class="wdl-archive <?php echo esc_attr($atts['class']); ?>">

	<?php if ($posts->have_posts()): ?>

		<div class="swiper wdl-archive-swiper overflow-visible">
			<div class="swiper-wrapper">
				<?php while ($posts->have_posts()): ?>
					<?php $posts->the_post(); ?>

					<div id="wdl-post-<?php the_ID(); ?>" class="swiper-slide card wdl-archive-card <?php echo esc_attr($atts['class_single']); ?>">

						<?php if (has_post_thumbnail(get_the_ID())): ?>
							<a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>">
								<?php echo get_the_post_thumbnail(get_the_ID(), 'medium_large') ?>
							</a>
						<?php endif; ?>

						<div class="card-body wdl-archive-card-body">
							<div class="wdl-badge-container mb-1">
								<?php
								$date = get_field('Date');
								if ($date): ?>
									<span class="badge wdl-badge-sm-primary">
										<?php the_field('Date') ?>
									</span>
								<?php endif; ?>
								<?php $hotDeal = get_field('HotDeal');
								if ($hotDeal && in_array('Hot Deal', $hotDeal)): ?>
									<span class="badge wdl-badge-sm">Hot Deal</span>
								<?php endif; ?>
							</div>

							<?php
							$relatedVenue = get_field('RelatedVenue');
							if ($relatedVenue):
								foreach ($relatedVenue as $venue):
									$venueType = get_field('VenueType', $venue->ID);
									?>
									<div class="wdl-archive-pretitle mb-0">
										<small>
											<?php echo $venueType[0]->name ?>
										</small>
									</div>
								<?php endforeach; endif; ?>

							<h3 class="wdl-archive-title mb-0"><a href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
								</a></h3>

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

				<?php endwhile; ?>
			</div>
			<div class="swiper-pagination"></div>
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