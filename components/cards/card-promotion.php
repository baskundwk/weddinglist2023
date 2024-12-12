<div id="wdl-post-<?php the_ID(); ?>" class="card swiper-slide wdl-archive-card <?php if (get_field('HotDeal')) {
    echo esc_html('wdl-archive-primary');
  } else {
    echo esc_html('wdl-archive-default');
  } ?> wdl-archive-infinite-scroll-post">
  <?php if (has_post_thumbnail(get_the_ID())): ?>
    <?php $promotionCategory = get_field('PromotionCategory');
    if ($promotionCategory) { ?>
      <div class="wdl-archive-pretitle">
        <?php echo implode(' / ', array_map(function ($promotionCategory) {
          return $promotionCategory->name;
        }, $promotionCategory)); ?>
      </div>
    <?php } ?>
    <a aria-label="<?php echo get_the_title(); ?>" class="card-img-top wdl-archive-card-img-top" title="<?php echo get_the_title(); ?>" href="<?php the_permalink(); ?>">
      <img loading="lazy" src="<?php echo esc_html(wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large')[0]) ?>" srcset="<?php echo esc_html(wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large')[0]) ?> 1x,
                            <?php echo esc_html(wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large')[0]) ?> 2x" alt="<?php get_the_title() ?>">
      <div class="swiper-lazy-preloader"></div>
    </a>
  <?php endif; ?>

  <div class="card-select wdl-checkbox">
    <input class="card-select-input" id="card-select-<?php the_ID() ?>" type="checkbox" data-select='
    {
      "title": "<?php the_title() ?>",
      "postType": "<?php echo get_post_type() ?>",
      "id": "<?php the_ID() ?>"
    }'>
    <label for="card-select-<?php the_ID() ?>">
      <?php _e('เลือก', 'wdl') ?>
    </label>
  </div>

  <div class="card-body wdl-archive-card-body">
    <div class="wdl-badge-container mb-1">

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

    <div class="wdl-archive-pretitle mb-0">
      <?php $promotionCategory = wp_get_post_terms(get_the_ID(), 'promotion-category');
      if ($promotionCategory) {
        $count = 1;
        foreach ($promotionCategory as $item) {
          if ($count > 1) {
            echo ', ';
          }
          echo $item->name;
          $count = $count + 1;
        }
      }
      ?>
    </div>

    <h3 class="wdl-archive-title mb-0">
      <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title() ?>" data-label="<?php echo get_the_title() ?>">
        <?php the_title(); ?>
      </a>
    </h3>

    <?php
    $relatedVenue = get_field('RelatedVenue');
    if ($relatedVenue):
      foreach ($relatedVenue as $venue):
        $venuePermalink = get_permalink($venue->ID);
        $venueTitle = get_the_title($venue->ID); ?>
        <p class="wdl-archive-location">
          <a href="<?php echo esc_html($venuePermalink) ?>">
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
      <a class="d-flex flex-wrap gap-2 align-items-stretch" href="<?php the_permalink(); ?>">
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

  <div class="card-footer">
    <a href="#" class="wdl-btn-cta wdl-form-general-direct" data-bs-toggle="modal" data-bs-target=".wdl-form-general-modal">สนใจรับโปรโมชั่น</a>
    <a href="<?php the_permalink() ?>" class="wdl-btn-more"><?php _e('ดูรายละเอียด', 'wdl') ?></a>
  </div>
</div>