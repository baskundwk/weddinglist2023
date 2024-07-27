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

						<a class="wdl-btn-line d-inline-flex d-lg-none" href="https://line.me/R/oaMessage/%40ety4154i/?สวัสดี%20ต้องการรับโปรโมชั่น%20<?php the_title(); ?>%0A<?php the_permalink(); ?>">
							<?php _e('ติดต่อแอดมินผ่าน LINE', 'ติดต่อแอดมินผ่าน LINE'); ?>
						</a>
						<a class="wdl-btn-line d-none d-lg-inline-flex" href="https://line.me/R/ti/p/%40ety4154i">
							<?php _e('ติดต่อแอดมินผ่าน LINE', 'ติดต่อแอดมินผ่าน LINE'); ?>
						</a>
					</div>
				</div>
			</div>
		</a>
	</section>
	<section class="wdl-main-bar">
		<div class="container-xl">

			<?php if(is_user_logged_in()){
					print_r(RankMath\Post::get_meta( 'title' ));
			} ?>
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
					<div class="wdl-archive-pretitle mb-0">
						<?php $promotionCategory = wp_get_post_terms(get_the_ID(), 'promotion-category');
						if ($promotionCategory) {
							$count = 1;
							foreach($promotionCategory as $item) {
								if ($count > 1) {
									echo ', ';
								}
								echo $item->name ;
								$count = $count + 1;
							}
						}
						?>
					</div>
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
				<div class="col-lg-auto text-center py-3 d-flex flex-column">
					<a id="apply-cta" href="#apply" class="wdl-btn-lg d-block mb-3" data-bs-toggle="modal">
						<?php _e('สนใจรับโปรโมชั่น', 'Apply for Promotion'); ?>
					</a>
					<a class="wdl-btn-line-lg d-flex d-lg-none" href="https://line.me/R/oaMessage/%40ety4154i/?สวัสดี%20ต้องการรับโปรโมชั่น%20<?php the_title(); ?>%0A<?php the_permalink(); ?>">
						<?php _e('ติดต่อแอดมินผ่าน LINE', 'ติดต่อแอดมินผ่าน LINE'); ?>
					</a>
						<a class="wdl-btn-line-lg d-none d-lg-inline-flex" href="https://line.me/R/ti/p/%40ety4154i">
						<?php _e('ติดต่อแอดมินผ่าน LINE', 'ติดต่อแอดมินผ่าน LINE'); ?>
					</a>
				</div>
			</div>
		</div>
	</section>


	<?php
		$coupon = get_posts(
			array(
				'posts_per_page' => -1,
				'post_type' => 'coupon',
				'meta_query' => array(
					array(
						'key' => 'Promotion',
						'value' => '"' . get_the_ID() . '"',
						'compare' => 'LIKE'
					)
				)
			)
		);

		if ($coupon): ?>
			<section class="pt-3">
				<div class="container">
					<h2 class="h6 mb-1">คูปองที่ร่วมรายการ</h2>
					<div class="d-flex flex-wrap gap-3 my-2 align-items-stretch">
						<?php foreach ($coupon as $singleCoupon):
							?>
							<div class="wdl-coupon-picker">
								<a href="#apply" data-bs-toggle="modal" class="wdl-coupon-picker-image">
									<img src="<?php echo (get_field('Image', $singleCoupon->ID)['sizes']['medium']) ?>" />
								</a>
								<div class="wdl-coupon-picker-info">
									<div class="wdl-coupon-picker-title">
										<a href="#apply" data-bs-toggle="modal">
											<?php echo (get_the_title($singleCoupon->ID)) ?>
										</a>
									</div>
									<div class="d-flex flex-wrap justify-content-between align-items-center">
										<div class="wdl-coupon-picker-action">
											<a href="#apply" data-bs-toggle="modal">เก็บคูปอง</a>
										</div>
										<div class="wdl-coupon-picker-term">
											<a class="wdl-coupon-popup-link" href="<?php echo (get_the_permalink($singleCoupon->ID)) ?>?popup=true" target="blank">เงื่อนไข</a>
										</div>
									</div>
								</div>
							</div>
						<?php
						endforeach; ?>
					</div>
				</div>
			</section>
		<?php endif; ?>
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

	<div class="modal fade wdl-gallery-modal" id="gallery">
		<div class="modal-dialog modal-dialog-centered modal-xl">
			<div class="modal-content mb-0">
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

												<div class="wdl-archive-pretitle mb-0">
													<?php $promotionCategory = wp_get_post_terms(get_the_ID(), 'promotion-category');
													if ($promotionCategory) {
														$count = 1;
														foreach($promotionCategory as $item) {
															if ($count > 1) {
																echo ', ';
															}
															echo $item->name ;
															$count = $count + 1;
														}
													}
													?>
												</div>

												<h3 class="wdl-archive-title mb-0"><a href="<?php the_permalink(); ?>">
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

<?php include 'components/form-promotion.php' ?>
<?php include 'components/footer.php' ?>