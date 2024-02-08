<?php include 'components/header.php' ?>
<main>
	<section class="py-3 overflow-hidden">
		<div class="container-fluid">
			<?php
			$images = get_field('Gallery');
			$videos = get_field('Video');
			if ($images || $videos):
				?>
				<div class="row g-3 wdl-gallery wdl-hero-gallery">
					<div class="col position-relative">
						<div id="hero-gallery" class="swiper wdl-hero-gallery-swiper <?php if($videos) { echo 'wdl-hero-gallery-video-swiper';} ?>">
							<div class="swiper-wrapper">
								<?php
								foreach ($videos as $video):
									?>
									<div class="swiper-slide">
										<a href="#" class="wdl-gallery-item" data-bs-toggle="modal" data-bs-target="#gallery">
											<?php echo($video['iframe_code']) ?>
										</a>
									</div>
									<?php
								endforeach;
								?>
								<?php
								foreach ($images as $image):
									$image_id = $image['ID'];
									$image_src = $image['ursl'];
									$image_caption = $image['caption'];
									?>
									<div class="swiper-slide">
										<a href="#" title="<?php echo esc_html($image_caption); ?>" class="wdl-gallery-item" data-bs-toggle="modal" data-bs-target="#gallery">
											<?php echo wp_get_attachment_image($image_id, 'w425'); ?>
										</a>
									</div>
									<?php
								endforeach;
								?>
							</div>
						</div>
						<div class="swiper-navigation container">
							<div class="swiper-button-prev"></div>
							<div class="swiper-button-next"></div>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</section>
	<section class="wdl-sticky-bar">
		<div class="container-xl">
			<div class="row align-items-center g-3">
				<div class="col col-lg-6 d-none d-lg-block">
					<div class="row g-4 align-items-center">
						<div class="col-auto">
							<?php $logo = get_field('Logo');
							if ($logo): ?>
								<div class="wdl-metadata-logo">
									<img loading="lazy" src="<?php echo esc_url($logo['sizes']['medium']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" height="40" />
								</div>
							<?php endif; ?>
						</div>
						<div class="col col-lg-auto">
							<h1 class="h6 text-secondary mb-0 wdl-sticky-bar-title">
								<?php the_title() ?>
							</h1>
						</div>
					</div>
				</div>
				<?php $sponsored = get_field('Sponsor', $relatedPost->ID); ?>
				<div class="col col-lg-6 d-flex align-items-center justify-content-center justify-content-lg-end gap-3">
					<a class="wdl-btn" id="apply-cta" href="#apply" data-bs-toggle="modal">
						<?php _e('คลิกขอแพ็กเกจ', 'คลิกขอแพ็กเกจ'); ?>
					</a>
					<a class="wdl-btn-line d-inline-flex d-lg-none" href="https://line.me/R/oaMessage/%40ety4154i/?สวัสดี%20ต้องการขอแพ็คเกจ%20<?php the_title(); ?>%0A<?php the_permalink(); ?>">
						<?php _e('ติดต่อแอดมินผ่าน LINE', 'ติดต่อแอดมินผ่าน LINE'); ?>
					</a>
					<a class="wdl-btn-line d-none d-lg-inline-flex" href="https://line.me/R/ti/p/%40ety4154i">
						<?php _e('ติดต่อแอดมินผ่าน LINE', 'ติดต่อแอดมินผ่าน LINE'); ?>
					</a>
				</div>
			</div>
		</div>
	</section>
	<section class="wdl-main-bar pb-3">
		<div class="container-xl">
			<div class="row">
				<div class="col-lg-2 mb-4 mb-lg-0">
					<?php $logo = get_field('Logo');
					if ($logo): ?>
						<div class="wdl-metadata-logo d-none d-lg-block">
							<img loading="lazy" src="<?php echo esc_url($logo['sizes']['medium']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" />
						</div>
					<?php endif; ?>
					<?php $brochure = get_field('Brochure');
					if ($brochure): ?>
						<div class="mt-1 text-center">
							<a href="#brochure" data-bs-toggle="modal" class="wdl-link-brochure">ดูโบรชัวร์โรงแรม</a>
						</div>
						<div class="modal fade modal-xl" id="brochure">
							<div class="modal-dialog modal-dialog-centered m-auto">
								<div class="modal-content m-3 mb-0">
									<button class="btn-close"></button>
									<div class="modal-body">
										<iframe class="wdl-iframe wdl-iframe-80vh" src="<?php echo($brochure) ?>" width="100%" height="560"></iframe>
										<div class="d-flex flex-column flex-sm-row align-items-center justify-content-center gap-3 mt-3">
											<a id="apply-cta" href="#apply" class="wdl-btn d-inline-block" data-bs-toggle="modal">
												<?php _e('คลิกขอแพ็กเกจ', 'คลิกขอแพ็กเกจ'); ?>
											</a>
											<a class="wdl-btn-line d-inline-flex d-lg-none" href="https://line.me/R/oaMessage/%40ety4154i/?สวัสดี%20ต้องการขอแพ็คเกจ%20<?php the_title(); ?>%0A<?php the_permalink(); ?>">
												<?php _e('ติดต่อแอดมินผ่าน LINE', 'ติดต่อแอดมินผ่าน LINE'); ?>
											</a>
											<a class="wdl-btn-line d-none d-lg-inline-flex" href="https://line.me/R/ti/p/%40ety4154i">
												<?php _e('ติดต่อแอดมินผ่าน LINE', 'ติดต่อแอดมินผ่าน LINE'); ?>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>

					<?php endif; ?>
				</div>
				<div class="col-lg mb-3 mb-lg-0 pt-lg-3">
					<?php $vendorTypes = get_field('VendorType');
					if ($vendorTypes): ?>
						<p class="text-accent mb-0 d-flex gap-3">
							<?php foreach ($vendorTypes as $venueType): ?>
								<span>
									<?php echo esc_html($venueType->name); ?>
								</span>
							<?php endforeach; ?>
						</p>

					<?php endif ?>
					<h1 class="wdl-single-title">
						<?php the_title(); ?>
					</h1>

					<?php
					$relatedVenue = get_field('RelatedVenue');
					$relatedVenuePermalink = get_permalink($relatedVenue);
					$relatedVenueTitle = get_the_title($relatedVenue);
					if ($relatedVenue): ?>
						<p class="wdl-archive-location mb-0"><a href="<?php echo esc_html($relatedVenuePermalink) ?>">
								<?php echo esc_html($relatedVenueTitle); ?> ">
							</a></p>
					<?php endif; ?>

					<?php
					$address2 = get_field('Address2');
					$googleMaps = get_field('GoogleMaps');
					if ($address2): ?>
						<p class="wdl-metadata wdl-archive-pin mb-0">
							<span>
								<?php the_field('Address2') ?>
								&nbsp;
								<?php if ($googleMaps): ?>
									<strong>
										<a href="<?php echo esc_url(the_field('GoogleMaps')) ?>" target="_blank" class="wdl-link-external">
											<?php _e('ดูแผนที่', 'Map') ?>
										</a>
									</strong>
								<?php endif; ?>
							</span>
						</p>
					<?php endif; ?>

					<?php
					if (get_field('Facebook') && get_field('FacebookLink')): ?>
						<p class="wdl-metadata wdl-archive-facebook mb-0">
							<a href="<?php echo get_field('FacebookLink')?>" target="_blank">
								<?php echo get_field('Facebook') ?>
							</a>
						</p>
					<?php endif; ?>

					<?php
					if (get_field('Instagram') && get_field('InstagramLink')): ?>
						<p class="wdl-metadata wdl-archive-instagram mb-0">
							<a href="<?php echo get_field('InstagramLink')?>" target="_blank">
								<?php echo get_field('Instagram') ?>
							</a>
						</p>
					<?php endif; ?>
				</div>
				<div class="col-lg-auto text-center">
					<div class="wdl-pricing-row-- p-3">
						<a id="apply-cta" href="#apply" class="wdl-btn-lg d-block mb-3" data-bs-toggle="modal">
							<?php _e('คลิกขอแพ็กเกจ', 'คลิกขอแพ็กเกจ'); ?>
						</a>
						<a class="wdl-btn-line-lg d-flex d-lg-none" href="https://line.me/R/oaMessage/%40ety4154i/?สวัสดี%20ต้องการขอแพ็คเกจ%20<?php the_title(); ?>%0A<?php the_permalink(); ?>">
							<?php _e('ติดต่อแอดมินผ่าน LINE', 'ติดต่อแอดมินผ่าน LINE'); ?>
						</a>
						<a class="wdl-btn-line-lg d-none d-lg-inline-flex" href="https://line.me/R/ti/p/%40ety4154i">
							<?php _e('ติดต่อแอดมินผ่าน LINE', 'ติดต่อแอดมินผ่าน LINE'); ?>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php if(get_the_excerpt() != '' && is_user_logged_in()) : ?>
	<section class="pb-3">
		<div class="container-xl">
				<div class="alert alert-secondary"><p class="mb-0"><?php echo(get_the_excerpt()); ?></p></div>
			</div>
		</section>
	<?php endif; ?>
	<section>
		<div class="container">
      <div class="row">
        <div class="col text-secondary">
          <?php the_content(); ?>

          <?php if (have_rows('Pricing')): ?>
						<div class="wdl-main-content wdl-archive wdl-archive-extended">
							<h2>
								<?php _e('ข้อมูลค่าใช้จ่าย', 'Pricing') ?>
							</h2>
							<div class="swiper wdl-archive-pricing-swiper px-2">
								<div class="swiper-wrapper">
									<?php while (have_rows('Pricing')):
									the_row(); ?>
										<div class="swiper-slide h-auto">
											<div class="card wdl-archive-card h-100">
												<?php if (get_sub_field('PricingName')): ?>
												<?php
												$pricingImages = get_sub_field('PricingGallery');
												if ($pricingImages):
													?>
												<div class="card-img-top wdl-archive-card-img-top">
													<div id="hero-gallery" class="swiper wdl-archive-pricing-gallery-swiper">
														<div class="swiper-wrapper">
															<?php
															// Grab each image.
															foreach ($pricingImages as $image):
																$image_id = $image['ID'];
																$image_src = $image['ursl'];
																$image_caption = $image['caption'];
																?>
																<div class="swiper-slide">
																	<?php echo wp_get_attachment_image($image_id, 'w425'); ?>
																</div>
																<?php
															endforeach;
															?>
														</div>
														<div class="swiper-navigation swiper-navigation-small">
															<div class="swiper-button-prev"></div>
															<div class="swiper-button-next"></div>
														</div>
													</div>
												</div>
												<?php endif; ?>
												<div class="card-body">
													<?php $pricingName = get_sub_field('PricingName'); ?>
													<h3 class="h5"><?php echo esc_html(get_sub_field('PricingName')); ?></h3>
													<p class="text-sm"><?php echo esc_html(get_sub_field('PricingDescription')); ?></p>
													<p class="text-sm text-accent fw-semibold"><?php _e('ราคา','ราคา')?> : <?php echo esc_html(number_format(get_sub_field('PricingStart')))?> <?php if(get_sub_field('PricingEnd')) {?> - <?php echo esc_html(number_format(get_sub_field('PricingEnd'))); }?></p>
												</div>
												<?php endif; ?>
											</div>
										</div>
									<?php endwhile; ?>
								</div>
								<div class="swiper-pagination position-relative"></div>
							</div>
						</div>
          <?php endif; ?>
        </div>
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
					<p class="wdl-archive-location mb-2">
						<?php the_title() ?>
					</p>
					<?php $microsite = get_field('Microsite');
					if ($microsite && in_array('Free Microsite', $microsite)): ?>
						<?php echo apply_shortcodes('[contact-form-7 id="206307" title="Venue Form : Free"]') ?>
					<?php else: ?>
						<?php echo apply_shortcodes('[contact-form-7 id="206300" title="Venue Form"]'); ?>
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
								foreach ($videos as $video):
									?>
									<div class="swiper-slide wdl-gallery-modal-item">
										<?php echo($video['iframe_code']) ?>
									</div>
									<?php
								endforeach;
								?>
								<?php
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
							<div class="swiper-navigation swiper-navigation-small">
								<div class="swiper-button-prev"></div>
								<div class="swiper-button-next"></div>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</main>

<?php include 'components/footer.php' ?>