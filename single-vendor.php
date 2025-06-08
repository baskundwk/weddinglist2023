<?php include get_stylesheet_directory() . '/components/header.php' ?>
<main class="<?php if(isset($campaignModeEnabled) && isset($campaignRelated['Vendor']) && in_array(get_the_ID(), $campaignRelated['Vendor'])) {
    echo esc_html('wdl-campaign-single');
  };
?>" style="
<?php if(isset($campaignModeEnabled) && isset($campaignRelated['Vendor']) && in_array(get_the_ID(), $campaignRelated['Vendor'])) {
  echo esc_html('--campaign-color-1: '.$campaignColor1.'; --campaign-color-2: '.$campaignColor2.';');
}?>">
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
      <div class="row align-items-center g-3">
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
        <?php $sponsored = get_field('Sponsor', $relatedPost->ID); ?>
        <div class="col-12 d-flex flex-row gap-2 col-lg-3 text-center text-lg-end mb-2 mb-sm-0">
          <a href="#apply" data-bs-target="#apply" data-bs-toggle="modal" class="flex-fill wdl-btn"
            data-dlev="buttonClick"
            data-dlcomp="button - vendor - cta"
            data-dltgt="<?php the_title() ?>">
            <?php _e('คลิกขอแพ็กเกจ', 'wdl'); ?>
          </a>

          <a class="wdl-btn-line d-inline-flex d-lg-none" href="https://line.me/R/oaMessage/%40ety4154i/?<?php _e('สวัสดี%20ต้องการขอแพ็กเกจ%20','wdl')?><?php the_title(); ?>%0A<?php the_permalink(); ?>"
            data-dlev="buttonClick"
            data-dlcomp="button - vendor - line"
            data-dltgt="<?php the_title() ?>">
            <!-- <?php _e('ติดต่อแอดมินผ่าน LINE', 'wdl'); ?> -->
          </a>
          <a class="wdl-btn-line d-none d-lg-inline-flex" href="https://line.me/R/ti/p/%40ety4154i"
            data-dlev="buttonClick"
            data-dlcomp="button - vendor - line"
            data-dltgt="<?php the_title() ?>">
            <!-- <?php _e('ติดต่อแอดมินผ่าน LINE', 'wdl'); ?> -->
          </a>

          <a class="wdl-btn-tertiary" href="tel:+66-88-989-8411" aria-label="โทรติดต่อแอดมิน"><i width="16" data-feather="phone"
            data-dlev="buttonClick"
            data-dlcomp="button - vendor - tel"
            data-dltgt="<?php the_title() ?>"></i></a>
        </div>

      </div>
    </div>
  </section>
  <section class="wdl-main-bar mb-3">
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
            <a href="#brochure" data-bs-toggle="modal" class="wdl-link-brochure"
            data-dlev="linkClick"
            data-dlcomp="link - vendor - brochure"
            data-dltgt="<?php the_title() ?>"><?php _e('ดูโบรชัวร์โรงแรม', 'wdl') ?></a>
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
					$vendorTypes = get_field('VendorType');
					$vendorCharacter = get_field('Character');
					if ($vendorCharacter || $vendorTypes): ?>
          <p class="mb-0 d-flex gap-3">
            <?php if ($vendorTypes): ?>
            <?php foreach ($vendorTypes as $vendorType): ?>
            <span class="text-accent">
              <?php echo esc_html($vendorType->name); ?>
            </span>
            <?php endforeach; ?>
            <?php endif ?>
            <?php if ($vendorCharacter): ?>
            <?php //foreach ($vendorCharacter as $character):
												$characterBackground = get_field('CharacterBackground', $vendorCharacter);
												$characterBorder = get_field('CharacterBorder', $vendorCharacter);
												$characterColor = get_field('CharacterColor', $vendorCharacter);
												$characterEffect = get_field('CharacterEffect', $vendorCharacter);
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
              <?php echo esc_html($vendorCharacter->name); ?>
            </span>
          </div>
          <?php //endforeach;  ?>
          <?php endif ?>
          </p>
          <?php endif ?>
          <h1 class="wdl-single-title">
            <?php the_title(); ?>
          </h1>

          <?php
					$relatedVenue = get_field('RelatedVenue');
					$relatedVenuePermalink = get_the_permalink($relatedVenue);
					$relatedVenueTitle = get_the_title($relatedVenue);
					if ($relatedVenue): ?>
          <p class="wdl-archive-location mb-0"><a href="<?php echo esc_html($relatedVenuePermalink) ?>">
              <?php echo esc_html($relatedVenueTitle); ?> ">
            </a></p>
          <?php endif; ?>

          <?php
					$address2 = get_field('Address2');
					$googleMaps = get_field('GoogleMaps');
					if ($address2): ?>
          <p class="wdl-metadata wdl-archive-pin mb-0">
            <span>
              <?php the_field('Address2') ?>
              &nbsp;
              <?php if ($googleMaps): ?>
              <strong>
                <a href="<?php echo esc_url(the_field('GoogleMaps')) ?>" target="_blank" class="wdl-link-external"
                data-dlev="linkClick"
                data-dlcomp="link - vendor - map"
                data-dltgt="<?php the_title() ?>">
                  <?php _e('ดูแผนที่', 'wdl') ?>
                </a>
              </strong>
              <?php endif; ?>
            </span>
          </p>
          <?php endif; ?>

          <?php
					if (get_field('Facebook') && get_field('FacebookLink')): ?>
          <p class="wdl-metadata wdl-archive-facebook mb-0">
            <a href="<?php echo get_field('FacebookLink') ?>" target="_blank"
            data-dlev="linkClick"
            data-dlcomp="link - vendor - facebook"
            data-dltgt="<?php the_title() ?>">
              <?php echo get_field('Facebook') ?>
            </a>
          </p>
          <?php endif; ?>

          <?php
					if (get_field('Instagram') && get_field('InstagramLink')): ?>
          <p class="wdl-metadata wdl-archive-instagram mb-0">
            <a href="<?php echo get_field('InstagramLink') ?>" target="_blank"
            data-dlev="linkClick"
            data-dlcomp="link - vendor - instagram"
            data-dltgt="<?php the_title() ?>">
              <?php echo get_field('Instagram') ?>
            </a>
          </p>
          <?php endif; ?>
        </div>
        <div class="col-lg-auto text-center py-3 d-flex flex-column">
          <a id="apply-cta" href="#apply" class="wdl-btn-lg d-block mb-3" data-bs-toggle="modal"
            data-dlev="buttonClick"
            data-dlcomp="button - vendor - cta"
            data-dltgt="<?php the_title() ?>">
            <?php _e('คลิกขอแพ็กเกจ', 'wdl'); ?>
          </a>
          <a class="wdl-btn-line-lg d-flex d-lg-none" href="https://line.me/R/oaMessage/%40ety4154i/?สวัสดี%20ต้องการขอแพ็กเกจ%20<?php the_title(); ?>%0A<?php the_permalink(); ?>"
            data-dlev="buttonClick"
            data-dlcomp="button - vendor - line"
            data-dltgt="<?php the_title() ?>">
            <?php _e('ติดต่อแอดมินผ่าน LINE', 'wdl'); ?>
          </a>
          <a class="wdl-btn-line-lg d-none d-lg-inline-flex" href="https://line.me/R/ti/p/%40ety4154i"
            data-dlev="buttonClick"
            data-dlcomp="button - vendor - line"
            data-dltgt="<?php the_title() ?>">
            <?php _e('ติดต่อแอดมินผ่าน LINE', 'wdl'); ?>
          </a>

          <a class="mt-3 wdl-btn-tertiary-lg" href="tel:+66-88-989-8411"
            data-dlev="buttonClick"
            data-dlcomp="button - vendor - tel"
            data-dltgt="<?php the_title() ?>"><i width="20" data-feather="phone"></i> <?php _e('โทรติดต่อแอดมิน','wdl')?></a>
        </div>
      </div>
    </div>
  </section>
  <?php include get_stylesheet_directory() . '/components/campaign-bar.php' ?>
  <?php
	$coupon = get_posts(
		array(
			'posts_per_page' => -1,
			'post_type' => 'coupon',
			'meta_query' => array(
				array(
					'key' => 'Vendor',
					'value' => '"' . get_the_ID() . '"',
					'compare' => 'LIKE'
				)
			)
		)
	);

	if ($coupon): ?>
  <section class="py-3">
    <div class="container-xl">
      <h2 class="h6 mb-1"><?php _e('คูปองที่ร่วมรายการ', 'wdl') ?></h2>
      <div class="d-flex flex-wrap gap-3 my-2 align-items-stretch">
        <?php foreach ($coupon as $singleCoupon):
							?>
        <?php include get_stylesheet_directory() . '/components/cards/card-coupon.php' ?>
        <?php
						endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>
  <?php if(!in_array(('Free microsite'), get_field('Status')) && have_rows('Album')): ?>
    <section class="py-3">
      <div class="container-xl">
        <div class="wdl-archive py-4">
          <!-- <h2 class="h1 mb-4">
            <?php _e('อัลบั้ม', 'wdl') ?>
          </h2> -->
          <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 g-5">
            <?php
              $albumIndex = 0;
              $album = [];
              while(have_rows('Album')):
                $albumIndex++;
                the_row(); 
                $album[$albumIndex]['index'] = $albumIndex;
                $album[$albumIndex]['title'] = get_sub_field('AlbumTitle');
                $album[$albumIndex]['desc'] = get_sub_field('AlbumDesc');
                $album[$albumIndex]['image'] = get_sub_field('AlbumImage')[0]['sizes']['medium_large'];
              endwhile;
  
              foreach($album as $alb) :
              ?>
              <div class="col">
                <a class="p-0" href="#album-<?php echo $alb['index'];?>">
                  <div class="card-img-top wdl-archive-card-img-top ratio ratio-1x1"><img class="object-fit-cover" src="<?php echo $alb['image']; ?>" alt="<?php echo $alb['title'] ?>"></div>
                  <div class="card-body pt-2">
                    <div class="mb-0 lineclamp-1"><?php echo $alb['title']; ?></div>
                    <?php if(isset($alb['desc'])) : ?>
                      <p class="text-xs mb-0 text-secondary lineclamp-1"><?php echo $alb['desc']; ?></p>
                    <?php endif; ?>
                  </div>
                </a>
              </div>
              <?php endforeach; ?>
          </div>
          
          <hr>
          <?php 
            $albumIndex = 0;
            while(have_rows('Album')):
            $albumIndex++;
            the_row(); ?>
            <?php $albumImages = get_sub_field('AlbumImage') ?>
            <?php if($albumImages) :?>
            <div id="album-<?php echo $albumIndex;?>" class="wdl-vendor-album-group mt-4">
              <div class="row">
                <div class="col-md-3">
                  <h3><?php the_sub_field('AlbumTitle'); ?></h3>
                  <p><?php the_sub_field('AlbumDesc'); ?></p>
                </div>
                <div class="col">
                  <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-3">
                    <?php foreach($albumImages as $image) :?>
                      <div class="col">
                        <div class="wdl-vendor-album-image ratio ratio-1x1 border border-1"><img class="object-fit-cover" src="<?php echo $image['url'] ?>" alt="<?php the_sub_field('AlbumTitle'); ?>"></div>
                      </div>
                    <?php endforeach;?>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <?php endif; ?>
  
          <?php endwhile; ?>
  
          
        </div>
        <?php endif; ?>
        <?php if(!in_array(('Free microsite'), get_field('Status')) && have_rows('Pricing')): ?>
        <div class="wdl-archive py-4">
          <h2>
            <?php _e('ข้อมูลค่าใช้จ่าย', 'wdl') ?>
          </h2>
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
              <?php while (have_rows('Pricing')):
                    the_row();
                $pricings[] = [
                  'name' => get_sub_field('PricingName'),
                  'desc' => get_sub_field('PricingDescription'),
                  'price' => get_sub_field('PricingStart'),
                ];
              ?>
              <div class="col">
                <div class="card wdl-archive-card h-100">
                  <?php if (get_sub_field('PricingName')): ?>
                  <?php
                              $pricingImages = get_sub_field('PricingGallery');
                              if ($pricingImages):
                                ?>
                  <div class="card-img-top wdl-archive-card-img-top">
                    <div id="hero-gallery" class="swiper wdl-archive-pricing-gallery-swiper">
                      <div class="swiper-wrapper">
                        <?php
                          // Grab each image.
                          foreach ($pricingImages as $image):
                            $image_id = $image['ID'];
                            $image_src = $image['ursl'];
                            $image_caption = $image['caption'];
                          ?>
                        <div class="swiper-slide">
                          <?php echo wp_get_attachment_image($image_id, 'w425'); ?>
                        </div>
                        <?php
                                        endforeach;
                                        ?>
                      </div>
                      <div class="swiper-navigation swiper-navigation-small">
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                      </div>
                    </div>
                  </div>
                  <?php endif; ?>
                  <div class="card-body">
                    <?php $pricingName = get_sub_field('PricingName'); ?>
                    <h3 class="h5"><?php echo esc_html(get_sub_field('PricingName')); ?></h3>
                    <p class="text-sm"><?php echo esc_html(get_sub_field('PricingDescription')); ?></p>
                    <p class="text-sm text-accent fw-semibold"><?php _e('ราคา', 'wdl') ?> : <?php echo esc_html(number_format(get_sub_field('PricingStart'))) ?> <?php if (get_sub_field('PricingEnd')) { ?> - <?php echo esc_html(number_format(get_sub_field('PricingEnd')));
                                                    } ?></p>
                  </div>
                  <?php endif; ?>
                </div>
              </div>
              <?php endwhile; ?>
          </div>
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
					'key' => 'RelatedVendor',
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
					'key' => 'RelatedVendor',
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
			'post_status' => 'publish',
			'meta_query' => array(
				array(
					'key' => 'RelatedVendor',
					'value' => '"' . get_the_ID() . '"',
					'compare' => 'LIKE'
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
          <a role="tab" aria-control="tab-promotion" data-bs-toggle="tab" data-bs-target="#tab-promotion" class="nav-link" aria-current="tab" href="#"><i class="wdl-tab-icon" data-feather="tag"></i> <?php _e('โปรโมชั่น', 'wdl')?></a>
        </li>
        <?php endif; ?>
        <?php if ($relatedWeddingFairs): ?>
        <li class="nav-item">
          <a role="tab" aria-control="tab-wedding-fair" data-bs-toggle="tab" data-bs-target="#tab-wedding-fair" class="nav-link" href="#"><i class="wdl-tab-icon" data-feather="calendar"></i> <?php _e('Wedding Fair & Event', 'wdl')?></a>
        </li>
        <?php endif; ?>
        <?php if ($relatedPosts): ?>
        <li class="nav-item">
          <a role="tab" aria-control="tab-post" data-bs-toggle="tab" data-bs-target="#tab-post" class="nav-link" href="#"><i class="wdl-tab-icon" data-feather="bookmark"></i> <?php _e('บทความ', 'wdl')?></a>
        </li>
        <?php endif; ?>
      </ul>
      <div class="tab-content wdl-tab-related-content">
        <?php if ($relatedPromotions): ?>
        <div id="tab-promotion" class="tab-pane fade">
          <div class="row align-items-center">
            <div class="col-12">
              <div class="wdl-archive <?php echo esc_attr($atts['class']); ?>">
                <div id="promotion-swiper" class="swiper wdl-archive-swiper pb-0">
                  <div class="swiper-wrapper">
                    <?php foreach ($relatedPromotions as $relatedPromotion): ?>
                    <div id="wdl-post-<?php echo $relatedPromotion->ID ?>" class="swiper-slide card wdl-archive-card <?php echo esc_attr($atts['class_single']); ?>">

                      <a class="card-img-top wdl-archive-card-img-top" href="<?php echo get_the_permalink($relatedPromotion->ID); ?>">
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
                          <a href="<?php echo get_the_permalink($relatedPromotion->ID); ?>">
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
                <div class="swiper wdl-archive-swiper pb-0">
                  <div class="swiper-wrapper">
                    <?php foreach ($relatedWeddingFairs as $relatedWeddingFair): ?>
                    <div id="wdl-post-<?php echo $relatedWeddingFair->ID ?>" class="swiper-slide card wdl-archive-card <?php echo esc_attr($atts['class_single']); ?>">

                      <?php if (has_post_thumbnail($relatedWeddingFair->ID)): ?>
                      <a class="card-img-top wdl-archive-card-img-top" href="<?php echo get_the_permalink($relatedWeddingFair->ID); ?>"><img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($relatedWeddingFair, 'medium_large')) ?>" width="100%"></a>
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
                          <span class="badge wdl-badge-sm"><?php _e('Hot Deal', 'wdl')?></span>
                          <?php endif; ?>
                        </div>

                        <h3 class="wdl-archive-title mb-0"><a href="<?php echo get_the_permalink($relatedWeddingFair->ID); ?>">
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
                <div class="swiper wdl-archive-swiper pb-0">
                  <div class="swiper-wrapper">
                    <?php foreach ($relatedPosts as $relatedPost): ?>
                    <div id="wdl-post-<?php echo $relatedPost->ID ?>" class="swiper-slide card wdl-archive-card <?php echo esc_attr($atts['class_single']); ?>">

                      <?php if (has_post_thumbnail($relatedPost->ID)): ?>
                      <a class="card-img-top wdl-archive-card-img-top" href="<?php echo get_the_permalink($relatedPost->ID); ?>"><img loading="lazy" class="" src="<?php echo esc_html(get_the_post_thumbnail_url($relatedPost, 'medium_large')) ?>" width="100%"></a>
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

                        <h3 class="wdl-archive-title mb-0"><a href="<?php echo get_the_permalink($relatedPost->ID); ?>">
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

  <?php if (get_the_excerpt() != '' && is_user_logged_in()): ?>
  <section class="pb-3">
    <div class="container-xl">
      <div class="alert alert-secondary">
        <p class="mb-0"><?php echo (get_the_excerpt()); ?></p>
      </div>
    </div>
  </section>
  <?php endif; ?>
  <?php $pricings = [];?>
  <section class="py-3">
    <div class="container-xl">
      <div class="row">
        <div class="col text-secondary">
          <?php the_content(); ?>
        </div>
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
</main>

<?php include get_stylesheet_directory() . '/components/form-lead.php' ?>
<?php include get_stylesheet_directory() . '/components/footer.php' ?>