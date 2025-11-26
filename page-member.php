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