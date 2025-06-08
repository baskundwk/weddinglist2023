<nav class="wdl-lead-menu">
  <div class="container-xl">
    <div class="wdl-lead-menu-swiper swiper overflow-visible">
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
  </div>
</nav>