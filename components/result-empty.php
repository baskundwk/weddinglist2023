<?php
$empty_word = [
  'wedding-fair' => __('ไม่พบ Wedding Fair & Event ที่คุณกำลังหา', 'wdl'),
  'promotion' => __('ไม่พบโปรโมชั่นที่คุณกำลังหา', 'wdl'),
  'venue' => __('ไม่พบสถานที่จัดงานที่คุณกำลังหา', 'wdl'),
  'vendor' => __('ไม่พบผู้ให้บริการที่คุณกำลังหา', 'wdl'),
  'listing' => __('ไม่พบรายการสถานที่จัดงานที่คุณกำลังหา', 'wdl'),
  'consultant' => __('ไม่พบที่ปรึกษาที่คุณกำลังหา', 'wdl'),
  'moment' => __('ไม่พบ Moment ที่คุณกำลังหา', 'wdl'),
  'video' => __('ไม่พบคลิปวิดีโอที่คุณกำลังหา', 'wdl'),
  'post' => __('ไม่พบบทความที่คุณกำลังหา', 'wdl'),
];
$empty_query = 'post';
if ($empty_type) {
  $empty_query = $empty_type;
}
?>
<section class="wdl-result-empty mb-3">
  <div class="container-xl">
    <div class="wdl-result-empty-inner">
      <div class="wdl-result-empty-image">
        <svg viewBox="0 0 24 24" width="100" height="100" stroke="currentColor" stroke-width="1" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
      </div>
      <p><?php echo $empty_word[$empty_query] ?></p>
    </div>
  </div>
</section>
<section class="wdl-result-empty-suggestion">
  <div class="container-xl">
    <?php $emptySuggestionQuery = new WP_Query([
      'post_type' => $empty_query,
      'order' => 'DESC',
      'orderby' => 'post_date',
      'post_status' => 'publish',
      'posts_per_page' => 8,
    ]);
    ?>
    <?php if ($emptySuggestionQuery->have_posts()): ?>
      <div class="row">
        <div class="col mb-2">
          <h2><?php __('คุณอาจสนใจ','wdl')?></h2>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="wdl-archive wdl-archive-extended">
            <div class="swiper wdl-archive-swiper">
              <div class="swiper-wrapper">
                <?php while ($emptySuggestionQuery->have_posts()): ?>
                  <?php $emptySuggestionQuery->the_post(); ?>
                  <div class="swiper-slide"><?php include 'cards/card-'.$empty_query.'.php' ?></div>
                <?php endwhile;
                wp_reset_postdata(); ?>
              </div>
              <div class="swiper-navigation swiper-navigation-small">
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
</section>