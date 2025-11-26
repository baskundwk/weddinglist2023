<div id="wdl-post-<?php the_ID(); ?>" class="card swiper-slide wdl-archive-card <?php if (get_field('HotDeal')) {
    echo esc_html('wdl-archive-primary');
  } else {
    echo esc_html('wdl-archive-default');
  } ?>
  <?php if(isset($campaignModeEnabled) && isset($campaignRelated['WeddingFair']) && in_array(get_the_ID(), $campaignRelated['WeddingFair'])) {
    echo esc_html('wdl-campaign-card');
  };
  ?> wdl-archive-infinite-scroll-post" style="
  <?php if(isset($campaignModeEnabled) && isset($campaignRelated['WeddingFair']) && in_array(get_the_ID(), $campaignRelated['WeddingFair'])) {
    echo esc_html('--campaign-color-1: '.$campaignColor1.'; --campaign-color-2: '.$campaignColor2.';');
  }?>">
  <?php if (has_post_thumbnail(get_the_ID())): ?>
    <a 
      aria-label="<?php echo esc_attr(get_the_title()); ?>"
      class="card-img-top wdl-archive-card-img-top"
      title="<?php echo get_the_title(); ?>" href="<?php the_permalink(); ?>"
      data-dlev="cardClick"
      data-dlcomp="card - wedding-fair"
      data-dltgt="<?php echo esc_attr(get_the_title()) ?>"
    >
      <img loading="lazy" src="<?php echo esc_html(wp_get_attachment_image_src(get_post_thumbnail_id(), 'w425')[0]) ?>" srcset="<?php echo esc_html(wp_get_attachment_image_src(get_post_thumbnail_id(), 'w425')[0]) ?> 1x,
            <?php echo esc_html(wp_get_attachment_image_src(get_post_thumbnail_id(), 'w425')[0]) ?> 2x" alt="<?php get_the_title() ?>">

      <?php if(isset($campaignModeEnabled) && isset($campaignRelated['WeddingFair']) && in_array(get_the_ID(), $campaignRelated['WeddingFair'])) {
        echo $campaignLogo;
      } ?>
      <div class="swiper-lazy-preloader"></div>
    </a>
  <?php endif; ?>

  <?php /* <div class="card-select wdl-checkbox">
    <input class="card-select-input" id="card-select-<?php the_ID() ?>" type="checkbox" data-select='
          {
            "title": "<?php the_title() ?>",
            "postType": "<?php echo get_post_type() ?>",
            "id": "<?php the_ID() ?>"
          }'>
    <label for="card-select-<?php the_ID() ?>">
      <?php _e('เลือก', 'wdl') ?>
    </label>
  </div> */ ?>

  <?php include get_stylesheet_directory() . '/components/card-action.php' ?>

  <div class="card-body wdl-archive-card-body">
    <div class="wdl-badge-container mb-1">
      <div class="wdl-archive-pretitle">
        <?php $weddingFairCategory = get_field('WeddingFairCategory');
        if ($weddingFairCategory) { ?>
          <span>
            <?php $count = 1;
            foreach ($weddingFairCategory as $item) {
              if ($count > 1) {
                echo ', ';
              }
              echo $item->name;
              $count = $count + 1;
            } ?>
          </span>
        <?php } ?>
        <?php
        $date = get_field('DateStart');
        if ($date): ?>
          <span class="badge wdl-badge-sm-subtle">
            <?php
            if (get_field('DateStart')) {
              echo promotionDate(get_field('DateStart'), 'DateStart');
            }
            if (get_field('DateEnd')) {
              echo promotionDate(get_field('DateEnd'), 'DateEnd');
            }
            ?>
          </span>
        <?php endif; ?>
        <?php $hotDeal = get_field('HotDeal');
        if ($hotDeal && in_array('Hot Deal', $hotDeal)): ?>
          <span class="badge wdl-badge-sm">Hot Deal</span>
        <?php endif; ?>
      </div>
    </div>
    <h3 class="wdl-archive-title">
      <a
        href="<?php echo esc_attr(get_the_permalink()); ?>"
        title="<?php echo esc_attr(get_the_title()) ?>"
        data-label="<?php echo esc_attr(get_the_title()) ?>"
        data-dlev="cardClick"
        data-dlcomp="card - wedding-fair"
        data-dltgt="<?php echo esc_attr(get_the_title()) ?>"
      >
        <?php the_title(); ?>
      </a>
    </h3>

    <?php
    $relatedVenue = get_field('RelatedVenue');
    if ($relatedVenue):
      foreach ($relatedVenue as $venue):
        $venuePermalink = get_the_permalink($venue->ID);
        $venueTitle = get_the_title($venue->ID); ?>
        <p class="wdl-archive-location">
          <a class="lineclamp-1" href="<?php echo esc_attr($venuePermalink) ?>"
            data-dlev="cardClick"
            data-dlcomp="card - wedding-fair"
            data-dltgt="<?php echo esc_attr(get_the_title()).' - '.esc_attr($venueTitle) ?>">
            <?php echo esc_html($venueTitle); ?>
          </a>
        </p>
      <?php endforeach;
    endif; ?>

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
      <a class="d-flex flex-wrap gap-2 align-items-stretch my-2" href="<?php echo esc_attr(get_the_permalink()); ?>"
        data-dlev="cardClick"
        data-dlcomp="card - wedding-fair"
        data-dltgt="<?php echo esc_attr(get_the_title()) ?>"
      >
        <?php foreach ($coupon as $singleCoupon): ?>
          <div class="wdl-coupon-picker wdl-coupon-picker-small">
            <div class="wdl-coupon-picker-image">
              <img loading="lazy" src="<?php echo (get_field('Image', $singleCoupon->ID)['sizes']['medium']) ?>" alt="<?php echo get_the_title(); ?>" />
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
      <a href="<?php echo esc_attr(get_the_permalink()).'#apply'?>" class="wdl-btn-cta wdl-form-general-direct"><?php _e('ลงทะเบียนร่วมงาน', 'wdl')?></a>
      <a href="<?php echo esc_attr(get_the_permalink()) ?>" class="wdl-btn-more"
        data-dlev="cardClick"
        data-dlcomp="card - wedding-fair"
        data-dltgt="<?php echo esc_attr(get_the_title()) ?>"
      ><?php _e('ดูรายละเอียด', 'wdl') ?></a>
    </div>
  <?php endif; ?>
</div>