<?php include get_stylesheet_directory() . '/components/header.php' ?>
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
          <div id="hero-gallery" class="swiper wdl-hero-gallery-swiper <?php if ($videos) {
              echo 'wdl-hero-gallery-video-swiper';
            } ?>">
            <div class="swiper-wrapper">
              <?php
                foreach ($videos as $video):
                  ?>
              <div class="swiper-slide">
                <a href="#" class="wdl-gallery-item" data-bs-toggle="modal" data-bs-target="#gallery">
                  <?php echo ($video['iframe_code']) ?>
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
      <div class="row align-items-center g-2">
        <div class="col-12 col-lg-9 d-flex gap-2 align-items-center">
          <?php $logo = get_field('Logo');
          if ($logo): ?>
          <div class="wdl-metadata-logo">
            <img loading="lazy" src="<?php echo esc_url($logo['sizes']['medium']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" height="40" />
          </div>
          <?php endif; ?>
          <p class="h6 mb-0 wdl-sticky-bar-title lineclamp-1">
            <?php the_title() ?>
          </p>
        </div>
        <div class="col-12 d-flex flex-row gap-2 col-lg-3 text-center text-lg-end mb-2 mb-sm-0">
          <a href="#apply" data-bs-target="#apply" data-bs-toggle="modal" class="flex-fill wdl-btn">
            <?php _e('คลิกขอแพ็กเกจ', 'wdl'); ?>
          </a>

          <a class="wdl-btn-line d-inline-flex d-lg-none" href="https://line.me/R/oaMessage/%40ety4154i/?สวัสดี%20ต้องการขอแพ็กเกจ%20<?php the_title(); ?>%0A<?php the_permalink(); ?>">
            <!-- <?php _e('ติดต่อแอดมินผ่าน LINE', 'wdl'); ?> -->
          </a>
          <a class="wdl-btn-line d-none d-lg-inline-flex" href="https://line.me/R/ti/p/%40ety4154i">
            <!-- <?php _e('ติดต่อแอดมินผ่าน LINE', 'wdl'); ?> -->
          </a>

          <a class="wdl-btn-tertiary" href="tel:+66-88-989-8411" aria-label="โทรติดต่อแอดมิน"><i width="16" data-feather="phone"></i></a>
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
              <div class="modal-content mb-0">
                <button class="btn-close"></button>
                <div class="modal-body">
                  <iframe class="wdl-iframe wdl-iframe-80vh" src="<?php echo ($brochure) ?>" width="100%" height="560"></iframe>
                  <div class="d-flex flex-column flex-sm-row align-items-center justify-content-center gap-3 mt-3">
                    <a id="apply-cta" href="#apply" class="wdl-btn d-inline-block" data-bs-toggle="modal">
                      <?php _e('คลิกขอแพ็กเกจ', 'wdl'); ?>
                    </a>
                    <a class="wdl-btn-line d-inline-flex d-lg-none" href="https://line.me/R/oaMessage/%40ety4154i/?สวัสดี%20ต้องการขอแพ็กเกจ%20<?php the_title(); ?>%0A<?php the_permalink(); ?>">
                      <?php _e('ติดต่อแอดมินผ่าน LINE', 'wdl'); ?>
                    </a>
                    <a class="wdl-btn-line d-none d-lg-inline-flex" href="https://line.me/R/ti/p/%40ety4154i">
                      <?php _e('ติดต่อแอดมินผ่าน LINE', 'wdl'); ?>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <?php endif; ?>
        </div>
        <div class="col-lg mb-3 mb-lg-0 pt-lg-3">
          <?php
          $venueTypes = get_field('VenueType');
          $venueCharacter = get_field('Character');
          if ($venueCharacter || $venueTypes): ?>
          <div class="mb-0 d-flex gap-3">
            <?php if ($venueCharacter): ?>
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
              } ?>" <?php
               if ($characterColor || $characterBackground): ?> style="
              --background-image: url(<?php echo ($characterBackground['url']) ?>);
              --box-shadow: none;
              --color: rgba(<?php echo ($characterColor['red']) ?>,<?php echo ($characterColor['green']) ?>,<?php echo ($characterColor['blue']) ?>,<?php echo ($characterColor['alpha']) ?>);
              --color-50: rgba(<?php echo ($characterColor['red']) ?>,<?php echo ($characterColor['green']) ?>,<?php echo ($characterColor['blue']) ?>, 50%);
              --color-0: rgba(<?php echo ($characterColor['red']) ?>,<?php echo ($characterColor['green']) ?>,<?php echo ($characterColor['blue']) ?>, 0);
            " <?php endif ?>>
              <span>
                <?php echo esc_html($venueCharacter->name); ?>
              </span>
            </div>
            <?php //endforeach;  ?>
            <?php endif ?>
            <?php if ($venueTypes): ?>
            <?php foreach ($venueTypes as $venueType): ?>
            <span class="text-accent">
              <?php echo esc_html($venueType->name); ?>
            </span>
            <?php endforeach; ?>
            <?php endif ?>
          </div>
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
          $address = get_field('Address');
          $googleMaps = get_field('GoogleMaps');
          if ($address): ?>
          <p class="wdl-metadata wdl-archive-pin mb-0">
            <span>
              <?php the_field('Address') ?>
              <?php if ($googleMaps): ?>
              <strong>
                <a href="<?php echo esc_url(the_field('GoogleMaps')) ?>" target="_blank" class="wdl-link-external">
                  <?php _e('ดูแผนที่', 'wdl') ?>
                </a>
              </strong>
              <?php endif; ?>
            </span>
          </p>
          <?php endif; ?>

          <?php
          $maxGuest = get_field('MaxGuest');
          $maxCarpark = get_field('MaxCarpark');
          if ($maxGuest || $maxCarpark): ?>
          <p class="wdl-metadata wdl-archive-max-guest mb-0">
            <span>
              <?php _e('รองรับแขกสูงสุด', 'wdl') ?>
              <strong class="text-red">
                <?php echo number_format(get_field('MaxGuest')) ?>
              </strong>
              <?php _e('คน', 'wdl') ?>
            </span> /
            <span>
              <?php _e('จอดรถได้', 'wdl') ?>
              <strong class="text-red">
                <?php the_field('MaxCarpark') ?>
              </strong>
              <?php _e('คัน', 'wdl') ?>
            </span>
          </p>
          <?php endif; ?>
          <?php
          $minPrice = get_field('MinPrice', $relatedVenue->ID);
          if ($minPrice): ?>
          <p class="wdl-metadata wdl-archive-min-price mb-0">
            <span>
              <?php _e('ราคาเริ่มต้น', 'wdl') ?>
              <strong class="text-red">
                <?php echo number_format(get_field('MinPrice')) ?>+
              </strong>
              <?php _e('บาท', 'wdl') ?>
            </span>
          </p>
          <?php endif; ?>
        </div>
        <div class="col-lg-auto text-center py-3 d-flex flex-column">
          <a id="apply-cta" href="#apply" class="wdl-btn-lg d-block mb-3" data-bs-toggle="modal">
            <?php _e('คลิกขอแพ็กเกจ', 'wdl'); ?>
          </a>
          <a class="wdl-btn-line-lg d-flex d-lg-none" href="https://line.me/R/oaMessage/%40ety4154i/?สวัสดี%20ต้องการขอแพ็กเกจ%20<?php the_title(); ?>%0A<?php the_permalink(); ?>">
            <?php _e('ติดต่อแอดมินผ่าน LINE', 'wdl'); ?>
          </a>
          <a class="wdl-btn-line-lg d-none d-lg-inline-flex" href="https://line.me/R/ti/p/%40ety4154i">
            <?php _e('ติดต่อแอดมินผ่าน LINE', 'wdl'); ?>
          </a>

          <a class="mt-3 wdl-btn-tertiary-lg" href="tel:+66-88-989-8411"><i width="20" data-feather="phone"></i> โทรติดต่อแอดมิน</a>
        </div>
      </div>
    </div>
  </section>
  <?php if (get_the_excerpt() != '' && is_user_logged_in()): ?>
  <section class="pb-3">
    <div class="container-xl">
      <div class="alert alert-secondary">
        <p class="mb-0">
          <?php echo (get_the_excerpt()); ?>
        </p>
      </div>
    </div>
  </section>
  <?php endif; ?>
  <?php
  $relatedPromotions = get_posts(
    array(
      'post_type' => 'promotion',
      'post_status' => 'publish',
      'meta_query' => array(
        array(
          'key' => 'RelatedVenue',
          'value' => '"' . get_the_ID() . '"',
          'compare' => 'LIKE'
        )
      )
    )
  );
  $relatedWeddingFairs = get_posts(
    array(
      'post_type' => 'wedding-fair',
      'post_status' => 'publish',
      'meta_query' => array(
        array(
          'key' => 'RelatedVenue',
          'value' => '"' . get_the_ID() . '"',
          'compare' => 'LIKE'
        )
      )
    )
  );


  $tags = wp_get_post_tags(get_the_ID(), array('fields' => 'ids'));
  $tagsArray = wp_get_post_tags(get_the_ID());

  $relatedPosts = get_posts(
    array(
      'post_type' => 'post',
      'posts_per_page' => 8,
      'orderby' => 'date',
      'order' => 'DESC',
      'post_status' => 'publish',
      'tax_query' => array(
        array(
          'taxonomy' => 'post_tag',
          'field' => 'term_id',
          'terms' => $tags,
        )
      )
    )
  );
  ?>

  <?php if ($relatedPromotions || $relatedWeddingFairs || $relatedPosts): ?>
  <section class="pb-3 overflow-hidden">
    <div class="container-xl">
      <ul class="wdl-tab nav mb-3 wdl-tab-related">
        <?php if ($relatedPromotions): ?>
        <li class="nav-item">
          <a role="tab" aria-controls="tab-promotion" data-bs-toggle="tab" data-bs-target="#tab-promotion" class="nav-link" aria-current="tab" href="#"><i class="wdl-tab-icon" data-feather="tag"></i> โปรโมชั่น</a>
        </li>
        <?php endif; ?>
        <?php if ($relatedWeddingFairs): ?>
        <li class="nav-item">
          <a role="tab" aria-controls="tab-wedding-fair" data-bs-toggle="tab" data-bs-target="#tab-wedding-fair" class="nav-link" href="#"><i class="wdl-tab-icon" data-feather="calendar"></i> Wedding Fair & Event</a>
        </li>
        <?php endif; ?>
        <?php if ($relatedPosts): ?>
        <li class="nav-item">
          <a role="tab" aria-controls="tab-post" data-bs-toggle="tab" data-bs-target="#tab-post" class="nav-link" href="#"><i class="wdl-tab-icon" data-feather="bookmark"></i> บทความ</a>
        </li>
        <?php endif; ?>
      </ul>
      <div class="tab-content wdl-tab-related-content">
        <?php if ($relatedPromotions): ?>
        <div id="tab-promotion" class="tab-pane fade">
          <div class="row align-items-center">
            <div class="col-12">
              <div class="wdl-archive wdl-archive-extended <?php echo esc_attr($atts['class']); ?>">
                <div id="promotion-swiper" class="swiper wdl-archive-swiper">
                  <div class="swiper-wrapper">
                    <?php foreach ($relatedPromotions as $relatedPromotion): ?>
                    <div id="wdl-post-<?php echo $relatedPromotion->ID ?>" class="swiper-slide card wdl-archive-card <?php echo esc_attr($atts['class_single']); ?>">

                      <a class="card-img-top wdl-archive-card-img-top" href="<?php echo get_permalink($relatedPromotion->ID); ?>">
                        <img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($relatedPromotion, 'medium_large')) ?>" width="100%">
                      </a>

                      <div class="card-body wdl-archive-card-body">
                        <div class="wdl-badge-container mb-1">
                          <?php
                                $date = get_field('Date', $relatedPromotion->ID);
                                if ($date): ?>
                          <span class="badge wdl-badge-sm-primary">
                            <?php the_field('Date', $relatedPromotion->ID) ?>
                          </span>
                          <?php endif; ?>
                          <?php $hotDeal = get_field('HotDeal', $relatedPromotion->ID);
                                if ($hotDeal && in_array('Hot Deal', $hotDeal)): ?>
                          <span class="badge wdl-badge-sm">Hot Deal</span>
                          <?php endif; ?>
                        </div>

                        <h3 class="wdl-archive-title mb-0">
                          <a href="<?php the_permalink($relatedPromotion->ID); ?>" title="<?php echo get_the_title($relatedPromotion->ID) ?>" data-label="<?php echo get_the_title($relatedPromotion->ID) ?>">
                            <?php echo get_the_title($relatedPromotion->ID); ?>
                          </a>
                        </h3>
                      </div>
                    </div>
                    <?php endforeach; ?>
                  </div>
                  <div class="swiper-navigation swiper-navigation-small">
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                  </div>
                  <div class="swiper-pagination"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>
        <?php if ($relatedWeddingFairs): ?>
        <div id="tab-wedding-fair" class="tab-pane fade">
          <div class="row align-items-center">
            <div class="col-12">
              <div class="wdl-archive <?php echo esc_attr($atts['class']); ?>">
                <div class="swiper wdl-archive-swiper">
                  <div class="swiper-wrapper">
                    <?php foreach ($relatedWeddingFairs as $relatedWeddingFair): ?>
                    <div id="wdl-post-<?php echo $relatedWeddingFair->ID ?>" class="swiper-slide card wdl-archive-card <?php echo esc_attr($atts['class_single']); ?>">

                      <?php if (has_post_thumbnail($relatedWeddingFair->ID)): ?>
                      <a class="card-img-top wdl-archive-card-img-top" href="<?php echo get_permalink($relatedWeddingFair->ID); ?>"><img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($relatedWeddingFair, 'medium_large')) ?>" width="100%"></a>
                      <?php endif; ?>

                      <div class="card-body wdl-archive-card-body">
                        <div class="wdl-badge-container mb-1">
                          <?php
                                $date = get_field('Date', $relatedWeddingFair->ID);
                                if ($date): ?>
                          <span class="badge wdl-badge-sm-primary">
                            <?php the_field('Date', $relatedWeddingFair->ID) ?>
                          </span>
                          <?php endif; ?>
                          <?php $hotDeal = get_field('HotDeal', $relatedWeddingFair->ID);
                                if ($hotDeal && in_array('Hot Deal', $hotDeal)): ?>
                          <span class="badge wdl-badge-sm">Hot Deal</span>
                          <?php endif; ?>
                        </div>

                        <h3 class="wdl-archive-title mb-0"><a href="<?php echo get_permalink($relatedWeddingFair->ID); ?>">
                            <?php echo get_the_title($relatedWeddingFair->ID); ?>
                          </a></h3>
                      </div>
                    </div>
                    <?php endforeach; ?>
                  </div>
                  <div class="swiper-navigation swiper-navigation-small">
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                  </div>
                  <div class="swiper-pagination"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>
        <?php if ($relatedPosts): ?>
        <div id="tab-post" class="tab-pane fade">
          <div class="row align-items-center">
            <div class="col-12">
              <div class="wdl-archive <?php echo esc_attr($atts['class']); ?>">
                <div class="swiper wdl-archive-swiper">
                  <div class="swiper-wrapper">
                    <?php foreach ($relatedPosts as $relatedPost): ?>
                    <div id="wdl-post-<?php echo $relatedPost->ID ?>" class="swiper-slide card wdl-archive-card <?php echo esc_attr($atts['class_single']); ?>">

                      <?php if (has_post_thumbnail($relatedPost->ID)): ?>
                      <a class="card-img-top wdl-archive-card-img-top" href="<?php echo get_permalink($relatedPost->ID); ?>"><img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($relatedPost, 'medium_large')) ?>" width="100%"></a>
                      <?php endif; ?>

                      <div class="card-body wdl-archive-card-body">
                        <div class="wdl-badge-container mb-1">
                          <?php
                                $date = get_field('Date', $relatedPost->ID);
                                if ($date): ?>
                          <span class="badge wdl-badge-sm-primary">
                            <?php the_field('Date', $relatedPost->ID) ?>
                          </span>
                          <?php endif; ?>
                          <?php $hotDeal = get_field('HotDeal', $relatedPost->ID);
                                if ($hotDeal && in_array('Hot Deal', $hotDeal)): ?>
                          <span class="badge wdl-badge-sm">Hot Deal</span>
                          <?php endif; ?>
                        </div>

                        <h3 class="wdl-archive-title mb-0"><a href="<?php echo get_permalink($relatedPost->ID); ?>">
                            <?php echo get_the_title($relatedPost->ID); ?>
                          </a></h3>
                      </div>
                    </div>
                    <?php endforeach; ?>
                  </div>
                  <div class="swiper-navigation swiper-navigation-small">
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                  </div>
                  <div class="swiper-pagination"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <?php

  $coupon = get_posts(
    array(
      'posts_per_page' => -1,
      'post_type' => 'coupon',
      'meta_query' => array(
        array(
          'key' => 'Venue',
          'value' => '"' . get_the_ID() . '"',
          'compare' => 'LIKE'
        )
      )
    )
  );

  if ($coupon): ?>
  <section class="pb-3">
    <div class="container">
      <h2 class="h6 mb-1"><?php _e('คูปองที่ร่วมรายการ', 'wdl') ?></h2>
      <div class="d-flex flex-wrap gap-2 align-items-stretch">
        <?php foreach ($coupon as $singleCoupon): ?>
        <?php include get_stylesheet_directory() . '/components/cards/card-coupon.php' ?>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>
  <section class="pb-3">
    <div class="container">

      <div class="row">
        <div class="col text-secondary">
          <?php the_content(); ?>
          <?php if (have_rows('Pricing')): ?>
          <div class="wdl-main-content">
            <h2>
              <?php _e('ข้อมูลค่าใช้จ่าย', 'wdl') ?>
            </h2>

            <?php
              $package = array_filter(get_field('Pricing'), function ($item) {
                return ($item["acf_fc_layout"] === 'Package');
              });
              if (count($package) > 0):
                ?>
            <h3 class="h6 text-secondary">
              <?php _e('แพ็กเกจงานหมั้น', 'wdl') ?>
            </h3>
            <div class="px-2">
              <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 wdl-pricing-row mb-4">
                <?php while (have_rows('Pricing')):
                      the_row(); ?>

                <?php if (get_row_layout() == 'Package'): ?>
                <div class="col">
                  <div class="wdl-pricing-card">
                    <div class="text-primary fw-semibold">
                      <?php if (get_sub_field('PackageType')): ?>
                      <?php $packageType = get_sub_field('PackageType'); ?>
                      <?php if (get_field('icon', $packageType)): ?>
                      <img loading="lazy" src="<?php echo esc_url(get_field('icon', $packageType)['url']) ?>" alt="">
                      <?php endif; ?>
                      <p class="mb-0">
                        <?php echo esc_html($packageType->name); ?>
                      </p>
                      <?php endif; ?>
                    </div>

                    <div class="text-red">
                      <?php if (get_sub_field('PackagePrice')):
                                the_sub_field('PackagePrice');
                              endif; ?>
                    </div>
                    <div class="wdl-metadata">
                      <?php if (get_sub_field('PackageNote')):
                                the_sub_field('PackageNote');
                              endif; ?>
                    </div>
                  </div>
                </div>
                <?php endif; ?>
                <?php endwhile; ?>
              </div>
            </div>
            <?php endif; ?>

            <?php
              $weddingPackage = array_filter(get_field('Pricing'), function ($item) {
                return ($item["acf_fc_layout"] === 'WeddingPackage');
              });
              if (count($weddingPackage) > 0):
                ?>
            <h3 class="h6 text-secondary">
              <?php _e('แพ็กเกจงานแต่งงาน', 'wdl') ?>
            </h3>
            <div class="px-2">
              <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 wdl-pricing-row mb-4">
                <?php while (have_rows('Pricing')):
                      the_row(); ?>

                <?php if (get_row_layout() == 'WeddingPackage'): ?>
                <div class="col">
                  <div class="wdl-pricing-card">
                    <div class="text-primary fw-semibold">
                      <?php if (get_sub_field('WeddingPackageType')): ?>
                      <?php $weddingPackageType = get_sub_field('WeddingPackageType'); ?>
                      <?php if (get_field('icon', $weddingPackageType)): ?>
                      <img loading="lazy" src="<?php echo esc_url(get_field('icon', $weddingPackageType)['url']) ?>" alt="">
                      <?php endif; ?>
                      <p class="mb-0">
                        <?php echo esc_html($weddingPackageType->name); ?>
                      </p>
                      <?php endif; ?>
                    </div>

                    <div class="text-red">
                      <?php if (get_sub_field('WeddingPackagePrice')):
                                the_sub_field('WeddingPackagePrice');
                              endif; ?>
                    </div>
                    <div class="wdl-metadata">
                      <?php if (get_sub_field('WeddingPackageNote')):
                                the_sub_field('WeddingPackageNote');
                              endif; ?>
                    </div>
                  </div>
                </div>
                <?php endif; ?>
                <?php endwhile; ?>
              </div>
            </div>
            <?php endif; ?>

            <?php
              $fbPackage = array_filter(get_field('Pricing'), function ($item) {
                return ($item["acf_fc_layout"] === 'FoodBeverage');
              });
              if (count($fbPackage) > 0):
                ?>
            <h3 class="h6 text-secondary">
              <?php _e('อาหารและเครื่องดื่ม', 'wdl') ?>
            </h3>
            <div class="px-2">
              <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 wdl-pricing-row">
                <?php while (have_rows('Pricing')):
                      the_row(); ?>

                <?php if (get_row_layout() == 'FoodBeverage'): ?>
                <div class="col">
                  <div class="wdl-pricing-card">
                    <div class="text-primary fw-semibold">
                      <?php if (get_sub_field('FoodBeverageType')):
                                $fbType = get_sub_field('FoodBeverageType'); ?>
                      <?php if (get_field('icon', $fbType)): ?>
                      <img loading="lazy" src="<?php echo esc_url(get_field('icon', $fbType)['url']) ?>" alt="">
                      <?php endif; ?>
                      <p class="mb-0">
                        <?php echo esc_html($fbType->name); ?>
                      </p>
                      <?php endif; ?>
                    </div>

                    <div class="text-red">
                      <?php if (get_sub_field('FoodBeveragePrice')):
                                the_sub_field('FoodBeveragePrice');
                              endif; ?>
                    </div>
                    <div class="wdl-metadata">
                      <?php if (get_sub_field('FoodBeverageNote')):
                                the_sub_field('FoodBeverageNote');
                              endif; ?>
                    </div>
                  </div>
                </div>
                <?php endif; ?>

                <?php endwhile; ?>
              </div>
            </div>
            <?php endif; ?>

          </div>
          <?php endif; ?>
        </div>
      </div>

      <?php if (get_field('CeremonyTypes')): ?>
      <div class="row my-3">
        <div class="col">
          <h3 class="h6 text-secondary">
            <?php _e('รูปแบบการจัดงาน', 'wdl') ?>
          </h3>
          <div class="px-2">
            <ul class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 wdl-checklist-row mb-4">
              <?php $ceremonyTypes = get_field('CeremonyTypes');
                foreach ($ceremonyTypes as $ceremonyType): ?>
              <li class="col">
                <?php echo esc_html($ceremonyType->name) ?>
              </li>
              <?php endforeach; ?>
          </div>
        </div>
      </div>
      <?php endif; ?>

      <?php if (get_field('Amentities')): ?>
      <div class="row my-3">
        <div class="col">
          <h3 class="h6 text-secondary">
            <?php _e('สิ่งอำนวยความสะดวก', 'wdl') ?>
          </h3>
          <div class="px-2">
            <ul class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 wdl-checklist-row mb-4">
              <?php $amentities = get_field('Amentities');
                foreach ($amentities as $amentity): ?>
              <li class="col">
                <?php echo esc_html($amentity->name) ?>
              </li>
              <?php endforeach; ?>
          </div>
        </div>
      </div>
      <?php endif; ?>

    </div>
  </section>
  <section class="pb-3 overflow-hidden">
    <div class="container">
      <?php if (have_rows('BanquetRoom')): ?>
      <div class="row">
        <div class="col text-secondary">
          <div class="wdl-main-content wdl-archive">
            <h2>
              <?php _e('ห้องจัดเลี้ยง', 'wdl') ?>
            </h2>

            <div id="banquet" class="swiper wdl-archive-swiper">
              <div class="swiper-wrapper">
                <?php while (have_rows('BanquetRoom')):
                    the_row(); ?>

                <?php if (get_row_layout() == 'BanquetRoomEntry'): ?>
                <div class="swiper-slide card wdl-archive-card">
                  <?php if (get_sub_field('BanquetRoomImage')): ?>
                  <a class="card-img-top wdl-archive-card-img-top" <?php if (get_sub_field('BanquetRoomGallery')): ?> href="#" data-bs-toggle="modal" data-bs-target="#banquet-gallery-<?php echo get_row_index(); ?>" <?php endif; ?>>
                    <img loading="lazy" src="<?php the_sub_field('BanquetRoomImage') ?>" alt="">
                  </a>
                  <?php endif; ?>
                  <div class="card-body">
                    <div class="wdl-pricing-card">
                      <?php if (get_sub_field('BanquetRoomName')): ?>
                      <?php if (get_sub_field('BanquetRoomGallery')): ?><a href="#" data-bs-toggle="modal" data-bs-target="#banquet-gallery-<?php echo get_row_index(); ?>"><?php endif; ?>
                        <div class="wdl-archive-title mb-0 fw-semibold">
                          <?php the_sub_field('BanquetRoomName') ?>
                        </div>
                        <?php if (get_sub_field('BanquetRoomGallery')): ?>
                      </a><?php endif; ?>
                      <?php endif; ?>

                      <div class="row row-cols-2 pt-2">
                        <?php if (get_sub_field('BanquetRoomArea')): ?>
                        <div class="col-12 wdl-metadata">
                          <div class="text-secondary">
                            <?php _e('พื้นที่', 'wdl') ?>
                          </div>
                          <div class="text-red">
                            <?php the_sub_field('BanquetRoomArea') ?>
                          </div>
                        </div>
                        <?php endif; ?>

                        <?php if (get_sub_field('BanquetRoomChineseDinner')): ?>
                        <div class="col wdl-metadata">
                          <div class="text-secondary">
                            <?php _e('โต๊ะจีน', 'wdl') ?>
                          </div>
                          <div class="text-red">
                            <?php the_sub_field('BanquetRoomChineseDinner') ?>
                          </div>
                        </div>
                        <?php endif; ?>

                        <?php if (get_sub_field('BanquetRoomCocktailDinner')): ?>
                        <div class="col wdl-metadata">
                          <div class="text-secondary">
                            <?php _e('ค็อกเทล', 'wdl') ?>
                          </div>
                          <div class="text-red">
                            <?php the_sub_field('BanquetRoomCocktailDinner') ?>
                          </div>
                        </div>
                        <?php endif; ?>

                        <?php if (get_sub_field('BanquetRoomBuffetDinner')): ?>
                        <div class="col wdl-metadata">
                          <div class="text-secondary">
                            <?php _e('บุฟเฟ่ต์', 'wdl') ?>
                          </div>
                          <div class="text-red">
                            <?php the_sub_field('BanquetRoomBuffetDinner') ?>
                          </div>
                        </div>
                        <?php endif; ?>

                        <?php if (get_sub_field('BanquetRoomSitdownDinner')): ?>
                        <div class="col wdl-metadata">
                          <div class="text-secondary">
                            <?php _e('ซิทดาวน์', 'wdl') ?>
                          </div>
                          <div class="text-red">
                            <?php the_sub_field('BanquetRoomSitdownDinner') ?>
                          </div>
                        </div>
                        <?php endif; ?>

                      </div>
                    </div>
                  </div>
                </div>
                <?php endif; ?>
                <?php endwhile; ?>
              </div>
              <div class="swiper-navigation swiper-navigation-small">
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>
        </div>
      </div>
      <?php endif; ?>
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
                foreach ($videos as $video):
                  ?>
              <div class="swiper-slide wdl-gallery-modal-item">
                <?php echo ($video['iframe_code']) ?>
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

  <?php if (have_rows('BanquetRoom')): ?>
  <?php while (have_rows('BanquetRoom')):
      the_row(); ?>
  <?php if (get_row_layout() == 'BanquetRoomEntry'): ?>
  <div class="modal fade wdl-gallery-modal" id="banquet-gallery-<?php echo get_row_index() ?>">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content mb-0">
        <div class="modal-body">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

          <?php
                $banquetImages = get_sub_field('BanquetRoomGallery');
                if ($banquetImages):
                  ?>
          <div class="swiper wdl-gallery-modal-swiper">
            <div class="swiper-wrapper">
              <?php
                      // Grab each image.
                      foreach ($banquetImages as $banquetImage):
                        $banquetImage_id = $banquetImage['ID'];
                        $banquetImage_src = $banquetImage['url'];
                        $banquetImage_caption = $banquetImage['caption'];
                        ?>
              <div class="swiper-slide wdl-gallery-modal-item">
                <?php echo wp_get_attachment_image($banquetImage_id, 'large'); ?>
              </div>
              <?php endforeach; ?>
            </div>
            <!-- <div class="swiper-pagination"></div> -->
          </div>
          <div class="swiper-navigation swiper-navigation-small">
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>
  <?php endwhile; ?>
  <?php endif; ?>
</main>

<?php include get_stylesheet_directory() . '/components/form-venue.php' ?>
<?php include get_stylesheet_directory() . '/components/footer.php' ?>