<?php defined('ABSPATH') || exit; ?>

<div class="wdl-archive <?php echo esc_attr($atts['class']); ?>">

	<?php if ($posts->have_posts()) : ?>
		<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-3">

			<?php while ($posts->have_posts()) : ?>
				<?php $posts->the_post(); ?>

				<div class="col">
					<div id="wdl-post-<?php the_ID(); ?>" class="card wdl-archive-card <?php echo esc_attr($atts['class_single']); ?>">

						<?php if (has_post_thumbnail(get_the_ID())) : ?>
							<a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>">
								<img class="" src="<?php echo esc_html(get_the_post_thumbnail_url($post, 'medium')) ?>" width="100%">
								<?php $sponsored = get_field('Sponsor');
								if ($sponsored && in_array('Sponsored', $sponsored)) : ?>
									<span class="badge wdl-badge-sm">Sponsored</span>
								<?php endif; ?>
							</a>
						<?php endif; ?>

						<div class="card-body wdl-archive-card-body">
							<h3 class="wdl-archive-title "><a href="<?php the_permalink(); ?>"><?php the_split_title(); ?></a></h3>

							<div class="wdl-metadata">
								<?php
								$locations = get_field('Location');
								if ($locations) : ?>
									<div class="wdl-archive-neighborhood">
										<ul>
											<?php foreach ($locations as $location) : ?>
												<li>
													<?php echo esc_html($location->name); ?>
												</li>
											<?php endforeach; ?>
										</ul>
									</div>
								<?php endif; ?>

								<?php
								$minPrice = get_field('MinPrice');
								if ($minPrice) : ?>
									<div class="wdl-archive-min-price">
										<?php _e('ราคาเริ่มต้น', 'Starting price') ?>&nbsp;<strong><?php echo the_field('MinPrice') ?>+ <?php _e('บาท', 'THB') ?></strong>
									</div>
								<?php endif; ?>

								<?php
								$maxGuest = get_field('MaxGuest');
								if ($maxGuest) : ?>
									<div class="wdl-archive-max-guest">
										<?php _e('รองรับแขกสูงสุด', 'Max guest') ?>&nbsp;<strong><?php echo the_field('MaxGuest') ?> <?php _e('คน', 'people') ?></strong>
									</div>
								<?php endif; ?>
							</div>
						</div>

					</div>
				</div>

			<?php endwhile; ?>

		</div>
		<?php else : ?>
			<div class="row">
				<div class="col">
					<h4><?php esc_html_e('ไม่พบโพสต์ในหมวดหมู่ดังกล่าว', 'Post not found'); ?></h4>
				</div>
			</div>
		<?php endif; ?>

</div>