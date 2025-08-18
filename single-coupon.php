<?php include get_stylesheet_directory() . '/components/header.php' ?>

<main>
  <section class="py-4">
    <div class="container-xl">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="card wdl-coupon-card">
            <?php if (get_field('Banner')): ?>
            <figure>
              <img class="wdl-coupon-card-image" src="<?php echo get_field('Banner')['sizes']['large'] ?>" alt="<?php the_title(); ?>">
            </figure>
            <?php endif; ?>
            <div class="row mb-3">
              <div class="col-sm-4 col-xl-3">
                <img class="wdl-coupon-card-image" src="<?php echo get_field('Image')['sizes']['medium'] ?>" alt="<?php the_title(); ?>">
              </div>
              <div class="col-sm">
                <h1 class="wdl-coupon-card-title">
                  <?php the_title(); ?>
                </h1>
                <p class="wdl-coupon-card-subtitle">
                  <?php echo get_field('Description'); ?>
                </p>
                <p class="wdl-coupon-card-datetime">
                  <?php if (get_field('DateTimeStart') || get_field('DateTimeEnd')): ?>
                  <?php _e('เวลาที่ใช้ได้', 'wdl') ?>
                  <strong>
                    <?php if (get_field('DateTimeStart') && get_field('DateTimeEnd')) {
												echo get_field('DateTimeStart') . ' - ' . get_field('DateTimeEnd');
											} elseif (get_field('DateTimeStart')) {
												echo __('ตั้งแต่','wdl').' ' . get_field('DateTimeStart');
											} elseif (get_field('DateTimeEnd')) {
												echo __('จนถึง','wdl').' ' . get_field('DateTimeEnd');
											} ?>
                  </strong>
                </p>
                <?php endif; ?>
                </p>
              </div>
              <div class="col-sm-auto">
                <a href="#share" class="ms-auto wdl-coupon-card-share" data-bs-toggle="modal">
                  <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 6C12.6562 6 14 4.65625 14 3C14 1.34375 12.6562 0 11 0C9.34375 0 8 1.34375 8 3C8 3.125 8.00625 3.25 8.02188 3.37187L5.08125 4.84062C4.54375 4.31875 3.80938 4 3 4C1.34375 4 0 5.34375 0 7C0 8.65625 1.34375 10 3 10C3.80938 10 4.54375 9.68125 5.08125 9.15938L8.02188 10.6281C8.00625 10.75 8 10.8719 8 11C8 12.6562 9.34375 14 11 14C12.6562 14 14 12.6562 14 11C14 9.34375 12.6562 8 11 8C10.1906 8 9.45625 8.31875 8.91875 8.84062L5.97813 7.37187C5.99375 7.25 6 7.12813 6 7C6 6.87187 5.99375 6.75 5.97813 6.62813L8.91875 5.15938C9.45625 5.68125 10.1906 6 11 6Z" fill="#222529" />
                  </svg>
                </a>
              </div>
            </div>
            <div class="wdl-coupon-card-condition">
              <h2 class="wdl-coupon-card-condition-title">
                <?php _e('เงื่อนไขการใช้คูปอง', 'wdl') ?>
              </h2>
              <?php echo get_field('Condition') ?>
            </div>
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
              <?php _e('โปรโมชั่นที่ร่วมรายการ', 'wdl') ?>
            </h3>
            <div class="swiper wdl-archive-swiper">
              <div class="swiper-wrapper">
                <?php foreach ($promotion as $post):
											// Setup this post for WP functions (variable must be named $post).
											setup_postdata($post); ?>

                <?php include get_stylesheet_directory() . '/components/cards/card-promotion.php' ?>

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

  <?php $weddingFair = get_field('WeddingFair');
		if ($weddingFair): ?>
  <section class="mb-4 pb-0 wdl-archive wdl-archive-extended">
    <div class="container-xl">
      <div class="row align-items-center">
        <div class="col-12">
          <div class="wdl-archive <?php echo esc_attr($atts['class']); ?>">
            <h3 class="h2 mb-4">
              <?php _e('Wedding Fair & Event ที่ร่วมรายการ', 'wdl') ?>
            </h3>
            <div class="swiper wdl-archive-swiper">
              <div class="swiper-wrapper">
                <?php foreach ($weddingFair as $post):
											// Setup this post for WP functions (variable must be named $post).
											setup_postdata($post); ?>

                <?php include get_stylesheet_directory() . '/components/cards/card-weddingfair.php' ?>

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
              <?php _e('สถานที่จัดงานแต่งงานที่ร่วมรายการ', 'wdl') ?>
            </h3>
            <div class="swiper wdl-archive-swiper overflow-visible">
              <div class="swiper-wrapper">
                <?php foreach ($venue as $post):
											// Setup this post for WP functions (variable must be named $post).
											setup_postdata($post); ?>

                <?php include get_stylesheet_directory() . '/components/cards/card-venue.php' ?>

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

  <?php $vendor = get_field('Vendor');
		if ($vendor): ?>
  <section class="mb-4 pb-0 overflow-hidden wdl-archive wdl-archive-extended">
    <div class="container-xl">
      <div class="row align-items-center">
        <div class="col-12">
          <div class="wdl-archive <?php echo esc_attr($atts['class']); ?>">
            <h3 class="h2 mb-4">
              <?php _e('ผู้ให้บริการที่ร่วมรายการ', 'wdl') ?>
            </h3>
            <div class="swiper wdl-archive-swiper overflow-visible">
              <div class="swiper-wrapper">
                <?php foreach ($vendor as $post):
											// Setup this post for WP functions (variable must be named $post).
											setup_postdata($post); ?>

                <?php include get_stylesheet_directory() . '/components/cards/card-vendor.php' ?>

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

<?php // include get_stylesheet_directory() . '/components/form-lead.php' ?>
<?php include get_stylesheet_directory() . '/components/share-modal.php' ?>
<?php include get_stylesheet_directory() . '/components/footer.php' ?>