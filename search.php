<?php
$type = $_GET['type'];
$searchTerm = $_GET['s'];
if ($type && $searchTerm):
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
<main
  data-dlev="search"
  data-dlcomp="search - page"
  data-dldt='{
    "keyword": "<?php echo $searchTerm ?>",
    "type": "<?php echo $type ?>"
  }'
>
  <?php // include get_stylesheet_directory() . '/components/search.php';
  $type = $_GET['type'];
  ?>
  <section>
    <div class="overflow-hidden mt-4">
      <div class="container-xl">
        <h1><?php echo (_e('ผลการค้นหา', 'wdl') . ' "' . $searchTerm . '"') ?></h1>
        <nav class="wdl-swiper-auto">
          <ul class="wdl-tab swiper-wrapper mb-3 p-0">
            <li class="swiper-slide w-auto">
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
            <li class="swiper-slide w-auto">
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
            <li class="swiper-slide w-auto">
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
            <li class="swiper-slide w-auto">
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
            <li class="swiper-slide w-auto">
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
            <li class="swiper-slide w-auto">
              <a role="tab" aria-controls="tab-video" class="nav-link <?php if ($type === "video") {
                  echo 'active';
                } ?>" aria-current="<?php if ($type === "video") {
                   echo 'page';
                 } ?>" href="<?php if ($type === 'video') {
                    echo '#';
                  } else {
                    echo updateParam(['type' => 'video']);
                  } ?>"><i class="wdl-tab-icon" data-feather="film"></i> คลิปวิดีโอ</a>
            </li>
            <?php /* <li class="swiper-slide w-auto">
              <a role="tab" aria-controls="tab-listing" class="nav-link <?php if ($type === "listing") {
                  echo 'active';
                } ?>" aria-current="<?php if ($type === "listing") {
                   echo 'page';
                 } ?>" href="<?php if ($type === 'listing') {
                    echo '#';
                  } else {
                    echo updateParam(['type' => 'listing']);
                  } ?>"><i class="wdl-tab-icon" data-feather="file-text"></i> รายการแนะนำ</a>
            </li> */ ?>
          </ul>
        </nav>
      </div>
    </div>

    <?php
      if ($query->have_posts()): ?>
    <div class="search-result">
      <?php if ($type === 'venue'): ?>
      <div class="wdl-listing-section py-4 border-top">
        <div class="container-xl gap-2 d-flex flex-column">
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
      <?php endif; ?>
      <?php if ($type === 'promotion'): ?>
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
      <?php endif; ?>
      <?php if ($type === 'wedding-fair'): ?>
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
      <?php endif; ?>
      <?php if ($type === 'vendor'): ?>
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
      <?php endif; ?>
      <?php if ($type === 'post'): ?>
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
      <?php endif; ?>
      <?php if ($type === 'video'): ?>
      <div class="container-xl overflow-hidden pb-4">
        <div class="wdl-video-grid <?php echo esc_attr($atts['class']); ?>">
          <?php
                while ($query->have_posts()) {
                  $query->the_post();
                  ?>
          <?php include get_stylesheet_directory() . '/components/cards/card-video.php' ?>
          <?php
                }
                rewind_posts(); ?>
        </div>
      </div>
      <?php endif; ?>
      <?php /* if ($type === 'listing'): ?>
      <div class="container-xxl container-archive overflow-hidden pb-4">
        <div class="wdl-archive wdl-archive-extended wdl-archive-grid <?php echo esc_attr($atts['class']); ?>">
          <?php
                while ($query->have_posts()) {
                  $query->the_post();
                  ?>
          <?php include get_stylesheet_directory() . '/components/cards/card-listing-thumbnail.php' ?>
          <?php
                }
                rewind_posts(); ?>
        </div>
      </div>
      <?php endif; */ ?>
    </div>
    <?php else: ?>
    <section class="pb-5">
      <div class="container-xl">
        <div class="row justify-content-center align-items-center py-5">
          <div class="col-12 text-center py-5">
            <i data-feather="search" class="mb-4" width="60" height="60" stroke="#DADADA" stroke-width="1"></i>
            <h1 class="text-red">
              <?php _e('ไม่พบผลลัพธ์ที่คุณกำลังหา', 'wdl') ?>
            </h1>
            <p>
              <?php _e('ขออภัยค่ะ ไม่พบผลลัพธ์ที่คุณกำลังหา กรุณาตรวจสอบความถูกต้องของคำค้น หรือประเภทของการค้นหา', 'wdl') ?>
            </p>
          </div>
        </div>
      </div>
    </section>
    <?php endif; ?>
  </section>
  <?php include get_stylesheet_directory() . '/components/compare-bar.php' ?>
</main>

<?php include get_stylesheet_directory() . '/components/footer.php' ?>

<?php else:
  http_response_code(400);
  header("Location: /");
endif; ?>