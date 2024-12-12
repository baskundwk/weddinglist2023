<?php include get_stylesheet_directory() . '/components/header.php' ?>
<?php include get_stylesheet_directory() . '/components/localnav.php' ?>
<main>
  <?php include get_stylesheet_directory() . '/components/hero-banner.php' ?>

  <?php include get_stylesheet_directory() . '/components/lead-menu-revamped.php' ?>

  <?php $promotionArgs = array(
    'post_type' => 'promotion',
    'post_status' => 'publish',
    'orderby' => 'meta_value',
    'order' => 'DESC',
    'posts_per_page' => '9',
    'meta_key' => 'HotDeal',
  );

  $promotion = new WP_Query($promotionArgs);
  ?>
  <?php
  if ($promotion->have_posts()): ?>
  <section>
    <div class="container">
      <div class="row mb-2">
        <div class="col-lg">
          <h2 class="h1 wdl-localnav-heading mb-0">
            <?php echo (get_option('wdl_options', 'โปรโมชั่นงานแต่งงาน')['word-frontpage-promotion-title']); ?>
          </h2>
          <p class="mb-2">
            <?php echo (get_option('wdl_options', 'รวบรวมโปรโมชั่นแต่งงานให้คุณไว้ที่เดียว')['word-frontpage-promotion-desc']); ?>
          </p>
        </div>
        <div class="col-lg text-lg-end pt-lg-2 d-none d-lg-block">
          <a href="<?php echo esc_html(get_post_type_archive_link('promotion')) ?>" class="wdl-btn-secondary py-2 px-3">
            <?php _e('ดูโปรโมชั่นทั้งหมด', 'wdl') ?>
          </a>
        </div>
      </div>
      <div class="wdl-archive wdl-archive-extended">

        <div id="promotions" class="swiper wdl-archive-swiper">
          <div class="swiper-wrapper 
            <?php if ($_GET['order'] || $_GET['orderby'] || $_GET['key']) {

            } else {
              echo 'row-cols-archive-randomized';
            } ?> ">
            <?php
            while ($promotion->have_posts()): ?>
            <?php $promotion->the_post(); ?>

            <?php include get_stylesheet_directory() . '/components/cards/card-promotion.php' ?>

            <?php endwhile; ?>
          </div>
          <div class="swiper-pagination"></div>
          <div class="swiper-navigation swiper-navigation-small">
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          </div>
        </div>
      </div>
      <div class="text-center pt-lg-2 d-block d-lg-none mb-4">
        <a href="<?php echo esc_html(get_post_type_archive_link('promotion')) ?>" class="wdl-btn-secondary py-2 px-3">
          <?php _e('ดูโปรโมชั่นทั้งหมด', 'wdl') ?>
        </a>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <?php $weddingfairArgs = array(
    'post_type' => 'wedding-fair',
    'post_status' => 'publish',
    'orderby' => 'meta_value',
    'order' => 'DESC',
    'posts_per_page' => '9',
    'meta_key' => 'HotDeal',
  );

  $weddingfair = new WP_Query($weddingfairArgs);
  ?>

  <?php if ($weddingfair->have_posts()): ?>
  <section class="html-lazy">
    <div class="container">
      <div class="row mb-2">
        <div class="col-lg">
          <h2 class="h1 wdl-localnav-heading mb-0">
            <?php echo (get_option('wdl_options', 'Wedding Fair & Event')['word-frontpage-wedding-fair-title']); ?>
          </h2>
          <p class="mb-2">
            <?php echo (get_option('wdl_options', 'รวบรวมงานแฟร์ และ อีเว้นท์ให้คุณไว้ที่เดียว')['word-frontpage-wedding-fair-desc']); ?>
          </p>
        </div>
        <div class="col-lg text-lg-end pt-lg-3 d-none d-lg-block">
          <a href="<?php echo esc_html(get_post_type_archive_link('wedding-fair')) ?>" class="wdl-btn-secondary py-2 px-3">
            <?php _e('ดู Wedding Fair & Event ทั้งหมด', 'wdl') ?>
          </a>
        </div>
      </div>
      <div class="wdl-archive wdl-archive-extended">

        <div class="swiper wdl-archive-swiper">
          <div class="swiper-wrapper 
              <?php if ($_GET['order'] || $_GET['orderby'] || $_GET['key']) {

              } else {
                echo 'row-cols-archive-randomized';
              } ?> ">
            <?php while ($weddingfair->have_posts()): ?>
            <?php $weddingfair->the_post(); ?>

            <?php include get_stylesheet_directory() . '/components/cards/card-weddingfair.php' ?>

            <?php endwhile; ?>
          </div>
          <div class="swiper-pagination"></div>
          <div class="swiper-navigation swiper-navigation-small">
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          </div>
        </div>
      </div>

      <div class="text-center pt-lg-3 d-block d-lg-none mb-4">
        <a href="<?php echo esc_html(get_post_type_archive_link('wedding-fair')) ?>" class="wdl-btn-secondary py-2 px-3">
          <?php _e('ดู Wedding Fair & Event ทั้งหมด', 'wdl') ?>
        </a>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <?php $venueArgs = array(
    'post_type' => 'venue',
    'post_status' => 'publish',
    'orderby' => 'meta_value',
    'order' => 'DESC',
    'posts_per_page' => '9',
    'meta_key' => 'Sponsor',
  );

  $venue = new WP_Query($venueArgs);
  ?>
  <?php if ($venue->have_posts()): ?>

  <section class="html-lazy">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h2 class="h1 wdl-localnav-heading mb-0">
            <?php echo (get_option('wdl_options', 'สถานที่จัดงานแต่งงาน')['word-frontpage-venue-title']); ?>
          </h2>
          <p class="mb-2">
            <?php echo (get_option('wdl_options', 'รวบรวมสถานที่จัดงานแต่งงานให้คุณไว้ที่เดียว')['word-frontpage-venue-desc']); ?>
          </p>
        </div>
        <div class="col-md-6 pb-3 py-lg-3 text-start text-lg-end">
          <?php foreach (get_terms('venue_type') as $term) {
              echo '<a class="wdl-badge-sm-secondary m-1" href="/venue/?type=' . $term->slug . '">' . $term->name . '</a>';
            } ?>
        </div>
      </div>
      <div class="wdl-archive wdl-archive-extended">
        <div class="swiper wdl-archive-swiper">
          <div class="swiper-wrapper  
              <?php if ($_GET['order'] || $_GET['orderby'] || $_GET['key']) {

              } else {
                echo 'row-cols-archive-randomized';
              } ?> ">

            <?php while ($venue->have_posts()): ?>
            <?php $venue->the_post();
                $sponsored = get_field('Sponsor');
                ?>

            <div class="swiper-slide <?php if ($sponsored && in_array('Sponsored', $sponsored)) {
                  echo ('order-first');
                } ?> <?php if (get_field('Sponsor')) {
                    echo esc_html('wdl-archive-primary');
                  } else {
                    echo esc_html('wdl-archive-default');
                  } ?>">
              <?php include get_stylesheet_directory() . '/components/cards/card-venue.php' ?>
            </div>
            <?php endwhile; ?>
          </div>

          <div class="swiper-pagination"></div>
          <div class="swiper-navigation swiper-navigation-small">
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          </div>
        </div>
      </div>
      <div class="text-center mb-3">
        <a href="<?php echo esc_html(get_post_type_archive_link('venue')) ?>" class="wdl-btn-secondary py-2 px-3">
          <?php _e('ดูสถานที่จัดงานแต่งงานทั้งหมด', 'wdl') ?>
        </a>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <?php
  $vendor_type = get_terms(array(
    'taxonomy' => 'vendor-type',
    'hide_empty' => true,
  ));

  if (is_user_logged_in() === true) {
    $post_status = 'any';
  } else {
    $post_status = 'publish';
  }
  $vendorArgs = array(
    'post_type' => 'vendor',
    'post_status' => $post_status,
    'order' => 'DESC',
    'posts_per_page' => '9',
  );

  $vendor = new WP_Query($vendorArgs);
  ?>

  <?php if ($vendor->have_posts()): ?>
  <section class="overflow-hidden html-lazy">
    <div class="container">
      <h2 class="h1 wdl-localnav-heading mb-0">
        <?php echo (get_option('wdl_options', 'ผู้ให้บริการงานแต่งงาน')['word-frontpage-vendor-title']); ?>
      </h2>
      <p class="mb-2">
        <?php echo (get_option('wdl_options', 'รวบรวมผู้ให้บริการงานแต่งงานให้คุณไว้ที่เดียว')['word-frontpage-vendor-desc']); ?>
      </p>
      <div class="swiper wdl-swiper-auto">
        <ul class="swiper-wrapper nav flex-nowrap p-0 wdl-tab mb-3 wdl-tab-related" role="tablist">
          <?php foreach ($vendor_type as $type) { ?>
          <li role="tab" aria-controls="tab-vendor-<?php echo $type->slug ?>" class="swiper-slide w-auto nav-item">
            <a data-bs-toggle="tab" data-bs-target="#tab-vendor-<?php echo $type->slug ?>" class="nav-link" href="#"><?php echo $type->name ?></a>
          </li>
          <?php } ?>
        </ul>
      </div>
      <div class="tab-content wdl-tab-related-content">
        <?php
          foreach ($vendor_type as $type) {
            $type_query = get_posts(
              array(
                'post_type' => 'vendor',
                'posts_per_page' => 9,
                'orderby' => 'date',
                'order' => 'DESC',
                'tax_query' => array(
                  array(
                    'taxonomy' => 'vendor-type',
                    'field' => 'term_id',
                    'terms' => $type->term_id,
                  )
                )
              )
            );

            if ($type_query): ?>
        <div id="tab-vendor-<?php echo $type->slug ?>" class="tab-pane fade">
          <div class="wdl-archive wdl-archive-extended">
            <div id="vendor-swiper" class="swiper wdl-archive-swiper">
              <div class="swiper-wrapper row-cols-archive-randomized opacity-1">
                <?php foreach ($type_query as $post): ?>
                <?php include get_stylesheet_directory() . '/components/cards/card-vendor.php' ?>
                <?php endforeach; ?>
              </div>
              <div class="swiper-navigation swiper-navigation-small">
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
              </div>
              <div class="swiper-pagination"></div>
            </div>

            <div class="text-center mt-4 mb-3">
              <a href="<?php echo esc_html(get_term_link($type)) ?>" class="wdl-btn-secondary py-2 px-3">
                <?php _e('ดู ' . $type->name . ' ทั้งหมด', 'wdl') ?>
              </a>
            </div>
          </div>
        </div>
        <?php endif;
          } ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <?php
  $paged = get_query_var('paged', 1);
  $postAll = new WP_Query(
    array(
      'post_type' => 'post',
      'post_status' => 'publish',
      'posts_per_page' => '12',
      'paged' => $paged,
      'orderby' => 'post_date',
      'order' => 'DESC'
    )
  ) ?>

  <section class="pb-5 html-lazy">
    <div class="container">
      <h2 class="h1 wdl-localnav-heading mb-0">
        <?php echo (get_option('wdl_options', 'บทความล่าสุด')['word-frontpage-post-title']); ?>
      </h2>
      <p class="text-secondary">
        <?php echo (get_option('wdl_options', 'รวบรวมบทความให้คุณไว้ที่เดียว')['word-frontpage-post-desc']); ?>
      </p>
      <div class="wdl-badge-container">
        <a href="#" class="wdl-badge-sm-primary">ทั้งหมด</a>
        <a href="<?php echo esc_html(get_category_link(get_cat_ID('รีวิวแต่งงาน'))) ?>" class="wdl-badge-sm-secondary">รีวิวแต่งงาน</a>
        <a href="<?php echo esc_html(get_category_link(get_cat_ID('สถานที่จัดงานแต่งงาน'))) ?>" class="wdl-badge-sm-secondary">สถานที่จัดงานแต่งงาน</a>
        <a href="<?php echo esc_html(get_category_link(get_cat_ID('ฤกษ์แต่งงาน'))) ?>" class="wdl-badge-sm-secondary">ฤกษ์แต่งงาน</a>
      </div>
      <?php if ($postAll->have_posts()): ?>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-2 wdl-archive wdl-archive-extended opacity-1">
        <?php while ($postAll->have_posts()): ?>
        <?php $postAll->the_post(); ?>
        <div class="col">
          <?php include get_stylesheet_directory() . '/components/cards/card-post.php' ?>
        </div>
        <?php endwhile;
          wp_reset_postdata(); ?>
        <div class="row">
          <div class="col">
            <?php pagination(); ?>
          </div>
        </div>
      </div>
      <div class="text-center">
        <a href="<?php echo esc_html(get_post_type_archive_link('post')) ?>" class="wdl-btn-secondary py-2 px-3">
          <?php _e('ดูบทความทั้งหมด', 'ดูบทความทั้งหมด') ?>
        </a>
      </div>
      <?php endif; ?>
    </div>
  </section>

  <?php include get_stylesheet_directory() . '/components/compare-bar.php' ?>
</main>

<?php include get_stylesheet_directory() . '/components/form-general.php' ?>
<?php include get_stylesheet_directory() . '/components/popup-ads.php' ?>
<?php include get_stylesheet_directory() . '/components/footer.php' ?>