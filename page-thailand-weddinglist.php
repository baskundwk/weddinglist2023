<?php
  //$hideNav = true;
  include get_stylesheet_directory().'/components/header.php';
?>
<section class="position-relative py-3">
  <div class="container-xl position-relative z-1">
    <div class="row g-4 justify-content-center min-vh--1 mt-0">
      <div class="col-lg-8 order-lg-2 h-auto pb-4 mt-0">
        <div class="wdl-single-thumbnail pb-3"><?php the_post_thumbnail( 'large' ) ?></div>
        <h1 class="wdl-single-title mb-3"><?php the_title(); ?></h1>
        <div class="col"><?php the_content(  )?></div>
        <div class="card rounded-4 mb-3 h-auto">
          <div class="card-body">
            <form id="businessSignUp" action="" method="post">
              <div id="businessTypeSpecContainer" class="mb-3 d-none">
                <label for="businessTypeSpec"><?php _e('ระบุประเภทกิจการ','wdl')?><span class="text-red">*</span></label>
                <input name="businessTypeSpec" id="businessTypeSpec" type="text" placeholder="<?php _e('ระบุประเภทกิจการ','wdl')?>" />
              </div>
              <div class="mb-3"">
                <label for="contactName"><?php _e('ชื่อ-นามสกุลผู้ติดต่อ','wdl')?><span class="text-red">*</span></label>
                <input name="contactName" id="contactName" type="text" placeholder="<?php _e('ชื่อ-นามสกุลผู้ติดต่อ','wdl')?>" required />
              </div>
              <div class="mb-3"">
                <label for="contactTel"><?php _e('เบอร์โทรผู้ติดต่อ','wdl')?><span class="text-red">*</span></label>
                <input name="contactTel" id="contactTel" type="text" placeholder="<?php _e('เบอร์โทรผู้ติดต่อ','wdl')?>" required />
              </div>
              <div class="mb-3"">
                <label for="contactEmail"><?php _e('อีเมลผู้ติดต่อ','wdl')?><span class="text-red">*</span></label>
                <input name="contactEmail" id="contactEmail" type="email" placeholder="<?php _e('อีเมลผู้ติดต่อ','wdl')?>" required />
              </div>
              <div class="mb-3">
                <div class="h3">เลือกสถานที่และผู้ให้บริการที่ท่านสนใจ</div>
              </div>
              <div id="accordionSet" class="accordion">
                <div class="accordion-item"">
                  <?php
                  $checkboxName = 'checkboxHotel';
                  $allHotel = new WP_Query([
                    'post_type' => 'venue',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'tax_query' => [
                      [
                        'taxonomy' => 'venue_type',
                        'field'    => 'slug',
                        'terms'    => ['hotel'],
                        'include_children' => false,
                      ]
                    ]
                  ]);
                  if($allHotel->have_posts()) { ?>
                    <div class="accordion-header d-flex flex-column">
                      <button type="button" class="accordion-button collapsed p-3 fw-bold" data-bs-toggle="collapse" data-bs-target="#accordion1"><?php _e('โรงแรม')?></button>
                      <div class="wdl-checkbox d-flex gap-2 ps-3 py-2">
                        <input type="checkbox" name="accordion1-select-all" id="accordion1-select-all"/>
                        <label class="d-flex gap-2" for="accordion1-select-all">เลือกทั้งหมด</label>
                      </div>
                    </div>
                    <div id="accordion1" class="accordion-collapse collapse" data-bs-parent="#accordionSet">
                      <div class="accordion-body pt-0">
                        <div class="row row-cols-1 row-cols-lg-2 g-2">
                          <?php while($allHotel->have_posts()) {
                            $allHotel->the_post(); ?>
                            <div class="col"><?php include get_stylesheet_directory() . '/components/cards/card-mini.php';?></div>
                          <?php }
                          wp_reset_postdata(  );?>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </div>
    
                <div class="accordion-item"">
                  <?php
                  $checkboxName = 'checkboxHotel5';
                  $allHotel5 = new WP_Query([
                    'post_type' => 'venue',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'tax_query' => [
                      [
                        'taxonomy' => 'venue_type',
                        'field'    => 'slug',
                        'terms'    => ['hotel-5s'],
                        'include_children' => false,
                      ]
                    ]
                  ]);
                  if($allHotel5->have_posts()) { ?>
                    <div class="accordion-header d-flex flex-column">
                      <button type="button" class="accordion-button collapsed p-3 fw-bold" data-bs-toggle="collapse" data-bs-target="#accordion2"><?php _e('โรงแรม 5 ดาว')?></button>
                      <div class="wdl-checkbox d-flex gap-2 ps-3 py-2">
                        <input type="checkbox" name="accordion2-select-all" id="accordion2-select-all"/>
                        <label class="d-flex gap-2" for="accordion2-select-all">เลือกทั้งหมด</label>
                      </div>
                    </div>
                    <div id="accordion2" class="accordion-collapse collapse" data-bs-parent="#accordionSet">
                      <div class="accordion-body pt-0">
                        <div class="row row-cols-1 row-cols-lg-2 g-2">
                          <?php while($allHotel5->have_posts()) {
                            $allHotel5->the_post(); ?>
                            <div class="col"><?php include get_stylesheet_directory() . '/components/cards/card-mini.php';?></div>
                          <?php }
                          wp_reset_postdata(  );?>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </div>
                
                <div class="accordion-item"">
                  <?php
                  $checkboxName = 'checkboxWeddingVenue';
                  $allWeddingVenue = new WP_Query([
                    'post_type' => 'venue',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'tax_query' => [
                      [
                        'taxonomy' => 'venue_type',
                        'field'    => 'slug',
                        'terms'    => ['venue'],
                        'include_children' => false,
                      ]
                    ]
                  ]);
                  if($allWeddingVenue->have_posts()) { ?>
                    <div class="accordion-header d-flex flex-column">
                      <button type="button" class="accordion-button collapsed p-3 fw-bold" data-bs-toggle="collapse" data-bs-target="#accordion3"><?php _e('เวนิวแต่งงาน')?></button>
                      <div class="wdl-checkbox d-flex gap-2 ps-3 py-2">
                        <input type="checkbox" name="accordion3-select-all" id="accordion3-select-all"/>
                        <label class="d-flex gap-2" for="accordion3-select-all">เลือกทั้งหมด</label>
                      </div>
                    </div>
                    <div id="accordion3" class="accordion-collapse collapse" data-bs-parent="#accordionSet">
                      <div class="accordion-body pt-0">
                        <div class="row row-cols-1 row-cols-lg-2 g-2">
                          <?php while($allWeddingVenue->have_posts()) {
                            $allWeddingVenue->the_post(); ?>
                            <div class="col"><?php include get_stylesheet_directory() . '/components/cards/card-mini.php';?></div>
                          <?php }
                          wp_reset_postdata(  );?>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </div>
                
                <div class="accordion-item"">
                  <?php
                  $checkboxName = 'checkboxStudio';
                  $allStudio = new WP_Query([
                    'post_type' => 'vendor',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'tax_query' => [
                      [
                        'taxonomy' => 'vendor-type',
                        'field'    => 'slug',
                        'terms'    => ['dress'],
                        'include_children' => false,
                      ]
                    ]
                  ]);
                  if($allStudio->have_posts()) { ?>
                    <div class="accordion-header d-flex flex-column">
                      <button type="button" class="accordion-button collapsed p-3 fw-bold" data-bs-toggle="collapse" data-bs-target="#accordion4"><?php _e('Wedding Studio')?></button>
                      <div class="wdl-checkbox d-flex gap-2 ps-3 py-2">
                        <input type="checkbox" name="accordion4-select-all" id="accordion4-select-all"/>
                        <label class="d-flex gap-2" for="accordion4-select-all">เลือกทั้งหมด</label>
                      </div>
                    </div>
                    <div id="accordion4" class="accordion-collapse collapse" data-bs-parent="#accordionSet">
                      <div class="accordion-body pt-0">
                        <div class="row row-cols-1 row-cols-lg-2 g-2">
                          <?php while($allStudio->have_posts()) {
                            $allStudio->the_post(); ?>
                            <div class="col"><?php include get_stylesheet_directory() . '/components/cards/card-mini.php';?></div>
                          <?php }
                          wp_reset_postdata(  );?>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </div>
               
                <div class="accordion-item"">
                  <?php
                  $checkboxName = 'checkboxMiscVendor';
                  $allMiscVendor = new WP_Query([
                    'post_type' => 'vendor',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'tax_query' => [
                      [
                        'taxonomy' => 'vendor-type',
                        'field'    => 'slug',
                        'terms'    => ['bridal-shoes', 'souvenir', 'suit-ชุดเพื่อนเจ้าสาว'],
                        'include_children' => false,
                      ]
                    ]
                  ]);
                  if($allMiscVendor->have_posts()) { ?>
                    <div class="accordion-header d-flex flex-column">
                      <button type="button" class="accordion-button collapsed p-3 fw-bold" data-bs-toggle="collapse" data-bs-target="#accordion5"><?php _e('Bridal Shoes, การ์ด ของชำร่วย ของรับไหว้, Suit & ชุดเพื่อนเจ้าสาว')?></button>
                      <div class="wdl-checkbox d-flex gap-2 ps-3 py-2">
                        <input type="checkbox" name="accordion5-select-all" id="accordion5-select-all"/>
                        <label class="d-flex gap-2" for="accordion5-select-all">เลือกทั้งหมด</label>
                      </div>
                    </div>
                    <div id="accordion5" class="accordion-collapse collapse" data-bs-parent="#accordionSet">
                      <div class="accordion-body pt-0">
                        <div class="row row-cols-1 row-cols-lg-2 g-2">
                          <?php while($allMiscVendor->have_posts()) {
                            $allMiscVendor->the_post(); ?>
                            <div class="col"><?php include get_stylesheet_directory() . '/components/cards/card-mini.php';?></div>
                          <?php }
                          wp_reset_postdata(  );?>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </div>
               
                <div class="accordion-item"">
                  <?php
                  $checkboxName = 'checkboxCatering';
                  $allCatering = new WP_Query([
                    'post_type' => 'vendor',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'tax_query' => [
                      [
                        'taxonomy' => 'vendor-type',
                        'field'    => 'slug',
                        'terms'    => ['catering'],
                        'include_children' => false,
                      ]
                    ]
                  ]);
                  if($allCatering->have_posts()) { ?>
                    <div class="accordion-header d-flex flex-column">
                      <button type="button" class="accordion-button collapsed p-3 fw-bold" data-bs-toggle="collapse" data-bs-target="#accordion6"><?php _e('Catering')?></button>
                      <div class="wdl-checkbox d-flex gap-2 ps-3 py-2">
                        <input type="checkbox" name="accordion6-select-all" id="accordion6-select-all"/>
                        <label class="d-flex gap-2" for="accordion6-select-all">เลือกทั้งหมด</label>
                      </div>
                    </div>
                    <div id="accordion6" class="accordion-collapse collapse" data-bs-parent="#accordionSet">
                      <div class="accordion-body pt-0">
                        <div class="row row-cols-1 row-cols-lg-2 g-2">
                          <?php while($allCatering->have_posts()) {
                            $allCatering->the_post(); ?>
                            <div class="col"><?php include get_stylesheet_directory() . '/components/cards/card-mini.php';?></div>
                          <?php }
                          wp_reset_postdata(  );?>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </div>
               
                <div class="accordion-item"">
                  <?php
                  $checkboxName = 'checkboxJewelry';
                  $allJewelry = new WP_Query([
                    'post_type' => 'vendor',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'tax_query' => [
                      [
                        'taxonomy' => 'vendor-type',
                        'field'    => 'slug',
                        'terms'    => ['jewelry'],
                        'include_children' => false,
                      ]
                    ]
                  ]);
                  if($allJewelry->have_posts()) { ?>
                    <div class="accordion-header d-flex flex-column">
                      <button type="button" class="accordion-button collapsed p-3 fw-bold" data-bs-toggle="collapse" data-bs-target="#accordion7"><?php _e('Jewelry แหวนแต่งงาน')?></button>
                      <div class="wdl-checkbox d-flex gap-2 ps-3 py-2">
                        <input type="checkbox" name="accordion7-select-all" id="accordion7-select-all"/>
                        <label class="d-flex gap-2" for="accordion7-select-all">เลือกทั้งหมด</label>
                      </div>
                    </div>
                    <div id="accordion7" class="accordion-collapse collapse" data-bs-parent="#accordionSet">
                      <div class="accordion-body pt-0">
                        <div class="row row-cols-1 row-cols-lg-2 g-2">
                          <?php while($allJewelry->have_posts()) {
                            $allJewelry->the_post(); ?>
                            <div class="col"><?php include get_stylesheet_directory() . '/components/cards/card-mini.php';?></div>
                          <?php }
                          wp_reset_postdata(  );?>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </div>
                
                <div class="accordion-item"">
                  <?php
                  $checkboxName = 'checkboxOrganizer';
                  $allOrganizer = new WP_Query([
                    'post_type' => 'vendor',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'tax_query' => [
                      [
                        'taxonomy' => 'vendor-type',
                        'field'    => 'slug',
                        'terms'    => ['planner', 'decoration-organizer', 'photography'],
                        'include_children' => false,
                      ]
                    ]
                  ]);
                  if($allOrganizer->have_posts()) { ?>
                    <div class="accordion-header d-flex flex-column">
                      <button type="button" class="accordion-button collapsed p-3 fw-bold" data-bs-toggle="collapse" data-bs-target="#accordion8"><?php _e('Wedding Planner & Organizer, Decoration & Organizer, Photography')?></button>
                      <div class="wdl-checkbox d-flex gap-2 ps-3 py-2">
                        <input type="checkbox" name="accordion8-select-all" id="accordion8-select-all"/>
                        <label class="d-flex gap-2" for="accordion8-select-all">เลือกทั้งหมด</label>
                      </div>
                    </div>
                    <div id="accordion8" class="accordion-collapse collapse" data-bs-parent="#accordionSet">
                      <div class="accordion-body pt-0">
                        <div class="row row-cols-1 row-cols-lg-2 g-2">
                          <?php while($allOrganizer->have_posts()) {
                            $allOrganizer->the_post(); ?>
                            <div class="col"><?php include get_stylesheet_directory() . '/components/cards/card-mini.php';?></div>
                          <?php }
                          wp_reset_postdata(  );?>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </div>
              </div>
              <button id="businessSignUp-submit" type="submit" name="submit" class="wdl-btn-lg wdl-form-submit mt-3 w-100">
                <span class="loader" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M232,128a104,104,0,0,1-208,0c0-41,23.81-78.36,60.66-95.27a8,8,0,0,1,6.68,14.54C60.15,61.59,40,93.27,40,128a88,88,0,0,0,176,0c0-34.73-20.15-66.41-51.34-80.73a8,8,0,0,1,6.68-14.54C208.19,49.64,232,87,232,128Z"></path></svg></span>
                <?php _e('ลงทะเบียน','wdl')?>
              </button>
            </form>

          </div>
        </div>
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

<script>
$(document).ready(() => {
  $('#businessType').change(()=>{
    if ( $('#businessType').val() === "อื่น ๆ" ) {
      $('#businessTypeSpecContainer').removeClass('d-none')
      $('#businessTypeSpecContainer input').attr('required', true)
    } else {
      $('#businessTypeSpecContainer input').removeAttr('required')
      $('#businessTypeSpecContainer').addClass('d-none')
    }
  })

  const modalVerify = new bootstrap.Modal(document.querySelector('#modal-thankyou'));

  $('#businessSignUp').submit(function(e) {
    e.preventDefault();
    $('#businessSignUp-submit').addClass('loading')
    $.post("<?php echo admin_url('admin-ajax.php'); ?>", {
      action: 'send_email_business',
      name: $('#businessName').val(),
      businessType: $('#businessType').val() !== 'อื่น ๆ' ? $('#businessType').val() : $('#businessTypeSpec').val(),
      contactName: $('#contactName').val(),
      contactTel: $('#contactTel').val(),
      contactEmail: $('#contactEmail').val(),
      message: $('#message').val(),
      leadType: 'Business',
    }, (res) => {
      modalVerify.show();
    }).fail((err) => {
      alert('ระบบเกิดการผิดพลาด ขออภัยค่ะ กรุณาลองใหม่');
    })

    $('#businessSignUp-submit').remove('loading')

  });
})
</script>

<?php include get_stylesheet_directory().'/components/footer.php' ?>