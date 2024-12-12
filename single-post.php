<?php include get_stylesheet_directory().'/components/header.php' ?>

<?php
$currentPostID = get_the_ID();
?>
<main>
  <div class="d-flex align-items-start justify-content-center gap-3 mb-3">

    <div class="wdl-single-container pb-2 py-xl-3">
      <?php include get_stylesheet_directory().'/components/all-page-ads.php' ?>
      <?php $post = new WP_Query(array(
        'ID' => $currentPostID,
        'status' => 'any'
      ));
      ?>
      <?php
      if ($post->have_posts()) {
        $post->the_post(); ?>

      <?php if (function_exists('rank_math_the_breadcrumbs')): ?>
      <div class="wdl-breadcrumb mb-2 px-3 px-xl-0">
        <?php rank_math_the_breadcrumbs(); ?>
      </div>
      <?php endif; ?>

      <h1 class="wdl-single-title mb-2 px-3 px-xl-0">
        <?php echo get_the_title($currentPostID); ?>
      </h1>
      <div class="wdl-single-thumbnail mb-3">
        <img loading="eager" src="<?php echo esc_html(get_the_post_thumbnail_url($currentPostID, 'medium_large')) ?>" width="100%" alt="<?php echo get_the_title() ?>">
      </div>

      <div class="wdl-single-content mb-2  px-3 px-xl-0">
        <div id="post-content-container" class="loading"></div>
        <?php /* the_content(); */ ?>
        <div class="wdl-single-content-readmore">
          <div class="wdl-btn">อ่านเพิ่มเติม</div>
        </div>
      </div>
      <?php } ?>
    </div>

    <div class="wdl-single-stickybar">
      <div class="wdl-single-stickybar-toggle">
        <i data-feather="bookmark"></i>
      </div>
      <div class="wdl-single-stickybar-toc mb-3">
        <div class="wdl-toc-inner disabled">
          <!-- <?php echo do_shortcode('[ez-toc post_in="'.$currentPostID.'"]') ?> -->
          <div class="wdl-toc-header">
            <p class="font-bold mb-0">เลือกหัวข้อที่ต้องการอ่าน</p>
            <span class="wdl-toc-toggle"></span>
          </div>
        </div>
      </div>

      <div class="wdl-single-stickybar-social">
        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_html(get_post_permalink()) ?>" class="wdl-share-icon">
          <img width="30" height="30" loading="eager" src="<?php echo (get_theme_file_uri()) ?>/images/share-facebook.svg" alt="Share to Facebook">
        </a>
        <a target="_blank" href="http://x.com/share?url=<?php echo esc_html(get_post_permalink()) ?>" class="wdl-share-icon">
          <img width="30" height="30" loading="eager" src="<?php echo (get_theme_file_uri()) ?>/images/share-x.svg" alt="Share to X">
        </a>
        <a target="_blank" href="https://social-plugins.line.me/lineit/share?url=<?php echo esc_html(get_post_permalink()) ?>" class="wdl-share-icon">
          <img width="30" height="30" loading="eager" src="<?php echo (get_theme_file_uri()) ?>/images/share-line.svg" alt="Share to LINE">
        </a>
        <a target="_blank" href="mailto:?body=<?php echo esc_html(get_the_title() . '%0D%0A' . get_post_permalink()) ?>" class="wdl-share-icon">
          <img width="30" height="30" loading="eager" src="<?php echo (get_theme_file_uri()) ?>/images/share-mail.svg" alt="Share to Email">
        </a>
      </div>
    </div>
  </div>

  <?php
  $related_promotion = get_field('RelatedPromotion', $currentPostID);
  if ($related_promotion):
    $related_promotion_id = array_map(function ($related_promotion) {
      return $related_promotion->ID;
    }, $related_promotion);
    $query_promotion = new WP_Query(array(
      'post_type' => 'promotion',
      'post_status' => 'publish',
      'p' => $related_promotion_id
    )) ?>
  <?php if ($query_promotion->have_posts()): ?>
  <div class="container-xl wdl-archive wdl-archive-extended wdl-archive-no-compare mx-auto">
    <h3>โปรโมชั่นที่เกี่ยวข้อง</h3>
    <div class="swiper wdl-archive-swiper">
      <div class="swiper-wrapper">
        <?php while ($query_promotion->have_posts()):
              $query_promotion->the_post() ?>
        <?php include get_stylesheet_directory().'/components/cards/card-promotion.php' ?>
        <?php endwhile;
            wp_reset_postdata(); ?>
      </div>
    </div>
  </div>
  <?php endif; endif; ?>

  <?php
  $related_weddingfair = get_field('RelatedWeddingFair', $currentPostID);
  if ($related_weddingfair):
    $related_weddingfair_id = array_map(function ($related_weddingfair) {
      return $related_weddingfair->ID;
    }, $related_weddingfair);
    $query_weddingfair = new WP_Query(array(
      'post_type' => 'wedding-fair',
      'post_status' => 'publish',
      'p' => $related_weddingfair_id
    )) ?>
  <?php if ($query_weddingfair->have_posts()): ?>
  <div class="container-xl wdl-archive wdl-archive-extended wdl-archive-no-compare mx-auto">
    <h3>Wedding Fair & Event ที่เกี่ยวข้อง</h3>
    <div class="swiper wdl-archive-swiper">
      <div class="swiper-wrapper">
        <?php while ($query_weddingfair->have_posts()):
              $query_weddingfair->the_post() ?>
        <?php include get_stylesheet_directory().'/components/cards/card-weddingfair.php' ?>
        <?php endwhile;
            wp_reset_postdata(); ?>
      </div>
    </div>
  </div>
  <?php endif; endif; ?>

  <?php
  $related_venue = get_field('RelatedVenue', $currentPostID);
  if ($related_venue):
    $related_venue_id = array_map(function ($related_venue) {
      return $related_venue->ID;
    }, $related_venue);
    $query_venue = new WP_Query(array(
      'post_type' => 'venue',
      'post_status' => 'publish',
      'p' => $related_venue_id
    )) ?>
  <?php if ($query_venue->have_posts()): ?>
  <div class="container-xl wdl-archive wdl-archive-extended wdl-archive-no-compare mx-auto">
    <h3>สถานที่จัดงานที่เกี่ยวข้อง</h3>
    <div class="swiper wdl-archive-swiper">
      <div class="swiper-wrapper">
        <?php while ($query_venue->have_posts()):
              $query_venue->the_post() ?>
        <?php include get_stylesheet_directory().'/components/cards/card-venue.php' ?>
        <?php endwhile;
            wp_reset_postdata(); ?>
      </div>
    </div>
  </div>
  <?php endif; endif; ?>

  <?php
  $related_vendor = get_field('RelatedVendor', $currentPostID);
  if ($related_vendor):
    $related_vendor_id = array_map(function ($related_vendor) {
      return $related_vendor->ID;
    }, $related_vendor);
    $query_vendor = new WP_Query(array(
      'post_type' => 'vendor',
      'post_status' => 'publish',
      'p' => $related_vendor_id
    )) ?>
  <?php if ($query_vendor->have_posts()): ?>
  <div class="container-xl wdl-archive wdl-archive-extended wdl-archive-no-compare mx-auto">
    <h3>ผู้ให้บริการที่เกี่ยวข้อง</h3>
    <div class="swiper wdl-archive-swiper">
      <div class="swiper-wrapper">
        <?php while ($query_vendor->have_posts()):
              $query_vendor->the_post() ?>
        <?php include get_stylesheet_directory().'/components/cards/card-vendor.php' ?>
        <?php endwhile;
            wp_reset_postdata(); ?>
      </div>
    </div>
  </div>
  <?php endif; endif; ?>

  <?php $latest_posts = new WP_Query(array(
    'post_type' => 'post',
    'order' => 'DESC',
    'orderby' => 'date',
    'post_status' => 'publish',
    'posts_per_page' => '3',
  )) ?>
  <?php if ($latest_posts->have_posts()): ?>
  <div class="container-xl wdl-archive wdl-archive-extended wdl-archive-no-compare mx-auto">
    <h3>บทความล่าสุด</h3>
    <div class="swiper wdl-archive-swiper">
      <div class="swiper-wrapper">
        <?php while ($latest_posts->have_posts()):
            $latest_posts->the_post() ?>
        <?php include get_stylesheet_directory().'/components/cards/card-post.php' ?>
        <?php endwhile;
          wp_reset_postdata(); ?>
      </div>
    </div>
  </div>
  <?php endif; ?>
</main>

<?php include get_stylesheet_directory().'/components/popup-ads.php' ?>

<?php include get_stylesheet_directory().'/components/footer.php' ?>