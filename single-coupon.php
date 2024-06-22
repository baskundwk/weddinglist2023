<?php include 'components/header.php' ?>

<main>
	<section class="py-4">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8">
					<div class="card wdl-coupon-card">
						<?php if(get_field('Banner')) :?>
						<figure>
							<img class="wdl-coupon-card-image" src="<?php echo get_field('Banner')['sizes']['large'] ?>" alt="<?php the_title(); ?>">
						</figure>
						<?php endif; ?>
						<div class="row">
							<div class="col-md-4 col-xl-3">
								<img class="wdl-coupon-card-image" src="<?php echo get_field('Image')['sizes']['medium'] ?>" alt="<?php the_title(); ?>">
							</div>
							<div class="col">
								<h1 class="wdl-coupon-card-title">
									<?php the_title(); ?>
								</h1>
								<p class="wdl-coupon-card-subtitle">
									<?php echo get_field('Description'); ?>
								</p>
								<p class="wdl-coupon-card-datetime">
								<?php if (get_field('DateTimeStart') || get_field('DateTimeEnd')): ?>
										<?php _e('เวลาที่ใช้ได้','เวลาที่ใช้ได้') ?>
										<strong>
											<?php if (get_field('DateTimeStart') && get_field('DateTimeEnd')) {
												echo get_field('DateTimeStart') . ' - ' . get_field('DateTimeEnd');
											} elseif (get_field('DateTimeStart')) {
												echo 'ตั้งแต่ ' . get_field('DateTimeStart');
											} elseif (get_field('DateTimeEnd')) {
												echo 'จนถึง ' . get_field('DateTimeEnd');
											} ?>
										</strong>
									</p>
								<?php endif; ?>
								</p>
							</div>
							<div class="col-auto">
								<a href="#share" class="wdl-coupon-card-share" data-bs-toggle="modal">
									<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M11 6C12.6562 6 14 4.65625 14 3C14 1.34375 12.6562 0 11 0C9.34375 0 8 1.34375 8 3C8 3.125 8.00625 3.25 8.02188 3.37187L5.08125 4.84062C4.54375 4.31875 3.80938 4 3 4C1.34375 4 0 5.34375 0 7C0 8.65625 1.34375 10 3 10C3.80938 10 4.54375 9.68125 5.08125 9.15938L8.02188 10.6281C8.00625 10.75 8 10.8719 8 11C8 12.6562 9.34375 14 11 14C12.6562 14 14 12.6562 14 11C14 9.34375 12.6562 8 11 8C10.1906 8 9.45625 8.31875 8.91875 8.84062L5.97813 7.37187C5.99375 7.25 6 7.12813 6 7C6 6.87187 5.99375 6.75 5.97813 6.62813L8.91875 5.15938C9.45625 5.68125 10.1906 6 11 6Z" fill="#222529"/>
									</svg>
								</a>
							</div>
						</div>
						<div class="wdl-coupon-card-condition">
							<h2 class="wdl-coupon-card-condition-title">
								<?php _e('เงื่อนไขการใช้คูปอง', 'เงื่อนไขการใช้คูปอง') ?>
							</h2>
							<?php echo get_field('Condition') ?>
						</div>
						<a href="#apply" data-bs-toggle="modal" class="wdl-btn-lg text-center mb-2">
							<?php _e('รับคูปอง','รับคูปอง') ?>
						</a>
						<a class="wdl-btn-line-lg d-flex d-lg-none" href="https://line.me/R/oaMessage/%40ety4154i/?สวัสดี%20ต้องการขอคูปอง%20<?php the_title(); ?>%0A<?php the_permalink(); ?>">
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

	<?php
	$post_type = get_post_type();
	$popup = $_GET['popup'];
	if ($popup != true || $post_type != 'coupon'): ?>

		<?php $promotion = get_field('Promotion');
		if ($promotion): ?>
			<section class="mb-4 pb-0 wdl-archive wdl-archive-extended">
				<div class="container-xl">
					<div class="row align-items-center">
						<div class="col-12">
							<div class="wdl-archive <?php echo esc_attr($atts['class']); ?>">
								<h3 class="h2 mb-4">
									<?php _e('โปรโมชั่นที่ร่วมรายการ', 'โปรโมชั่นที่ร่วมรายการ') ?>
								</h3>
								<div class="swiper wdl-archive-swiper">
									<div class="swiper-wrapper">
										<?php foreach ($promotion as $post):
											// Setup this post for WP functions (variable must be named $post).
											setup_postdata($post); ?>

											<div id="wdl-post-<?php the_ID(); ?>" class="swiper-slide card wdl-archive-card <?php echo esc_attr($atts['class_single']); ?>">

												<?php if (has_post_thumbnail(get_the_ID())): ?>
													<a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>">
														<img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($post, 'medium_large')) ?>" width="100%">
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

													<div class="wdl-archive-pretitle mb-0">
														<?php
														$relatedVenue = get_field('RelatedVenue');
														$relatedVenueType = get_field('VenueType', $relatedVenue->ID);
														if ($relatedVenue): ?>
															<small>
																<?php echo $relatedVenueType->name ?>
															</small>
														<?php endif; ?>
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

												<div class="card-footer justify-content-end">
													<a href="<?php the_permalink() ?>" class="wdl-btn-more">ดูรายละเอียด</a>
												</div>
											</div>
											<?php
											wp_reset_postdata();
										endforeach;
										?>
									</div>
									<div class="swiper-pagination"></div>
									<div class="swiper-navigation swiper-navigation-small">
										<div class="swiper-button-prev"></div>
										<div class="swiper-button-next"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		<?php endif; ?>
		
		<?php $venue = get_field('Venue');
		if ($venue): ?>
			<section class="mb-4 pb-0 overflow-hidden wdl-archive wdl-archive-extended">
				<div class="container-xl">
					<div class="row align-items-center">
						<div class="col-12">
							<div class="wdl-archive <?php echo esc_attr($atts['class']); ?>">
								<h3 class="h2 mb-4">
									<?php _e('สถานที่จัดงานแต่งงานที่ร่วมรายการ', 'สถานที่จัดงานแต่งงานที่ร่วมรายการ') ?>
								</h3>
								<div class="swiper wdl-archive-swiper overflow-visible">
									<div class="swiper-wrapper">
										<?php foreach ($venue as $post):
											// Setup this post for WP functions (variable must be named $post).
											setup_postdata($post); ?>

											<div id="wdl-post-<?php the_ID(); ?>" class="swiper-slide card wdl-archive-card <?php echo esc_attr($atts['class_single']); ?>">

												<?php if (has_post_thumbnail(get_the_ID())): ?>
													<a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>"><img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($post, 'medium_large')) ?>" width="100%"></a>
												<?php endif; ?>

												<div class="card-body wdl-archive-card-body">
													<div class="wdl-archive-pretitle">
														<?php $venueType = get_field('VenueType', $post->id);
														if ($venueType) {
															foreach ($venueType as $item) {
																echo $item->name;
															}
														}
														?>
														<?php $venueCharacter = get_field('Character', $post->id);
														if ($venueCharacter): ?>
															<?php //foreach ($venueCharacter as $character):
																			$characterBackground = get_field('CharacterBackground', $venueCharacter);
																			$characterBorder = get_field('CharacterBorder', $venueCharacter);
																			$characterColor = get_field('CharacterColor', $venueCharacter);
																			$characterEffect = get_field('CharacterEffect', $venueCharacter);
																			?>
															<div class="wdl-character
														<?php if ($characterBorder) {
															echo ('wdl-character-border');
														} ?>
														<?php if ($characterEffect) {
															echo ('wdl-character-animation-' . $characterEffect);
														} ?>"
																<?php
																if ($characterColor || $characterBackground): ?>
																	style="
														--background-image: url(<?php echo ($characterBackground['url']) ?>);
														--box-shadow: none;
														--color: rgba(<?php echo ($characterColor['red']) ?>,<?php echo ($characterColor['green']) ?>,<?php echo ($characterColor['blue']) ?>,<?php echo ($characterColor['alpha']) ?>);
														--color-50: rgba(<?php echo ($characterColor['red']) ?>,<?php echo ($characterColor['green']) ?>,<?php echo ($characterColor['blue']) ?>, 50%);
														--color-0: rgba(<?php echo ($characterColor['red']) ?>,<?php echo ($characterColor['green']) ?>,<?php echo ($characterColor['blue']) ?>, 0);
													"
																<?php endif ?>>
																<span>
																	<?php echo esc_html($venueCharacter->name); ?>
																</span>
															</div>
															<?php //endforeach;  ?>
														<?php endif ?>
													</div>

													<h3 class="wdl-archive-title mb-0"><a href="<?php the_permalink(); ?>">
															<?php the_title(); ?>
														</a></h3>

													<?php
													$relatedVenue = get_field('RelatedVenue', $post->id);
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

													<?php
													if (get_the_excerpt() != ''):
														?>
														<p class="lineclamp-3 mb-2 text-sm text-secondary">
															<?php echo get_the_excerpt(); ?>
														</p>
													<?php endif; ?>

													<div class="wdl-metadata">
														<?php
														$locations = get_field('Location', $post->id);
														if ($locations): ?>
															<div class="wdl-archive-neighborhood">
																<ul>
																	<?php foreach ($locations as $location): ?>
																		<li>
																			<?php echo esc_html($location->name); ?>
																		</li>
																	<?php endforeach; ?>
																</ul>
															</div>
														<?php endif; ?>

														<?php
														$minPrice = get_field('MinPrice', $post->id);
														if ($minPrice): ?>
															<div class="wdl-archive-min-price">
																<?php _e('ราคาเริ่มต้น', 'Starting price') ?>&nbsp;<strong>
																	<?php echo number_format(get_field('MinPrice')) ?>+
																	<?php _e('บาท', 'THB') ?>
																</strong>
															</div>
														<?php endif; ?>

														<?php
														$maxGuest = get_field('MaxGuest', $post->id);
														if ($maxGuest): ?>
															<div class="wdl-archive-max-guest">
																<?php _e('รองรับแขกสูงสุด', 'Max guest') ?>&nbsp;<strong>
																	<?php echo number_format(get_field('MaxGuest')) ?>
																	<?php _e('คน', 'people') ?>
																</strong>
															</div>
														<?php endif; ?>
													</div>
												</div>

												<div class="card-footer justify-content-end">
													<a href="<?php the_permalink() ?>" class="wdl-btn-more">ดูรายละเอียด</a>
												</div>
											</div>
											<?php
											wp_reset_postdata();
										endforeach;
										?>
									</div>
									<div class="swiper-pagination"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		<?php endif; ?>

	<?php endif; ?>

</main>

<?php include 'components/form-coupon.php' ?>
<?php include 'components/share-modal.php' ?>
<?php include 'components/footer.php' ?>