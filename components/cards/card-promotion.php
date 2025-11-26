<div id="wdl-post-<?php the_ID(); ?>" class="card swiper-slide wdl-archive-card <?php if (get_field('HotDeal')) {
    echo esc_html('wdl-archive-primary');
  } else {
    echo esc_html('wdl-archive-default');
  }; ?>
  <?php if(isset($campaignModeEnabled) && isset($campaignRelated['Promotion']) && in_array(get_the_ID(), $campaignRelated['Promotion'])) {
    echo esc_html('wdl-campaign-card');
  };
  ?> wdl-archive-infinite-scroll-post" style="
  <?php if(isset($campaignModeEnabled) && isset($campaignRelated['Promotion']) && in_array(get_the_ID(), $campaignRelated['Promotion'])) {
    echo esc_html('--campaign-color-1: '.$campaignColor1.'; --campaign-color-2: '.$campaignColor2.';');
  }?>">
  <?php if (has_post_thumbnail(get_the_ID())): ?>
    <a
    data-dlev="cardClick"
    data-dlcomp="card - promotion"
    data-dltgt="<?php the_title() ?>"
    aria-label="<?php echo esc_attr(get_the_title()); ?>" class="card-img-top wdl-archive-card-img-top" title="<?php echo esc_attr(get_the_title()); ?>" href="<?php echo esc_attr(get_the_permalink()); ?>">
      <img loading="lazy" src="<?php echo esc_attr(wp_get_attachment_image_src(get_post_thumbnail_id(), 'w425')[0]) ?>" srcset="<?php echo esc_attr(wp_get_attachment_image_src(get_post_thumbnail_id(), 'w425')[0]) ?> 1x,
                            <?php echo esc_attr(wp_get_attachment_image_src(get_post_thumbnail_id(), 'w425')[0]) ?> 2x" alt="<?php echo esc_attr(get_the_title()) ?>">

      <?php if(isset($campaignModeEnabled) && isset($campaignRelated['Promotion']) && in_array(get_the_ID(), $campaignRelated['Promotion'])) {
        echo $campaignLogo;
      } ?>
      <div class="swiper-lazy-preloader"></div>
    </a>
  <?php endif; ?>

  <?php include get_stylesheet_directory() . '/components/card-action.php' ?>

  <div class="card-body wdl-archive-card-body">
    <div class="d-flex gap-2">
      <?php $promotionCategory = get_field('PromotionCategory');
      if ($promotionCategory || get_field('HotDeal')) { ?>
      <div class="wdl-archive-pretitle">
      <?php if ($promotionCategory) { ?>
          <span>
            <?php $count = 1;
            foreach ($promotionCategory as $item) {
              if ($count > 1) {
                echo ', ';
              }
              echo $item->name;
              $count = $count + 1;
            } ?>
          </span>
      <?php } ?>
      <?php $hotDeal = get_field('HotDeal');
      if ($hotDeal && in_array('Hot Deal', $hotDeal)): ?>
        <span class="badge wdl-badge-sm">Hot Deal</span>
      <?php endif; ?>
      </div>
      <?php } ?>
  
    </div>
    <h3 class="wdl-archive-title mt-1 mb-1">
      <a
      href="<?php the_permalink(); ?>"
      title="<?php echo esc_attr(get_the_title()) ?>"
      data-label="<?php echo esc_attr(get_the_title()) ?>"
      data-dlev="cardClick"
      data-dlcomp="card - promotion"
      data-dltgt="<?php esc_attr(get_the_title()) ?>">
        <?php the_title(); ?>
      </a>
    </h3>


    <div class="mb-2">
      <?php
      $relatedVenue = get_field('RelatedVenue');
      if ($relatedVenue):
        foreach ($relatedVenue as $venue):
          $venuePermalink = get_the_permalink($venue->ID);
          $venueTitle = get_the_title($venue->ID); ?>
          <p class="wdl-archive-location mb-0">
            <a class="lineclamp-1" href="<?php echo esc_attr($venuePermalink) ?>"
              data-dlev="cardClick"
              data-dlcomp="card - promotion - venue"
              data-dltgt="<?php echo esc_attr($venueTitle) ?>">
              <?php echo esc_html($venueTitle); ?>
            </a>
          </p>
        <?php endforeach; endif; ?>
  
      <?php
      if (get_field('DateStart') && get_field('DateEnd')): ?>
        <div class="wdl-badge-container mb-0">
          <div class="text-accent text-sm">
            <svg viewBox="0 0 24 24" width="1em" height="1em" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
          </div>
          <span class="badge wdl-badge-sm-subtle fw-normal">
            <?php
            echo promotionDate(get_field('DateStart'), 'DateStart');
            echo promotionDate(get_field('DateEnd'), 'DateEnd');
            ?>
          </span>
        </div>
      <?php endif; ?>
    </div>

    <?php $coupon = get_posts(
      array(
        'posts_per_page' => 1,
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
      <a 
        class="d-flex flex-wrap gap-2 align-items-stretch my-2"
        href="<?php echo esc_attr(the_permalink()); ?>"
        data-dlev="cardClick"
        data-dlcomp="card - promotion"
        data-dltgt="<?php echo esc_attr(get_the_title()) ?>"
      >
        <?php foreach ($coupon as $singleCoupon): ?>
          <div class="wdl-coupon-picker wdl-coupon-picker-small">
            <div class="wdl-coupon-picker-image">
              <img loading="lazy" src="<?php echo (get_field('Image', $singleCoupon->ID)['sizes']['medium']) ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
              <div class="swiper-lazy-preloader"></div>
            </div>
            <div class="wdl-coupon-picker-info">
              <div class="wdl-coupon-picker-title">
                <?php echo (get_the_title($singleCoupon->ID)) ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </a>
    <?php endif; ?>
    <?php $price = get_field('Price');
     if($price && $price != 0) { ?>
    <div class="debug">
      <hr class="my-2">
      <div class="text-end">
          เริ่มต้น <span class="text-red fw-semibold"><?php echo esc_html(number_format($price)); ?> บาท</span>
        </div>
      </div>
      <?php } ?>
  </div>

  <?php 
  if(isset($member_data) && get_field('OwnerMerchant') && in_array($member_data->ID, get_field('OwnerMerchant'))) : ?>
    <div class="card-footer px-2 pb-3 h-auto">
      <div div class="border-top text-red d-flex justify-content-center align-items-center w-100 m-0 pt-2 text-13 gap-1">
        <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" viewBox="0 0 256 256"><path d="M240,102c0,70-103.79,126.66-108.21,129a8,8,0,0,1-7.58,0C119.79,228.66,16,172,16,102A62.07,62.07,0,0,1,78,40c20.65,0,38.73,8.88,50,23.89C139.27,48.88,157.35,40,178,40A62.07,62.07,0,0,1,240,102Z"></path></svg>
        <?php if(get_field('WishlistedBy')) : ?>
          <span>ยอดในรายการโปรด <?php echo count(get_field('WishlistedBy')) ?> คน</span>
        <?php else : ?>
          <span>ยังไม่มียอดรายการโปรด</span>
        <?php endif; ?>
      </div>
    </div>
  <?php else : ?>
    <div class="card-footer">
      <a href="<?php echo get_the_permalink().'#apply'?>" class="wdl-btn-cta wdl-form-general-direct"><?php _e('สนใจแพ็กเกจ', 'wdl')?></a>
      <a 
        href="<?php the_permalink() ?>"
        class="wdl-btn-more"
        data-dlev="cardClick"
        data-dlcomp="card - promotion"
        data-dltgt="<?php esc_attr(get_the_title()) ?>"
      ><?php _e('ดูรายละเอียด', 'wdl') ?></a>
    </div>
  <?php endif; ?>
</div>