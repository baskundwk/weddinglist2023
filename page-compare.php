<?php include 'components/header.php' ?>
<main>
  <?php include 'components/lead-menu-revamped.php' ?>

  <?php
  $comparePosts = new WP_Query(
    array(
      'post__in' => explode(',', $_GET['compare_id']),
      'post_type' => 'venue',
      'orderby' => 'post__in'
    )
  ) ?>

  <section class="wdl-archive overflow-hidden">
    <div class="container-xxl">
      <div class="row mb-3">
        <div class="col-md-6 text-center text-md-start">
          <a class="wdl-link-back" href="#" onclick="history.back()">ย้อนกลับ</a>
          <h1>
            <?php echo _e('เปรียบเทียบสถานที่จัดงานแต่งงาน', 'เปรียบเทียบสถานที่จัดงานแต่งงาน') ?>
          </h1>
        </div>
        <div class="col-md-6 pt-3 text-center text-md-end">
          <a class="wdl-link-print" href="#">Print หน้านี้</a>
          <a class="wdl-link-share" href="#share" data-bs-toggle="modal">แชร์หน้านี้</a>
        </div>
      </div>
    </div>
    <div class="container-xxl container-archive">
      <div class="swiper wdl-compare-swiper mb-5">
        <div class="swiper-wrapper">
          <?php while ($comparePosts->have_posts()): ?>
            <?php $comparePosts->the_post(); ?>

            <div id="wdl-post-<?php the_ID(); ?>" class="swiper-slide wdl-archive-card card p-0 h-100 <?php echo esc_attr($atts['class_single']); ?> wdl-archive-card-blog wdl-compare-card">

              <div class="card-select d-none">
                <div class="wdl-checkbox">
                  <input class="card-select-input" id="card-select-<?php the_ID() ?>" type="checkbox" data-select='
                    {
                      "title": "<?php the_title() ?>",
                      "postType": "<?php echo get_post_type() ?>",
                      "id": "<?php the_ID() ?>"
                    }'>
                  <label for="card-select-<?php the_ID() ?>"><?php _e('เลือก','เลือก')?></label>
                </div>
              </div>

              <?php if (has_post_thumbnail(get_the_ID())): ?>
                <a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>"><img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($post, 'medium_large')) ?>" width="100%"></a>
              <?php endif; ?>

              <div class="card-body wdl-archive-card-body">
                <div class="mb-3 wdl-compare-group" data-mh="wdl-compare-group-1">
                  <div class="wdl-archive-pretitle">
                    <small>
                      <?php if(get_field('VenueType')[0]->name) {
                          echo esc_html(get_field('VenueType')[0]->name);
                        } else {
                          echo esc_html('&nbsp;');
                        }?>
                    </small>
                  </div>
                  <h3 class="wdl-archive-title mb-0">
                    <a href="<?php the_permalink(); ?>">
                      <?php the_title(); ?>
                    </a>
                  </h3>
                </div>

                <div class="mb-4 wdl-compare-group" data-mh="wdl-compare-group-2">
                  <a href="#" class="wdl-btn w-100 text-center wdl-apply-btn wdl-btn-cta wdl-form-general-direct" data-bs-toggle="modal" data-bs-target=".wdl-form-general-modal">คลิกขอแพ็กเกจ</a>
                </div>

                <div class="mb-4 wdl-compare-group" data-mh="wdl-compare-group-3">
                  <div class="wdl-metadata">
                      <?php
                      $locations = get_field('Location');
                      if ($locations) : ?>
                        <div class="wdl-archive-neighborhood">
                          <ul>
                            <?php foreach ($locations as $location) : ?>
                              <li>
                                <?php echo esc_html($location->name); ?>
                              </li>
                            <?php endforeach; ?>
                          </ul>
                        </div>
                      <?php endif; ?>

                      <?php
                      $minPrice = get_field('MinPrice');
                      if ($minPrice) : ?>
                        <div class="wdl-archive-min-price">
                          <span><?php _e('ราคาเริ่มต้น', 'Starting price') ?>&nbsp;<strong><?php echo number_format(get_field('MinPrice')) ?>+ <?php _e('บาท', 'THB') ?></strong></span>
                        </div>
                      <?php endif; ?>

                      <?php
                      $maxGuest = get_field('MaxGuest');
                      if ($maxGuest) : ?>
                        <div class="wdl-archive-max-guest">
                          <span><?php _e('รองรับแขกสูงสุด', 'Max guest') ?>&nbsp;<strong><?php echo number_format(get_field('MaxGuest')) ?> <?php _e('คน', 'people') ?></strong></span>
                        </div>
                      <?php endif; ?>
                    </div>
                </div>

                <div class="mb-4 wdl-compare-group" data-mh="wdl-compare-group-4">
                  <h4><?php _e('ข้อมูลค่าใช้จ่าย','ข้อมูลค่าใช้จ่าย')?></h4>
                  <ul>
                  <?php $pricings = get_field('Pricing');
                    while (have_rows('Pricing')):
                    the_row();?>
                    <?php if (get_row_layout() == 'Package'): ?>
                      <li class="wdl-metadata">
                        งานหมั้น
                        <?php // echo esc_html(get_sub_field('PackageType')->name); ?>
                        <span class="text-red fw-semibold"><?php the_sub_field('PackagePrice'); ?></span>
                      </li>
                      <?php break; ?>
                    <?php endif; ?>
                    <?php endwhile; ?>
                    <?php while (have_rows('Pricing')):
                    the_row();?>
                    
                    <?php if (get_row_layout() == 'WeddingPackage'): ?>
                      <li class="wdl-metadata">
                        งานแต่งงาน
                        <?php // echo esc_html(get_sub_field('WeddingPackageType')->name); ?>
                        <span class="text-red fw-semibold"><?php the_sub_field('WeddingPackagePrice'); ?></span>
                      </li>
                      <?php break; ?>
                    <?php endif; ?>
                    <?php endwhile; ?>
                    <?php while (have_rows('Pricing')):
                    the_row();?>
                    <?php if (get_row_layout() == 'FoodBeverage'): ?>
                      <li class="wdl-metadata">
                        <?php echo esc_html(get_sub_field('FoodBeverageType')->name); ?>
                        <span class="text-red fw-semibold"><?php the_sub_field('FoodBeveragePrice'); ?></span>
                      </li>
                    <?php endif; ?>
                    <?php endwhile; ?>
                  </ul>
                </div>

                <div class="mb-4 wdl-compare-group" data-mh="wdl-compare-group-5">
                  <h4><?php _e('รูปแบบการจัดงาน','รูปแบบการจัดงาน')?></h4>
                  <ul>
                  <?php $ceremonyTypes = get_field('CeremonyTypes');
                    foreach($ceremonyTypes as $ceremonyType) :	?>
                      <li class="wdl-metadata">
                        <?php echo esc_html($ceremonyType->name)?>
                      </li>
                  <?php endforeach; ?>
                  </ul>
                </div>
                
                <div class="mb-4 wdl-compare-group" data-mh="wdl-compare-group-6">
                  <h4><?php _e('สิ่งอำนวยความสะดวก','สิ่งอำนวยความสะดวก')?></h4>
                  <ul>
                  <?php $amentities = get_field('Amentities');
                    foreach($amentities as $ceremonyType) :	?>
                      <li class="wdl-metadata">
                        <?php echo esc_html($ceremonyType->name)?>
                      </li>
                  <?php endforeach; ?>
                  </ul>
                </div>

                <div class="mb-4 wdl-compare-group position-relative">
                  <h4><?php _e('ห้องจัดเลี้ยง', 'Banquet room')?></h4>
                  <div class="swiper wdl-compare-group-room-swiper p-3">
                    <div class="swiper-wrapper">
                      <?php while( have_rows('BanquetRoom') ): the_row(); ?>
                      <?php if( get_row_layout() == 'BanquetRoomEntry' ): ?>
                        <div class="swiper-slide" data-mh="wdl-compare-group-7">
                          <div class="wdl-pricing-card wdl-card">
                            <?php if( get_sub_field('BanquetRoomImage')) : ?>
                            <figure class="card-img-top wdl-archive-card-img-top p-0">
                              <img loading="lazy" src="<?php the_sub_field('BanquetRoomImage')?>" alt="">
                            </figure>
                            <?php endif; ?>
                            <?php if( get_sub_field('BanquetRoomName')) : ?>
                            <div class="text-sm fw-semibold">
                              <?php the_sub_field('BanquetRoomName')?>
                            </div>
                            <?php endif; ?>

                            <?php if( get_sub_field('BanquetRoomArea')) : ?>
                              <div class="wdl-metadata text-secondary"><?php _e('พื้นที่', 'Area')?> <?php the_sub_field('BanquetRoomArea')?></div>
                            <?php endif; ?>

                            <?php if( get_sub_field('BanquetRoomChineseDinner')) : ?>
                              <div class="wdl-metadata text-secondary"><?php _e('โต๊ะจีน', 'Chinese dinner')?> <?php the_sub_field('BanquetRoomChineseDinner')?></div>
                            <?php endif; ?>

                            <?php if( get_sub_field('BanquetRoomCocktailDinner')) : ?>                                
                              <div class="wdl-metadata text-secondary"><?php _e('ค็อกเทล', 'Cocktail dinner')?> <?php the_sub_field('BanquetRoomCocktailDinner')?></div>
                            <?php endif; ?>

                            <?php if( get_sub_field('BanquetRoomBuffetDinner')) : ?>                                
                              <div class="wdl-metadata text-secondary"><?php _e('บุฟเฟ่ต์', 'Buffet dinner')?> <?php the_sub_field('BanquetRoomBuffetDinner')?></div>
                            <?php endif; ?>
                              
                            <?php if( get_sub_field('BanquetRoomSitdownDinner')) : ?>                                
                              <div class="wdl-metadata text-secondary"><?php _e('ซิทดาวน์', 'Sitdown dinner')?> <?php the_sub_field('BanquetRoomSitdownDinner')?></div>
                            <?php endif; ?>
                          </div>
                        </div>
                      <?php endif; ?>
                      <?php endwhile; ?>
                    </div>
                    <div class="swiper-navigation swiper-navigation-small">
                      <div class="swiper-button-prev"></div>
                      <div class="swiper-button-next"></div>
                    </div>
                  </div>

                </div>
                
              </div>

            </div>

          <?php endwhile;
          wp_reset_postdata(); ?>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </section>

  <div class="modal fade modal-lg" id="apply">
    <div class="modal-dialog modal-dialog-centered m-auto">
      <div class="modal-content m-3 mb-0">
        <div class="modal-header">
          <h3 class="m-0">ตอบคำถามสั้น ๆ เพื่อรับสิทธิพิเศษสำหรับคุณ!</h3>
          
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="wdl-archive-location mb-2"><?php the_title() ?></p>
          <?php $microsite = get_field('Microsite');
          if ($microsite && in_array('Free Microsite', $microsite)) : ?>
            <?php echo apply_shortcodes('[contact-form-7 id="206307" title="Venue Form : Free"]') ?>
          <?php else : ?>
            <?php echo apply_shortcodes('[contact-form-7 id="206300" title="Venue Form"]'); ?>
          <?php endif; ?>

        </div>
      </div>
    </div>
  </div>
</main>

<?php include 'components/form-general.php' ?>
<?php include 'components/share-modal.php' ?>
<?php include 'components/footer.php' ?>