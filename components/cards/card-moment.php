<div id="wdl-post-<?php the_ID(); ?>" class="wdl-moment-card swiper-slide wdl-archive-card
  <?php if(isset($campaignModeEnabled) && isset($campaignRelated['Moment']) && in_array(get_the_ID(), $campaignRelated['Moment'])) {
    echo esc_html('wdl-campaign-card');
  };
  ?> wdl-archive-infinite-scroll-post" style="
  <?php if(isset($campaignModeEnabled) && isset($campaignRelated['Moment']) && in_array(get_the_ID(), $campaignRelated['Moment'])) {
    echo esc_html('--campaign-color-1: '.$campaignColor1.'; --campaign-color-2: '.$campaignColor2.';');
  }?>">
  <?php if (has_post_thumbnail(get_the_ID())): ?>
    <a
      aria-label="<?php echo esc_attr(get_the_title()); ?>"
      class="card-img-top wdl-archive-card-img-top"
      title="<?php echo esc_attr(get_the_title()); ?>"
      href="<?php the_permalink(); ?>"
      data-dlev="cardClick"
      data-dlcomp="card - moment"
      data-dltgt="<?php echo esc_attr(get_the_title())?>">
      <img
        loading="lazy"
        src="<?php echo esc_html(get_the_post_thumbnail_url($post)) ?>"
        alt="<?php echo esc_attr(get_the_title()); ?>" />

      <?php if(isset($campaignModeEnabled) && isset($campaignRelated['Moment']) && in_array(get_the_ID(), $campaignRelated['Moment'])) {
        echo $campaignLogo;
      } ?>

      <?php $sponsored = get_field('Sponsor');
      if ($sponsored && in_array('Sponsored', $sponsored)): ?>
        <span class="badge wdl-badge-sm">Most Popular</span>
      <?php endif; ?>
      <div class="swiper-lazy-preloader"></div>
    </a>
  <?php endif; ?>

  <?php include get_stylesheet_directory() . '/components/card-action.php' ?>

  <div class="card-body wdl-archive-card-body">
      <?php $momentCharacter = get_field('MomentCharacter');
      if ($momentCharacter): ?>
        <div class="wdl-archive-pretitle">
          <?php foreach ($momentCharacter as $character):
          $characterBackground = get_field('CharacterBackground', $character);
          $characterBorder = get_field('CharacterBorder', $character);
          $characterColor = get_field('CharacterColor', $character);
          $characterEffect = get_field('CharacterEffect', $character);
          ?>
          <div class="wdl-character
            <?php if ($characterBorder) {
              echo ('wdl-character-border');
            } ?>
            <?php if ($characterEffect) {
              echo ('wdl-character-animation-' . $characterEffect);
            } ?>"
            <?php
            if ($characterColor || $characterBackground): ?>
              style="
                --background-image: url(<?php echo ($characterBackground['url']) ?>);
                --box-shadow: none;
                --color: rgba(<?php echo ($characterColor['red']) ?>,<?php echo ($characterColor['green']) ?>,<?php echo ($characterColor['blue']) ?>,<?php echo ($characterColor['alpha']) ?>);
                --color-50: rgba(<?php echo ($characterColor['red']) ?>,<?php echo ($characterColor['green']) ?>,<?php echo ($characterColor['blue']) ?>, 50%);
                --color-0: rgba(<?php echo ($characterColor['red']) ?>,<?php echo ($characterColor['green']) ?>,<?php echo ($characterColor['blue']) ?>, 0);
              "
            <?php endif ?>>
            <span><?php echo esc_html($character->name); ?></span>
          </div>
          <?php endforeach; ?>
        </div>
      <?php endif ?>
    <h3 class="wdl-archive-title lineclamp-2 mb-0">
        <?php the_title(); ?>
    </h3>

    <div class="d-flex flex-column gap-1">
      <?php 
      $momentAdvanceReservation = get_field('MomentAdvanceReservation');
      $momentDuration = get_field('MomentDuration');
      if($momentAdvanceReservation || $momentDuration) {
      ?>
      <div class="wdl-metadata">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M128,40a96,96,0,1,0,96,96A96.11,96.11,0,0,0,128,40Zm0,176a80,80,0,1,1,80-80A80.09,80.09,0,0,1,128,216ZM173.66,90.34a8,8,0,0,1,0,11.32l-40,40a8,8,0,0,1-11.32-11.32l40-40A8,8,0,0,1,173.66,90.34ZM96,16a8,8,0,0,1,8-8h48a8,8,0,0,1,0,16H104A8,8,0,0,1,96,16Z"></path></svg>
        <span class="lineclamp-1">
          <?php if($momentAdvanceReservation) { echo __('จองล่วงหน้า ').$momentAdvanceReservation.__(' วัน'); }?>
          <?php if($momentAdvanceReservation && $momentDuration) { echo '/'; }?>
          <?php if($momentDuration) { echo __('ทริป ', 'wdl').$momentDuration.__(' วัน', 'wdl'); }?>
        </span>
      </div>
      <?php } ?>

      <?php if(get_field('MomentDateStart') || get_field('MomentDateEnd')) {?>
      <div class="wdl-metadata">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M208,32H184V24a8,8,0,0,0-16,0v8H88V24a8,8,0,0,0-16,0v8H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32ZM72,48v8a8,8,0,0,0,16,0V48h80v8a8,8,0,0,0,16,0V48h24V80H48V48ZM208,208H48V96H208V208Zm-68-76a12,12,0,1,1-12-12A12,12,0,0,1,140,132Zm44,0a12,12,0,1,1-12-12A12,12,0,0,1,184,132ZM96,172a12,12,0,1,1-12-12A12,12,0,0,1,96,172Zm44,0a12,12,0,1,1-12-12A12,12,0,0,1,140,172Zm44,0a12,12,0,1,1-12-12A12,12,0,0,1,184,172Z"></path></svg>
        <span class="lineclamp-1">
          <?php
            echo promotionDate(get_field('MomentDateStart'), 'DateStart');
            echo promotionDate(get_field('MomentDateEnd'), 'DateEnd');
          ?>
        </span>
      </div>
      <?php } ?>

      <?php if(get_field('MomentLocation')) {?>
      <div class="wdl-metadata">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256"><path d="M128,64a40,40,0,1,0,40,40A40,40,0,0,0,128,64Zm0,64a24,24,0,1,1,24-24A24,24,0,0,1,128,128Zm0-112a88.1,88.1,0,0,0-88,88c0,31.4,14.51,64.68,42,96.25a254.19,254.19,0,0,0,41.45,38.3,8,8,0,0,0,9.18,0A254.19,254.19,0,0,0,174,200.25c27.45-31.57,42-64.85,42-96.25A88.1,88.1,0,0,0,128,16Zm0,206c-16.53-13-72-60.75-72-118a72,72,0,0,1,144,0C200,161.23,144.53,209,128,222Z"></path></svg>
        <span class="lineclamp-1">
          <?php the_field('MomentLocation')?><br/>
        </span>
      </div>
      <?php } ?>
    </div>
      
    <?php if(get_field('MomentPriceStart')) {?>
    <div class="mt-auto pt-1 w-100 text-center fw-bold text-red">
      <?php echo __('เริ่มต้น', 'wdl').' '. number_format(get_field('MomentPriceStart')).' '.__('บาท','')?>
    </div>
    <?php } ?>
    <?php 
    if(isset($member_data) && get_field('OwnerMerchant') && in_array($member_data->ID, get_field('OwnerMerchant'))) : ?>
      <div class="card-footer px-2 mt-auto h-auto">
        <div div class="border-top text-red d-flex justify-content-center align-items-center w-100 m-0 pt-2 text-13 gap-1">
          <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" viewBox="0 0 256 256"><path d="M240,102c0,70-103.79,126.66-108.21,129a8,8,0,0,1-7.58,0C119.79,228.66,16,172,16,102A62.07,62.07,0,0,1,78,40c20.65,0,38.73,8.88,50,23.89C139.27,48.88,157.35,40,178,40A62.07,62.07,0,0,1,240,102Z"></path></svg>
          <?php if(get_field('WishlistedBy')) : ?>
            <span>ยอดในรายการโปรด <?php echo count(get_field('WishlistedBy')) ?> คน</span>
          <?php else : ?>
            <span>ยังไม่มียอดรายการโปรด</span>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>