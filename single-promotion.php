<?php include 'components/header.php' ?>

<main>
	<section>
		<div class="container-xl">
			<div class="row pb-3 pt-lg-3">
				<?php $banner = get_field('Banner');
				if ($banner): ?>
					<div class="col-12 order-xl-2 pb-0 px-0 px-xl-3">
						<div class="wdl-metadata-banner">
							<img loading="lazy" src="<?php the_field('Banner'); ?>" alt="<?php the_title(); ?>" />
						</div>
					</div>
				<?php endif; ?>

				<!-- <div class="col-12 order-xl-1 py-4">
				<?php if (function_exists('rank_math_the_breadcrumbs')): ?>
					<div class="wdl-breadcrumb">
						<?php rank_math_the_breadcrumbs(); ?>
					</div>
					<?php endif; ?>
				</div> -->
			</div>
		</div>
	</section>
	<section class="wdl-sticky-bar">
		<a id="apply-cta" href="#apply" data-bs-toggle="modal">
			<div class="container-xl">
				<div class="row align-items-center g-3">
					<div class="col-12 col-sm col-lg-9">
						<div class="row g-4 align-items-center">
							<div class="col-auto">
								<?php $logo = get_field('Logo');
								if ($logo): ?>
									<div class="wdl-metadata-logo">
										<img loading="lazy" src="<?php echo esc_url($logo['sizes']['medium']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" height="40" />
									</div>
								<?php endif; ?>
							</div>
							<div class="col">
								<h1 class="h6 text-secondary mb-0 wdl-sticky-bar-title">
									<?php the_title() ?>
								</h1>
							</div>
						</div>
					</div>
					<?php $sponsored = get_field('Sponsor', $relatedPost->ID); ?>
					<div class="col-12 col-sm-auto col-lg-3 text-center text-lg-end mb-2 mb-sm-0">
						<button class="wdl-btn">
							<?php _e('สนใจรับโปรโมชั่น', 'สนใจรับโปรโมชั่น'); ?>
						</button>
					</div>
				</div>
			</div>
		</a>
	</section>
	<section class="wdl-main-bar">
		<div class="container-xl">
			<div class="row align-items-center">
				<div class="col-sm-2 mb-4 mb-xl-0 d-none d-lg-block">
					<?php $logo = get_field('Logo');
					if ($logo): ?>
						<div class="wdl-metadata-logo">
							<img loading="lazy" src="<?php echo esc_url($logo['sizes']['medium']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" />
						</div>
					<?php endif; ?>
				</div>
				<div class="col-sm mb-3 mb-sm-0">
					<p class="mb-0"><a class="text-accent" href="/promotion">
							<?php _e('Promotion', 'Promotion') ?>
						</a></p>
					<h1 class="wdl-single-title">
						<?php the_title(); ?>
					</h1>
					<?php
					$date = get_field('Date');
					if ($date): ?>
						<p><span class="badge wdl-badge-sm-primary">
								<?php the_field('Date') ?>
							</span></p>
					<?php endif; ?>
					<?php
					$relatedVenue = get_field('RelatedVenue');
					if ($relatedVenue):
						foreach ($relatedVenue as $venue):
							$venuePermalink = get_permalink($venue->ID);
							$venueTitle = get_the_title($venue->ID); ?>
							<p class="wdl-archive-location mb-0">
								<a class="wdl-data-venue" href="<?php echo esc_html($venuePermalink) ?>">
									<?php echo esc_html($venueTitle); ?>
								</a>
							</p>
						<?php endforeach; endif; ?>
				</div>
				<div class="col-sm-auto text-center text-sm-end">
					<a id="apply-cta" href="#apply" class="wdl-btn-lg" data-bs-toggle="modal">
						<?php _e('สนใจรับโปรโมชั่น', 'Apply for Promotion'); ?>
					</a>
				</div>
			</div>
		</div>
	</section>
	<section>
		<div class="container-xl">
			<div class="row my-5">
				<div class="col text-secondary">
					<div class="wdl-main-content">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
			<div class="row my-4">
				<div class="col text-center">
					<a id="apply-cta" href="#apply" class="wdl-btn-lg" data-bs-toggle="modal">
						<?php _e('สนใจรับโปรโมชั่น', 'Apply for Promotion'); ?>
					</a>
				</div>
			</div>
			<?php
			$images = get_field('Gallery');
			if ($images):
				?>
				<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 my-4 wdl-gallery">
					<div class="col-12 col-sm-12 col-md-12">
						<h3 class="h6 text-secondary">ตัวอย่างภาพถ่ายจากสถานที่จริง</h3>
					</div>
					<?php
					// Grab each image.
					foreach ($images as $image):
						$image_id = $image['ID'];
						$image_src = $image['url'];
						$image_caption = $image['caption'];
						?>
						<div class="col">
							<a href="#" title="<?php echo esc_html($image_caption); ?>" class="wdl-gallery-item" data-bs-toggle="modal" data-bs-target="#gallery">
								<?php echo wp_get_attachment_image($image_id, 'medium-large'); ?>
							</a>
						</div>
						<?php
					endforeach;
					?>
				</div>
			<?php endif; ?>
			<div class="row row-cols-1">
				<?php $afterContent = get_field('AfterContent');
				if ($afterContent): ?>
					<div class="col">
						<?php the_field('AfterContent') ?>
					</div>
				<?php endif ?>

				<?php $tel = get_field('Tel');
				if ($tel): ?>
					<div class="col">
						<p>
							<?php _e('โทร', 'Tel') ?> :
							<?php the_field('Tel') ?>
						</p>
					</div>
				<?php endif ?>
				<?php $email = get_field('FormRecepient');
				if ($email): ?>
					<div class="col">
						<p>
							<?php _e('อีเมล', 'Email') ?> :
							<?php the_field('FormRecepient') ?>
						</p>
					</div>
				<?php endif ?>
			</div>
		</div>
	</section>

	<div class="modal fade modal-lg" id="apply">
		<div class="modal-dialog modal-dialog-centered m-auto">
			<div class="modal-content m-3 mb-0">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				<div class="modal-body">
					<h3 class="mt-2">ตอบคำถามสั้น ๆ เพื่อรับสิทธิพิเศษสำหรับคุณ!</h3>
					<hr>
					<?php if ($venueTitle): ?>
						<p class="wdl-archive-location mb-2">
							<?php echo esc_html($venueTitle) ?>
						</p>
					<?php endif; ?>
					<?php $microsite = get_field('Microsite');
					if ($microsite && in_array('Free Microsite', $microsite)): ?>
						<?php echo apply_shortcodes('[contact-form-7 id="206309" title="Promotion Form : Free"]') ?>
					<?php else: ?>
						<?php echo apply_shortcodes('[contact-form-7 id="35" title="Promotion Form"]'); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade wdl-gallery-modal" id="gallery">
		<div class="modal-dialog modal-dialog-centered modal-xl">
			<div class="modal-content m-3 mb-0">
				<div class="modal-body">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

					<?php
					if ($images):
						?>
						<div class="swiper wdl-gallery-modal-swiper">
							<div class="swiper-wrapper">
								<?php
								// Grab each image.
								foreach ($images as $image):
									$image_id = $image['ID'];
									$image_src = $image['url'];
									$image_caption = $image['caption'];
									?>
									<div class="swiper-slide wdl-gallery-modal-item">
										<?php echo wp_get_attachment_image($image_id, 'large'); ?>
									</div>
								<?php endforeach; ?>
							</div>
							<div class="swiper-pagination"></div>
						</div>
						<div class="swiper-navigation">
							<div class="swiper-button-prev"></div>
							<div class="swiper-button-next"></div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

	<?php $featured_posts = get_field('RelatedPosts');
	if ($featured_posts): ?>
		<section class="my-5 pb-5 overflow-hidden">
			<div class="container-xl">
				<div class="row align-items-center">
					<div class="col-12">
						<div class="wdl-archive <?php echo esc_attr($atts['class']); ?>">
							<h3 class="h4 mb-4">
								<?php _e('โปรโมชั่นงานแต่งงานแนะนำ', 'Recommended Wedding Promotion') ?>
							</h3>
							<div class="swiper wdl-archive-swiper overflow-visible">
								<div class="swiper-wrapper">
									<?php foreach ($featured_posts as $post):
										// Setup this post for WP functions (variable must be named $post).
										setup_postdata($post); ?>

										<div id="wdl-post-<?php the_ID(); ?>" class="swiper-slide card wdl-archive-card <?php echo esc_attr($atts['class_single']); ?>">

											<?php if (has_post_thumbnail(get_the_ID())): ?>
												<a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>"><img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($post, 'medium_large')) ?>" width="100%"></a>
											<?php endif; ?>

											<div class="card-body wdl-archive-card-body">
												<div class="wdl-badge-container mb-2">
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

												<div class="wdl-archive-pretitle mb-2">
													<?php
													$relatedVenue = get_field('RelatedVenue');
													$relatedVenueType = get_field('VenueType', $relatedVenue->ID);
													if ($relatedVenue): ?>
														<small>
															<?php echo $relatedVenueType->name ?>
														</small>
													<?php endif; ?>
												</div>

												<h3 class="wdl-archive-title"><a href="<?php the_permalink(); ?>">
														<?php the_title(); ?>
													</a></h3>

												<?php
												$relatedVenue = get_field('RelatedVenue');
												if ($relatedVenue):
													foreach ($relatedVenue as $venue):
														$venuePermalink = get_permalink($venue->ID);
														$venueTitle = get_the_title($venue->ID); ?>
														<p class="wdl-archive-location mb-0">
															<a href="<?php echo esc_html($venuePermalink) ?>">
																<?php echo esc_html($venueTitle); ?>
															</a>
														</p>
													<?php endforeach; endif; ?>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
								<div class="swiper-pagination"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>

</main>

<?php include 'components/footer.php' ?>