<?php 
  if(is_single( )) {
    $formType = get_post_type_object(get_post_type())->labels->singular_name;
  } else {
    $formType = 'General';
  }
?>

<div id="apply" class="wdl-form-general-modal modal fade html-lazy">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content m-1 mb-0">
      <button class="btn-close" data-bs-dismiss="modal" aria-label="Close modal"></button>
      <div class="modal-body p-3 p-lg-3">
        <h2><?php _e('กรุณากรอกข้อมูลเพื่อให้เซลล์ติดต่อกลับ', 'wdl') ?></h2>
        <hr class="mb-2">
        <?php if($formType === 'General') { ?>
          <ul class="wdl-form-general-list">
  
          </ul>
        <?php }?>
        <form id="wdl-form-general" class="wdl-form-general" action="" method="post" enctype="multipart/form-data">
          <div class="row g-2 g-lg-3">
            <div class="col-6">
              <div class="form-floating">
                <input class="form-control" name="name" id="name-lastname" type="text" placeholder="<?php _e('ชื่อ - นามสกุล*','wdl')?>" required />
                <label for="name-lastname"><?php _e('ชื่อ - นามสกุล*','wdl')?></label>
              </div>
            </div>
            <div class="col-6">
              <div class="form-floating">
                <input class="form-control" name="tel" id="tel" type="text" placeholder="<?php _e('เบอร์โทรติดต่อ*','wdl')?>" required />
                <label for="tel"><?php _e('เบอร์โทรติดต่อ*','wdl')?></label>
              </div>
            </div>
            <div class="col-6">
              <div class="form-floating">
                <input class="form-control" name="email" id="email" type="text" placeholder="<?php _e('E-mail*', 'wdl')?>" required />
                <label for="email"><?php _e('E-mail*', 'wdl')?></label>
              </div>
            </div>
            <div class="col-6">
              <div class="form-floating">
                <input class="form-control" name="lineid" id="lineid" type="text" placeholder="<?php _e('Line ID', 'wdl')?>" />
                <label for="lineid"><?php _e('Line ID', 'wdl')?></label>
              </div>
            </div>
            <?php if($formType !== 'Vendor') : ?>
            <div class="col-6">
              <div class="form-floating">
                <input class="form-control" name="guest" id="guest" type="number" placeholder="<?php _e('จำนวนแขก*','wdl')?>" required />
                <label for="guest"><?php _e('จำนวนแขก*','wdl')?></label>
              </div>
            </div>
            <div class="col-6">
              <div class="form-floating">
                <input class="form-control" name="budget" id="budget" type="number" placeholder="<?php _e('งบประมาณ*', 'wdl')?>" required />
                <label for="budget"><?php _e('งบประมาณ*', 'wdl')?></label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-floating">
                <input class="form-control" name="date" id="date" type="date" placeholder="<?php _e('วันที่จัดงาน','wdl')?>" />
                <label for="date"><?php _e('วันที่จัดงาน','wdl')?></label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="d-block"><label><?php _e('ช่วงเวลาจัดงาน (เลือกได้มากกว่า 1)', 'wdl')?></label></div>
              <div class="wdl-checkbox-button">
                <input type="checkbox" name="daytime" id="daytime-1" value="งานเลี้ยงเช้า" /><label for="daytime-1"><?php _e('งานเลี้ยงเช้า', 'wdl')?></label>
                <input type="checkbox" name="daytime" id="daytime-2" value="งานเลี้ยงเที่ยง" /><label for="daytime-2"><?php _e('งานเลี้ยงเที่ยง', 'wdl')?></label>
                <input type="checkbox" name="daytime" id="daytime-3" value="งานเลี้ยงเย็น" /><label for="daytime-3"><?php _e('งานเลี้ยงเย็น', 'wdl')?></label>
              </div>
            </div>
            <?php endif; ?>

            <?php if($formType !== 'Vendor') {
              $availablePackageTypes = [];

              if(checkPackage('Package') || checkPackage('WeddingPackage')) {
                $availablePackageTypes[] = __('Wedding', 'wdl');
              }
              if(checkPackage('ConventionPackage')) {
                $availablePackageTypes[] = __('ประชุม', 'wdl');
              }
              if(checkPackage('PartyPackage')) {
                $availablePackageTypes[] = __('ปาร์ตี้', 'wdl');
              }
            if(count($availablePackageTypes) > 0) { ?>
              <div class="col-md-12">
                <div class="d-block"><label><?php _e('ประเภท Package', 'wdl')?></label></div>
                <div class="wdl-checkbox-button">
                  <?php 
                  foreach($availablePackageTypes as $packageType) { ?>
                    <input <?php if(count($availablePackageTypes) < 2) {echo 'checked';}?> type="radio" name="packageType" id="packageType-<?php echo $packageType ?>" value="<?php echo $packageType ?>" /><label for="packageType-<?php echo $packageType ?>"><?php echo $packageType ?></label>
                  <?php } ?>
                </div>
              </div>  
            <?php }
            } ?>

            <?php if($formType === 'Vendor' && isset($pricings) && count($pricings) > 0) {
              $pricingIndex = 0?>
              <div class="col-md-12">
                <p class="h6 mb-1"><label><?php _e('Package ที่สนใจ
                ', 'wdl')?></label></p>
                <div class="wdl-checkbox-button wdl-checkbox-bundle">
                  <?php 
                  foreach($pricings as $pricing) { 
                    $pricingIndex++?>
                    <label class="bundle-item" for="packageType-<?php echo $pricingIndex ?>">
                      <input <?php if(count($pricings) < 2) {echo 'checked';}?> type="radio" name="packageType" id="packageType-<?php echo $pricingIndex ?>" value="<?php echo $pricing['name'] ?>" />
                      <div class="title h4 mb-0"><?php echo $pricing['name'] ?></div>
                      <div class="desc text-xs lineclamp-3"><?php echo $pricing['desc'] ?></div>
                      <div class="h3 mt-3 mb-0">เริ่มต้น <?php echo number_format($pricing['price']) ?></div>
                    </label>
                  <?php } ?>
                </div>
              </div>  
            <?php } ?>

            <?php if($formType !== 'Vendor') : ?>
            <div class="col-md-12">
              <hr class="mt-0" />
              <p class="h6 mb-1"><?php _e('นัดหมายเข้าชมสถานที่', 'wdl')?></p>
              <div id="appoint-field" class="row g-2 g-lg-3">
                <div class="col-md-6">
                  <div class="form-floating">
                    <input class="form-control" id="appoint-date" type="date" placeholder="<?php _e('วันที่ต้องการนัดหมาย', 'wdl')?>">
                    <label class="text-sm" for="appoint-date"><?php _e('วันที่ต้องการนัดหมาย', 'wdl')?></label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <select class="form-select" id="appoint-time" placeholder="<?php _e('วันที่ต้องการนัดหมาย', 'wdl')?>">
                      <option value="" selected disabled><?php _e('กรุณาเลือกเวลานัดหมาย','wdl')?></option>
                      <option value="<?php _e('ช่วงเช้า (09:00 - 12:00 น.)','wdl')?>"><?php _e('ช่วงเช้า (09:00 - 12:00 น.)','wdl') ?></option>
                      <option value="<?php _e('ช่วงบ่าย (12:00 - 16:00 น.)','wdl')?>"><?php _e('ช่วงบ่าย (12:00 - 16:00 น.)','wdl') ?></option>
                      <option value="<?php _e('ช่วงเย็น (16:00 - 19:00 น.)','wdl')?>"><?php _e('ช่วงเย็น (16:00 - 19:00 น.)','wdl') ?></option>
                      <option value="<?php _e('ช่วงค่ำ (19:00 - 22:00 น.)','wdl')?>"><?php _e('ช่วงค่ำ (19:00 - 22:00 น.)','wdl') ?></option>
                    </select>
                    <label class="text-sm" for="appoint-time"><?php _e('ช่วงเวลาที่ต้องการ','wdl')?></label>
                  </div>
                </div>
              </div>
              <hr class="mb-0" />
            </div>
            <?php endif; ?>

            <?php
            if($formType !== 'General') {
              $couponArg = [
                'posts_per_page' => -1,
                'post_type' => 'coupon',
                'meta_query' => [
                  [
                    'key' => $formType,
                    'value' => get_the_ID(),
                    'compare' => 'LIKE'
                  ]
                ]
              ];
            $coupon = get_posts($couponArg);
            if($coupon) { ?>
              <div class="col-md-12 mt-3">
                <p class="h6 mb-1"><?php _e('คูปองที่ร่วมรายการ', 'wdl') ?></p>
                <div class="d-flex flex-wrap gap-3 my-2 align-items-stretch">
                  <?php foreach ($coupon as $singleCoupon): ?>
                  <div class="wdl-coupon-picker wdl-coupon-checkbox"
                    data-dlev="couponClick",
                    data-dlcomp="coupon - <?php echo $formType ?>",
                    data-dltgt="<?php the_title($singleCoupon->ID) ?>"
                  >
                    <div class="wdl-coupon-picker-indicator"></div>
                    <input class="d-none wdl-coupon-checkbox-target" type="checkbox" value="<?php echo $singleCoupon->ID?>" readonly />
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
                          <a class="wdl-coupon-popup-link" href="<?php echo (get_the_permalink($singleCoupon->ID)) ?>?popup=true" target="blank"
                            data-dlev="couponClick",
                            data-dlcomp="coupon condition - <?php echo $formType ?>",
                            data-dltgt="<?php the_title($singleCoupon->ID) ?>"
                          ><?php _e('เงื่อนไข','wdl')?></a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; ?>
                </div>
              </div>
            <?php }
            } ?>
            <div class="col-md-12">
              <label class="text-sm" for="message"><?php _e('ข้อความเพิ่มเติม','wdl')?></label>
              <textarea rows="4" class="form-control" name="message" id="message" label="<?php _e('ข้อความเพิ่มเติม','wdl')?>"></textarea>
            </div>
            <div class="col-md-12">
              <hr class="my-1 opacity-0">
              <button id="wdl-form-general-submit" type="submit" name="submit" class="wdl-btn-lg wdl-form-submit w-100"><?php _e('ลงทะเบียน','wdl')?></button>
              <p class="fail-message text-red"><?php _e('ขออภัยค่ะ ไม่สามารถส่งข้อมูลได้ กรุณาลองใหม่','wdl') ?></p>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="wdl-form-general-coupon-verify modal fade">
  <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-md-down">
    <div class="modal-content mb-0">
      <button class="btn-close" data-bs-dismiss="modal"
        data-dlev="buttonClick"
        data-dlcomp="button - <?php echo $formType ?> - cta"></button>
      <div class="modal-body text-center">
        <div class="py-4">
          <img class="mb-4" src="<?php echo(get_theme_file_uri() . '/images/logo.png') ?>" alt="Weddinglist" width="180" height="43">
          <p class="h2 text-red"><?php _e('ลงทะเบียนสำเร็จ กรุณายืนยันตัวตนเพื่อรับคูปอง','wdl') ?></p>
          <p><?php _e('ระบบได้ส่งลิงค์ยืนยันตัวตนไปยังอีเมล<br/>หากไม่พบอีเมลดังกล่าวกรุณาตรวจสอบในกล่องเมลขยะของบัญชีคุณ', 'wdl') ?></p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="wdl-form-general-succeed-modal modal fade">
  <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-md-down">
    <div class="modal-content mb-0">
      <button class="btn-close" data-bs-dismiss="modal" aria-label="Close modal"></button>
      <div class="modal-body text-center">
        <div class="py-4">
          <img class="mb-4" src="<?php echo(get_theme_file_uri() . '/images/logo.png') ?>" alt="Weddinglist" width="180" height="43">
          <p class="h2 text-red"><?php _e('ลงทะเบียนสำเร็จ','wdl') ?></p>
          <p><?php _e('ทางโรงแรมที่ท่านได้เลือกไว้จะติดต่อกลับมาในไม่ช้า ขอบคุณค่ะ', 'wdl') ?></p>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(() => {
  const modal = new bootstrap.Modal(document.querySelector('.wdl-form-general-modal'));
  const modalVerify = new bootstrap.Modal(document.querySelector('.wdl-form-general-coupon-verify'));
  const modalSuccess = new bootstrap.Modal(document.querySelector('.wdl-form-general-succeed-modal'));
  $('#wdl-form-general').submit(function(e) {
    e.preventDefault();
    $('.wdl-form-general-modal .modal-body').addClass('submitting')
    let selectedDaytime = []
    let selectedCoupon = []
    $('.wdl-coupon-checkbox-target:checked').each((i, e) => {
      selectedCoupon.push($(e).val())
    })
    $('input[name=daytime]:checked').each((i2, e2) => {
      selectedDaytime.push(e2.value)
    })
    
    <?php if($formType === 'General') { ?>
      let selectedItems = generalDirectData.length > 0 ? generalDirectData : selectedCard
      selectedItems.forEach((e,i) => {
        $.post("<?php echo admin_url('admin-ajax.php'); ?>", {
          action: 'send_email',
          name: $('#name-lastname').val(),
          tel: $('#tel').val(),
          email: $('#email').val(),
          lineid: $('#lineid').val(),
          guest: $('#guest').val(),
          budget: $('#budget').val(),
          date: $('#date').val(),
          daytime: selectedDaytime.join(', '),
          appointDate: $('#appoint-date').val(),
          appointTime: $('#appoint-time').val(),
          message: $('#message').val(),
          cardTitle: e.title,
          cardId: e.id,
          leadType: '<?php echo $formType ?>',
        }, () => {
          $('#wdl-form-general').removeClass('failed')
        
          modal.hide();
          modalSuccess.show();
  
          $('.wdl-form-general-modal .modal-body').removeClass('submitting')
          generalDirectData = {}
        }).fail(() => {
          $('.wdl-form-general-modal .modal-body').removeClass('submitting')
          $('#wdl-form-general').addClass('failed')
        })
      })
    <?php } else { ?>
      $.post("<?php echo admin_url('admin-ajax.php'); ?>", {
      action: 'send_email',
      name: $('#name-lastname').val(),
      tel: $('#tel').val(),
      email: $('#email').val(),
      lineid: $('#lineid').val(),
      guest: $('#guest').val(),
      budget: $('#budget').val(),
      date: $('#date').val(),
      daytime: selectedDaytime.join(', '),
      //appoint: $('#appoint').is(':checked'),
      appointDate: $('#appoint-date').val(),
      appointTime: $('#appoint-time').val(),
      message: $('#message').val(),
      cardId: <?php echo get_the_id()?>,
      packageType: $('input[name=packageType]:checked').val(),
      leadType: '<?php echo $formType ?>',
      selectedCoupon: selectedCoupon.join(',')
    }, () => {
      $('#wdl-form-general').removeClass('failed')
      modal.hide();
        
      if (selectedCoupon.length > 0) {
        modalVerify.show();
      } else {
        modalSuccess.show();
      }
      $('.wdl-form-general-modal .modal-body').removeClass('submitting')
      generalDirectData = {}
    }).fail(() => {
      $('.wdl-form-general-modal .modal-body').removeClass('submitting')
      $('#wdl-form-general').addClass('failed')
    })
    <?php } ?>

    window.dataLayer.push({
      'event': 'formSubmit',
      'component': 'form - <?php echo $formType ?>'.toLowerCase(),
      'source': window.location.href,
      'target': '',
      'data': {
        'name': $('#name-lastname').val(),
        'tel': $('#tel').val(),
        'email': $('#email').val(),
        'lineid': $('#lineid').val(),
        'guest': $('#guest').val(),
        'budget': $('#budget').val(),
        'date': $('#date').val(),
        'daytime': selectedDaytime.join(', '),
        'appoint': $('#appoint').is(':checked'),
        'appointDate': $('#appoint-date').val(),
        'appointTime': $('#appoint-time').val(),
        'message': $('#message').val(),
        'cardId': '<?php echo get_the_id()?>',
        'packageType': $('input[name=packageType]:checked').val(),
        'leadType': '<?php echo $formType ?>',
        'selectedCoupon': selectedCoupon.join(',')
      }
    })
  });
})
</script>