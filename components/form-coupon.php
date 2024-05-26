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
              <label class="text-sm" for="message">ข้อความเพิ่มเติม</label>
              <textarea rows="4" name="message" id="message" label="ข้อความเพิ่มเติม"></textarea>
            </div>
            <div class="col-md-12">
              <div class="d-block"><label>ช่วงเวลาจัดงาน</label></div>
              <div class="wdl-checkbox-button">
                <input type="checkbox" name="daytime" id="daytime-1" value="งานเลี้ยงเช้า"/><label for="daytime-1">งานเลี้ยงเช้า</label>
                <input type="checkbox" name="daytime" id="daytime-2" value="งานเลี้ยงเที่ยง"/><label for="daytime-2">งานเลี้ยงเที่ยง</label>
                <input type="checkbox" name="daytime" id="daytime-3" value="งานเลี้ยงเย็น"/><label for="daytime-3">งานเลี้ยงเย็น</label>
              </div>
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
    <div class="modal-content m-3 mb-0">
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

<!-- <?php
  $recepient = "";
  if(get_field('Venue')){
    $venue = get_field('Venue');

    foreach($venue as $item) {
      $recepient != "" && $recepient .= ","; 
      $recepient .= get_field('Email', $item->ID);
    }

    echo $recepient;
  }
?> -->
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
        appoint: $('#appoint').is(':checked'),
        appointDate: $('#appoint-date').val(),
        appointTime: $('#appoint-time').val(),
        message: $('#message').val(),
        cardTitle: '<?php echo get_the_title()?>',
        cardId: <?php echo get_the_id()?>,
        leadType: 'Coupon'
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
    });
  })
</script>