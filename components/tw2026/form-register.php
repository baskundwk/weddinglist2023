<!-- TW2026 : Visitor Form -->

<form id="visitorSignUp" class="form-with-loader" method="post">
  <?php if( isset($_GET['status']) && $_GET['status'] === 'success'): ?>
    <div class="alert alert-success w-100 mb-3">ขอบคุณสำหรับการลงทะเบียน Thailand Weddinglist 2026 ค่ะ</div>
  <?php elseif( isset($_GET['status']) && $_GET['status'] === 'error'): ?>
    <div class="alert alert-danger w-100 mb-3">เกิดข้อผิดพลาดในการส่งข้อมูล กรุณาลองใหม่อีกครั้ง</div>
  <?php endif; ?>

  <?php // UTM paramters to hidden input fields
  $utm_parameters = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_content'];
  foreach ($utm_parameters as $param) {
      if (isset($_GET[$param])) {
          $value = sanitize_text_field($_GET[$param]);
          echo '<input type="hidden" name="' . esc_attr($param) . '" value="' . esc_attr($value) . '">';
      }
  } ?>
  <input type="hidden" name="action" value="handleTW2026FormSubmit">
  <?php wp_nonce_field('tw2026_form', 'tw2026_nonce'); ?>


  <div class="row row-cols-1 row-cols-lg-2 g-3 mb-4">
    <div class="col">
      <label for="contactName"><?php _e('ชื่อ-นามสกุลผู้ติดต่อ','wdl')?><span class="text-red">*</span></label>
      <input name="contactName" id="contactName" type="text" placeholder="<?php _e('ชื่อ-นามสกุลผู้ติดต่อ','wdl')?>" required />
    </div>
    <div class="col">
      <label for="contactTel"><?php _e('เบอร์โทรผู้ติดต่อ','wdl')?><span class="text-red">*</span></label>
      <input name="contactTel" id="contactTel" type="text" placeholder="<?php _e('เบอร์โทรผู้ติดต่อ','wdl')?>" required />
    </div>
    <div class="col">
      <label for="contactEmail"><?php _e('อีเมลผู้ติดต่อ','wdl')?><span class="text-red">*</span></label>
      <input name="contactEmail" id="contactEmail" type="email" placeholder="<?php _e('อีเมลผู้ติดต่อ','wdl')?>" required />
    </div>
    <div class="col">
      <label for="contactLine"><?php _e('Line ID','wdl')?></label>
      <input name="contactLine" id="contactLine" type="text" placeholder="<?php _e('Line ID','wdl')?>" />
    </div>
  </div>

  <div class="row gy-3 gx-md-4 mb-4">
    <div class="col-md-12 d-flex flex-column flex-xl-row align-items-xl-center gap-xl-5 position-relative z-2">
      <div class="wdl-label-aside"><?php _e('วันที่กำหนดจัดงาน', 'wdl')?>&nbsp;<span class="text-red">*</span></div>
      <div class="wdl-checkbox-button wdl-datepicker-container">
        <input type="radio" name="date" id="date-1" value="" required/>
        <label for="date-1" class="datepicker-input-group datepicker-toggle">
          <span><?php _e('ระบุวันที่', 'wdl')?></span>
          <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M16.25 2.6875H14.6875V2.375C14.6875 2.12636 14.5887 1.8879 14.4129 1.71209C14.2371 1.53627 13.9986 1.4375 13.75 1.4375C13.5014 1.4375 13.2629 1.53627 13.0871 1.71209C12.9113 1.8879 12.8125 2.12636 12.8125 2.375V2.6875H7.1875V2.375C7.1875 2.12636 7.08873 1.8879 6.91291 1.71209C6.7371 1.53627 6.49864 1.4375 6.25 1.4375C6.00136 1.4375 5.7629 1.53627 5.58709 1.71209C5.41127 1.8879 5.3125 2.12636 5.3125 2.375V2.6875H3.75C3.3356 2.6875 2.93817 2.85212 2.64515 3.14515C2.35212 3.43817 2.1875 3.8356 2.1875 4.25V16.75C2.1875 17.1644 2.35212 17.5618 2.64515 17.8549C2.93817 18.1479 3.3356 18.3125 3.75 18.3125H16.25C16.6644 18.3125 17.0618 18.1479 17.3549 17.8549C17.6479 17.5618 17.8125 17.1644 17.8125 16.75V4.25C17.8125 3.8356 17.6479 3.43817 17.3549 3.14515C17.0618 2.85212 16.6644 2.6875 16.25 2.6875ZM5.3125 4.5625C5.3125 4.81114 5.41127 5.0496 5.58709 5.22541C5.7629 5.40123 6.00136 5.5 6.25 5.5C6.49864 5.5 6.7371 5.40123 6.91291 5.22541C7.08873 5.0496 7.1875 4.81114 7.1875 4.5625H12.8125C12.8125 4.81114 12.9113 5.0496 13.0871 5.22541C13.2629 5.40123 13.5014 5.5 13.75 5.5C13.9986 5.5 14.2371 5.40123 14.4129 5.22541C14.5887 5.0496 14.6875 4.81114 14.6875 4.5625H15.9375V6.4375H4.0625V4.5625H5.3125ZM4.0625 16.4375V8.3125H15.9375V16.4375H4.0625ZM11.25 10.5C11.25 10.7472 11.1767 10.9889 11.0393 11.1945C10.902 11.4 10.7068 11.5602 10.4784 11.6549C10.2499 11.7495 9.99861 11.7742 9.75614 11.726C9.51366 11.6778 9.29093 11.5587 9.11612 11.3839C8.9413 11.2091 8.82225 10.9863 8.77402 10.7439C8.72579 10.5014 8.75054 10.2501 8.84515 10.0216C8.93976 9.79324 9.09998 9.59801 9.30554 9.46066C9.5111 9.32331 9.75277 9.25 10 9.25C10.3315 9.25 10.6495 9.3817 10.8839 9.61612C11.1183 9.85054 11.25 10.1685 11.25 10.5ZM15 10.5C15 10.7472 14.9267 10.9889 14.7893 11.1945C14.652 11.4 14.4568 11.5602 14.2284 11.6549C13.9999 11.7495 13.7486 11.7742 13.5061 11.726C13.2637 11.6778 13.0409 11.5587 12.8661 11.3839C12.6913 11.2091 12.5722 10.9863 12.524 10.7439C12.4758 10.5014 12.5005 10.2501 12.5951 10.0216C12.6898 9.79324 12.85 9.59801 13.0555 9.46066C13.2611 9.32331 13.5028 9.25 13.75 9.25C14.0815 9.25 14.3995 9.3817 14.6339 9.61612C14.8683 9.85054 15 10.1685 15 10.5ZM7.5 14.25C7.5 14.4972 7.42669 14.7389 7.28934 14.9445C7.15199 15.15 6.95676 15.3102 6.72835 15.4049C6.49995 15.4995 6.24861 15.5242 6.00614 15.476C5.76366 15.4278 5.54093 15.3087 5.36612 15.1339C5.1913 14.9591 5.07225 14.7363 5.02402 14.4939C4.97579 14.2514 5.00054 14.0001 5.09515 13.7716C5.18976 13.5432 5.34998 13.348 5.55554 13.2107C5.7611 13.0733 6.00277 13 6.25 13C6.58152 13 6.89946 13.1317 7.13388 13.3661C7.3683 13.6005 7.5 13.9185 7.5 14.25ZM11.25 14.25C11.25 14.4972 11.1767 14.7389 11.0393 14.9445C10.902 15.15 10.7068 15.3102 10.4784 15.4049C10.2499 15.4995 9.99861 15.5242 9.75614 15.476C9.51366 15.4278 9.29093 15.3087 9.11612 15.1339C8.9413 14.9591 8.82225 14.7363 8.77402 14.4939C8.72579 14.2514 8.75054 14.0001 8.84515 13.7716C8.93976 13.5432 9.09998 13.348 9.30554 13.2107C9.5111 13.0733 9.75277 13 10 13C10.3315 13 10.6495 13.1317 10.8839 13.3661C11.1183 13.6005 11.25 13.9185 11.25 14.25ZM15 14.25C15 14.4972 14.9267 14.7389 14.7893 14.9445C14.652 15.15 14.4568 15.3102 14.2284 15.4049C13.9999 15.4995 13.7486 15.5242 13.5061 15.476C13.2637 15.4278 13.0409 15.3087 12.8661 15.1339C12.6913 14.9591 12.5722 14.7363 12.524 14.4939C12.4758 14.2514 12.5005 14.0001 12.5951 13.7716C12.6898 13.5432 12.85 13.348 13.0555 13.2107C13.2611 13.0733 13.5028 13 13.75 13C14.0815 13 14.3995 13.1317 14.6339 13.3661C14.8683 13.6005 15 13.9185 15 14.25Z" fill="currentColor"/>
          </svg>

          <div class="datepicker"></div>
        </label>
        <input type="radio" name="date" id="date-2" value="ภายใน 3 เดือน" required/>
        <label class="datepicker-clear" for="date-2"><?php _e('ภายใน 3 เดือน', 'wdl')?></label>
        <input type="radio" name="date" id="date-3" value="ภายใน 6 เดือน" required/>
        <label class="datepicker-clear" for="date-3"><?php _e('ภายใน 6 เดือน', 'wdl')?></label>
        <input type="radio" name="date" id="date-4" value="ภายใน 1 ปี" required/>
        <label class="datepicker-clear" for="date-4"><?php _e('ภายใน 1 ปี', 'wdl')?></label>
      </div>
    </div>
    <div class="col-md-12 d-flex flex-column flex-xl-row align-items-xl-center gap-xl-5">
      <div class="wdl-label-aside"><?php _e('จำนวนแขก', 'wdl')?>&nbsp;<span class="text-red">*</span></div>
      <div class="wdl-checkbox-button">
        <input type="radio" name="guest" id="guest-1" value="ต่ำกว่า 100 คน" required/>
        <label for="guest-1"><?php _e('ต่ำกว่า 100 คน', 'wdl')?></label>
        <input type="radio" name="guest" id="guest-2" value="101 - 300 คน" required/>
        <label for="guest-2"><?php _e('101 - 300 คน', 'wdl')?></label>
        <input type="radio" name="guest" id="guest-3" value="301 - 500 คน" required/>
        <label for="guest-3"><?php _e('301 - 500 คน', 'wdl')?></label>
        <input type="radio" name="guest" id="guest-4" value="500 ท่านขึ้นไป" required/>
        <label for="guest-4"><?php _e('500 ท่านขึ้นไป', 'wdl')?></label>
      </div>
    </div>
    <div class="col-md-12 d-flex flex-column flex-xl-row align-items-xl-center gap-xl-5">
      <div class="wdl-label-aside"><?php _e('งบประมาณ', 'wdl')?></div>
      <div class="position-relative w-100">
        <select name="budget" id="budget" class="select2" required>
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
    <div class="col-md-12 d-flex flex-column flex-xl-row align-items-xl-center gap-xl-5">
      <div class="wdl-label-aside"><?php _e('รู้จักงานนี้จากช่องทางไหน', 'wdl')?>&nbsp;<span class="text-red">*</span></div>
      <div class="position-relative w-100">
        <select name="channel" id="channel" class="select2" required>
          <option selected disabled>เลือกช่องทาง</option>
          <option>Facebook / Instagram Weddinglist</option>
          <option>เพื่อนแนะนำ</option>
          <option>เว็บไซต์ Weddinglist.co.th</option>
          <option>เว็บไซต์อื่น ๆ / Webblog</option>
          <option>โฆษณาออนไลน์ (Google, YouTube, etc.)</option>
          <option>ป้ายโฆษณา</option>
          <option>อื่น ๆ</option>
        </select>
      </div>
    </div>
  </div>
  <div class="col-md-12 card p-3 rounded-4 mb-4">
    <div class="fw-semibold mb-3"><?php _e('ประเภทของบริการที่สนใจ', 'wdl')?>&nbsp;<span class="text-red">*</span></div>
    <div class="row row-cols-1 row-cols-md-2 g-2">
      <div class="wdl-checkbox col">
        <input type="checkbox" name="interest" data-checkbox-group="interest" id="interest-1" value="โรงแรมหรือสถานที่จัดงานแต่ง" required/>
        <label for="interest-1"><?php _e('โรงแรมหรือสถานที่จัดงานแต่ง', 'wdl')?></label>
      </div>
      <div class="wdl-checkbox col">
        <input type="checkbox" name="interest" data-checkbox-group="interest" id="interest-2" value="ร้านชุดแต่งงาน" required/>
        <label for="interest-2"><?php _e('ร้านชุดแต่งงาน', 'wdl')?></label>
      </div>
      <div class="wdl-checkbox col">
        <input type="checkbox" name="interest" data-checkbox-group="interest" id="interest-3" value="Organizer / Wedding Planner" required/>
        <label for="interest-3"><?php _e('Organizer / Wedding Planner', 'wdl')?></label>
      </div>
      <div class="wdl-checkbox col">
        <input type="checkbox" name="interest" data-checkbox-group="interest" id="interest-4" value="ร้านแหวนแต่งงานและจิวเวลรี่" required/>
        <label for="interest-4"><?php _e('ร้านแหวนแต่งงานและจิวเวลรี่', 'wdl')?></label>
      </div>
      <div class="wdl-checkbox col">
        <input type="checkbox" name="interest" data-checkbox-group="interest" id="interest-5" value="ช่างภาพ / วิดีโอ" required/>
        <label for="interest-5"><?php _e('ช่างภาพ / วิดีโอ', 'wdl')?></label>
      </div>
      <div class="wdl-checkbox col">
        <input type="checkbox" name="interest" data-checkbox-group="interest" id="interest-6" value="ของชำร่วย / การ์ดแต่งงาน" required/>
        <label for="interest-6"><?php _e('ของชำร่วย / การ์ดแต่งงาน', 'wdl')?></label>
      </div>
      <div class="wdl-checkbox col">
        <input type="checkbox" name="interest" data-checkbox-group="interest" id="interest-7" value="Photo Booth & Interactive Entertainment" required/>
        <label for="interest-7"><?php _e('Photo Booth & Interactive Entertainment', 'wdl')?></label>
      </div>
      <div class="wdl-checkbox col">
        <input type="checkbox" name="interest" data-checkbox-group="interest" id="interest-8" value="Beauty / Makeup / Hairdo" required/>
        <label for="interest-8"><?php _e('Beauty / Makeup / Hairdo', 'wdl')?></label>
      </div>
      <div class="wdl-checkbox col">
        <input type="checkbox" name="interest" data-checkbox-group="interest" id="interest-9" value="Pre-wedding Travel / Honeymoon Package" required/>
        <label for="interest-9"><?php _e('Pre-wedding Travel / Honeymoon Package', 'wdl')?></label>
      </div>
      <div class="wdl-checkbox col">
        <input type="checkbox" name="interest" data-checkbox-group="interest" id="interest-10" value="ธุรกิจเกี่ยวกับการเงิน / บัตรเครดิต / สินเชื่อ" required/>
        <label for="interest-10"><?php _e('ธุรกิจเกี่ยวกับการเงิน / บัตรเครดิต / สินเชื่อ', 'wdl')?></label>
      </div>
      <?php /* <div class="wdl-checkbox col">
        <input type="checkbox" name="interest" data-checkbox-group="interest" id="interest-11" value="อื่นๆ (โปรดระบุ" required/>
        <label for="interest-11"><?php _e('อื่นๆ (โปรดระบุ)', 'wdl')?></label>
      </div> */ ?>
    </div>
  </div>
  <div class="col-md-12 gap-3">
    <label for="province"><?php _e('ภูมิลำเนา', 'wdl')?><span class="text-red">*</span></label>
    <div class="position-relative w-100">
      <select name="province" id="province" class="select2" required>
        <option selected disabled>เลือกจังหวัด</option><option value="กรุงเทพมหานคร">กรุงเทพมหานคร</option>
        <option value="กระบี่">กระบี่ </option>
        <option value="กาญจนบุรี">กาญจนบุรี </option>
        <option value="กาฬสินธุ์">กาฬสินธุ์ </option>
        <option value="กำแพงเพชร">กำแพงเพชร </option>
        <option value="ขอนแก่น">ขอนแก่น</option>
        <option value="จันทบุรี">จันทบุรี</option>
        <option value="ฉะเชิงเทรา">ฉะเชิงเทรา </option>
        <option value="ชัยนาท">ชัยนาท </option>
        <option value="ชัยภูมิ">ชัยภูมิ </option>
        <option value="ชุมพร">ชุมพร </option>
        <option value="ชลบุรี">ชลบุรี </option>
        <option value="เชียงใหม่">เชียงใหม่ </option>
        <option value="เชียงราย">เชียงราย </option>
        <option value="ตรัง">ตรัง </option>
        <option value="ตราด">ตราด </option>
        <option value="ตาก">ตาก </option>
        <option value="นครนายก">นครนายก </option>
        <option value="นครปฐม">นครปฐม </option>
        <option value="นครพนม">นครพนม </option>
        <option value="นครราชสีมา">นครราชสีมา </option>
        <option value="นครศรีธรรมราช">นครศรีธรรมราช </option>
        <option value="นครสวรรค์">นครสวรรค์ </option>
        <option value="นราธิวาส">นราธิวาส </option>
        <option value="น่าน">น่าน </option>
        <option value="นนทบุรี">นนทบุรี </option>
        <option value="บึงกาฬ">บึงกาฬ</option>
        <option value="บุรีรัมย์">บุรีรัมย์</option>
        <option value="ประจวบคีรีขันธ์">ประจวบคีรีขันธ์ </option>
        <option value="ปทุมธานี">ปทุมธานี </option>
        <option value="ปราจีนบุรี">ปราจีนบุรี </option>
        <option value="ปัตตานี">ปัตตานี </option>
        <option value="พะเยา">พะเยา </option>
        <option value="พระนครศรีอยุธยา">พระนครศรีอยุธยา </option>
        <option value="พังงา">พังงา </option>
        <option value="พิจิตร">พิจิตร </option>
        <option value="พิษณุโลก">พิษณุโลก </option>
        <option value="เพชรบุรี">เพชรบุรี </option>
        <option value="เพชรบูรณ์">เพชรบูรณ์ </option>
        <option value="แพร่">แพร่ </option>
        <option value="พัทลุง">พัทลุง </option>
        <option value="ภูเก็ต">ภูเก็ต </option>
        <option value="มหาสารคาม">มหาสารคาม </option>
        <option value="มุกดาหาร">มุกดาหาร </option>
        <option value="แม่ฮ่องสอน">แม่ฮ่องสอน </option>
        <option value="ยโสธร">ยโสธร </option>
        <option value="ยะลา">ยะลา </option>
        <option value="ร้อยเอ็ด">ร้อยเอ็ด </option>
        <option value="ระนอง">ระนอง </option>
        <option value="ระยอง">ระยอง </option>
        <option value="ราชบุรี">ราชบุรี</option>
        <option value="ลพบุรี">ลพบุรี </option>
        <option value="ลำปาง">ลำปาง </option>
        <option value="ลำพูน">ลำพูน </option>
        <option value="เลย">เลย </option>
        <option value="ศรีสะเกษ">ศรีสะเกษ</option>
        <option value="สกลนคร">สกลนคร</option>
        <option value="สงขลา">สงขลา </option>
        <option value="สมุทรสาคร">สมุทรสาคร </option>
        <option value="สมุทรปราการ">สมุทรปราการ </option>
        <option value="สมุทรสงคราม">สมุทรสงคราม </option>
        <option value="สระแก้ว">สระแก้ว </option>
        <option value="สระบุรี">สระบุรี </option>
        <option value="สิงห์บุรี">สิงห์บุรี </option>
        <option value="สุโขทัย">สุโขทัย </option>
        <option value="สุพรรณบุรี">สุพรรณบุรี </option>
        <option value="สุราษฎร์ธานี">สุราษฎร์ธานี </option>
        <option value="สุรินทร์">สุรินทร์ </option>
        <option value="สตูล">สตูล </option>
        <option value="หนองคาย">หนองคาย </option>
        <option value="หนองบัวลำภู">หนองบัวลำภู </option>
        <option value="อำนาจเจริญ">อำนาจเจริญ </option>
        <option value="อุดรธานี">อุดรธานี </option>
        <option value="อุตรดิตถ์">อุตรดิตถ์ </option>
        <option value="อุทัยธานี">อุทัยธานี </option>
        <option value="อุบลราชธานี">อุบลราชธานี</option>
        <option value="อ่างทอง">อ่างทอง </option>
      </select>
    </div>
  </div>


  <div class="col-md-12">
    <div class="wdl-checkbox p-0 m-0 my-3 my-xl-4">
      <input type="checkbox" name="consentDisclosure" id="consentDisclosure" required>
      <label for="consentDisclosure" class="d-flex gap-2 align-items-center justify-content-start">
        <span>ข้าพเจ้ายินยอมให้เปิดเผยข้อมูลส่วนบุคคลแก่พาร์ทเนอร์และผู้ร่วมออกบูธในงาน Thailand Weddinglist 2026 เพื่อวัตถุประสงค์ทางการตลาด การนำเสนอสิทธิพิเศษ โปรโมชั่น สิทธิ์ลุ้นรางวัล และข่าวสารที่เกี่ยวข้อง <span class="text-red">*</span> <a target="_blank" class="fw-light" href="<?php echo home_url( '/privacy-policy/' ) ?>">อ่านเพิ่มเติมเกี่ยวกับนโยบายความเป็นส่วนตัว</a></span>
      </label>
    </div>
  </div>
  
  <button id="businessSignUp-submit" type="submit"  name="tw2026_form_submit" value="1" class="wdl-btn-lg wdl-form-submit mt-3 w-100">
    <span class="loader" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M232,128a104,104,0,0,1-208,0c0-41,23.81-78.36,60.66-95.27a8,8,0,0,1,6.68,14.54C60.15,61.59,40,93.27,40,128a88,88,0,0,0,176,0c0-34.73-20.15-66.41-51.34-80.73a8,8,0,0,1,6.68-14.54C208.19,49.64,232,87,232,128Z"></path></svg></span>
    <?php _e('ลงทะเบียน','wdl')?>
  </button>
</form>