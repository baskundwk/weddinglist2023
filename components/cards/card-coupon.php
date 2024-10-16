<div class="wdl-coupon-picker">
  <a href="#apply" data-bs-toggle="modal" class="wdl-coupon-picker-image">
    <img src="<?php echo (get_field('Image', $singleCoupon->ID)['sizes']['medium']) ?>" />
  </a>
  <div class="wdl-coupon-picker-info">
    <div class="wdl-coupon-picker-title">
      <a href="#apply" data-bs-toggle="modal">
        <?php echo (get_the_title($singleCoupon->ID)) ?>
      </a>
    </div>
    <div class="d-flex flex-wrap justify-content-between align-items-center">
      <div class="wdl-coupon-picker-action">
        <a href="#apply" data-bs-toggle="modal">เก็บคูปอง</a>
      </div>
      <div class="wdl-coupon-picker-term">
        <a class="wdl-coupon-popup-link" href="<?php echo (get_the_permalink($singleCoupon->ID)) ?>?popup=true" target="blank">เงื่อนไข</a>
      </div>
    </div>
  </div>
</div>