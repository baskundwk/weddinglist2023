<section>
  <div class="container-xl">
    <div class="row mb-2">
      <div class="col-12 py-2">
        <?php if (function_exists('rank_math_the_breadcrumbs')): ?>
          <div class="wdl-breadcrumb">
            <?php rank_math_the_breadcrumbs(); ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col">
        <div class="wdl-search">
          <form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url(home_url('/')); ?>">
            <div class="form-floating d-flex">
              <input class="form-control" type="text" name="s" id="s" placeholder="<?php _e('คุณกำลังมองหาอะไร...', 'wdl')?>">
              <label for="s"><?php _e('คุณกำลังมองหาอะไร...', 'wdl')?></label>
              <input class="wdl-search-submit" type="submit" id="searchsubmit" value="Search">
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-auto">
        <p><?php _e('คำค้นหายอดนิยม :', 'wdl')?></p>
      </div>
      <div class="col">
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
    <div class="row">
      <div class="col-12 px-0 overflow-hidden">
        <?php
        wp_nav_menu(
          array(
            'menu' => 'Lead menu',
            'container_class' => 'wdl-lead-menu-small-swiper',
            'menu_class' => 'wdl-lead-menu-container wdl-lead-menu-small-container swiper-wrapper',
            'menu_id' => 'lead-menu'
          )
        );
        ?>
      </div>
      <div class="col-12">
        <hr>
      </div>
    </div>
  </div>
</section>