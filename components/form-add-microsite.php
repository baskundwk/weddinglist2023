<div id="addMicrositeModal" class="wdl-form-general-modal modal fade html-lazy">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content m-1 mb-0">
      <button class="btn-close" data-bs-dismiss="modal" aria-label="Close modal"></button>
      <div class="modal-body p-3">
        <h2 class="mb-2 h1 text-center fw-semibold"><?php _e('แจ้งขอเพิ่ม Microsite', 'wdl') ?></h2>
        <form id="businessSignUp" method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
          <input type="hidden" name="action" value="send_email_add_microsite">
          <?php wp_nonce_field('add_microsite_form', 'add_microsite_nonce'); ?>

          <div class="mb-3">
            <div class="wdl-label-aside"><?php _e('ประเภท', 'wdl')?></div>
            <div class="position-relative w-100">
              <select name="type" id="type" class="select2" required>
                <option selected>รวมสถานที่จัดงาน</option>
                <option>Event</option>
                <option>แพ็คเกจ</option>
                <option>ผู้ให้บริการ</option>
                <option>Moment</option>
              </select>
            </div>
          </div>

          <div class="mb-3">
            <label for="businessName"><?php _e('ชื่อกิจการ','wdl')?><span class="text-red">*</span></label>
            <input name="businessName" id="businessName" type="text" placeholder="<?php _e('ชื่อกิจการ','wdl')?>" required />
          </div>
          <div class="mb-3">
            <div class="h4">ข้อมูลผู้ติดต่อ</div>
            <div class="text-14">เว้นว่างได้หากต้องการให้เซลส์ติดต่อกลับตามข้อมูลในทะเบียน</div>
            <label for="contactName"><?php _e('ชื่อผู้ติดต่อ','wdl')?><span class="text-red">*</span></label>
            <input name="contactName" id="contactName" type="text" placeholder="<?php _e('ชื่อผู้ติดต่อ','wdl')?>" required />
          </div>
          <div class="mb-3">
            <label for="contactTel"><?php _e('เบอร์โทรผู้ติดต่อ','wdl')?><span class="text-red">*</span></label>
            <input name="contactTel" id="contactTel" type="text" placeholder="<?php _e('เบอร์โทรผู้ติดต่อ','wdl')?>" required />
          </div>
          <div class="mb-3">
            <label for="contactMessage"><?php _e('ข้อความเพิ่มเติม','wdl')?> <span class="fw-regular">(สำหรับเป็นข้อมูลให้เซลส์ติดต่อกลับ)</span></label>
            <textarea name="contactMessage" id="contactMessage" type="email" placeholder="<?php _e('ข้อความเพิ่มเติม','wdl')?>"></textarea>
          </div>
          <div class="mb-3 text-center">
            <p>ทางทีมงานจะติดต่อกลับเพื่อสอบถามรายละเอียดเพิ่มเติมนะคะ</p>
          </div>
          <button type="submit" name="send_email_add_microsite_submit" value="1" class="wdl-btn-lg wdl-form-submit w-100"><?php _e('ส่งข้อความ','wdl')?></button>
        </form>
      </div>
    </div>
  </div>
</div>
