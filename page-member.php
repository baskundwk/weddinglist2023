<?php restrict_page(false, false) ?>
<?php include get_stylesheet_directory() . '/components/header.php' ?>
<main>
  <section class="wdl-member-login-section">
    <div class="container">
      <div class="wdl-member-login-box">
        <div class="member-form">
          <?php wp_nonce_field('member_login_action', 'member_login_nonce'); ?>
          <input type="hidden" name="member_username_hidden" id="member_username_hidden" value="" />

          <div class="member-step member-step-username">
            <div class="h2 text-center mb-3">เข้าสู่ระบบสมาชิก</div>
            <div class="row row-cols-2 mb-3 g-2">
              <div class="col">
                <div class="card p-3 d-flex gap-2 align-content-center justify-content-center text-center">
                  <div class="text-red"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M178,40c-20.65,0-38.73,8.88-50,23.89C116.73,48.88,98.65,40,78,40a62.07,62.07,0,0,0-62,62c0,70,103.79,126.66,108.21,129a8,8,0,0,0,7.58,0C136.21,228.66,240,172,240,102A62.07,62.07,0,0,0,178,40ZM128,214.8C109.74,204.16,32,155.69,32,102A46.06,46.06,0,0,1,78,56c19.45,0,35.78,10.36,42.6,27a8,8,0,0,0,14.8,0c6.82-16.67,23.15-27,42.6-27a46.06,46.06,0,0,1,46,46C224,155.61,146.24,204.15,128,214.8Z"></path></svg></div>
                  <div class="text-14 text-center">
                    <div class="fw-semibold">รายการโปรด</div>
                    <div class="fw-normal">บันทึกรายการที่คุณสนใจ</div>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="card p-3 d-flex gap-2 align-content-center justify-content-center text-center">
                  <div class="text-red"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M232,104a8,8,0,0,0,8-8V64a16,16,0,0,0-16-16H32A16,16,0,0,0,16,64V96a8,8,0,0,0,8,8,24,24,0,0,1,0,48,8,8,0,0,0-8,8v32a16,16,0,0,0,16,16H224a16,16,0,0,0,16-16V160a8,8,0,0,0-8-8,24,24,0,0,1,0-48ZM32,167.2a40,40,0,0,0,0-78.4V64H88V192H32Zm192,0V192H104V64H224V88.8a40,40,0,0,0,0,78.4Z"></path></svg></div>
                  <div class="text-14 text-center">
                    <div class="fw-semibold">สิทธิพิเศษเฉพาะสมาชิก</div>
                    <div class="fw-normal">(เร็ว ๆ นี้)</div>
                  </div>
                </div>
              </div>
            </div>
            <form class="form-login">
              <label for="member_username">E-mail</label>
              <input type="text" name="member_username" id="member_username" />
              <div class="pt-4 d-flex flex-column gap-2">
                <button class="wdl-btn-lg btn-next btn-password" type="submit">เข้าสู่ระบบ</button>
                <div class="d-flex gap-2">
                  <button class="flex-grow-1 flex-shrink-1 wdl-btn-secondary btn-go-register" type="button" data-to-step="register">สมัครสมาชิก</button>
                  <button class="flex-grow-1 flex-shrink-1 wdl-link btn-go-forgot text-sm" type="button" data-to-step="forgot">ลืมรหัสผ่าน</button>
                </div>
              </div>
            </form>
          </div>

          <div class="member-step member-step-forgot d-none">
            <div class="h2 text-center mb-3">ลืมรหัสผ่าน</div>
            <form class="form-forgot">
              <label for="member_forgot_username">E-mail</label>
              <input type="text" name="member_forgot_username" id="member_forgot_username" />
              <div class="pt-4 d-flex flex-column gap-3">
                <button class="wdl-btn-lg btn-next btn-password" type="submit">ยืนยันตัวตน</button>
              </div>
            </form>
          </div>

          <div class="member-step member-step-password d-none">
            <div class="h2 text-center mb-3">เข้าสู่ระบบสมาชิก</div>
            <form class="form-password">
              <div class="user-info mb-3">
                <!-- <div class="h3 text-center">สวัสดีค่ะ</div> -->
                <!-- <img class="login-display-image" src="https://www.weddinglist.co.th/wp-content/themes/weddinglist2023/images/avatar.svg" alt=""> -->
                <div class="user-info-text">
                  <div class="text-red login-display-email fw-semibold">...email...</div>
                  <!-- <div class="text-sm login-display-type">...type...</div> -->
                </div>
              </div>
              <label for="member_password">รหัสผ่าน</label>
              <input type="password" name="member_password" id="member_password" />
              <div class="pt-4 d-flex flex-column gap-3">
                <button class="wdl-btn-lg btn-login" type="submit">เข้าสู่ระบบ</button>
              </div>
            </form>
          </div>

          <div class="member-step member-step-verify d-none">
            <div class="h2 text-center mb-3">เข้าสู่ระบบสมาชิก</div>
            <form class="form-verify">
              <div class="user-info mb-3">
                <div class="h3 text-center">
                  <strong>เราได้ส่งรหัส OTP ไปยังอีเมลของคุณแล้ว</strong><br />
                  <span class="fw-normal">กรุณากรอกรหัสที่ท่านได้รับ</span>
                </div>
                <!-- <img class="login-display-image" src="<?php echo get_template_directory_uri() . '/images/avatar.svg'?>" alt=""> -->
                <div class="text-red login-display-email fw-semibold"></div>
              </div>
              <label for="member_otp">รหัส OTP</label>
              <input type="text" name="member_otp" id="member_otp" />
              <div class="pt-4 d-flex flex-column gap-3">
                <button class="wdl-btn-lg btn-next btn-confirmotp" type="submit">ยืนยันตัวตน</button>
              </div>
            </form>
          </div>

          <div class="member-step member-step-setpassword d-none">
            <div class="h2 text-center mb-3">เข้าสู่ระบบสมาชิก</div>
            <form class="form-setpassword">
              <div class="user-info mb-3">
                <div class="h3">ตั้งรหัสผ่าน</div>
                <!-- <img class="login-display-image" src="<?php echo get_template_directory_uri() . '/images/avatar.svg'?>" alt=""> -->
                <div class="text-red login-display-email fw-semibold">...email...</div>
              </div>
              <div class="mb-3">
                <label for="member_setpassword">รหัสผ่าน</label>
                <input type="password" name="member_setpassword" id="member_setpassword" />
              </div>
              <div class="mb-3">
                <label for="member_setconfirm">ยืนยันรหัสผ่าน</label>
                <input type="password" name="member_setconfirm" id="member_setconfirm" />
              </div>
              <div class="pt-4 d-flex flex-column gap-3">
                <button class="wdl-btn-lg btn-next btn-setpassword" type="submit">เข้าสู่ระบบ</button>
              </div>
            </form>
          </div>

          <div class="member-step member-step-register d-none">
            <div class="h2 text-center mb-3">สมัครสมาชิก</div>
            <form class="form-register">
              <!-- <div class="h3">สมัครสมาชิก</div>
  
              <label class="wdl-file-upload">
                <img class="image-preview" src="<?php echo get_template_directory_uri() . '/images/avatar.svg'?>" alt="">
                <div class="d-flex flex-column gap-2 align-content-start">
                  <input type="file" name="member_register_profile_image" id="member_register_profile_image" accept="image/*">
                  <div class="wdl-btn">เลือกรูปโปรไฟล์</div>
                  <div class="text">
                    ขนาดไม่เกิน 2 MB<br/>
                    รองรับไฟล์นามสกุล JPG, PNG, GIF, WEBP
                  </div>
                </div>
              </label> -->
  
              <div class="mb-3">
                <label for="member_register_name">ชื่อ - นามสกุล <span class="text-red">*</span></label>
                <input type="text" name="member_register_name" id="member_register_name" />
              </div>
              <div class="mb-3">
                <label for="member_register_email">E-mail <span class="text-red">*</span></label>
                <input type="email" name="member_register_email" id="member_register_email" />
              </div>
              <?php /* 
              <div class="mb-3">
                <label for="member_register_password">รหัสผ่าน <span class="text-red">*</span></label>
                <input type="password" name="member_register_password" id="member_register_password" />
              </div>
              <div class="mb-3">
                <label for="member_register_password_confirm">ยืนยันรหัสผ่าน <span class="text-red">*</span></label>
                <input type="password" name="member_register_password_confirm" id="member_register_password_confirm" />
              </div> */ ?>
              <div class="pt-4 d-flex flex-column gap-3">
                <button class="wdl-btn-lg btn-register" type="submit">สมัครสมาชิก</button>
              </div>
            </form>
          </div>

        </div>


        <?php if (!empty($_GET['status'])) : ?>
          <div class="mt-3 text-center text-red text-sm fw-semibold">
            <hr class="mb-3" />
            <?php if (!empty($_GET['status']) && $_GET['status'] === 'failed') : ?>
              <div class="member-login-message">เกิดข้อผิดพลาด เข้าสู่ระบบไม่สำเร็จ กรุณาลองใหม่</div>
            <?php endif; ?>
            <?php if (!empty($_GET['status']) && $_GET['status'] === 'failed_login') : ?>
              <div class="member-login-message">อีเมลหรือรหัสผ่านไม่ถูกต้อง กรุณาลองใหม่</div>
            <?php endif; ?>
            <?php if (!empty($_GET['status']) && $_GET['status'] === 'failed_verify') : ?>
              <div class="member-login-message">ยืนยันตัวตนไม่สำเร็จ กรุณาลองใหม่</div>
            <?php endif; ?>
            <?php if (!empty($_GET['status']) && $_GET['status'] === 'failed_setpassword') : ?>
              <div class="member-login-message">ยืนยันรหัสผ่านไม่ถูกต้อง กรุณาลองใหม่</div>
            <?php endif; ?>
            <?php if (!empty($_GET['status']) && $_GET['status'] === 'pending') : ?>
              <div class="member-login-message">กรุณายืนยันตัวตนผ่านอีเมล</div>
            <?php endif; ?>
            <?php if (!empty($_GET['status']) && $_GET['status'] === 'banned') : ?>
              <div class="member-login-message">บัญชีของคุณถูกระงับ กรุณาติดต่อผู้ดูแลระบบ</div>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>
</main>

<?php include get_stylesheet_directory() . '/components/footer.php' ?>