<section>
  <div class="container">
    <div class="row overflow-hidden mb-3">
      <?php
      wp_nav_menu(
        array(
          'menu' => 'Lead menu',
          'container_class' => 'wdl-lead-menu-revamped-swiper',
          'menu_class' => 'swiper-wrapper',
          'menu_id' => 'lead-menu'
        )
      );
      ?>
    </div>
    <div class="row mb-3 g-3">
      <div class="col-xl-4">
        <div class="wdl-search">
          <form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url(home_url('/')); ?>">
            <div class="form-floating d-flex">
              <input class="form-control" type="text" name="s" id="s" placeholder="คุณกำลังมองหาอะไร">
              <label for="s">คุณกำลังมองหาอะไร</label>
              <input class="wdl-search-submit" type="submit" id="searchsubmit" value="Search">
            </div>
          </form>
        </div>
      </div>
      <div class="col-xl-8">
        <?php
        wp_nav_menu(
          array(
            'menu' => 'Lead menu location',
            'container_class' => '',
            'menu_class' => 'wdl-badge-container',
            'menu_id' => 'lead-menu'
          )
        );
        ?>
      </div>
    </div>
  </div>
</section>