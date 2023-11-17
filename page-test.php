<?php include 'components/header.php' ?>
<main>
  <section class="overflow-x-hidden pt-4">
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
    <div class="container pb-4">
      <div class="row px-xl-2">
        <div class="col px-0 px-xl-1">
          <div class="wdl-hero su-posts su-posts-default-loop <?php echo esc_attr($atts['class']); ?>">
            <?php if ($hero->have_posts()): ?>

              <div class="swiper wdl-hero-swiper">
                <div class="swiper-wrapper">
                  <?php while ($hero->have_posts()): ?>
                    <?php $hero->the_post(); ?>

                    <?php if (!su_current_user_can_read_post(get_the_ID())): ?>
                      <?php continue; ?>
                    <?php endif; ?>

                    <?php if (get_field('HeroBannerImage')):
                      //print_r(get_field('HeroBannerImage')['sizes']['medium_large']); ?>
                      <div id="su-post-<?php the_ID(); ?>" class="swiper-slide su-post <?php echo esc_attr($atts['class_single']); ?>">
                        <a class="wdl-hero-banner" href="<?php the_permalink(); ?>">
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

  <?php include 'components/lead-menu.php' ?>

  <section class="overflow-x-hidden">
    <?php $promotionArgs = array(
      'post_type' => 'promotion',
      'post_status' => 'publish',
      'orderby' => 'meta_value',
      'order' => 'DESC',
      'posts_per_page' => '8',
      'meta_key' => 'HotDeal',
    );

    $promotion = new WP_Query($promotionArgs);
    ?>
    <div class="container">
      <div class="row">
        <div class="col">
          <h2 class="h1">โปรโมชั่นงานแต่งงาน</h2>
          <p class="mb-2">รวบรวมโปรโมชั่นแต่งงานให้คุณไว้ที่เดียว</p>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="wdl-archive wdl-archive-extended <?php echo esc_attr($atts['class']); ?>">
            <?php
            if ($promotion->have_posts()): ?>

              <div id="promotions" class="swiper wdl-archive-swiper overflow-visible">
                <div class="swiper-wrapper row-cols-archive-randomized">
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

                        <?php
                        $relatedVenue = get_field('RelatedVenue');
                        if ($relatedVenue):
                          foreach ($relatedVenue as $venue):
                            $venueType = get_field('VenueType', $venue->ID);
                            ?>
                            <div class="wdl-archive-pretitle mb-2">
                              <small>
                                <?php echo $venueType[0]->name ?>
                              </small>
                            </div>
                          <?php endforeach; endif; ?>

                        <h3 class="wdl-archive-title"><a href="<?php the_permalink(); ?>">
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
                      </div>
                      <div class="card-footer">
                        <a href="#" class="wdl-btn-cta">ลงทะเบียนรับสิทธิพิเศษ</a>
                        <a href="#" class="wdl-btn-more">ดูรายละเอียด</a>
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
        </div>
      </div>
      <div class="row">
        <div class="col text-center mt-3 mb-5">
          <a href="<?php echo esc_html(get_post_type_archive_link('promotion')) ?>" class="wdl-btn-secondary py-2 px-3">ดูทั้งหมด</a>
        </div>
      </div>
    </div>
  </section>

  <section class="overflow-x-hidden">
    <?php $weddingfairArgs = array(
      'post_type' => 'wedding-fair',
      'post_status' => 'publish',
      'orderby' => 'meta_value',
      'order' => 'DESC',
      'posts_per_page' => '8',
      'meta_key' => 'HotDeal',
    );

    $weddingfair = new WP_Query($weddingfairArgs);
    ?>

    <div class="container">
      <div class="row">
        <div class="col">
          <h2 class="h1">Wedding Fair</h2>
          <p class="mb-2">รวบรวมงานแฟร์แต่งงานให้คุณไว้ที่เดียว</p>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="wdl-archive wdl-archive-extended <?php echo esc_attr($atts['class']); ?>">

            <?php if ($weddingfair->have_posts()): ?>

              <div class="swiper wdl-archive-swiper overflow-visible">
                <div class="swiper-wrapper row-cols-archive-randomized">
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
                          <input id="card-select-<?php the_ID()?>" type="checkbox" data-select='
                            {
                              "title": "<?php the_title() ?>",
                              "postType": "<?php echo get_post_type() ?>"
                            }'>
                          <label for="card-select-<?php the_ID()?>">เลือก</label>
                        </div>
                      </div>

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

                        <h3 class="wdl-archive-title"><a href="<?php the_permalink(); ?>">
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
                        <a href="#" class="wdl-btn-cta">ลงทะเบียนรับสิทธิพิเศษ</a>
                        <a href="#" class="wdl-btn-more">ดูรายละเอียด</a>
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
        </div>
      </div>
      <div class="row">
        <div class="col text-center mt-3 mb-5">
          <a href="<?php echo esc_html(get_post_type_archive_link('wedding-fair')) ?>" class="wdl-btn-secondary py-2 px-3">ดูทั้งหมด</a>
        </div>
      </div>
    </div>
  </section>

  <section class="overflow-x-hidden">
    <?php $venueArgs = array(
      'post_type' => 'venue',
      'post_status' => 'publish',
      'orderby' => 'meta_value',
      'order' => 'DESC',
      'posts_per_page' => '9',
      'meta_key' => 'Sponsor',
    );

    $venue = new WP_Query($venueArgs);
    ?>

    <div class="container">
      <div class="row">
        <div class="col">
          <h2 class="h1">สถานที่จัดงานแต่งงาน</h2>
          <p class="mb-2">รวบรวมสถานที่จัดงานแต่งงานให้คุณไว้ที่เดียว</p>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="wdl-archive wdl-archive-extended <?php echo esc_attr($atts['class']); ?>">
            <?php if ($venue->have_posts()): ?>
              <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-3 row-cols-archive-randomized">

                <?php while ($venue->have_posts()): ?>
                  <?php $venue->the_post();
                  $sponsored = get_field('Sponsor');
                  ?>

                  <div class="col <?php if ($sponsored && in_array('Sponsored', $sponsored)) {
                    echo ('order-first');
                  } ?> <?php if (get_field('Sponsor')) {
                      echo esc_html('wdl-archive-primary');
                    } else {
                      echo esc_html('wdl-archive-default');
                    } ?>">
                    <div id="wdl-post-<?php the_ID(); ?>" class="card wdl-archive-card <?php echo esc_attr($atts['class_single']); ?>">

                      <?php if (has_post_thumbnail(get_the_ID())): ?>
                        <a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>" title="<?php get_the_title() ?>">
                          <img loading="lazy" src="<?php echo esc_html(wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large')[0]) ?>" srcset="<?php echo esc_html(wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large')[0]) ?> 1x,
                            <?php echo esc_html(wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large')[0]) ?> 2x" alt="<?php get_the_title() ?>">
                          <?php
                          if ($sponsored && in_array('Sponsored', $sponsored)): ?>
                            <span class="badge wdl-badge-sm">Sponsored</span>
                          <?php endif; ?>
                        </a>
                      <?php endif; ?>

                      <div class="card-body wdl-archive-card-body">
                        <h3 class="wdl-archive-title "><a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                          </a></h3>

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
                        <a href="#" class="wdl-btn-cta">ลงทะเบียนรับสิทธิพิเศษ</a>
                        <a href="#" class="wdl-btn-more">ดูรายละเอียด</a>
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
        </div>
      </div>
      <div class="row">
        <div class="col text-center mt-3 mb-5">
          <a href="<?php echo esc_html(get_post_type_archive_link('venue')) ?>" class="wdl-btn-secondary py-2 px-3">ดูทั้งหมด</a>
        </div>
      </div>
    </div>
  </section>
</main>

<?php include 'components/footer.php' ?>