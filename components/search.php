<div class="row mb-3">
  <div class="col">
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
</div>
<div class="row">
  <div class="col-auto">
    <p>คำค้นหายอดนิยม :</p>
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