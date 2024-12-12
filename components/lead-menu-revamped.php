<section class="pt-2 overflow-hidden">
  <div class="container">
    <div class="row mb-2">
      <?php
      wp_nav_menu(
        array(
          'menu' => 'Lead menu',
          'container_class' => 'wdl-lead-menu-revamped-container',
          'menu_class' => 'wdl-lead-menu-revamped',
          'menu_id' => 'lead-menu'
        )
      );
      ?>
    </div>
    <div class="d-flex gap-2 flex-column flex-xl-row mb-2 align-items-xl-center">
      <div class="col">
        <div class="wdl-search">
          <form class="searchform" onsubmit="searchRedirect(event)">
            <div class="input-group d-flex">
              <input class="form-control p-2" type="text" name="s" id="search" placeholder="คุณกำลังมองหาอะไร..." value="<?php echo esc_html($_GET['s']) ?>">
              <select id="s-type" value="<?php if ($_GET['type']) {
                echo $_GET['type'];
              } else {
                echo 'venue';
              } ?>">
                <option value="venue"><a data-type="venue" href="#" class="px-3"><?php _e('สถานที่จัดงาน', 'wdl') ?></a></option>
                <option value="promotion"><a data-type="promotion" href="#" class="px-3"><?php _e('โปรโมชั่น', 'wdl') ?></a></option>
                <option value="wedding-fair"><a data-type="wedding-fair" href="#" class="px-3"><?php _e('Wedding Fair & Event', 'wdl') ?></a></option>
                <option value="vendor"><a data-type="vendor" href="#" class="px-3"><?php _e('ผู้ให้บริการ', 'wdl') ?></a></option>
                <option value="post"><a data-type="post" href="#" class="px-3"><?php _e('บทความ', 'wdl') ?></a></option>
              </select>
              <input class="wdl-search-submit" type="submit">
            </div>
          </form>
        </div>
      </div>
      <div class="col">
        <?php
        wp_nav_menu(
          array(
            'menu' => 'Lead menu location',
            'container_class' => '',
            'menu_class' => 'wdl-badge-small-container',
            'menu_id' => 'lead-menu'
          )
        );
        ?>
      </div>
    </div>
  </div>
</section>