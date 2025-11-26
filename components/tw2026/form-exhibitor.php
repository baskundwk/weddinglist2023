<form id="businessSignUp" method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
  <?php if( isset($_GET['status']) && $_GET['status'] === 'success'): ?>
    <div class="alert alert-success w-100 mb-3">ขอบคุณสำหรับการลงทะเบียน Thailand Weddinglist 2026 ค่ะ</div>
  <?php elseif( isset($_GET['status']) && $_GET['status'] === 'error'): ?>
    <div class="alert alert-danger w-100 mb-3">เกิดข้อผิดพลาดในการส่งข้อมูล กรุณาลองใหม่อีกครั้ง</div>
  <?php endif; ?>
  <input type="hidden" name="action" value="send_email_business">
  <?php wp_nonce_field('tw2026_form', 'tw2026_nonce'); ?>

  <div class="mb-3">
    <label for="campaignBusinessName"><?php _e('บริษัท/ชื่อกิจการ','wdl')?><span class="text-red">*</span></label>
    <input name="campaignBusinessName" id="campaignBusinessName" type="text" placeholder="<?php _e('บริษัท/ชื่อกิจการ','wdl')?>" required />
  </div>
  <div class="mb-3">
    <label for="campaignBusinessType"><?php _e('ประเภทกิจการ','wdl')?><span class="text-red">*</span></label>
    <select name="campaignBusinessType" id="campaignBusinessType" required>
      <option disabled hidden selected>-- เลือกประเภทกิจการ --</option>
      <optgroup label="<?php _e('สถานที่จัดงานแต่งงาน', 'wdl')?>">
        <?php $venueTypes = get_terms([
          'taxonomy' => 'venue_type',
          'hide_empty' => false,
        ]);

        if (!is_wp_error($venueTypes)) {
          foreach ($venueTypes as $venueType) {
            echo '<option value="'.$venueType->name.'">'. $venueType->name . '</option>' ;
          }
        }?>
      </optgroup>
      <optgroup label="<?php _e('ผู้ให้บริการ', 'wdl')?>">
        <?php $vendorTypes = get_terms([
          'taxonomy' => 'vendor-type',
          'hide_empty' => false,
        ]);

        if (!is_wp_error($vendorTypes)) {
          foreach ($vendorTypes as $vendorType) {
            echo '<option value="'.$vendorType->name.'">'. $vendorType->name . '</option>' ;
          }
        }?>
      </optgroup>
      <option value="อื่น ๆ">อื่น ๆ</option>
    </select>
  </div>
  <div class="mb-3">
    <label for="campaignContactName"><?php _e('ชื่อ-นามสกุลผู้ติดต่อ','wdl')?><span class="text-red">*</span></label>
    <input name="campaignContactName" id="campaignContactName" type="text" placeholder="<?php _e('ชื่อ-นามสกุลผู้ติดต่อ','wdl')?>" required />
  </div>
  <div class="mb-3">
    <label for="campaignContactTel"><?php _e('เบอร์โทรผู้ติดต่อ','wdl')?><span class="text-red">*</span></label>
    <input name="campaignContactTel" id="campaignContactTel" type="text" placeholder="<?php _e('เบอร์โทรผู้ติดต่อ','wdl')?>" required />
  </div>
  <div class="mb-3">
    <label for="campaignContactEmail"><?php _e('อีเมลผู้ติดต่อ','wdl')?><span class="text-red">*</span></label>
    <input name="campaignContactEmail" id="campaignContactEmail" type="email" placeholder="<?php _e('อีเมลผู้ติดต่อ','wdl')?>" required />
  </div>
  <div class="mb-3">
    <label for="campaignMessage"><?php _e('ข้อความเพิ่มเติม','wdl')?></label>
    <textarea name="campaignMessage" id="campaignMessage" type="tel" placeholder="<?php _e('ข้อความเพิ่มเติม','wdl')?>" rows="4"></textarea>
  </div>
  <button id="wdl-form-general-submit" type="submit" name="send_email_business_submit" value="1" class="wdl-btn-lg wdl-form-submit w-100" style="  
    --campaign-color-1: <?php the_field('CampaignColor1');?>;
    --campaign-color-2: <?php the_field('CampaignColor2');?>;
    background: linear-gradient(to right, var(--campaign-color-1, #EB355D), var(--campaign-color-2, #EB355D));
  "><?php _e('ลงทะเบียน','wdl')?></button>
</form>