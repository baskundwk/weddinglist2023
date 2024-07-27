<div id="apply" class="wdl-form-general-modal modal fade">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content m-1 mb-0">
      <button class="btn-close" data-bs-dismiss="modal"></button>
      <div class="modal-body p-3 p-lg-3">
        <h2><?php _e('กรุณากรอกข้อมูลผู้ติดต่อ', 'กรุณากรอกข้อมูลผู้ติดต่อ') ?></h2>
        <hr class="mb-2">
        <ul class="wdl-form-general-list">
          
        </ul>
        <form id="wdl-form-general" class="wdl-form-general" action="" method="post" enctype="multipart/form-data">
          <div class="row g-2 g-lg-3">
            <div class="col-6">
              <div class="form-floating">
                <input class="form-control" name="name" id="name-lastname" type="text" placeholder="ชื่อ - นามสกุล*" required />
                <label for="name-lastname">ชื่อ - นามสกุล*</label>
              </div>
            </div>
            <div class="col-6">
              <div class="form-floating">
                <input class="form-control" name="tel" id="tel" type="text" placeholder="เบอร์โทรติดต่อ*" required />
                <label for="tel">เบอร์โทรติดต่อ*</label>
              </div>
            </div>
            <div class="col-6">
              <div class="form-floating">
                <input class="form-control" name="email" id="email" type="text" placeholder="E-mail*" required />
                <label for="email">E-mail*</label>
              </div>
            </div>
            <div class="col-6">
              <div class="form-floating">
                <input class="form-control" name="lineid" id="lineid" type="text" placeholder="Line ID" />
                <label for="lineid">Line ID</label>
              </div>
            </div>
            <div class="col-6">
              <div class="form-floating">
                <input class="form-control" name="guest" id="guest" type="number" placeholder="จำนวนแขก*" />
                <label for="guest">จำนวนแขก*</label>
              </div>
            </div>
            <div class="col-6">
              <div class="form-floating">
                <input class="form-control" name="budget" id="budget" type="number" placeholder="งบประมาณ" />
                <label for="budget">งบประมาณ*</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-floating">
                <input class="form-control" name="date" id="date" type="date" placeholder="วันที่จัดงาน" />
                <label for="date">วันที่จัดงาน</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="d-block"><label>ช่วงเวลาจัดงาน</label></div>
              <div class="wdl-checkbox-button">
                <input type="checkbox" name="daytime" id="daytime-1" value="งานเลี้ยงเช้า"/><label for="daytime-1">งานเลี้ยงเช้า</label>
                <input type="checkbox" name="daytime" id="daytime-2" value="งานเลี้ยงเที่ยง"/><label for="daytime-2">งานเลี้ยงเที่ยง</label>
                <input type="checkbox" name="daytime" id="daytime-3" value="งานเลี้ยงเย็น"/><label for="daytime-3">งานเลี้ยงเย็น</label>
              </div>
            </div>
            <div class="col-md-12">
              <hr class="mt-0"/>
              <!-- <div class="wdl-checkbox">
                <input id="appoint" type="checkbox">
                <label for="appoint"><?php _e('สนใจนัดหมายเพื่อเข้าชมสถานที่','สนใจนัดหมายเพื่อเข้าชมสถานที่')?></label>
              </div> -->
              <p class="h6 mb-1">นัดหมายเข้าชมสถานที่</p>
              <div id="appoint-field" class="row g-2 g-lg-3">
                <div class="col-md-6">
                  <div class="form-floating">
                    <input class="form-control" id="appoint-date" type="date" placeholder="วันที่ต้องการนัดหมาย">
                    <label class="text-sm" for="appoint-date">วันที่ต้องการนัดหมาย</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <select class="form-select" id="appoint-time" placeholder="วันที่ต้องการนัดหมาย">
                      <option value="" selected disabled><?php _e('กรุณาเลือกเวลานัดหมาย','กรุณาเลือกเวลานัดหมาย')?></option>
                      <option value="ช่วงเช้า (09:00 - 12:00 น.)"><?php _e('ช่วงเช้า (09:00 - 12:00 น.)','ช่วงเช้า (09:00 - 12:00 น.)') ?></option>
                      <option value="ช่วงบ่าย (12:00 - 16:00 น.)"><?php _e('ช่วงบ่าย (12:00 - 16:00 น.)','ช่วงบ่าย (12:00 - 16:00 น.)') ?></option>
                      <option value="ช่วงเย็น (16:00 - 19:00 น.)"><?php _e('ช่วงเย็น (16:00 - 19:00 น.)','ช่วงเย็น (16:00 - 19:00 น.)') ?></option>
                      <option value="ช่วงค่ำ (19:00 - 22:00 น.)"><?php _e('ช่วงค่ำ (19:00 - 22:00 น.)','ช่วงค่ำ (19:00 - 22:00 น.)') ?></option>
                    </select>
                    <label class="text-sm" for="appoint-time">ช่วงเวลาที่ต้องการ</label>
                  </div>
                </div>
              </div>
              <hr class="mb-0" />
            </div>
            <?php $coupon = get_posts(
              array(
                'posts_per_page' => -1,
                'post_type' => 'coupon',
                'meta_query' => array(
                  array(
                    'key' => 'Venue',
                    'value' => '"' . get_the_ID() . '"',
                    'compare' => 'LIKE'
                  )
                )
              )
            );
            if($coupon) : ?>
            <div class="col-md-12 mt-3">
              <h2 class="h6 mb-1">คูปองที่ร่วมรายการ</h2>
              <div class="d-flex flex-wrap gap-2">
                <?php foreach ($coupon as $singleCoupon): ?>
                  <div class="wdl-coupon-picker wdl-coupon-checkbox">
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
                          <button type="button">เก็บคูปอง</button>
                        </div>
                        <div class="wdl-coupon-picker-term">
                          <a class="wdl-coupon-popup-link" href="<?php echo (get_the_permalink($singleCoupon->ID)) ?>?popup=true" target="blank">เงื่อนไข</a>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
            <?php endif; ?>
            <div class="col-md-12">
              <label class="text-sm" for="message">ข้อความเพิ่มเติม</label>
              <textarea rows="4" class="form-control" name="message" id="message" label="ข้อความเพิ่มเติม"></textarea>
            </div>

            <hr class="my-1 opacity-0">
            <button id="wdl-form-general-submit" type="submit" name="submit" class="wdl-btn-lg wdl-form-submit">ลงทะเบียน</button>
            <p class="fail-message text-red"><?php _e('ขออภัยค่ะ ไม่สามารถส่งข้อมูลได้ กรุณาลองใหม่','ขออภัยค่ะ ไม่สามารถส่งข้อมูลได้ กรุณาลองใหม่') ?></p>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="wdl-form-general-succeed-modal modal fade">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content mb-0">
      <button class="btn-close" data-bs-dismiss="modal"></button>
      <div class="modal-body text-center">
        <div class="py-4">
          <img class="mb-4" src="<?php echo(get_theme_file_uri() . '/images/logo.png') ?>" alt="Weddinglist" width="180" height="43">
          <h2 class="text-red"><?php _e('ลงทะเบียนสำเร็จ','ลงทะเบียนสำเร็จ') ?></h2>
          <p><?php _e('ทางโรงแรมที่ท่านได้เลือกไว้จะติดต่อกลับมาในไม่ช้า ขอบคุณค่ะ', 'ทางโรงแรมที่ท่านได้เลือกไว้จะติดต่อกลับมาในไม่ช้า ขอบคุณค่ะ') ?></p>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(() => {
    $('#wdl-form-general').submit(function (e) {
      e.preventDefault();

      $('.wdl-form-general-modal .modal-body').addClass('submitting')

      let selectedDaytime = []

      $('input[name=daytime]:checked').each((index, element)=> {
        selectedDaytime.push(element.value)
      })
      
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
        cardTitle: '<?php echo get_the_title()?>',
        cardId: <?php echo get_the_id()?>,
        leadType: 'Venue'
      }, ()=> {
        $('#wdl-form-general').removeClass('failed')
        $('.wdl-form-general-modal').modal('hide')
        $('.wdl-form-general-succeed-modal').modal('show')

        $('.wdl-form-general-modal .modal-body').removeClass('submitting')
        generalDirectData = {}
      }).fail(()=> {
        $('.wdl-form-general-modal .modal-body').removeClass('submitting')
        $('#wdl-form-general').addClass('failed')
      })

      $('.wdl-coupon-checkbox-target:checked').each((i, e)=> {
        const couponId = $(e).val()
        $.post("<?php echo admin_url('admin-ajax.php'); ?>", {
          toClient: true,
          action: 'send_email',
          name: $('#name-lastname').val(),
          tel: $('#tel').val(),
          email: $('#email').val(),
          recepient: '<?php $recepient?>' ,
          lineid: $('#lineid').val(),
          guest: $('#guest').val(),
          budget: $('#budget').val(),
          date: $('#date').val(),
          daytime: selectedDaytime.join(', '),
          //appoint: $('#appoint').is(':checked'),
          appointDate: $('#appoint-date').val(),
          appointTime: $('#appoint-time').val(),
          message: $('#message').val(),
          cardId: couponId,
          leadType: 'Coupon'
        }, ()=> {}).fail(()=> {})
      })
    });
  })
</script>