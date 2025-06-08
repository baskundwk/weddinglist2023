<?php include get_stylesheet_directory().'/components/header.php' ?>

<main>
  <?php $arg = [
    'post_type' => 'campaign',
    'posts_per_page' => 1,
    'post_status' => 'any'
  ];
  if(isset($_GET['i'])) {
    $slug = $_GET['i'];
    $arg['name'] = $slug;
  }
  $campaignQuery = new WP_Query($arg); ?>

  <section class="pt-3 pb-5">
    <?php if($campaignQuery->have_posts()) {
      while($campaignQuery->have_posts()) {
        $campaignQuery->the_post(); ?>
        <div class="container-xl">
          <div class="mb-3 pb-lg-1">
            <div class="wdl-campaign-banner" style="
              --campaign-color-1: <?php the_field('CampaignColor1');?>;
              --campaign-color-2: <?php the_field('CampaignColor2');?>;
            ">
              <div class="background">
                <img src="<?php echo get_field('CampaignBackground')['url'];?>" alt="<?php the_title(); ?>">
              </div>
              <?php if(get_field('CampaignDateStart') && get_field('CampaignDateEnd') ) :?>
              <div class="date">
                <?php _e('ระยะเวลาแคมเปญ', 'wdl') ?> 
                <?php 
                  echo promotionDate(get_field('CampaignDateStart'), 'DateStart');
                  echo promotionDate(get_field('CampaignDateEnd'), 'DateEnd');
                ?> 
              </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="row g-4">
            <div class="col-lg-8">
              <div class="wdl-campaign-announcement">
                <h1 class="title">
                  <?php the_title();?>
                </h1>

                <a href="#campaign-register" type="submit" name="submit" class="wdl-btn-lg text-center wdl-form-submit w-100 d-lg-none mb-3" style="  
                  --campaign-color-1: <?php the_field('CampaignColor1');?>;
                  --campaign-color-2: <?php the_field('CampaignColor2');?>;
                  background: linear-gradient(to right, var(--campaign-color-1, #ff2758), var(--campaign-color-2, #ff2758));
                "><?php _e('ลงทะเบียน','wdl')?></a>
                <?php the_field('CampaignAnnouncement') ?>
              </div>
            </div>
            <?php if(get_field('CampaignMerchantRegister')) : ?>
            <div class="col-lg-4" id="campaign-register">
              <h2 class="h1">ลงทะเบียนสนใจเข้าร่วมงาน</h2>
              <div class="card rounded-4 h-auto">
                <div class="card-body">
                  <form action="">
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
                    <button id="wdl-form-general-submit" type="submit" name="submit" class="wdl-btn-lg wdl-form-submit w-100" style="  
                      --campaign-color-1: <?php the_field('CampaignColor1');?>;
                      --campaign-color-2: <?php the_field('CampaignColor2');?>;
                      background: linear-gradient(to right, var(--campaign-color-1, #ff2758), var(--campaign-color-2, #ff2758));
                    "><?php _e('ลงทะเบียน','wdl')?></button>
                  </form>
                </div>
              </div>
            </div>
            <?php endif; ?>
          </div>
        </div>
      <?php }
    }?>
  </section>
</main>

<?php include get_stylesheet_directory().'/components/footer.php' ?>