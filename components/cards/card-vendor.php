<div id="wdl-post-<?php the_ID(); ?>"
  class="swiper-slide card wdl-archive-card 
  <?php if (isset($campaignModeEnabled) && isset($campaignRelated['Vendor']) && in_array(get_the_ID(), $campaignRelated['Vendor'])) {
    echo esc_html('wdl-campaign-card');
  };
  ?> wdl-archive-infinite-scroll-post"
  style="
  <?php if (isset($campaignModeEnabled) && isset($campaignRelated['Vendor']) && in_array(get_the_ID(), $campaignRelated['Vendor'])) {
    echo esc_html('--campaign-color-1: ' . $campaignColor1 . '; --campaign-color-2: ' . $campaignColor2 . ';');
  } ?>">
  <?php if (has_post_thumbnail(get_the_ID())): ?>
    <a aria-label="<?php echo esc_attr(get_the_title()); ?>"
      title="<?php echo esc_attr(get_the_title()); ?>"
      class="card-img-top wdl-archive-card-img-top"
      href="<?php echo esc_attr(the_permalink()); ?>"
      data-dlev="cardClick"
      data-dlcomp="card - vendor"
      data-dltgt="<?php echo esc_attr(get_the_title()) ?>">
      <img loading="lazy"
        src="<?php echo esc_attr(get_the_post_thumbnail_url($post, 'w425')) ?>"
        alt="<?php echo esc_attr(get_the_title()) ?>">

      <?php if (isset($campaignModeEnabled) && isset($campaignRelated['Vendor']) && in_array(get_the_ID(), $campaignRelated['Vendor'])) {
        echo $campaignLogo;
      } ?>

      <?php $status = get_field('Status');
      if ($status && in_array('Sponsored', $status)): ?>
        <span class="badge wdl-badge-sm">Most Popular</span>
      <?php endif; ?>

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

    <div class="wdl-archive-pretitle">
      <span class="lineclamp-1">
        <?php $vendorType = get_field('VendorType');
        if ($vendorType) {
          $vendorTypeIndex = 0;
          foreach ($vendorType as $item) {
            $vendorTypeIndex++;
            if ($vendorTypeIndex > 1) {
              echo ' / ' . $item->name;
            } else {
              echo $item->name;
            }
          }
        }
        ?>
      </span>
      <span class="lineclamp-1">
        <?php $vendorCharacter = get_field('Character');
        if ($vendorCharacter): ?>
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
            <span><?php echo esc_html($vendorCharacter->name); ?></span>
          </div>
          <?php //endforeach; 
          ?>
        <?php endif ?>
      </span>
    </div>

    <h3 class="wdl-archive-title mb-1">
      <a href="<?php echo esc_attr(get_the_permalink()); ?>"
        title="<?php echo esc_attr(get_the_title()) ?>"
        data-label="<?php echo esc_attr(get_the_title()) ?>"
        data-dlev="cardClick"
        data-dlcomp="card - vendor"
        data-dltgt="<?php echo esc_attr(get_the_title()) ?>">
        <?php the_title(); ?>
      </a>
    </h3>
    <?php
    $locations = get_field('Location');
    if ($locations): ?>
      <div class="wdl-archive-neighborhood wdl-metadata">
        <span class="lineclamp-1">
          <?php
          echo implode(' / ', array_map(function ($location) {
            return $location->name;
          }, $locations));
          ?>
        </span>
      </div>
    <?php endif; ?>
    <?php /*  <p class="lineclamp-3 mb-0 text-sm text-secondary">
 <?php echo (get_the_excerpt()); ?>
</p> 
<hr class="my-2"> */ ?>

    <?php if (get_field('MinPrice')): ?>
      <div class="text-red fw-semibold mb-2"><?php _e('เริ่มต้น', 'wdl') ?>
        <?php echo number_format(get_field('MinPrice')); ?> <?php _e('บาท', 'wdl') ?>
      </div>
    <?php endif; ?>

    <?php $coupon = get_posts(
      array(
        'posts_per_page' => 1,
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
      <a class="d-flex flex-wrap gap-2 align-items-stretch my-2"
        href="<?php echo esc_attr(the_permalink()); ?>"
        data-dlev="cardClick"
        data-dlcomp="card - vendor"
        data-dltgt="<?php echo esc_attr(get_the_title()) ?>">
        <?php foreach ($coupon as $singleCoupon): ?>
          <div class="wdl-coupon-picker wdl-coupon-picker-small">
            <div class="wdl-coupon-picker-image">
              <img loading="lazy"
                src="<?php echo (get_field('Image', $singleCoupon->ID)['sizes']['medium']) ?>"
                alt="<?php echo esc_attr(get_the_title()); ?>" />
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
      <a href="<?php echo esc_attr(get_the_permalink()) . '#apply' ?>"
        class="wdl-btn-cta wdl-form-general-direct"><?php _e('คลิกขอแพ็กเกจ', 'wdl') ?></a>
      <a href="<?php echo esc_attr(the_permalink()) ?>"
        class="wdl-btn-more"
        data-dlev="cardClick"
        data-dlcomp="card - vendor"
        data-dltgt="<?php echo esc_attr(get_the_title()) ?>"><?php _e('ดูรายละเอียด', 'wdl') ?></a>
    </div>
  <?php endif; ?>
</div>