<?php include 'components/header.php' ?>
<main>
  <?php include 'components/lead-menu-revamped.php' ?>
  <section class="pb-3">
    <div class="container-xl">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="row my-3 g-4">
            <div class="col-md-6">
              <div class="wdl-single-thumbnail">
                <?php the_post_thumbnail('large') ?>
              </div>
            </div>
            <div class="col-md-6">
              <h1 class="mb-3">
                <?php the_title(); ?>
              </h1>
              <p class="mb-0 text-secondary text-sm">
                <?php echo (get_the_excerpt()); ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="wdl-listing-section wdl-archive-infinite-scroll">
    <div class="container gap-3 wdl-archive-infinite-scroll-wrapper" id="wdl-archive-infinite-scroll-wrapper">
      <?php foreach (get_field('List') as $item): ?>
        <?php
        $itemQuery = new WP_Query(
          array(
            'p' => $item['ListVenue']->ID,
            'post_type' => 'any'
          )
        );?>
        <?php if ($itemQuery->have_posts()): ?>
          <?php $itemQuery->the_post(); ?>
          <div id="wdl-post-<?php echo get_the_ID(); ?>" class="wdl-listing-card row wdl-archive-infinite-scroll-post wdl-archive-card">
            <div class="card-select d-none">
              <div class="wdl-checkbox">
                <input id="card-select-<?php echo get_the_ID() ?>" type="checkbox" data-select='
              {
                "title": "<?php echo get_the_title() ?>",
                "postType": "<?php echo get_post_type() ?>",
                "id": "<?php echo get_the_ID() ?>"
              }'>
                <label for="card-select-<?php echo get_the_ID() ?>">
                  <?php _e('เลือก', 'เลือก') ?>
                </label>
              </div>
            </div>
            <?php if($item['ListBadge']) : ?>
              <div class="wdl-listing-badge <?php echo $item['ListColor']?>"><?php echo $item['ListBadge']?></div>
            <?php endif; ?>
            <div class="wdl-listing-card-gallery col-md-4">
              <?php if (get_field('Gallery')): ?>
                <div class="swiper wdl-listing-card-gallery-swiper">
                  <div class="swiper-wrapper">
                    <?php
                    $galleryLimit = 0;
                    foreach (get_field('Gallery') as $image):
                      $image_id = $image['ID'];
                      $image_src = $image['url'];
                      $image_caption = $image['caption'];
                      ?>
                      <div class="swiper-slide">
                        <?php echo wp_get_attachment_image($image_id, 'w425'); ?>
                      </div>
                      <?php
                      $galleryLimit++;
                      if ($galleryLimit >= 5) {
                        break;
                      }
                      ;
                    endforeach;
                    ?>
                  </div>
                  <div class="swiper-navigation swiper-navigation-small">
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                  </div>
                </div>
              <?php endif; ?>
            </div>
            <div class="wdl-listing-card-detail col-md-8">
              <a href="<?php the_permalink(); ?>" class="wdl-listing-card-detail-title">
                <h2>
                  <?php echo get_the_title(); ?>
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
                  <?php //endforeach; ?>
                <?php endif ?>
              </a>
              <div class="wdl-listing-card-detail-address">
                <?php
                $address = get_field('Address');
                $googleMaps = get_field('GoogleMaps');
                if ($address): ?>
                  <p class="wdl-metadata wdl-archive-pin mb-0">
                    <span>
                      <?php echo $address ?>
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
                        <?php if (get_sub_field('PackageType') && get_sub_field('PackagePrice')): ?>
                          <div class="swiper-slide">
                            <div class="wdl-listing-card-detail-pricing-card">
                              <?php $packageType = get_sub_field('PackageType'); ?>
                              <?php echo esc_html($packageType->name); ?><br />
                              <span class="text-red">
                                <?php the_sub_field('PackagePrice'); ?>
                              </span>
                            </div>
                          </div>
                        <?php endif; ?>
                      <?php endif; ?>

                      <?php if (get_row_layout() == 'WeddingPackage'): ?>
                        <?php if (get_sub_field('WeddingPackageType') && get_sub_field('WeddingPackagePrice')): ?>
                          <div class="swiper-slide">
                            <div class="wdl-listing-card-detail-pricing-card">
                              <?php $weddingPackageType = get_sub_field('WeddingPackageType'); ?>
                              <?php echo esc_html($weddingPackageType->name); ?><br />
                              <span class="text-red">
                                <?php the_sub_field('WeddingPackagePrice'); ?>
                              </span>
                            </div>
                          </div>
                        <?php endif; ?>
                      <?php endif; ?>

                      <?php if (get_row_layout() == 'FoodBeverage'): ?>
                        <?php if (get_sub_field('FoodBeverageType') && get_sub_field('FoodBeveragePrice')): ?>
                          <div class="swiper-slide">
                            <div class="wdl-listing-card-detail-pricing-card">
                              <?php $fbType = get_sub_field('FoodBeverageType'); ?>
                              <?php echo esc_html($fbType->name); ?><br />
                              <span class="text-red">
                                <?php the_sub_field('FoodBeveragePrice'); ?>
                              </span>
                            </div>
                          </div>
                        <?php endif; ?>
                      <?php endif; ?>
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
                        <p>
                          <?php echo esc_html($ceremonyType->name) ?>
                        </p>
                      </div>
                    <?php endforeach; ?>
                    <?php $amentities = get_field('Amentities');
                    foreach ($amentities as $amentity): ?>
                      <div class="swiper-slide">
                        <p>
                          <?php echo esc_html($amentity->name) ?>
                        </p>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
              <div class="wdl-listing-card-detail-action">
                <a href="#" class="wdl-btn wdl-form-general-direct" data-bs-toggle="modal" data-bs-target=".wdl-form-general-modal">
                  <?php _e('คลิกขอแพ็กเกจ', 'Apply for Promotion'); ?>
                </a>
                <a href="<?php the_permalink(); ?>" class="wdl-btn-more">
                  <?php _e('ดูรายละเอียด', 'More detail'); ?>
                </a>
              </div>
            </div>
          </div>
          <?php wp_reset_postdata(); ?>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </section>
</main>
<?php include 'components/form-general.php' ?>
<?php include 'components/footer.php' ?>