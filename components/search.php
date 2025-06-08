<!-- <section class="py-2">
  <div class="container-xl">
    <div class="row align-items-center g-3">
      <div class="col-lg">
        <div class="wdl-search">
          <form class="searchform" action="/">
            <div class="input-group d-flex">
              <input class="form-control p-2" type="text" name="s" id="search" placeholder="คุณกำลังมองหาอะไร..." value="<?php 
              if(isset($_GET['s'])) { 
                echo esc_html($_GET['s']);
              } ?>">
              <select id="type" name="type" value="<?php if ($_GET['type']) {
                echo $_GET['type'];
              } else {
                echo 'venue';
              } ?>">
                <option value="venue"><a data-type="venue" href="#" class="px-3"><?php _e('สถานที่จัดงาน', 'wdl') ?></a></option>
                <option value="promotion"><a data-type="promotion" href="#" class="px-3"><?php _e('โปรโมชั่น', 'wdl') ?></a></option>
                <option value="wedding-fair"><a data-type="wedding-fair" href="#" class="px-3"><?php _e('Wedding Fair & Event', 'wdl') ?></a></option>
                <option value="vendor"><a data-type="vendor" href="#" class="px-3"><?php _e('ผู้ให้บริการ', 'wdl') ?></a></option>
                <option value="post"><a data-type="post" href="#" class="px-3"><?php _e('บทความ', 'wdl') ?></a></option>
                <option value="video"><a data-type="video" href="#" class="px-3"><?php _e('คลิปวิดีโอ', 'wdl') ?></a></option>
                <?php /* <option value="listing"><a data-type="listing" href="#" class="px-3"><?php _e('รายการแนะนำ', 'wdl') ?></a></option> */ ?>
              </select>
              <input class="wdl-search-submit" type="submit">
            </div>
          </form>
        </div>
      </div>
      <div class="col-lg">
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
</section> -->

<section class="pb-3 bg-gray border-bottom">
  <?php include get_stylesheet_directory() . '/components/friendlysearch.php' ?>
</section>