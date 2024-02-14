<?php $localnav = true; ?>
<?php include 'components/header.php' ?>
<main>
  <?php include 'components/lead-menu-revamped.php' ?>
  <script>
    document.querySelector('input[name="s"]').setAttribute('value', '<?php echo esc_html(get_search_query()) ?>');
  </script>
  <section>
    <?php if (have_posts()):
      $countPromotion = 0;
      $countWeddingFair = 0;
      $countVendor = 0;
      $countPost = 0;
      $countVenue = 0;
      foreach ($posts as $eachPost) {
        if ($eachPost->post_type === 'venue') {
          $countVenue++;
        }
        if ($eachPost->post_type === 'promotion') {
          $countPromotion++;
        }
        if ($eachPost->post_type === 'wedding-fair') {
          $countWeddingFair++;
        }
        if ($eachPost->post_type === 'vendor') {
          $countVendor++;
        }
        if ($eachPost->post_type === 'post') {
          $countPost++;
        }
      }
      $types = array('venue', 'promotion', 'wedding-fair', 'vendor', 'post'); ?>

      <div class="overflow-hidden mt-4">
        <div class="container-xl">
          <h1><?php echo(_e('ผลการค้นหา', 'ผลการค้นหา') . ' "' . get_search_query() . '"') ?></h1>
          <ul class="wdl-tab nav mb-3 wdl-tab-related">
          <?php foreach ($types as $type): ?>
            <?php if ($type === 'venue' && $countVenue > 0): ?><li class="nav-item">
              <a role="tab" aria-control="tab-post" data-bs-toggle="tab" data-bs-target="#tab-venue" class="nav-link" href="#"><i class="wdl-tab-icon" data-feather="map-pin"></i> สถานที่จัดงาน</a>
            </li><?php endif; ?>
            <?php if ($type === 'promotion' && $countPromotion > 0): ?><li class="nav-item">
              <a role="tab" aria-control="tab-promotion" data-bs-toggle="tab" data-bs-target="#tab-promotion" class="nav-link" aria-current="tab" href="#"><i class="wdl-tab-icon" data-feather="tag"></i> โปรโมชั่น</a>
            </li><?php endif; ?>
            <?php if ($type === 'wedding-fair' && $countWeddingFair > 0): ?><li class="nav-item">
              <a role="tab" aria-control="tab-wedding-fair" data-bs-toggle="tab" data-bs-target="#tab-wedding-fair" class="nav-link" href="#"><i class="wdl-tab-icon" data-feather="calendar"></i> Wedding Fair & Event</a>
            </li><?php endif; ?>
            <?php if ($type === 'vendor' && $countVendor > 0): ?><li class="nav-item">
              <a role="tab" aria-control="tab-post" data-bs-toggle="tab" data-bs-target="#tab-vendor" class="nav-link" href="#"><i class="wdl-tab-icon" data-feather="users"></i> ผู้ให้บริการ</a>
            </li><?php endif; ?>
            <?php if ($type === 'post' && $countPost > 0): ?><li class="nav-item">
              <a role="tab" aria-control="tab-post" data-bs-toggle="tab" data-bs-target="#tab-post" class="nav-link" href="#"><i class="wdl-tab-icon" data-feather="bookmark"></i> บทความ</a>
            </li><?php endif; ?>
          <?php endforeach; ?>
          </ul>
        </div>
      </div>
      
      <div class="tab-content wdl-tab-related-content">
        <?php foreach ($types as $type): ?>
          <?php if ($type === 'venue' && $countVenue > 0): ?>
            <div id="tab-venue" class="tab-pane fade">
              <div class="wdl-listing-section py-3">
                <div class="container-xl gap-3 d-flex flex-column">
                  <?php
                  while (have_posts()) {
                    the_post();
                    if ($type === get_post_type()) {
                      ?>
                      <div id="wdl-post-<?php the_ID(); ?>" class="wdl-listing-card row m-0 wdl-archive-infinite-scroll-post wdl-archive-card">
                        <div class="card-select d-none">
                          <div class="wdl-checkbox">
                            <input class="card-select-input" id="card-select-<?php echo get_the_ID() ?>" type="checkbox" data-select='
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
                          <div class="wdl-listing-card-gallery col-md-4">
                          <?php if (get_field('Gallery')): ?>
                          <div class="swiper wdl-listing-card-gallery-swiper">
                            <div class="swiper-wrapper">
                              <?php if (has_post_thumbnail(get_the_ID())): ?>
                                <div class="swiper-slide">
                                  <img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($post, 'medium_large')) ?>" width="100%">
                                </div>
                              <?php endif; ?>
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
                            </h2>
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
                      <?php
                    }
                  }
                  rewind_posts(); ?>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <?php if ($type === 'promotion' && $countPromotion > 0): ?>
            <div id="tab-promotion" class="tab-pane fade">
              <div class="container-xxl container-archive pb-4">
                <div class="wdl-archive wdl-archive-extended <?php echo esc_attr($atts['class']); ?>">
                  <div class="row row-cols-archive g-4">
                    <?php
                    while (have_posts()) {
                      the_post();                      if ($type === get_post_type()) {
                        ?>
                        <div class="col">
                          <div class="card wdl-archive-card h-100">
                          <?php if (has_post_thumbnail(get_the_ID())): ?>
                            <a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>"><img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($post, 'medium_large')) ?>" width="100%"></a>
                          <?php endif; ?>
  
                          <div class="card-select">
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
                                <p class="wdl-archive-location mb-0"><a href="<?php echo esc_html($venuePermalink) ?>">
                                    <?php echo esc_html($venueTitle); ?>
                                  </a></p>
                              <?php endforeach; endif; ?>
                          </div>
  
                          <div class="card-footer">
                            <a href="#" class="wdl-btn-cta wdl-form-general-direct" data-bs-toggle="modal" data-bs-target=".wdl-form-general-modal">คลิกขอแพ็กเกจ</a>
                            <a href="<?php the_permalink() ?>" class="wdl-btn-more">ดูรายละเอียด</a>
                          </div>
                          </div>
                        </div>
                        <?php
                      }
                    }
                    rewind_posts(); ?>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <?php if ($type === 'wedding-fair' && $countWeddingFair > 0): ?>
            <div id="tab-wedding-fair" class="tab-pane fade">
              <div class="container-xxl container-archive overflow-hidden pb-4">
                <div class="wdl-archive wdl-archive-extended <?php echo esc_attr($atts['class']); ?>">
                  <div class="row row-cols-archive g-4">
                    <?php
                    while (have_posts()) {
                      the_post();
                      if ($type === get_post_type()) {
                        ?>
                        <div class="col">
                          <div class="card wdl-archive-card h-100">
                          <?php if (has_post_thumbnail(get_the_ID())): ?>
                            <a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>"><img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($post, 'medium_large')) ?>" width="100%"></a>                          <?php endif; ?>
  
                          <div class="card-select">
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
                                <p class="wdl-archive-location mb-0"><a href="<?php echo esc_html($venuePermalink) ?>">
                                    <?php echo esc_html($venueTitle); ?>
                                  </a></p>
                              <?php endforeach; endif; ?>
                          </div>
  
                          <div class="card-footer">
                            <a href="#" class="wdl-btn-cta wdl-form-general-direct" data-bs-toggle="modal" data-bs-target=".wdl-form-general-modal">คลิกขอแพ็กเกจ</a>
                            <a href="<?php the_permalink() ?>" class="wdl-btn-more">ดูรายละเอียด</a>
                          </div>
                          </div>
                        </div>
                        <?php
                      }
                    }
                    rewind_posts(); ?>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <?php if ($type === 'vendor' && $countVendor > 0): ?>
            <div id="tab-vendor" class="tab-pane fade">
              <div class="container-xl overflow-hidden pb-4">
                <div class="row">
                  <div class="col">
                    <div class="wdl-archive wdl-archive-extended <?php echo esc_attr($atts['class']); ?>">
                      <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-3">
                        <?php
                        while (have_posts()) {
                          the_post();
                          if ($type === get_post_type()) {
                            ?>
                            <div class="col">
                              <div id="wdl-post-<?php the_ID(); ?>" class="swiper-slide card wdl-archive-card <?php echo esc_attr($atts['class_single']); ?> <?php if (get_field('HotDeal')) {
                                  echo esc_html('wdl-archive-primary');
                                } else {
                                  echo esc_html('wdl-archive-default');
                                } ?>">
    
                                <?php if (has_post_thumbnail(get_the_ID())): ?>                                  <a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>" title="<?php get_the_title() ?>">
                                  <?php if (get_field('Gallery')): ?>
                                  <div class="swiper wdl-card-gallery-swiper">
                                    <div class="swiper-wrapper">
                                      <?php if (has_post_thumbnail(get_the_ID())): ?>
                                        <div class="swiper-slide">
                                          <img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($post, 'medium_large')) ?>" width="100%">
                                        </div>
                                        <?php endif; ?>
                                        
                                      <?php if (get_field('Gallery')): ?>
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
                                      if($galleryLimit >= 3) {break;};
                                      endforeach;
                                      ?>
                                      <?php endif; ?>
                                    </div>
                                    <div class="swiper-navigation swiper-navigation-small">
                                      <div class="swiper-button-prev"></div>
                                      <div class="swiper-button-next"></div>
                                    </div>
                                  </div>
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
                                    <label for="card-select-<?php the_ID() ?>"><?php _e('เลือก','เลือก')?></label>
                                  </div>
                                </div>
    
                                <div class="card-body wdl-archive-card-body">
                                <?php
                                  $vendorType = get_field('VendorType');
                                  if ($vendorType):
                                  foreach ($vendorType as $type):
                                  $typeLink = get_term_link( $type->term_id);
                                  ?>
                                  <div class="wdl-archive-pretitle mb-2">
                                    <a href="<?php echo($typeLink) ?>" class="text-accent fw-normal"><?php echo $type->name ?></a>
                                  </div>
                                  <?php endforeach; endif; ?>
                  
                                  <h3 class="wdl-archive-title"><a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                  </a></h3>
    
                                  <div class="lineclamp-3 mb-2 text-sm"><?php echo(get_the_excerpt()); ?></div>
                                  
                                  <div class="text-red fw-semibold mb-2">เริ่มต้น <?php echo number_format(get_field('MinPrice')); ?> บาท</div>
                                </div>
    
                                <div class="card-footer">
                                  <a href="#" class="wdl-btn-cta wdl-form-general-direct" data-bs-toggle="modal" data-bs-target=".wdl-form-general-modal">ลงทะเบียนร่วมงาน</a>
                                  <a href="<?php the_permalink() ?>" class="wdl-btn-more">ดูรายละเอียด</a>
                                </div>
    
                              </div>
                            </div>
                            <?php
                          }
                        }
                        rewind_posts(); ?>
                      </div>
                      <div class="swiper-pagination"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <?php $post_query = new WP_Query(array(
            'post_type' => 'post',
            'orderby' => 'date',
            's' => $_GET['s'],
            'order' => 'DESC',
            'relevanssi'  => true,
          ));?>

          <?php if ($type === 'post' && $countPost > 0): ?>
            <div id="tab-post" class="tab-pane fade">
              <div class="container-xl overflow-hidden pb-4">
                <div class="row">
                  <div class="col">
                    <div class="wdl-archive wdl-archive-extended <?php echo esc_attr($atts['class']); ?>">
                      <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-3">
                        <?php
                        while ($post_query->have_posts()) {
                          $post_query->the_post();
                          if ($type === get_post_type()) {
                            ?>
                            <div class="col">
                              <div id="wdl-post-<?php the_ID(); ?>" class="card wdl-archive-card <?php echo esc_attr($atts['class_single']); ?> wdl-archive-card-blog">
                                <?php if (has_post_thumbnail(get_the_ID())): ?>
                                  <a class="card-img-top wdl-archive-card-img-top" href="<?php the_permalink(); ?>"><img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($post, 'medium_large')) ?>" width="100%"></a>
                                <?php endif; ?>
    
                                <div class="card-body wdl-archive-card-body">
                                  <h3 class="wdl-archive-title mb-1"><a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                  </a></h3>
                                  <!-- <div class="wdl-archive-date text-secondary text-sm mb-2"><date><?php // the_date(); ?></date></div> -->
                                  
                                  <?php
                                  $relatedVenue = get_field('RelatedVenue');                                  if ($relatedVenue):
                                    foreach ($relatedVenue as $venue):
                                      $venuePermalink = get_permalink($venue->ID);
                                      $venueTitle = get_the_title($venue->ID); ?>
                                      <p class="wdl-archive-location"><a href="<?php echo esc_html($venuePermalink) ?>">
                                          <?php echo esc_html($venueTitle); ?>
                                        </a></p>
                                    <?php endforeach; endif; ?>
                                </div>
    
                              </div>
                            </div>
                            <?php
                          }
                        }
                        rewind_posts(); ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </section>
  <?php include 'components/compare-bar.php' ?>
</main>

<?php include 'components/form-general.php' ?>
<?php include 'components/footer.php' ?>