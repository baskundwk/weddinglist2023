<?php include 'components/header.php' ?>
<script>
  document.querySelector('body').classList.add('beta')
</script>
<main>
  <?php include 'components/lead-menu-revamped.php' ?>

  <section class="wdl-listing-section">
  <div class="container">
  <?php
    query_posts(
      array(
        'post_type' => 'venue',
        'orderby' => 'rand',
        'post_status' => 'publish',
        'posts_per_page' => '8',
      )
    ) ?>
    <?php if(have_posts()) :?>
    <?php while(have_posts()) :?>
      <?php the_post(); ?>
      <div class="wdl-listing-card row">
        <div class="wdl-listing-card-gallery col-md-4">
          <?php if (get_field('Gallery')): ?>
          <div class="wdl-listing-card-gallery-swiper">
            <div class="swiper-wrapper">
              <?php
              foreach (get_field('Gallery') as $image):
                $image_id = $image['ID'];
                $image_src = $image['url'];
                $image_caption = $image['caption'];
                ?>
                <div class="swiper-slide">
                  <?php echo wp_get_attachment_image($image_id, 'w425'); ?>
                </div>
                <?php
              endforeach;
              ?>
            </div>
          </div>
          <?php endif; ?>
        </div>
        <div class="wdl-listing-card-detail col-md-8">
          <a href="<?php the_permalink(); ?>" class="wdl-listing-card-detail-title">
            <h2 class="h4">
                <?php the_title(); ?>
            </h2>
            <?php $venueTypes = get_field('VenueType');
              if ($venueTypes): ?>
            <p>
              <?php foreach ($venueTypes as $venueType): ?>
                <span>
                  <?php echo esc_html($venueType->name); ?>
                </span>
              <?php endforeach; ?>
            </p>
            <?php endif ?>
          </a>
          <div class="wdl-listing-card-detail-address">
            <?php
            $address = get_field('Address');
            $googleMaps = get_field('GoogleMaps');
            if ($address): ?>
              <p class="wdl-metadata wdl-archive-pin mb-0">
                <span>
                  <?php the_field('Address') ?>
                  &nbsp;
                  <?php if ($googleMaps): ?>
                    <a href="<?php echo esc_url(the_field('GoogleMaps')) ?>" target="_blank" class="wdl-link-external">
                      <?php _e('ดูแผนที่', 'Map') ?>
                    </a>
                  <?php endif; ?>
                </span>
              </p>
            <?php endif; ?>
          </div>
          <div class="wdl-listing-card-detail-pricing">
            <div class="wdl-listing-card-detail-pricing-swiper swiper">
              <div class="swiper-wrapper">
                <?php while (have_rows('Pricing')):
                  the_row(); ?>
                  <?php if (get_row_layout() == 'Package'): ?>
                  <div class="swiper-slide">
                    <?php if (get_sub_field('PackageType')): ?>
                      <?php $packageType = get_sub_field('PackageType'); ?>
                      <?php echo esc_html($packageType->name); ?><br/>
                    <?php endif; ?>

                    <span class="text-red">
                      <?php if (get_sub_field('PackagePrice')):
                        the_sub_field('PackagePrice');
                      endif; ?>
                    </span>
                    <!-- if (get_sub_field('PackageNote')):
                      the_sub_field('PackageNote');
                    endif; -->
                  </div>
                  <?php endif; ?>

                  <?php if (get_row_layout() == 'WeddingPackage'): ?>
                  <div class="swiper-slide">
                    <?php if (get_sub_field('WeddingPackageType')): ?>
                      <?php $weddingPackageType = get_sub_field('WeddingPackageType'); ?>
                      <?php echo esc_html($weddingPackageType->name); ?><br/>
                    <?php endif; ?>

                    <span class="text-red">
                      <?php if (get_sub_field('WeddingPackagePrice')):
                        the_sub_field('WeddingPackagePrice');
                      endif; ?>
                    </span>
                    <!-- if (get_sub_field('WeddingPackageNote')):
                      the_sub_field('WeddingPackageNote');
                    endif; -->
                  </div>
                  <?php endif; ?>

                  <?php if (get_row_layout() == 'FoodBeverage'): ?>
                  <div class="swiper-slide">
                    <?php if (get_sub_field('FoodBeverageType')):
                      $fbType = get_sub_field('FoodBeverageType'); ?>
                      <?php echo esc_html($fbType->name); ?><br/>
                    <?php endif; ?>

                    <span class="text-red">
                      <?php if (get_sub_field('FoodBeveragePrice')):
                        the_sub_field('FoodBeveragePrice');
                      endif; ?>
                    </span>
                    <!-- if (get_sub_field('FoodBeverageNote')):
                      the_sub_field('FoodBeverageNote');
                    endif; -->
                  </div>
                  <?php endif; ?>
                <?php endwhile; ?>
              </div>
            </div>
          </div>
          <div class="wdl-listing-card-detail-room">
            <div class="wdl-listing-card-detail-room-swiper">
              <div class="swiper-wrapper">
                <?php while (have_rows('BanquetRoom')):
                  the_row(); ?>
                  <div class="swiper-slide">
                    <div class="wdl-listing-card-detail-room-image">
                      <img loading="lazy" src="<?php the_sub_field('BanquetRoomImage') ?>" alt="">
                    </div>
                    <div class="wdl-listing-card-detail-room-detail">
                      <div class="wdl-listing-card-detail-room-title">
                        <?php the_sub_field('BanquetRoomName') ?>
                      </div>
                      <div class="wdl-listing-card-detail-room-area">
                        <?php the_sub_field('BanquetRoomArea') ?>
                      </div>
                    </div>
                  </div>
                <?php endwhile; ?>
              </div>
            </div>
          </div>
          <div class="wdl-listing-card-detail-features">
            <div class="wdl-listing-card-detail-features-swiper">
              <div class="swiper-wrapper">
                <?php $ceremonyTypes = get_field('CeremonyTypes');
                foreach ($ceremonyTypes as $ceremonyType): ?>
                  <div class="swiper-slide">
                    <p><?php echo esc_html($ceremonyType->name) ?></p>
                  </div>
                <?php endforeach; ?>
                <?php $amentities = get_field('Amentities');
                foreach ($amentities as $amentity): ?>
                  <div class="swiper-slide">
                    <p><?php echo esc_html($amentity->name) ?></p>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
          <div class="wdl-listing-card-detail-action">
            <a id="apply-cta" href="#apply" class="wdl-btn" data-bs-toggle="modal">
              <?php _e('คลิกขอแพ็กเกจ', 'Apply for Promotion'); ?>
            </a>
            <a href="<?php the_permalink();?>" class="wdl-btn-more">
              <?php _e('ดูรายละเอียด', 'More detail'); ?>
            </a>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
    <?php endif; ?>
  </div>
  </section>
</main>

<?php include 'components/footer.php' ?>