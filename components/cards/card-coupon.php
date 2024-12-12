<div class="wdl-coupon-picker wdl-coupon-proxy">
  <div class="wdl-coupon-picker-image">
    <img src="<?php echo (get_field('Image', $singleCoupon->ID)['sizes']['medium']) ?>" />
  </div>
  <div class="wdl-coupon-picker-info">
    <div class="wdl-coupon-picker-title">
      <?php echo (get_the_title($singleCoupon->ID)) ?>
    </div>
    <div class="d-flex flex-wrap justify-content-between align-items-center">
      <div class="wdl-coupon-picker-action">
        เก็บคูปอง
      </div>
      <div class="wdl-coupon-picker-term">
        <a class="wdl-coupon-popup-link" href="<?php echo (get_the_permalink($singleCoupon->ID)) ?>?popup=true" target="blank">เงื่อนไข</a>
      </div>
    </div>
  </div>
</div>