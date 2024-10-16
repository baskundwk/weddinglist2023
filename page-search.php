<?php
$type = esc_html($_GET['type']);
$searchTerm = esc_html($_GET['q']);
$args = array(
  's' => $searchTerm,
  'post_type' => $type,
  'posts_per_page' => '50',
  'relevanssi' => true,
);
$searchQuery = new WP_Query($args);
$query = $searchQuery;
//print_r($query);
?>

<?php include get_stylesheet_directory() . '/components/header.php' ?>
<main>
  <?php include get_stylesheet_directory() . '/components/lead-menu-revamped.php' ?>
  <div class="row mb-2 g-2 align-items-center">
    <div class="col-xl-4">
      <div class="wdl-search">
        <form role="search" method="get" id="searchform" class="searchform" action="<?php
        if ($type === 'venue') {
          echo esc_url(home_url('/')) . '?type=venue';
        } else if ($type === 'promotion') {
          echo esc_url(home_url('/')) . '?type=promotion';
        } else if ($type === 'wedding-fair') {
          echo esc_url(home_url('/')) . '?type=wedding-fair';
        } else if ($type === 'vendor') {
          echo esc_url(home_url('/')) . '?type=vendor';
        } else if ($type === 'post') {
          echo esc_url(home_url('/')) . '?type=post';
        } else {
          echo esc_url(home_url('/')) . '?type=venue';
        } ?>">
          <div class="input-group d-flex">
            <input class="form-control p-2" type="text" name="s" id="s" placeholder="คุณกำลังมองหาอะไร..." value="<?php echo esc_html($searchTerm) ?>">
            <div id="search-type" class="wdl-dropdown dropdown">
              <div class="wdl-btn-filter" data-bs-toggle="dropdown" aria-expanded="false">
                <span>
                  <?php
                  if ($type === 'venue') {
                    echo 'สถานที่จัดงาน';
                  } else if ($type === 'promotion') {
                    echo 'โปรโมชั่น';
                  } else if ($type === 'wedding-fair') {
                    echo 'Wedding Fair & Event';
                  } else if ($type === 'vendor') {
                    echo 'ผู้ให้บริการ';
                  } else if ($type === 'post') {
                    echo 'บทความ';
                  } else {
                    echo 'สถานที่จัดงาน';
                  }
                  ?>
                </span>
                <i data-feather="chevron-down"></i>

              </div>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a data-type="venue" href="#" class="px-3"><?php _e('สถานที่จัดงาน') ?></a></li>
                <li><a data-type="promotion" href="#" class="px-3"><?php _e('โปรโมชั่น') ?></a></li>
                <li><a data-type="wedding-fair" href="#" class="px-3"><?php _e('Wedding Fair & Event') ?></a></li>
                <li><a data-type="vendor" href="#" class="px-3"><?php _e('ผู้ให้บริการ') ?></a></li>
                <li><a data-type="post" href="#" class="px-3"><?php _e('บทความ') ?></a></li>
              </ul>
            </div>
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
          'menu_class' => 'wdl-badge-small-container',
          'menu_id' => 'lead-menu'
        )
      );
      ?>
    </div>
  </div>
  <section>

    <div class="overflow-hidden mt-4">
      <div class="container-xl">
        <h1><?php echo (_e('ผลการค้นหา', 'ผลการค้นหา') . ' "' . $searchTerm . '"') ?></h1>
        <ul class="wdl-tab nav mb-3">
          <li class="nav-item">
            <a role="tab" aria-controls="tab-venue" class="nav-link <?php if ($type === "venue") {
              echo 'active';
            } ?>" aria-current="<?php if ($type === "venue") {
               echo 'page';
             } ?>" href="<?php if ($type === 'venue') {
                echo '#';
              } else {
                echo updateParam(['type' => 'venue']);
              } ?>"><i class="wdl-tab-icon" data-feather="map-pin"></i> สถานที่จัดงาน</a>
          </li>
          <li class="nav-item">
            <a role="tab" aria-controls="tab-promotion" class="nav-link <?php if ($type === "promotion") {
              echo 'active';
            } ?>" aria-current="<?php if ($type === "promotion") {
               echo 'page';
             } ?>" href="<?php if ($type === 'promotion') {
                echo '#';
              } else {
                echo updateParam(['type' => 'promotion']);
              } ?>"><i class="wdl-tab-icon" data-feather="tag"></i> โปรโมชั่น</a>
          </li>
          <li class="nav-item">
            <a role="tab" aria-controls="tab-wedding-fair" class="nav-link <?php if ($type === "wedding-fair") {
              echo 'active';
            } ?>" aria-current="<?php if ($type === "wedding-fair") {
               echo 'page';
             } ?>" href="<?php if ($type === 'wedding-fair') {
                echo '#';
              } else {
                echo updateParam(['type' => 'wedding-fair']);
              } ?>"><i class="wdl-tab-icon" data-feather="calendar"></i> Wedding Fair & Event</a>
          </li>
          <li class="nav-item">
            <a role="tab" aria-controls="tab-vendor" class="nav-link <?php if ($type === "vendor") {
              echo 'active';
            } ?>" aria-current="<?php if ($type === "vendor") {
               echo 'page';
             } ?>" href="<?php if ($type === 'vendor') {
                echo '#';
              } else {
                echo updateParam(['type' => 'vendor']);
              } ?>"><i class="wdl-tab-icon" data-feather="users"></i> ผู้ให้บริการ</a>
          </li>
          <li class="nav-item">
            <a role="tab" aria-controls="tab-post" class="nav-link <?php if ($type === "post") {
              echo 'active';
            } ?>" aria-current="<?php if ($type === "post") {
               echo 'page';
             } ?>" href="<?php if ($type === 'post') {
                echo '#';
              } else {
                echo updateParam(['type' => 'post']);
              } ?>"><i class="wdl-tab-icon" data-feather="bookmark"></i> บทความ</a>
          </li>
        </ul>
      </div>
    </div>

    <?php
    if ($query->have_posts()): ?>
      <div class="tab-content wdl-tab-related-content">
        <?php if ($type === 'venue'): ?>
          <div id="tab-venue" class="tab-pane fade">
            <div class="wdl-listing-section py-3">
              <div class="container-xl gap-3 d-flex flex-column">
                <?php
                while ($query->have_posts()) {
                  $query->the_post();
                  $listID = get_the_ID();
                  ?>
                  <?php include get_stylesheet_directory() . '/components/cards/card-listing.php' ?>
                  <?php
                }
                rewind_posts(); ?>
              </div>
            </div>
          </div>
        <?php endif; ?>
        <?php if ($type === 'promotion'): ?>
          <div id="tab-promotion" class="tab-pane fade">
            <div class="container-xxl container-archive pb-4">
              <div class="wdl-archive wdl-archive-extended wdl-archive-grid <?php echo esc_attr($atts['class']); ?>">
                <?php
                while ($query->have_posts()) {
                  $query->the_post();
                  ?>
                  <?php include get_stylesheet_directory() . '/components/cards/card-promotion.php' ?>
                  <?php
                }
                rewind_posts(); ?>
              </div>
            </div>
          </div>
        <?php endif; ?>
        <?php if ($type === 'wedding-fair'): ?>
          <div id="tab-wedding-fair" class="tab-pane fade">
            <div class="container-xxl container-archive overflow-hidden pb-4">
              <div class="wdl-archive wdl-archive-extended wdl-archive-grid <?php echo esc_attr($atts['class']); ?>">
                <?php
                while ($query->have_posts()) {
                  $query->the_post();
                  ?>
                  <?php include get_stylesheet_directory() . '/components/cards/card-wedding-fair.php' ?>
                  <?php
                }
                rewind_posts(); ?>
              </div>
            </div>
          </div>
        <?php endif; ?>
        <?php if ($type === 'vendor'): ?>
          <div id="tab-vendor" class="tab-pane fade">
            <div class="container-xxl container-archive overflow-hidden pb-4">
              <div class="wdl-archive wdl-archive-extended wdl-archive-grid <?php echo esc_attr($atts['class']); ?>">
                <?php
                while ($query->have_posts()) {
                  $query->the_post();
                  ?>
                  <?php include get_stylesheet_directory() . '/components/cards/card-vendor.php' ?>
                  <?php
                }
                rewind_posts(); ?>
              </div>
            </div>
          </div>
        <?php endif; ?>
        <?php if ($type === 'post'): ?>
          <div id="tab-post" class="tab-pane fade">
            <div class="container-xxl container-archive overflow-hidden pb-4">
              <div class="wdl-archive wdl-archive-extended wdl-archive-grid <?php echo esc_attr($atts['class']); ?>">
                <?php
                while ($query->have_posts()) {
                  $query->the_post();
                  ?>
                  <?php include get_stylesheet_directory() . '/components/cards/card-post.php' ?>
                  <?php
                }
                rewind_posts(); ?>
              </div>
            </div>
          </div>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </section>
  <?php include get_stylesheet_directory() . '/components/compare-bar.php' ?>
</main>

<?php include get_stylesheet_directory() . '/components/form-general.php' ?>
<?php include get_stylesheet_directory() . '/components/footer.php' ?>