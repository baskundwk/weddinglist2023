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

  <div class="card-body wdl-archive-card-body">
    <div class="wdl-badge-container mb-1">
      <?php $promotionCategory = get_field('PromotionCategory');
      if ($promotionCategory) { ?>
        <div class="wdl-archive-pretitle mb-0">
          <?php $count = 1;
          foreach ($promotionCategory as $item) {
            if ($count > 1) {
              echo ', ';
            }
            echo $item->name;
            $count = $count + 1;
          } ?>
        </div>
      <?php } ?>
      <?php
      if (get_field('DateStart') && get_field('DateEnd')): ?>
        <span class="badge wdl-badge-sm-subtle">
          <?php
          echo promotionDate(get_field('DateStart'), 'DateStart');
          echo promotionDate(get_field('DateEnd'), 'DateEnd');
          ?>
        </span>
      <?php endif; ?>
      <?php $hotDeal = get_field('HotDeal');
      if ($hotDeal && in_array('Hot Deal', $hotDeal)): ?>
        <span class="badge wdl-badge-sm">Hot Deal</span>
      <?php endif; ?>
    </div>
    <h3 class="wdl-archive-title mb-0">
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

    <?php
    $relatedVenue = get_field('RelatedVenue');
    if ($relatedVenue):
      foreach ($relatedVenue as $venue):
        $venuePermalink = get_the_permalink($venue->ID);
        $venueTitle = get_the_title($venue->ID); ?>
        <p class="wdl-archive-location lineclamp-1">
          <a href="<?php echo esc_attr($venuePermalink) ?>"
            data-dlev="cardClick"
            data-dlcomp="card - promotion - venue"
            data-dltgt="<?php echo esc_attr($venueTitle) ?>">
            <?php echo esc_html($venueTitle); ?>
          </a>
        </p>
      <?php endforeach; endif; ?>

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
        class="d-flex flex-wrap gap-2 align-items-stretch"
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
  </div>

  <div class="card-footer">
    <a href="<?php echo get_the_permalink().'#apply'?>" class="wdl-btn-cta wdl-form-general-direct"><?php _e('สนใจรับโปรโมชั่น', 'wdl')?></a>
    <a 
      href="<?php the_permalink() ?>"
      class="wdl-btn-more"
      data-dlev="cardClick"
      data-dlcomp="card - promotion"
      data-dltgt="<?php esc_attr(get_the_title()) ?>"
    ><?php _e('ดูรายละเอียด', 'wdl') ?></a>
  </div>
</div>