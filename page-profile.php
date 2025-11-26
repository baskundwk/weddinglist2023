
<?php restrict_page(true, true) ?>
<?php include get_stylesheet_directory() . '/components/header.php' ?>
<?php $memberData = get_current_member_data();?>
<main class="py-2">
  <section class="py-4">
    <div class="container">
      <div class="d-flex gap-4 flex-column flex-lg-row align-items-lg-start">
        <?php include get_stylesheet_directory() . '/components/member-sidebar.php' ?>
        <div class="flex-fill">
          <h1><?php the_title(); ?></h1>

          <?php if (isset($_GET['status']) && $_GET['status'] === 'failed'): ?>
            <div class="alert alert-danger w-100 mb-3">กรุณากรอกข้อมูลให้ครบถ้วน</div>
          <?php endif; ?>
          <?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
            <div class="alert alert-success w-100 mb-3">บันทึกข้อมูลสำเร็จ</div>
          <?php endif; ?>
          
          <form class="d-flex flex-column gap-3" method="POST" enctype="multipart/form-data" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">
            <input type="hidden" name="action" value="update_profile" />
            <?php /* <label class="wdl-file-upload">
              <img class="image-preview" src="<?php echo esc_attr($memberData['image']); ?>" alt="">
              <div class="d-flex flex-column gap-2 align-content-start">
              <input type="file" name="MemberProfileImage" id="MemberProfileImage" accept="image/*">
              <div class="wdl-btn">เลือกรูปโปรไฟล์</div>
              <div class="text">
                ขนาดไม่เกิน 2 MB<br/>
                รองรับไฟล์นามสกุล JPG, PNG, GIF, WEBP
              </div>
              </div>
            </label> */ ?>
             
            <label>
              <span>ชื่อ - นามสกุล <span class="text-red">*</span></span>
              <input type="text" name="MemberProfileName" id="MemberProfileName" value="<?php echo esc_attr($memberData['name']); ?>">
            </label>
             
            <label>
              <span>Email <span class="text-red">*</span></span>
              <input type="email" name="MemberProfileEmail" id="MemberProfileEmail" value="<?php echo esc_attr($memberData['email']); ?>" readonly disabled>
            </label>
             
            <div class="d-flex gap-4">
              <label class="flex-fill">
              <span>รหัสผ่าน <span class="fw-normal opacity-50">เว้นว่างหากไม่ต้องการเปลี่ยนแปลง</span> <span class="text-red">*</span></span>
              <input type="password" name="MemberProfilePassword" id="MemberProfilePassword">
              </label>
              <label class="flex-fill">
              <span>ยืนยันรหัสผ่าน <span class="text-red">*</span></span>
              <input type="password" name="MemberProfilePasswordConfirm" id="MemberProfilePasswordConfirm">
              </label>
            </div>
            <div class="pt-4">
              <button type="submit" class="d-block wdl-btn-lg w-auto mx-auto">บันทึกการเปลี่ยนแปลง</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</main>
<?php include get_stylesheet_directory() . '/components/footer.php' ?>
