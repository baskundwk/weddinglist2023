<?php 
  if(is_single( )) {
    $formType = get_post_type_object(get_post_type())->labels->singular_name;
  } else {
    $formType = 'General';
  }
?>

<div id="apply" class="wdl-form-general-modal modal fade html-lazy show" style="display:block">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content m-1 mb-0">
      <button class="btn-close" data-bs-dismiss="modal" aria-label="Close modal"></button>
      <div class="modal-body py-4 px-md-5">
        <h2 class="mb-2 h1 text-center fw-medium"><?php _e('ลงทะเบียนเพื่อรับสิทธิพิเศษ', 'wdl') ?></h2>
        <hr class="mb-4">
        <form id="wdl-form-general" class="wdl-form-general" action="" method="post" enctype="multipart/form-data">
          <div class="row gy-3 gx-md-4">
            <?php if($formType !== 'Vendor') : ?>
            <div class="col-md-12 d-flex flex-column flex-md-row align-items-md-center gap-md-5 position-relative z-1">
              <div class="wdl-label-aside"><?php _e('วันที่กำหนดจัดงาน', 'wdl')?></div>
              <div class="wdl-checkbox-button wdl-datepicker-container">
                <input type="radio" name="date" id="date-1" value="" />
                <label for="date-1" class="datepicker-input-group datepicker-toggle">
                  <span><?php _e('ระบุวันที่', 'wdl')?></span>
                  <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M16.25 2.6875H14.6875V2.375C14.6875 2.12636 14.5887 1.8879 14.4129 1.71209C14.2371 1.53627 13.9986 1.4375 13.75 1.4375C13.5014 1.4375 13.2629 1.53627 13.0871 1.71209C12.9113 1.8879 12.8125 2.12636 12.8125 2.375V2.6875H7.1875V2.375C7.1875 2.12636 7.08873 1.8879 6.91291 1.71209C6.7371 1.53627 6.49864 1.4375 6.25 1.4375C6.00136 1.4375 5.7629 1.53627 5.58709 1.71209C5.41127 1.8879 5.3125 2.12636 5.3125 2.375V2.6875H3.75C3.3356 2.6875 2.93817 2.85212 2.64515 3.14515C2.35212 3.43817 2.1875 3.8356 2.1875 4.25V16.75C2.1875 17.1644 2.35212 17.5618 2.64515 17.8549C2.93817 18.1479 3.3356 18.3125 3.75 18.3125H16.25C16.6644 18.3125 17.0618 18.1479 17.3549 17.8549C17.6479 17.5618 17.8125 17.1644 17.8125 16.75V4.25C17.8125 3.8356 17.6479 3.43817 17.3549 3.14515C17.0618 2.85212 16.6644 2.6875 16.25 2.6875ZM5.3125 4.5625C5.3125 4.81114 5.41127 5.0496 5.58709 5.22541C5.7629 5.40123 6.00136 5.5 6.25 5.5C6.49864 5.5 6.7371 5.40123 6.91291 5.22541C7.08873 5.0496 7.1875 4.81114 7.1875 4.5625H12.8125C12.8125 4.81114 12.9113 5.0496 13.0871 5.22541C13.2629 5.40123 13.5014 5.5 13.75 5.5C13.9986 5.5 14.2371 5.40123 14.4129 5.22541C14.5887 5.0496 14.6875 4.81114 14.6875 4.5625H15.9375V6.4375H4.0625V4.5625H5.3125ZM4.0625 16.4375V8.3125H15.9375V16.4375H4.0625ZM11.25 10.5C11.25 10.7472 11.1767 10.9889 11.0393 11.1945C10.902 11.4 10.7068 11.5602 10.4784 11.6549C10.2499 11.7495 9.99861 11.7742 9.75614 11.726C9.51366 11.6778 9.29093 11.5587 9.11612 11.3839C8.9413 11.2091 8.82225 10.9863 8.77402 10.7439C8.72579 10.5014 8.75054 10.2501 8.84515 10.0216C8.93976 9.79324 9.09998 9.59801 9.30554 9.46066C9.5111 9.32331 9.75277 9.25 10 9.25C10.3315 9.25 10.6495 9.3817 10.8839 9.61612C11.1183 9.85054 11.25 10.1685 11.25 10.5ZM15 10.5C15 10.7472 14.9267 10.9889 14.7893 11.1945C14.652 11.4 14.4568 11.5602 14.2284 11.6549C13.9999 11.7495 13.7486 11.7742 13.5061 11.726C13.2637 11.6778 13.0409 11.5587 12.8661 11.3839C12.6913 11.2091 12.5722 10.9863 12.524 10.7439C12.4758 10.5014 12.5005 10.2501 12.5951 10.0216C12.6898 9.79324 12.85 9.59801 13.0555 9.46066C13.2611 9.32331 13.5028 9.25 13.75 9.25C14.0815 9.25 14.3995 9.3817 14.6339 9.61612C14.8683 9.85054 15 10.1685 15 10.5ZM7.5 14.25C7.5 14.4972 7.42669 14.7389 7.28934 14.9445C7.15199 15.15 6.95676 15.3102 6.72835 15.4049C6.49995 15.4995 6.24861 15.5242 6.00614 15.476C5.76366 15.4278 5.54093 15.3087 5.36612 15.1339C5.1913 14.9591 5.07225 14.7363 5.02402 14.4939C4.97579 14.2514 5.00054 14.0001 5.09515 13.7716C5.18976 13.5432 5.34998 13.348 5.55554 13.2107C5.7611 13.0733 6.00277 13 6.25 13C6.58152 13 6.89946 13.1317 7.13388 13.3661C7.3683 13.6005 7.5 13.9185 7.5 14.25ZM11.25 14.25C11.25 14.4972 11.1767 14.7389 11.0393 14.9445C10.902 15.15 10.7068 15.3102 10.4784 15.4049C10.2499 15.4995 9.99861 15.5242 9.75614 15.476C9.51366 15.4278 9.29093 15.3087 9.11612 15.1339C8.9413 14.9591 8.82225 14.7363 8.77402 14.4939C8.72579 14.2514 8.75054 14.0001 8.84515 13.7716C8.93976 13.5432 9.09998 13.348 9.30554 13.2107C9.5111 13.0733 9.75277 13 10 13C10.3315 13 10.6495 13.1317 10.8839 13.3661C11.1183 13.6005 11.25 13.9185 11.25 14.25ZM15 14.25C15 14.4972 14.9267 14.7389 14.7893 14.9445C14.652 15.15 14.4568 15.3102 14.2284 15.4049C13.9999 15.4995 13.7486 15.5242 13.5061 15.476C13.2637 15.4278 13.0409 15.3087 12.8661 15.1339C12.6913 14.9591 12.5722 14.7363 12.524 14.4939C12.4758 14.2514 12.5005 14.0001 12.5951 13.7716C12.6898 13.5432 12.85 13.348 13.0555 13.2107C13.2611 13.0733 13.5028 13 13.75 13C14.0815 13 14.3995 13.1317 14.6339 13.3661C14.8683 13.6005 15 13.9185 15 14.25Z" fill="currentColor"/>
                  </svg>

                  <div class="datepicker"></div>
                </label>
                <input type="radio" name="date" id="date-2" value="ภายใน 3 เดือน" />
                <label class="datepicker-clear" for="date-2"><?php _e('ภายใน 3 เดือน', 'wdl')?></label>
                <input type="radio" name="date" id="date-3" value="ภายใน 6 เดือน" />
                <label class="datepicker-clear" for="date-3"><?php _e('ภายใน 6 เดือน', 'wdl')?></label>
                <input type="radio" name="date" id="date-4" value="ภายใน 1 ปี" />
                <label class="datepicker-clear" for="date-4"><?php _e('ภายใน 1 ปี', 'wdl')?></label>
              </div>
            </div>
            <div class="col-md-12 d-flex flex-column flex-md-row align-items-md-center gap-md-5">
              <div class="wdl-label-aside"><?php _e('จำนวนแขก', 'wdl')?></div>
              <div class="wdl-checkbox-button">
                <input type="radio" name="guest" id="guest-1" value="ต่ำกว่า 100 คน" /><label for="guest-1"><?php _e('ต่ำกว่า 100 คน', 'wdl')?></label>
                <input type="radio" name="guest" id="guest-2" value="101 - 300 คน" /><label for="guest-2"><?php _e('101 - 300 คน', 'wdl')?></label>
                <input type="radio" name="guest" id="guest-3" value="301 - 500 คน" /><label for="guest-3"><?php _e('301 - 500 คน', 'wdl')?></label>
                <input type="radio" name="guest" id="guest-4" value="500 ท่านขึ้นไป" /><label for="guest-4"><?php _e('500 ท่านขึ้นไป', 'wdl')?></label>
              </div>
            </div>
            <div class="col-md-12 d-flex flex-column flex-md-row align-items-md-center gap-md-5">
              <div class="wdl-label-aside"><?php _e('งบประมาณ', 'wdl')?></div>
              <div class="position-relative w-100">
                <select name="budget" id="budget-select" class="select2">
                  <option selected>ยังไม่กำหนด</option>
                  <option>ต่ำกว่า 100,000 บาท</option>
                  <option>100,001 - 200,000 บาท</option>
                  <option>200,001 - 300,000 บาท</option>
                  <option>300,001 - 500,000 บาท</option>
                  <option>500,001 - 700,000 บาท</option>
                  <option>700,001 - 1,000,000 บาท</option>
                  <option>1,000,000 บาท ขึ้นไป</option>
                </select>
              </div>
            </div>
            <?php endif; ?>

            <?php if($formType === 'Vendor' && isset($pricings) && count($pricings) > 0) {
              $pricingIndex = 0?>
              <div class="col-md-12">
                <p class="h6 mb-1"><?php _e('Package ที่สนใจ', 'wdl')?></p>
                <select name="package" id="package" class="select2" >
                  <?php 
                  foreach($pricings as $pricing) { 
                    $pricingIndex++?>
                    <option for="packageType-<?php echo $pricingIndex ?>"><?php echo $pricing['name'] ?></option>
                  <?php } ?>
                </select>
              </div>  
            <?php } ?>


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

            <div class="col-6">
              <label for="name-lastname"><?php _e('ชื่อ - นามสกุล','wdl')?> <span class="text-red">*</span></label>
              <input name="name" id="name-lastname" type="text" placeholder="<?php _e('ชื่อ - นามสกุล','wdl')?>" required />
            </div>
            <div class="col-6">
              <label for="tel"><?php _e('เบอร์โทรติดต่อ','wdl')?> <span class="text-red">*</span></label>
              <input name="tel" id="tel" type="text" placeholder="<?php _e('เบอร์โทรติดต่อ','wdl')?>" required />
            </div>
            <div class="col-6">
              <label for="email"><?php _e('E-mail', 'wdl')?> <span class="text-red">*</span></label>
              <input name="email" id="email" type="text" placeholder="<?php _e('E-mail', 'wdl')?>" required />
            </div>
            <div class="col-6">
              <label for="lineid"><?php _e('Line ID', 'wdl')?></label>
              <input name="lineid" id="lineid" type="text" placeholder="<?php _e('Line ID', 'wdl')?>" />
            </div>

            <div class="col-md-12">
              <label class="text-sm" for="message"><?php _e('ข้อความเพิ่มเติม','wdl')?></label>
              <textarea rows="1" name="message" id="message" label="<?php _e('ข้อความเพิ่มเติม','wdl')?>"></textarea>
            </div>
            <div class="col-md-12">
              <div class="wdl-checkbox p-0 m-0 mb-4 mt-4">
                <input type="checkbox" name="consent" id="consent">
                <label for="consent" class="d-flex gap-2 align-items-center justify-content-start fs-6">
                  <span>ในการลงทะเบียนครั้งนี้ ข้าพเจ้ายอมรับข้อตกลงและเงื่อนไขทุกประการ (โปรดอ่านและยอมรับ <a href="#" class="text-accent">ข้อตกลงและเงื่อนไขการใช้งาน</a> ก่อนดำเนินการต่อ)</span>
                </label>
              </div>
            </div>
            <div class="col-md-12 text-center">
              <button id="wdl-form-general-submit" type="submit" name="submit" class="wdl-btn-lg wdl-form-submit"><?php _e('ลงทะเบียน','wdl')?></button>
              <p class="fail-message text-red"><?php _e('ขออภัยค่ะ ไม่สามารถส่งข้อมูลได้ กรุณาลองใหม่','wdl') ?></p>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal-backdrop fade show"></div>
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
          guest: $('input[name=guest]:checked').val(),
          budget: $('input[name=budget]:checked').val(),
          date: $('input[name=date]:checked').val(),
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
      guest: $('input[name=guest]:checked').val(),
      budget: $('input[name=budget]:checked').val(),
      date: $('input[name=date]:checked').val(),
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
        'guest': $('input[name=guest]:checked').val(),
        'budget': $('input[name=budget]:checked').val(),
        'date': $('input[name=date]:checked').val(),
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