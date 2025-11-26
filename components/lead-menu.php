<nav class="wdl-lead-menu">
  <div class="container-xl d-flex gap-3 align-items-stretch justify-content-between">
    <div class="wdl-lead-menu-swiper swiper overflow-visible flex-fill">
      <?php
        wp_nav_menu(
          array(
            'container' => false,
            'menu' => 'Lead Menu (2025)',
            'menu_class' => 'wdl-lead-menu-wrapper swiper-wrapper',
            'menu_id' => 'nav-menu',
          )
        );
      ?>
      <div class="swiper-navigation swiper-navigation-small">
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
      </div>
    </div>
    <a href="https://ktc.cards/wdc" target="_blank" class="wdl-ktc-cta d-none d-xl-flex">
      <img src="https://www.weddinglist.co.th/wp-content/uploads/2025/10/logo-ktc-white.png" style="width: 28px" alt="KTC Proud Logo">
      <span>สมัครบัตรเครดิต KTC</span>
    </a>
  </div>
</nav>

<?php if(isset($campaignModeEnabled) && $campaignModeEnabled && isset($campaignId)): ?>
  <a class="wdl-campaign-floating-cta" href="<?php echo get_permalink( get_field('CampaignLandingPage', $campaignId)->ID . '#register' ) ?>"
    style="
      --campaign-color-1: <?php the_field('CampaignColor2', $campaignId);?>;
      --campaign-color-2: <?php the_field('CampaignColor2', $campaignId);?>;
    ">ลงทะเบียน <?php echo get_the_title($campaignId) ?></a>
<?php endif; ?>