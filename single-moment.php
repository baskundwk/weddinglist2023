<?php include get_stylesheet_directory().'/components/header.php' ?>
<main class="<?php if(isset($campaignModeEnabled) && isset($campaignRelated['Moment']) && in_array(get_the_ID(), $campaignRelated['Moment'])) {
    echo esc_html('wdl-campaign-single');
  };
?>" style="
<?php if(isset($campaignModeEnabled) && isset($campaignRelated['Moment']) && in_array(get_the_ID(), $campaignRelated['Moment'])) {
  echo esc_html('--campaign-color-1: '.$campaignColor1.'; --campaign-color-2: '.$campaignColor2.';');
}?>">
  <section class="bg-gray py-4">
    <div class="container-xl">
      <div class="row g-3">
        <div class="col-xl-8">
          <div class="wdl-layout-card">
            <h1 class="mb-2"><?php the_title(); ?></h1>
  
            <figure class="wdl-gallery wdl-moment-gallery">
              <?php $gallery = get_field('MomentGallery');
              
              if($gallery) {
                $galleryI = 0;
                foreach($gallery as $image) {
                  $galleryI++;
                  if($galleryI === 1) { ?>
                  <div data-bs-target="#gallery" data-bs-toggle="modal" class="wdl-gallery-item wdl-moment-gallery-item">
                    <img src="<?php echo $image['sizes']['large'] ?>" alt="<?php the_title()?>">
                  </div>
                  <?php } else if($galleryI < 5 ) { ?>
                  <div data-bs-target="#gallery" data-bs-toggle="modal" class="wdl-gallery-item wdl-moment-gallery-item">
                    <img src="<?php echo $image['sizes']['medium'] ?>" alt="<?php the_title()?>">
                  </div>
                  <?php } else if($galleryI === 5 ) { ?>
                  <div data-bs-target="#gallery" data-bs-toggle="modal" class="wdl-gallery-item wdl-moment-gallery-item">
                    <div class="wdl-moment-gallery-item-more">
                      5+
                    </div>
                    <img src="<?php echo $image['sizes']['medium'] ?>" alt="<?php the_title()?>">
                  </div>
                <?php }
                }
              }?>
            </figure>
  
            <div class="wdl-single-content h-auto"><?php the_content();?></div>
          </div>
        </div>
        <div class="col-xl-4">
          <?php include get_stylesheet_directory() . '/components/campaign-bar.php' ?>

          <div class="wdl-layout-card">
            <h2 class="h4"><?php _e('รายละเอียด', 'wdl') ?></h2>
            <div class="d-flex flex-column gap-1">
              <?php 
              $momentAdvanceReservation = get_field('MomentAdvanceReservation');
              $momentDuration = get_field('MomentDuration');
              if($momentAdvanceReservation || $momentDuration) {
              ?>
              <div class="wdl-metadata">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M128,40a96,96,0,1,0,96,96A96.11,96.11,0,0,0,128,40Zm0,176a80,80,0,1,1,80-80A80.09,80.09,0,0,1,128,216ZM173.66,90.34a8,8,0,0,1,0,11.32l-40,40a8,8,0,0,1-11.32-11.32l40-40A8,8,0,0,1,173.66,90.34ZM96,16a8,8,0,0,1,8-8h48a8,8,0,0,1,0,16H104A8,8,0,0,1,96,16Z"></path></svg>
                <?php if($momentAdvanceReservation) { echo __('จองล่วงหน้า').' '.$momentAdvanceReservation.' '.__('วัน'); }?>
                <?php if($momentAdvanceReservation && $momentDuration) { echo '/'; }?>
                <?php if($momentAdvanceReservation) { echo __('ทริป', 'wdl').' '.$momentDuration.' '.__('วัน', 'wdl'); }?>
              </div>
              <?php } ?>

              <?php if(get_field('MomentDateStart') || get_field('MomentDateEnd')) {?>
              <div class="wdl-metadata">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M208,32H184V24a8,8,0,0,0-16,0v8H88V24a8,8,0,0,0-16,0v8H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32ZM72,48v8a8,8,0,0,0,16,0V48h80v8a8,8,0,0,0,16,0V48h24V80H48V48ZM208,208H48V96H208V208Zm-68-76a12,12,0,1,1-12-12A12,12,0,0,1,140,132Zm44,0a12,12,0,1,1-12-12A12,12,0,0,1,184,132ZM96,172a12,12,0,1,1-12-12A12,12,0,0,1,96,172Zm44,0a12,12,0,1,1-12-12A12,12,0,0,1,140,172Zm44,0a12,12,0,1,1-12-12A12,12,0,0,1,184,172Z"></path></svg>
                <?php
                  echo promotionDate(get_field('MomentDateStart'), 'DateStart');
                  echo promotionDate(get_field('MomentDateEnd'), 'DateEnd');
                ?>
              </div>
              <?php } ?>

              <?php if(get_field('MomentLocation')) {?>
              <div class="wdl-metadata">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M128,64a40,40,0,1,0,40,40A40,40,0,0,0,128,64Zm0,64a24,24,0,1,1,24-24A24,24,0,0,1,128,128Zm0-112a88.1,88.1,0,0,0-88,88c0,31.4,14.51,64.68,42,96.25a254.19,254.19,0,0,0,41.45,38.3,8,8,0,0,0,9.18,0A254.19,254.19,0,0,0,174,200.25c27.45-31.57,42-64.85,42-96.25A88.1,88.1,0,0,0,128,16Zm0,206c-16.53-13-72-60.75-72-118a72,72,0,0,1,144,0C200,161.23,144.53,209,128,222Z"></path></svg>
                <span>
                  <?php the_field('MomentLocation')?><br/>
                  <a class="text-accent" target="_blank" href="<?php echo get_field('MomentMap')?>"
                  data-dlev="buttonClick"
                  data-dlcomp="button - moment - map"
                  data-dltgt="<?php the_title() ?>"><?php _e('ดูแผนที่', 'wdl')?></a>
                </span>
              </div>
              <?php } ?>
            </div>
            <hr>
            <h2 class="h4"><?php _e('ราคาแพ็คเกจ', 'wdl') ?></h2>
            <table class="table-borderless text-14" width="100%">
              <?php $momentPackage = get_field('MomentPackage');
              foreach($momentPackage as $package) { 
                if($package['MomentPackagePrice'] && $package['MomentPackageUnit']) {
              ?>
              <tr>
                <td class="pb-2"><?php echo $package['MomentPackageName']?></td>
                <td class="pb-2" width="100">
                  <strong class="d-block">
                    <?php echo number_format($package['MomentPackagePrice'])?>
                    <?php echo $package['MomentPackageUnit']?>
                  </strong>
                  <small><?php if($package['MomentPackagePriceFull']) { echo '<s>'.number_format($package['MomentPackagePriceFull']).' '.$package['MomentPackageUnit'].'</s><br/>';} ?></small>
                </td>
              </tr>
              <?php } } ?>
            </table>
          </div>
          <div class="wdl-layout-card">
            <h2 class="h4"><?php _e('ติดต่อซื้อแพ็คเกจ Moment นี้', 'wdl') ?></h2>
            <form id="form-line-contact" data-items="name,tel,date,package" action="https://line.me/R/oaMessage/@ety4154i/?" data-message-prefix="<?php _e('ติดต่อซื้อแพ็คเกจ Moment', 'wdl')?>">
              <div class="row mb-2 mb-lg-3 g-2 g-lg-3">
                <div class="col-12">
                  <div class="form-floating">
                    <input name="name" id="name" class="form-control" type="text" placeholder="<?php _e('ชื่อ - นามสกุล', 'wdl')?>" required>
                    <label for="name"><?php _e('ชื่อ - นามสกุล', 'wdl')?></label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating">
                    <input name="tel" id="tel" class="form-control" type="text" placeholder="<?php _e('เบอร์โทรติดต่อ', 'wdl')?>" required>
                    <label for="tel"><?php _e('เบอร์โทรติดต่อ', 'wdl')?></label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating">
                    <input name="date" id="date" class="form-control" type="date" placeholder="<?php _e('จองวันที่', 'wdl')?>" required>
                    <label for="date"><?php _e('จองวันที่', 'wdl')?></label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating">
                    <select name="package" id="package" class="form-control" placeholder="<?php _e('แพ็คเกจที่ต้องการ', 'wdl')?>" required>
                      <?php
                      foreach($momentPackage as $package) { 
                        if($package['MomentPackagePrice'] && $package['MomentPackageUnit']) {
                          $packageName = $package['MomentPackageName'];
                          $message = $packageName.' - '.$package['MomentPackagePrice'].' '.$package['MomentPackageUnit']
                      ?>
                      <option value="<?php echo $packageName ?>"><?php echo $message ?></option>
                      <?php } } ?>
                    </select>
                    <label for="package"><?php _e('แพ็คเกจที่ต้องการ', 'wdl')?></label>
                  </div>
                </div>
              </div>
              <button type="submit" class="mb-2 mb-lg-3 w-100 wdl-btn-line-cta d-lg-none"
                data-dlev="buttonClick"
                data-dlcomp="button - moment - line"
                data-dltgt="<?php the_title() ?>"><?php _e('ซื้อแพ็คเกจผ่าน Line', 'wdl')?></button>
              <button type="submit" class="mb-2 mb-lg-3 w-100 wdl-btn-line-cta d-none d-lg-flex"
                data-dlev="buttonClick"
                data-dlcomp="button - moment - line"
                data-dltgt="<?php the_title() ?>"><?php _e('สแกน QR - ซื้อแพ็คเกจผ่าน Line', 'wdl')?></button>
              <?php 
              $brochure = get_field('MomentBrochure');
              if($brochure) {?>
              <a href="#brochure" data-bs-toggle="modal" class="w-100 wdl-link-brochure"
              data-dlev="buttonClick"
              data-dlcomp="button - moment - brochure"
              data-dltgt="<?php the_title() ?>"><?php _e('ดูโบรชัวร์โรงแรม', 'wdl')?></a>
              <?php } ?>
            </form>
          </div>
          <div class="wdl-layout-card">
            <h2 class="h4"><?php _e('แผนการเดินทาง', 'wdl')?></h2>
            <table class="table-borderless text-14" width="100%">
              <?php $momentIteration = get_field('MomentIteration');
              foreach($momentIteration as $iteration) { 
                if($iteration['MomentIterationTimeStart'] && $iteration['MomentIterationTimeEnd'] && $iteration['MomentIterationName']) {
              ?>
              <tr>
                <td class="pb-2" width="100">
                  <strong class="d-block">
                    <?php echo $iteration['MomentIterationTimeStart']?> - <?php echo $iteration['MomentIterationTimeEnd']?>
                  </strong>
                </td>
                <td class="pb-2"><?php echo $iteration['MomentIterationName']?></td>
              </tr>
              <?php } } ?>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="modal fade wdl-gallery-modal" id="gallery">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content mb-0">
        <div class="modal-body">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

          <?php
          if ($gallery):
            ?>
          <div class="swiper wdl-gallery-modal-swiper">
            <div class="swiper-wrapper">
              <?php
                foreach ($gallery as $image):
                  $image_id = $image['ID'];
                  $image_src = $image['url'];
                  $image_caption = $image['caption'];
                  ?>
              <div class="swiper-slide wdl-gallery-modal-item">
                <?php echo wp_get_attachment_image($image_id, 'large'); ?>
              </div>
              <?php endforeach; ?>
            </div>
            <div class="swiper-navigation swiper-navigation-small">
              <div class="swiper-button-prev"></div>
              <div class="swiper-button-next"></div>
            </div>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade modal-xl" id="brochure">
    <div class="modal-dialog modal-dialog-centered m-auto">
      <div class="modal-content mb-0">
        <button class="btn-close"></button>
        <div class="modal-body">
          <iframe class="wdl-iframe wdl-iframe-80vh" src="<?php echo ($brochure) ?>" width="100%" height="560"></iframe>
        </div>
      </div>
    </div>
  </div>

  <?php include get_stylesheet_directory().'/components/modal-lineqr.php' ?>
</main>
<?php include get_stylesheet_directory().'/components/footer.php' ?>
