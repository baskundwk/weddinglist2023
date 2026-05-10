<?php $hideCTA = true; ?>
<?php
//$hideNav = true;
include get_stylesheet_directory() . '/components/header.php';
?>
<?php if (isset($_GET['id']) && !empty($_GET['id']) && get_posts([
  'post_type' => 'tw-lead',
  'post__in' => [intval($_GET['id'])]
])):
  $data = get_posts([
    'post_type' => 'tw-lead',
    'post__in' => [intval($_GET['id'])]
  ])[0];
?>
  <!-- Event snippet for Form conversion page -->
  <script>
    gtag('event', 'conversion', {'send_to': 'AW-16540240935/Vmx4CI7w3MEZEKeYgM89'});
  </script>
  <main>
    <section class="wdl-tw2026-register" style="background-image: url('/wp-content/uploads/2025/11/register-bg.jpg')">
      <div class="container position-relative z-1">
        <div class="card form-card rounded-5 mb-3 h-auto">
          <div class="card-body font-mitr">
            <div class="mb-3">
              <img class="rounded-4"
                src="/wp-content/uploads/2025/12/Rewards-banner-Revised-02-12-2025.jpg"
                alt="hero banner" />
            </div>
            <h1 class="text-center">ขอบคุณสำหรับการลงทะเบียน</h1>
            <p class="text-center fw-semibold text-red">โปรดแสดงหน้านี้ หรือบันทึกหน้าจอหน้านี้ไว้<br />เพื่อเป็นหลักฐานการลงทะเบียนแสดงต่อเจ้าหน้าที่ในงาน<br /> Thailand Weddinglist 2026</p>
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
  <main class="wdl-tw2026-register d-flex align-items-center justify-content-center" style="background-image: url('/wp-content/uploads/2025/11/register-bg.jpg')">
    <section class="w-100">
      <div class="container-xl position-relative z-1">
        <div class="card form-card rounded-4 mb-3 h-auto">
          <div class="card-body font-mitr text-center">
            <!-- <div class="wdl-single-thumbnail pb-lg-3">
              <img class="mx-auto" style="max-height: 350px; width: auto;" src="/wp-content/uploads/2025/12/Rewards-banner-Revised-02-12-2025.jpg" alt="">
            </div> -->
            <?php /* <h1 class="display-6 fw-medium mt-3 mb-4 text-center font-mitr">ลงทะเบียนรับสิทธ์ก่อนใคร!<br />ลุ้นรางวัลใหญ่ <word class="text-red">"จัดงานแต่งฟรี"</word></h1>
            <p class="mb-3 text-center">
              "ยิ่งใหญ่สะเทือนวงการ" มาร่วมลุ้นเป็น
              <word>The Lucky Couple</word> เพียงหนึ่งเดียว <br/>
              <span class="text-red fw-bold fs-5">ที่จะคว้า Your Dream Wedding!</span> <br/>
              พร้อมกองทัพของรางวัลและของสมนาคุณกว่า 1,000 รายการ <br/><word class="fw-bold fs-5 text-red">รวมมูลค่า 2,000,000 บาท!</word><br/>
              (จับรางวัล 1,300,000 บาท และของสมนาคุณ 700,000 บาท)
            </p>
            <table class="mx-auto my-3 table table-borderless bg-gray rounded-3" cellpadding="12" style="max-width: 800px; width: 100%;">
              <tr>
                <td class="text-red" valign="top">ช้อปครบ 3,000 บาท</td>
                <td valign="top">รับคูปองลุ้นชิงโชครางวัลใหญ่แห่งปี The Grond Prize<br/>
                รางวัลพิเศษ Special Prize และรางวัลอื่นๆ (จำกัดสูงสุด 10 ใบ/ท่าน ตลอดรายการ)</td>
              </tr>
              <tr>
                <td class="text-red" valign="top">ช้อปครบ 10,000 บาท</td>
                <td valign="top">รับเพิ่มกระเป๋า Summer Bag Limited Edition<br/>
                จำกัด 1 สิทธิ์/ท่าน ตลอดรายการ (มีจำนวนวนจำกัด)</td>
              </tr>
            </table>
            <div class="bg-red rounded-4 p-3 mb-4 text-center mx-auto" style="width: fit-content;">
              <div class="wdl-campaign-countdown justify-content-center" data-date="2026-01-24T10:00:00+07:00">
                <div class="unit day">
                  <div class="number loading"></div>
                  <div class="suffix"><?php _e('วัน', 'wdl') ?></div>
                </div>
                <div class="separator">
                  :
                </div>
                <div class="unit hour">
                  <div class="number loading"></div>
                  <div class="suffix"><?php _e('ชม.', 'wdl') ?></div>
                </div>
                <div class="separator">
                  :
                </div>
                <div class="unit minute">
                  <div class="number loading"></div>
                  <div class="suffix"><?php _e('นาที', 'wdl') ?></div>
                </div>
                <div class="separator">
                  :
                </div>
                <div class="unit second">
                  <div class="number loading"></div>
                  <div class="suffix"><?php _e('วินาที', 'wdl') ?></div>
                </div>
              </div>
            </div>
            <div class="alert fw-normal w-100 mb-3">
              <p class="fw-bold mb-0">🎁 ลงทะเบียนล่วงหน้า <span class="text-red">รับฟรี! WELCOME GIFT 2 รายการ</span></p>
              <ul>
                <li>📸 กรอบรูป "บันทึกรัก" พร้อมถ่ายภาพฟรี! 📍 ที่บูธ Goat Photobooth หรือ IDO360 Video Booth</li>
                <li>📱 Mobile Wish 💌 การ์ดอวยพรออนไลน์ Photobook สุดล้ำ จาก Photo Wish</li>
              </ul>
              <p><strong>เพียงแคปหน้าจอยืนยันการลงทะเบียน มารับที่หน้างาน ได้เลย!</strong></p>

              <hr>

              <p class="mb-3">
                <strong class="text-red">👜 Wedding Passport Challenge</strong><br />
                เดินชิลล์ในงาน สะสมสแตมป์ครบ 15 ดวง 👉 แลกรับฟรี! “Chic Mesh Bag” ดีไซน์เก๋ ไม่ซ้ำใคร (จำกัดเพียง 200 ใบ/วัน เท่านั้น)
              </p>

              <hr>

              <p class="mb-3">
                <strong class="text-red">ลุ้น "รางวัลใหญ่ และ รางวัลพิเศษ” </strong>
              </p>
              <p class="text-red fw-bold mb-0">🏆 รางวัลใหญ่แห่งปี (The Grand Prize)</p>
              <ul>
                <li>💒  แพ็กเกจจัดงานแต่งงานฟรี! ที่ St.Tropez มูลค่า 260,000 บาท ✦ จำนวน 1 รางวัล</li>
              </ul>
              <p class="text-red fw-bold mb-0">✨ รางวัลพิเศษ (Special Prize)</p>
              <ul>
                <li>👰🤵 MONIQUE Wedding แพ็กเกจ Prestige Edition เช่าตัดชุดแต่งงานสำหรับเจ้าบ่าว-เจ้าสาว มูลค่า 250,000 บาท จำนวน 1 รางวัล</li>
                <li>🏨 137 Pillars House Chiang Mai ห้องพัก Rajah Brooke Suite 2 คืน รวมอาหารเช้าสำหรับ 2 ท่าน มูลค่า 50,000 บาท จำนวน 1 รางวัล</li>
                <li>👰🤵 The Classic Studio & Planner แพ็กเกจเช่าชุดแต่งงาน เจ้าบ่าว-เจ้าสาว 1 เซ็ท มูลค่า 50,000 บาท จำนวน 2 รางวัล</li>
                <li>🏙️ Rosewood Bangkok ห้องพัก Deluxe Room 2 คืน รวมอาหารเช้าสำหรับ 2 ท่าน มูลค่า 35,000 บาท จำนวน 1 รางวัล</li>
                <li>⛰️ Intercontinental Khao Yai ห้องพัก Premium Terrace 1 คืน รวมอาหารเช้าและแพ็กเกจสปา 60 นาทีสำหรับ 2 ท่าน มูลค่า 33,000 บาท จำนวน 1 รางวัล </li>
                <li>🏰 Mövenpick Resort Khao Yai Voucher Pre-Wedding และ ห้องพัก 1 คืน รวมอาหารเช้าสำหรับ 2 ท่าน มูลค่า 30,000 บาท จำนวน 1 รางวัล</li>
                <li>🌊 The Culture Samui Resort ห้องพัก Deluxe Seaview 2 คืน รวมอาหารเช้าสำหรับ 2 ท่าน และมื้อค่ำชุดอาหารไทย 1 มื้อ ณ ห้องอาหาร Mui Mui Eat & Mee สำหรับ 2 ท่าน มูลค่า 20,000 บาท จำนวน 1 รางวัล</li>
              </ul>

              <hr>

              <p class="mb-0"><strong class="text-red">🎁 และของรางวัลอื่นๆอีกมากมาย</strong></p>
              <ul>
                <li>Voucher ที่พัก / ดินเนอร์ / สปา สำหรับทริปฮันนีมูน</li>
                <li>"Summer Bag Limited Edition" กระเป๋าใบใหญ่ ใส่ของจุใจ (มีจำนวนจำกัด)</li>
              </ul>
              <p><span class="text-red">Canvas of Love & Wedding Destination</span> ครบที่สุด คุ้มที่สุด ง่ายที่สุด สบายที่สุด รังสรรค์แรงบันดาลใจ ครบทุกดีล ที่สุดของงานแต่งในฝัน เปลี่ยนการเตรียมงานแต่งที่วุ่นวายให้ง่ายที่สุด...ที่งานนี้งานเดียว</p>
              <a class="wdl-link" href="https://www.weddinglist.co.th/wp-content/uploads/2026/01/รายละเอียดของรางวัลทั้งหมด.pdf" target="_blank" rel="noopener noreferrer">[PDF] ดูรายละเอียดของรางวัลทั้งหมด (ใบอนุญาต ปค. เลขที่ 94/2569)</a>
            </div>
            <?php /* include get_stylesheet_directory() . '/components/tw2026/form-register.php' */ ?>
            <h1>ลงทะเบียนงาน Thailand Weddinglist 2026</h1>
            <p>การลงทะเบียนและงาน Thailand Weddinglist 2026 ได้สิ้นสุดลงแล้ว<br/>
            แล้วพบกันใหม่ปีหน้า ติดตามข่าวสารได้ที่เว็บไซต์ของเรานะคะ</p>
            <a href="/" class="wdl-btn-secondary mt-3">กลับสู่หน้าหลัก</a>
          </div>
        </div>
      </div>
    </section>

    <?php /* [et_pb_section fb_built="1" _builder_version="4.21.0" hover_enabled="0" global_colors_info="{}" sticky_enabled="0" background_color="#efefef" custom_padding="||||true" custom_padding_last_edited="on|tablet" custom_padding_tablet="30px||30px||true|false" custom_padding_phone="30px||30px||true|false"][et_pb_row _builder_version="4.21.0" background_size="initial" background_position="top_left" background_repeat="repeat" hover_enabled="0" global_colors_info="{}" custom_margin="||||true" custom_margin_last_edited="off|desktop" sticky_enabled="0" custom_margin_tablet="0px||0px||true|false" custom_padding="24px|16px|24px|16px|true|true" background_color="#FFFFFF" border_radii="on|16px|16px|16px|16px" width="95%" custom_padding_last_edited="on|phone" custom_padding_tablet="16px||16px||true|true" custom_padding_phone="|8px||8px|true|true"][et_pb_column type="4_4" _builder_version="4.16" custom_padding="|||" global_colors_info="{}" custom_padding__hover="|||"][et_pb_text _builder_version="4.21.0" background_size="initial" background_position="top_left" background_repeat="repeat" global_colors_info="{}"]

    [contact-form-7 id="200" title="Promotion Form : General"]

    [/et_pb_text][/et_pb_column][/et_pb_row][/et_pb_section] */ ?>

    <div id="modal-thankyou" class="modal fade">
      <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-md-down">
        <div class="modal-content mb-0">
          <button class="btn-close" data-bs-dismiss="modal"></button>
          <div class="modal-body text-center">
            <div class="py-4">
              <img class="mb-4" src="<?php echo (get_theme_file_uri() . '/images/logo.webp') ?>" alt="Weddinglist" width="180" height="43">
              <p class="h2 text-red"><?php _e('ลงทะเบียนสำเร็จ ขอบคุณค่ะ', 'wdl') ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
<?php endif; ?>

<?php include get_stylesheet_directory() . '/components/footer.php' ?>