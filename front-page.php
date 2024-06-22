<?php $localnav = true; ?>
<?php include 'components/header.php' ?>
<main>
  <section class="xl:pt-3">
    <?php $heroArgs = array(
      'post_type' => 'any',
      'post_status' => 'publish',
      'orderby' => 'rand',
      'posts_per_page' => '-1',
      'meta_query' => array(
        array(
          'key' => 'HeroBanner',
          'compare' => 'LIKE',
          'value' => '"ขึ้น Hero Banner"'
        )
      )
    );

    $hero = new WP_Query($heroArgs);
    ?>
    <div class="container">
      <div class="row px-xl-2">
        <div class="col px-0 px-xl-1">
          <div class="wdl-hero su-posts su-posts-default-loop <?php echo esc_attr($atts['class']); ?>">
            <?php if ($hero->have_posts()): ?>

              <div class="swiper wdl-hero-swiper">
                <div class="swiper-wrapper">
                  <?php while ($hero->have_posts()): ?>
                    <?php $hero->the_post(); ?>

                    <?php if (get_field('HeroBannerImage')):
                      //print_r(get_field('HeroBannerImage')['sizes']['medium_large']);   ?>
                      <div id="su-post-<?php the_ID(); ?>" class="swiper-slide su-post <?php echo esc_attr($atts['class_single']); ?>">
                        <a class="wdl-hero-banner" href="<?php if (get_field('HeroBannerLink')) {
                          echo (get_field('HeroBannerLink'));
                        } else {
                          the_permalink();
                        } ?>">
                          <picture>
                            <source srcset="<?php echo esc_html(get_field('HeroBannerImage')['sizes']['w1160']) ?>" width="<?php echo esc_html(get_field('HeroBannerImage')['sizes']['w1160-width']) ?>" height="<?php echo esc_html(get_field('HeroBannerImage')['sizes']['w1160-height']) ?>" media="(min-width: 576px)">
                            <img loading="lazy" src="<?php echo esc_html(get_field('HeroBannerImage')['sizes']['h270']) ?>" alt="<?php get_the_title() ?>" sizes="100%">
                          </picture>
                        </a>
                      </div>
                    <?php endif; ?>

                  <?php endwhile; ?>
                </div>
                <!-- <div class="swiper-pagination"></div> -->
              </div>
              <div class="swiper-navigation">
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
              </div>

            <?php else: ?>
              <h4>
                <?php esc_html_e('Posts not found', 'shortcodes-ultimate'); ?>
              </h4>
            <?php endif; ?>

          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include 'components/lead-menu-revamped.php' ?>

  <?php $promotionArgs = array(
    'post_type' => 'promotion',
    'post_status' => 'publish',
    'orderby' => 'meta_value',
    'order' => 'DESC',
    'posts_per_page' => '40',
    'meta_key' => 'HotDeal',
  );

  $promotion = new WP_Query($promotionArgs);
  ?>
  <?php
  if ($promotion->have_posts()): ?>
    <section class="overflow-x-hidden">
      <div class="container">
        <div class="row">
          <div class="col">
            <h2 class="h1 wdl-localnav-heading">
              <?php echo(get_option('wdl_options', 'โปรโมชั่นงานแต่งงาน')['word-frontpage-promotion-title']); ?>
            </h2>
            <p class="mb-2">
              <?php echo(get_option('wdl_options', 'รวบรวมโปรโมชั่นแต่งงานให้คุณไว้ที่เดียว')['word-frontpage-promotion-desc']); ?>
            </p>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="wdl-archive wdl-archive-extended <?php echo esc_attr($atts['class']); ?>">

              <div id="promotions" class="swiper wdl-archive-swiper">
                <div class="swiper-wrapper 
                  <?php if ($_GET['order'] || $_GET['orderby'] || $_GET['key']) {

                  } else {
                    echo 'row-cols-archive-randomized';
                  } ?> ">
                  <?php while ($promotion->have_posts()): ?>
                    <?php $promotion->the_post(); ?>

                    <div id="wdl-post-<?php the_ID(); ?>" class="swiper-slide card wdl-archive-card <?php echo esc_attr($atts['class_single']); ?> <?php if (get_field('HotDeal')) {
                            echo esc_html('wdl-archive-primary');
                          } else {
                            echo esc_html('wdl-archive-default');
                          } ?>">

                      <?php if (has_post_thumbnail(get_the_ID())): ?>
                        <a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>" title="<?php get_the_title() ?>">
                          <img loading="lazy" src="<?php echo esc_html(wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large')[0]) ?>" srcset="<?php echo esc_html(wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large')[0]) ?> 1x,
                          <?php echo esc_html(wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large')[0]) ?> 2x" alt="<?php get_the_title() ?>">
                        </a>
                      <?php endif; ?>

                      <div class="card-select">
                        <div class="wdl-checkbox">
                          <input class="card-select-input" id="card-select-<?php the_ID() ?>" type="checkbox" data-select='
                            {
                              "title": "<?php the_title() ?>",
                              "postType": "<?php echo get_post_type() ?>",
                              "id": "<?php the_ID() ?>"
                            }'>
                          <label for="card-select-<?php the_ID() ?>">
                            <?php _e('เลือก', 'เลือก') ?>
                          </label>
                        </div>
                      </div>

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
                            <p class="wdl-archive-location"><a href="<?php echo esc_html($venuePermalink) ?>">
                                <?php echo esc_html($venueTitle); ?>
                              </a></p>
                          <?php endforeach; endif; ?>

                        <?php $coupon = get_posts(
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
                          <div class="mt-1">
                            <p class="text-sm mb-1 text-secondary">คูปองที่ร่วมรายการ</p>
                            <div class="d-flex flex-wrap gap-2 align-items-stretch">
                              <?php foreach ($coupon as $singleCoupon): ?>
                                  <div class="wdl-coupon-picker wdl-coupon-picker-small">
                                    <div class="wdl-coupon-picker-image">
                                      <img loading="lazy" src="<?php echo (get_field('Image', $singleCoupon->ID)['sizes']['medium']) ?>" />
                                    </div>
                                    <!-- <div class="wdl-coupon-picker-info">
                                      <div class="wdl-coupon-picker-title">
                                        <p class="mb-0">
                                          <?php echo (get_the_title($singleCoupon->ID)) ?>
                                        </p>
                                      </div>
                                    </div> -->
                                  </div>
                              <?php endforeach; ?>
                            </div>
                          </div>
                        <?php endif; ?>
                      </div>

                      <div class="card-footer">
                        <a href="#" class="wdl-btn-cta wdl-form-general-direct" data-bs-toggle="modal" data-bs-target=".wdl-form-general-modal">สนใจรับโปรโมชั่น</a>
                        <a href="<?php the_permalink() ?>" class="wdl-btn-more">ดูรายละเอียด</a>
                      </div>
                    </div>
                  <?php endwhile; ?>
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
        <div class="row">
          <div class="col text-center mt-3 mb-5">
            <a href="<?php echo esc_html(get_post_type_archive_link('promotion')) ?>" class="wdl-btn-secondary py-2 px-3">
              <?php _e('ดูโปรโมชั่นทั้งหมด', 'ดูโปรโมชั่นทั้งหมด') ?>
            </a>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php $weddingfairArgs = array(
    'post_type' => 'wedding-fair',
    'post_status' => 'publish',
    'orderby' => 'meta_value',
    'order' => 'DESC',
    'posts_per_page' => '40',
    'meta_key' => 'HotDeal',
  );

  $weddingfair = new WP_Query($weddingfairArgs);
  ?>

  <?php if ($weddingfair->have_posts()): ?>
    <section class="overflow-x-hidden">
      <div class="container">
        <div class="row">
          <div class="col">
            <h2 class="h1 wdl-localnav-heading">
              <?php echo(get_option('wdl_options', 'Wedding Fair & Event')['word-frontpage-wedding-fair-title']); ?>
            </h2>
            <p class="mb-2">
              <?php echo(get_option('wdl_options', 'รวบรวมงานแฟร์ และ อีเว้นท์ให้คุณไว้ที่เดียว')['word-frontpage-wedding-fair-desc']); ?>
            </p>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="wdl-archive wdl-archive-extended <?php echo esc_attr($atts['class']); ?>">

              <div class="swiper wdl-archive-swiper">
                <div class="swiper-wrapper 
        <?php if ($_GET['order'] || $_GET['orderby'] || $_GET['key']) {

        } else {
          echo 'row-cols-archive-randomized';
        } ?> ">
                  <?php while ($weddingfair->have_posts()): ?>
                    <?php $weddingfair->the_post(); ?>

                    <div id="wdl-post-<?php the_ID(); ?>" class="swiper-slide card wdl-archive-card <?php echo esc_attr($atts['class_single']); ?> <?php if (get_field('HotDeal')) {
                            echo esc_html('wdl-archive-primary');
                          } else {
                            echo esc_html('wdl-archive-default');
                          } ?>">

                      <?php if (has_post_thumbnail(get_the_ID())): ?>
                        <a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>" title="<?php get_the_title() ?>">
                          <img loading="lazy" src="<?php echo esc_html(wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large')[0]) ?>" srcset="<?php echo esc_html(wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large')[0]) ?> 1x,
                            <?php echo esc_html(wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large')[0]) ?> 2x" alt="<?php get_the_title() ?>">
                        </a>
                      <?php endif; ?>

                      <div class="card-select">
                        <div class="wdl-checkbox">
                          <input class="card-select-input" id="card-select-<?php the_ID() ?>" type="checkbox" data-select='
                            {
                              "title": "<?php the_title() ?>",
                              "postType": "<?php echo get_post_type() ?>",
                              "id": "<?php the_ID() ?>"
                            }'>
                          <label for="card-select-<?php the_ID() ?>">
                            <?php _e('เลือก', 'เลือก') ?>
                          </label>
                        </div>
                      </div>

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

                        <h3 class="wdl-archive-title mb-0"><a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                          </a></h3>

                        <?php
                        $relatedVenue = get_field('RelatedVenue');
                        if ($relatedVenue):
                          foreach ($relatedVenue as $venue):
                            $venuePermalink = get_permalink($venue->ID);
                            $venueTitle = get_the_title($venue->ID); ?>
                            <p class="wdl-archive-location"><a href="<?php echo esc_html($venuePermalink) ?>">
                                <?php echo esc_html($venueTitle); ?>
                              </a></p>
                          <?php endforeach;
                        endif; ?>
                      </div>

                      <div class="card-footer">
                        <a href="#" class="wdl-btn-cta wdl-form-general-direct" data-bs-toggle="modal" data-bs-target=".wdl-form-general-modal">ลงทะเบียนร่วมงาน</a>
                        <a href="<?php the_permalink() ?>" class="wdl-btn-more">ดูรายละเอียด</a>
                      </div>

                    </div>

                  <?php endwhile; ?>
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
        <div class="row">
          <div class="col text-center mt-3 mb-5">
            <a href="<?php echo esc_html(get_post_type_archive_link('wedding-fair')) ?>" class="wdl-btn-secondary py-2 px-3">
              <?php _e('ดู Wedding Fair & Event ทั้งหมด', 'ดู Wedding Fair & Event ทั้งหมด') ?>
            </a>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php $venueArgs = array(
    'post_type' => 'venue',
    'post_status' => 'publish',
    'orderby' => 'meta_value',
    'order' => 'DESC',
    'posts_per_page' => '40',
    'meta_key' => 'Sponsor',
  );

  $venue = new WP_Query($venueArgs);
  ?>
  <?php if ($venue->have_posts()): ?>

    <section class="overflow-x-hidden">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h2 class="h1 wdl-localnav-heading">
              <?php echo(get_option('wdl_options', 'สถานที่จัดงานแต่งงาน')['word-frontpage-venue-title']); ?>
            </h2>
            <p class="mb-2">
              <?php echo(get_option('wdl_options', 'รวบรวมสถานที่จัดงานแต่งงานให้คุณไว้ที่เดียว')['word-frontpage-venue-desc']); ?>
            </p>
          </div>
          <div class="col-md-6 pb-3 py-lg-3 text-start text-lg-end">
            <?php foreach (get_terms('venue_type') as $term) {
              echo '<a class="wdl-badge-sm-secondary m-1" href="' . get_term_link($term->slug, 'venue_type') . '">' . $term->name . '</a>';
            } ?>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="wdl-archive wdl-archive-extended <?php echo esc_attr($atts['class']); ?>">
              <div class="swiper wdl-archive-swiper">
                <div class="swiper-wrapper  
                  <?php if ($_GET['order'] || $_GET['orderby'] || $_GET['key']) {
  
                  } else {
                    echo 'row-cols-archive-randomized';
                  } ?> ">
  
                  <?php while ($venue->have_posts()): ?>
                    <?php $venue->the_post();
                    $sponsored = get_field('Sponsor');
                    ?>
  
                    <div id="wdl-post-<?php the_ID(); ?>" class="swiper-slide h-auto card wdl-archive-card <?php if ($sponsored && in_array('Sponsored', $sponsored)) {
                      echo ('order-first');
                    } ?> <?php if (get_field('Sponsor')) {
                        echo esc_html('wdl-archive-primary');
                      } else {
                        echo esc_html('wdl-archive-default');
                      } ?>">
                        <?php if (has_post_thumbnail(get_the_ID())): ?>
                          <a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>" title="<?php get_the_title() ?>">
                            <img loading="lazy" src="<?php echo esc_html(wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large')[0]) ?>" srcset="<?php echo esc_html(wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large')[0]) ?> 1x,
                              <?php echo esc_html(wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large')[0]) ?> 2x" alt="<?php get_the_title() ?>">
                            <?php
                            if ($sponsored && in_array('Sponsored', $sponsored)): ?>
                              <span class="badge wdl-badge-sm">Most Popular</span>
                            <?php endif; ?>
                          </a>
                        <?php endif; ?>
  
                        <div class="card-select">
                          <div class="wdl-checkbox">
                            <input class="card-select-input" id="card-select-<?php the_ID() ?>" type="checkbox" data-select='
                              {
                                "title": "<?php the_title() ?>",
                                "postType": "<?php echo get_post_type() ?>",
                                "id": "<?php the_ID() ?>"
                              }'>
                            <label for="card-select-<?php the_ID() ?>"><small>
                                <?php _e('เลือก/เปรียบเทียบ', 'เลือก/เปรียบเทียบ') ?>
                              </small></label>
                          </div>
                        </div>
  
                        <div class="card-body wdl-archive-card-body">
                          <div class="wdl-archive-pretitle">
                            <?php $venueCharacter = get_field('Character');
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
                              <?php //endforeach;   ?>
                            <?php endif ?>
                          </div>
                          <h3 class="wdl-archive-title mb-0"><a href="<?php the_permalink(); ?>">
                              <?php the_title(); ?>
                            </a></h3>
  
                          <?php if (get_the_excerpt()): ?>
                            <p class="lineclamp-3 mb-2 text-sm text-secondary">
                              <?php echo (get_the_excerpt()); ?>
                            </p>
                          <?php endif; ?>
  
                          <div class="wdl-metadata">
                            <?php
                            $locations = get_field('Location');
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
                            $minPrice = get_field('MinPrice');
                            if ($minPrice): ?>
                              <div class="wdl-archive-min-price">
                                <?php _e('ราคาเริ่มต้น', 'Starting price') ?>&nbsp;<strong>
                                  <?php echo number_format(get_field('MinPrice')) ?>+
                                  <?php _e('บาท', 'THB') ?>
                                </strong>
                              </div>
                            <?php endif; ?>
  
                            <?php
                            $maxGuest = get_field('MaxGuest');
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
  
                        <div class="card-footer">
                          <a href="#" class="wdl-btn-cta wdl-form-general-direct" data-bs-toggle="modal" data-bs-target=".wdl-form-general-modal">คลิกขอแพ็กเกจ</a>
                          <a href="<?php the_permalink() ?>" class="wdl-btn-more">ดูรายละเอียด</a>
                        </div>
                    </div>
                  <?php endwhile; ?>
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
        <div class="row">
          <div class="col text-center mt-3 mb-5">
            <a href="<?php echo esc_html(get_post_type_archive_link('venue')) ?>" class="wdl-btn-secondary py-2 px-3">
              <?php _e('ดูสถานที่จัดงานแต่งงานทั้งหมด', 'ดูสถานที่จัดงานแต่งงานทั้งหมด') ?>
            </a>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php
  $vendor_type = get_terms( array(
    'taxonomy'   => 'vendor-type',
    'hide_empty' => true,
  ) );

  if (is_user_logged_in() === true) {
    $post_status = 'any';
  } else {
    $post_status = 'publish';
  }
  $vendorArgs = array(
    'post_type' => 'vendor',
    'post_status' => $post_status,
    'order' => 'DESC',
    'posts_per_page' => '40',
  );

  $vendor = new WP_Query($vendorArgs);
  ?>

  <?php if ($vendor->have_posts()): ?>
    <section class="overflow-hidden">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h2 class="h1 wdl-localnav-heading">
              <?php echo(get_option('wdl_options', 'ผู้ให้บริการงานแต่งงาน')['word-frontpage-vendor-title']); ?>
            </h2>
            <p class="mb-2">
              <?php echo(get_option('wdl_options', 'รวบรวมผู้ให้บริการงานแต่งงานให้คุณไว้ที่เดียว')['word-frontpage-vendor-desc']); ?>
            </p>
          </div>
          <!-- <div class="col-md-6 pb-3 text-start text-lg-end">
            <?php foreach (get_terms('vendor-type') as $term) {
              echo '<a class="wdl-badge-sm-secondary m-1" href="' . get_term_link($term->slug, 'vendor-type') . '">' . $term->name . '</a>';
            } ?>
          </div> -->
        </div>
        <div class="row">
          <div class="col">
            <ul class="wdl-tab nav mb-3 wdl-tab-related">
              <?php foreach($vendor_type as $type) { ?>
                <li class="nav-item">
                  <a role="tab" aria-control="tab-vendor-<?php echo $type->slug?>" data-bs-toggle="tab" data-bs-target="#tab-<?php echo $type->slug?>" class="nav-link" aria-current="tab" href="#"><?php echo $type->name ?></a>
                </li>
              <?php } ?>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="tab-content wdl-tab-related-content">
              <?php 
              foreach($vendor_type as $type) {
                $type_query = get_posts(
                  array(
                    'post_type' => 'vendor',
                    'posts_per_page' => 40,
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'tax_query' => array(
                      array(
                        'taxonomy' => 'vendor-type',
                        'field' => 'term_id',
                        'terms' => $type->term_id,
                      )
                    )
                  )
                );
  
              if ($type_query): ?>
              <div id="tab-<?php echo $type->slug?>" class="tab-pane fade">
                <div class="wdl-archive wdl-archive-extended <?php echo esc_attr($atts['class']); ?>">
                  <div id="promotion-swiper" class="swiper wdl-archive-swiper">
                    <div class="swiper-wrapper row-cols-archive-randomized opacity-1">
                      <?php foreach ($type_query as $post): ?>
                        <div id="wdl-post-<?php the_ID(); ?>" class="<?php echo esc_attr($atts['class_single']); ?> swiper-slide h-auto card wdl-archive-card">
                            <?php if (has_post_thumbnail(get_the_ID())): ?>
                              <a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>">
                                <img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($post, 'medium_large')) ?>" width="100%">
                              </a>
                            <?php endif; ?>
  
                            <div class="card-select">
                              <div class="wdl-checkbox">
                                <input class="card-select-input" id="card-select-<?php the_ID() ?>" type="checkbox" data-select='
                                {
                                  "title": "<?php the_title() ?>",
                                  "postType": "<?php echo get_post_type() ?>",
                                  "id": "<?php the_ID() ?>"
                                }'>
                                <label for="card-select-<?php the_ID() ?>">
                                  <?php _e('เลือก', 'เลือก') ?>
                                </label>
                              </div>
                            </div>
  
                            <div class="card-body wdl-archive-card-body">
                              <div class="wdl-archive-pretitle mb-0">
                                <?php $vendorType = get_field('VendorType');
                                if ($vendorType) {
                                  foreach($vendorType as $item) {
                                    echo $item->name;
                                  }
                                }
                                ?>
                                
                                <?php $vendorCharacter = get_field('Character');
                                if ($vendorCharacter): ?>
                                <?php //foreach ($vendorCharacter as $character):
                                $characterBackground = get_field('CharacterBackground', $vendorCharacter);
                                $characterBorder = get_field('CharacterBorder', $vendorCharacter);
                                $characterColor = get_field('CharacterColor', $vendorCharacter);
                                $characterEffect = get_field('CharacterEffect', $vendorCharacter);
                                ?>
                                <div class="wdl-character
                                  <?php if($characterBorder) {echo('wdl-character-border');} ?>
                                  <?php if($characterEffect) {echo('wdl-character-animation-' . $characterEffect);} ?>"
                                <?php 
                                if($characterColor || $characterBackground) :?>
                                style="
                                  --background-image: url(<?php echo( $characterBackground['url'] )?>);
                                  --box-shadow: none;
                                  --color: rgba(<?php echo( $characterColor['red']) ?>,<?php echo( $characterColor['green']) ?>,<?php echo( $characterColor['blue']) ?>,<?php echo( $characterColor['alpha'])?>);
                                  --color-50: rgba(<?php echo( $characterColor['red']) ?>,<?php echo( $characterColor['green']) ?>,<?php echo( $characterColor['blue']) ?>, 50%);
                                  --color-0: rgba(<?php echo( $characterColor['red']) ?>,<?php echo( $characterColor['green']) ?>,<?php echo( $characterColor['blue']) ?>, 0);
                                "
                                <?php endif ?>
                                >
                                  <span><?php echo esc_html($vendorCharacter->name); ?></span>
                                </div>
                                <?php //endforeach; ?>
                                <?php endif ?>
                              </div>
                              
                              <h3 class="wdl-archive-title mb-0"><a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                              </a></h3>
  
                              <?php
                              $locations = get_field('Location');
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
  
                              <p class="lineclamp-3 mb-2 text-sm text-secondary">
                                <?php echo (get_the_excerpt()); ?>
                              </p>
  
                              <?php if(get_field('MinPrice')) : ?>
                              <div class="text-red fw-semibold mb-2">เริ่มต้น
                                <?php echo number_format(get_field('MinPrice')); ?> บาท
                              </div>
                              <?php endif; ?>
                            </div>
  
                            <div class="card-footer">
                              <a href="#" class="wdl-btn-cta wdl-form-general-direct" data-bs-toggle="modal" data-bs-target=".wdl-form-general-modal">คลิกขอแพ็กเกจ</a>
                              <a href="<?php the_permalink() ?>" class="wdl-btn-more">ดูรายละเอียด</a>
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
  
  
  
                  <div class="row">
                    <div class="col text-center mt-4 mb-5">
                      <a href="<?php echo esc_html(get_term_link($type)) ?>" class="wdl-btn-secondary py-2 px-3">
                        <?php _e('ดู '.$type->name.' ทั้งหมด', 'ดู '.$type->name.' ทั้งหมด') ?>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <?php endif; } ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php
  $paged = get_query_var('paged', 1);
  $postAll = new WP_Query(
    array(
      'post_type' => 'post',
      'post_status' => 'publish',
      'posts_per_page' => '12',
      'paged' => $paged,
      'orderby' => 'post_date',
      'order' => 'DESC'
    )
  ) ?>

  <section class="pb-5">
    <div class="container">
      <div class="row pb-3">
        <div class="col">
          <h2 class="h1 wdl-localnav-heading">
            <?php echo(get_option('wdl_options', 'บทความล่าสุด')['word-frontpage-post-title']); ?>
          </h2>
          <p class="text-secondary">
            <?php echo(get_option('wdl_options', 'รวบรวมบทความให้คุณไว้ที่เดียว')['word-frontpage-post-desc']); ?>
          </p>
          <div class="wdl-badge-container">
            <a href="#" class="wdl-badge-sm-primary">ทั้งหมด</a>
            <a href="<?php echo esc_html(get_category_link(get_cat_ID('รีวิวแต่งงาน'))) ?>" class="wdl-badge-sm-secondary">รีวิวแต่งงาน</a>
            <a href="<?php echo esc_html(get_category_link(get_cat_ID('สถานที่จัดงานแต่งงาน'))) ?>" class="wdl-badge-sm-secondary">สถานที่จัดงานแต่งงาน</a>
            <a href="<?php echo esc_html(get_category_link(get_cat_ID('ฤกษ์แต่งงาน'))) ?>" class="wdl-badge-sm-secondary">ฤกษ์แต่งงาน</a>
          </div>
        </div>
      </div>
      <?php if ($postAll->have_posts()): ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-3 wdl-archive wdl-archive-extended opacity-1">
          <?php while ($postAll->have_posts()): ?>
            <?php $postAll->the_post(); ?>
            <div class="col">
              <div id="wdl-post-<?php the_ID(); ?>" class="card wdl-archive-card h-100 <?php echo esc_attr($atts['class_single']); ?> wdl-archive-card-blog">

                <?php if (has_post_thumbnail(get_the_ID())): ?>
                  <a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>"><img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($post, 'medium_large')) ?>" width="100%"></a>
                <?php endif; ?>

                <div class="card-body wdl-archive-card-body pb-3">
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

                  <h3 class="wdl-archive-title mb-1"><a href="<?php the_permalink(); ?>">
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
            </div>
          <?php endwhile;
          wp_reset_postdata(); ?>
          <div class="row">
            <div class="col">
              <?php wp_pagenavi(); ?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col text-center mt-3 mb-5">
            <a href="<?php echo esc_html(get_post_type_archive_link('post')) ?>" class="wdl-btn-secondary py-2 px-3">
              <?php _e('ดูบทความทั้งหมด', 'ดูบทความทั้งหมด') ?>
            </a>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <?php include 'components/compare-bar.php' ?>
</main>

<?php include 'components/form-general.php' ?>
<?php include 'components/popup-ads.php' ?>
<?php include 'components/footer.php' ?>