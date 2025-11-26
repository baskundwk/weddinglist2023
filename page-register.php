<?php
  //$hideNav = true;
  include get_stylesheet_directory().'/components/header.php';
?>
<?php if(isset($_GET['id']) && !empty($_GET['id']) && get_posts([
  'post_type' => 'tw-lead',
  'post__in' => [intval($_GET['id'])]
])): 
$data = get_posts([
  'post_type' => 'tw-lead',
  'post__in' => [intval($_GET['id'])]
])[0];
?>
  <main>
    <section class="wdl-tw2026-register" style="background-image: url('/wp-content/uploads/2025/11/register-bg.jpg')">
      <div class="container position-relative z-1">
        <div class="card form-card rounded-5 mb-3 h-auto">
            <div class="card-body">
              <div class="mb-3">
                <img class="rounded-4"
                      src="/wp-content/uploads/2025/11/tw2026-Rewards-banner-Revised.jpg"
                      alt="hero banner" />
              </div>
              <h1 class="text-center">ขอบคุณสำหรับการลงทะเบียน</h1>
              <p class="text-center fw-semibold text-red">โปรดแสดงหน้านี้ หรือบันทึกหน้าจอหน้านี้ไว้<br/>เพื่อเป็นหลักฐานการลงทะเบียนแสดงต่อเจ้าหน้าที่ในงาน<br/> Thailand Weddinglist 2026</p>
              <div>
                <p class="fs-6 mb-2">รหัสลงทะเบียน: <strong>TW2026-<?php echo $_GET['id'] ?></strong></p>
                <p class="fs-6 mb-2">วันเวลาที่ลงทะเบียน: <strong><?php echo esc_html(get_the_date('d M Y H:i:s', $data->ID)); ?></strong></p>
                <p class="fs-6 mb-2">ชื่อ: <strong><?php echo esc_html($data->post_title); ?></strong></p>
                <p class="fs-6 mb-2">อีเมล: <strong><?php echo esc_html(get_post_meta($data->ID, 'contactEmail', true)); ?></strong></p>
              </div>
            </div>
        </div>
      </div>
    </section>
  </main>
<?php else : ?>
  <main>
    <section class="wdl-tw2026-register" style="background-image: url('/wp-content/uploads/2025/11/register-bg.jpg')">
      <div class="container-xl position-relative z-1">
        <div class="card form-card rounded-4 mb-3 h-auto">
          <div class="card-body">
            <div class="wdl-single-thumbnail pb-3">
              <img class="mx-auto" style="max-height: 350px; width: auto;" src="/wp-content/uploads/2025/10/Weddinglist-Rewards-graphic-page.jpg" alt="">
            </div>
            <h1 class="fs-3 fw-medium mt-3 mb-4 text-center"><?php the_title(); ?></h1>
            <div class="alert fw-normal">
              <p class="mb-1 fw-semibold text-red">งานใหญ่สำหรับคู่รัก Thailand Weddinglist 2026 - The Canvas of Love and Wedding Destination</p>
              <p class="mb-3">วันที่ 24-25 มกราคม 2569 ณ ศูนย์การประชุมแห่งชาติสิริกิติ์</p>
  
              <p class="mb-1">พิเศษ! เพียงลงทะเบียนล่วงหน้า... <strong>รับฟรี! ของที่ระลึกสุดพรีเมียม 3 รายการ</strong> ที่จุดลงทะเบียน</p>
              <ol>
                <li>กรอบรูปสุดพิเศษ (พร้อมถ่ายรูปในงาน ฟรี ! - จำนวนจำกัด)</li>
                <li>Mobile Wish ฟรี! ระบบสร้างคำอวยพรออนไลน์ผ่าน QR Code พร้อมเทมเพลตสุดเก๋</li>
                <li>Weddinglist Passport ร่วมสนุกสะสมแสตมป์ แลกของรางวัลสุดพิเศษภายในงาน</li>
              </ol>
              <p class="mb-1">เพียง <strong class="text-red">"แคปหน้าจอข้อความ หรือ E-mail"</strong> เพื่อยืนยันการลงทะเบียนของคุณ แล้วนำไปแสดงที่จุดลงทะเบียนในวันงาน รับของที่ระลึกทั้งหมดได้เลย !</p>
              <p>พิเศษยิ่งขึ้น! <strong>แลกรับของสมนาคุณตามยอดใช้จ่าย และรับสิทธิ์ชิงรางวัลใหญ่มูลค่าสูงสุดภายในงาน</strong></p>
              <div class="col"><?php the_content(  )?></div>
            </div>
            <hr class="my-3"/>
            <?php include get_stylesheet_directory().'/components/tw2026/form-register.php' ?>
          </div>
        </div>
      </div>
    </section>
  
    <div id="modal-thankyou" class="modal fade">
      <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-md-down">
        <div class="modal-content mb-0">
          <button class="btn-close" data-bs-dismiss="modal"></button>
          <div class="modal-body text-center">
            <div class="py-4">
              <img class="mb-4" src="<?php echo(get_theme_file_uri() . '/images/logo.png') ?>" alt="Weddinglist" width="180" height="43">
              <p class="h2 text-red"><?php _e('ลงทะเบียนสำเร็จ ขอบคุณค่ะ','wdl') ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
<?php endif; ?>

<?php include get_stylesheet_directory().'/components/footer.php' ?>