<?php include get_stylesheet_directory() . '/components/header.php' ?>
<main>
  <?php include get_stylesheet_directory() . '/components/hero-banner.php' ?>
  <?php include get_stylesheet_directory().'/components/search.php' ?>

  <?php $weddingfairArgs = array(
    'post_type' => 'wedding-fair',
    'orderby' => 'meta_value',
    'order' => 'DESC',
    'posts_per_page' => '9',
    'meta_key' => 'HotDeal',
  );

  $weddingfair = new WP_Query($weddingfairArgs);
  ?>

  <?php if ($weddingfair->have_posts()): ?>
  <section class="html-lazy">
    <div class="container-xl">
      <div class="row mb-2">
        <div class="col-lg">
          <h2 class="h1 wdl-localnav-heading mb-0">
            <?php _e('Wedding Fair & Event', 'wdl'); ?>
          </h2>
        </div>
        <div class="col-lg text-lg-end d-none d-lg-block">
          <a href="<?php echo esc_html(get_post_type_archive_link('wedding-fair')) ?>" class="wdl-btn-secondary ">
            <?php _e('ดู Wedding Fair & Event ทั้งหมด', 'wdl') ?>
          </a>
        </div>
      </div>
      <div class="wdl-archive wdl-archive-extended">

        <div class="swiper wdl-archive-swiper">
          <div class="swiper-wrapper row-cols-archive-randomized">
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

      <div class="text-center pt-lg-2 d-block d-lg-none mb-4">
        <a href="<?php echo esc_html(get_post_type_archive_link('wedding-fair')) ?>" class="wdl-btn-secondary ">
          <?php _e('ดู Wedding Fair & Event ทั้งหมด', 'wdl') ?>
        </a>
      </div>
    </div>
  </section>
  <?php endif; ?>

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
    <div class="container-xl">
      <div class="row mb-2">
        <div class="col-lg">
          <h2 class="h1 wdl-localnav-heading mb-0">
            <?php _e('โปรโมชั่นงานแต่งงาน', 'wdl'); ?>
          </h2>
        </div>
        <div class="col-lg text-lg-end d-none d-lg-block">
          <a href="<?php echo esc_html(get_post_type_archive_link('promotion')) ?>" class="wdl-btn-secondary ">
            <?php _e('ดูโปรโมชั่นทั้งหมด', 'wdl') ?>
          </a>
        </div>
      </div>
      <div class="wdl-archive wdl-archive-extended">

        <div id="promotions" class="swiper wdl-archive-swiper">
          <div class="swiper-wrapper row-cols-archive-randomized'">
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
        <a href="<?php echo esc_html(get_post_type_archive_link('promotion')) ?>" class="wdl-btn-secondary ">
          <?php _e('ดูโปรโมชั่นทั้งหมด', 'wdl') ?>
        </a>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <?php
    $venueArgs = array(
    'post_type' => 'venue',
    'orderby' => 'meta_value',
    'order' => 'DESC',
    'posts_per_page' => '9',
    'meta_key' => 'Sponsor',
    );

  $venue = new WP_Query($venueArgs);?>
  <?php if ($venue->have_posts()): ?>
  <section class="html-lazy">
    <div class="container-xl">
      <div class="row g-2">
        <div class="col-auto">
          <h2 class="h1 wdl-localnav-heading mb-0">
            <?php _e('สถานที่จัดงานแต่งงาน', 'wdl') ?>
          </h2>
        </div>
        <div class="col-lg text-lg-end d-none d-lg-block">
          <a href="<?php echo esc_html(get_post_type_archive_link('venue')) ?>" class="wdl-btn-secondary ">
            <?php _e('ดูสถานที่จัดงานแต่งงานทั้งหมด', 'wdl') ?>
          </a>
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-auto pb-2 py-lg-1 text-start text-lg-end d-flex flex-wrap gap-3">
          <?php $venueType = get_field('VenueType');
          if ($venueType) {
            echo implode(' / ', array_map(function ($venueType) { return $venueType->name;}, $venueType));
          }
          ?>
          <?php 
          $venueSlugs = ['ultra-luxury','luxury','garden','modern','hall','contempory-thai-style','city-hotel-lifestyle','beachside'];
          $venueCharacter = get_terms([
            'taxonomy' => 'venue_character',
            'hide_empty' => true,
            'slug' => $venueSlugs,
          ]);
          if (!is_wp_error($venueCharacter) && !empty($venueCharacter)) {
              // Create an associative array of terms keyed by slug for easy lookup
              $terms_by_slug = [];
              foreach ($venueCharacter as $term) {
                  $terms_by_slug[$term->slug] = $term;
              }
          
              // Sort the terms based on the order of the slug array
              $sorted_terms = [];
              foreach ($venueSlugs as $slug) {
                  if (isset($terms_by_slug[$slug])) {
                      $sorted_terms[] = $terms_by_slug[$slug];
                  }
              }
          
              // Display the sorted terms
              foreach ($sorted_terms as $term) {
                  $characterBackground = get_field('CharacterBackground', $term);
                  $characterBorder = get_field('CharacterBorder', $term);
                  $characterColor = get_field('CharacterColor', $term);
                  $characterEffect = get_field('CharacterEffect', $term);
                  ?>
                  <a href="<?php echo home_url( '/venue/?character='.$term->slug ) ?>" class="wdl-character
                    <?php if ($characterBorder) {
                      echo ('wdl-character-border');
                    } ?>
                    <?php if ($characterEffect) {
                      echo ('wdl-character-animation-' . $characterEffect);
                    } ?>"
                    <?php
                    if ($characterColor || $characterBackground): ?>
                      style="
                        --background-image: url(<?php echo ($characterBackground['url']) ?>);
                        --box-shadow: none;
                        --color: rgba(<?php echo ($characterColor['red']) ?>,<?php echo ($characterColor['green']) ?>,<?php echo ($characterColor['blue']) ?>,<?php echo ($characterColor['alpha']) ?>);
                        --color-50: rgba(<?php echo ($characterColor['red']) ?>,<?php echo ($characterColor['green']) ?>,<?php echo ($characterColor['blue']) ?>, 50%);
                        --color-0: rgba(<?php echo ($characterColor['red']) ?>,<?php echo ($characterColor['green']) ?>,<?php echo ($characterColor['blue']) ?>, 0);
                      "
                    <?php endif ?>>
                    <span><?php echo esc_html($term->name); ?></span>
                  </a>
              <?php }
          } ?>
        </div>
      </div>
      <div class="wdl-archive wdl-archive-extended">
        <div class="swiper wdl-archive-swiper">
          <div class="swiper-wrapper row-cols-archive-randomized">

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
      <div class="text-center pt-lg-2 d-block d-lg-none mb-4">
        <a href="<?php echo esc_html(get_post_type_archive_link('venue')) ?>" class="wdl-btn-secondary ">
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

    $vendorArgs = array(
      'post_type' => 'vendor',
      'order' => 'DESC',
      'posts_per_page' => '9',
      'orderby' => 'meta_value',
      'meta_key' => 'Status',
    );

  $vendor = new WP_Query($vendorArgs); ?>
  <?php if ($vendor->have_posts()): ?>
  <section class="overflow-hidden html-lazy">
    <div class="container-xl">
      <h2 class="h1 wdl-localnav-heading mb-0">
        <?php _e('ผู้ให้บริการงานแต่งงาน', 'wdl')?>
      </h2>
      <div class="swiper wdl-swiper-auto">
        <ul class="swiper-wrapper nav flex-nowrap p-0 wdl-tab mb-2 wdl-tab-related" role="tablist">
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
                'orderby' => 'meta_value',
                'meta_key' => 'Status',
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

            <div class="text-center mt-4 mb-2">
              <a href="<?php echo esc_html(get_term_link($type)) ?>" class="wdl-btn-secondary ">
              <?php _e('ดู ', 'wdl');
                  echo $type->name; 
                  _e(' ทั้งหมด', 'wdl'); ?>
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


  <?php $videoArgs = array(
    'post_type' => 'video',
    'orderby' => 'meta_value',
    'posts_per_page' => '12',
  );

  $video = new WP_Query($videoArgs);
  ?>
  <?php
  if ($video->have_posts()): ?>
  <section class="mb-4">
    <div class="container-xl">
      <div class="row mb-2">
        <div class="col-lg">
          <h2 class="h1 wdl-localnav-heading mb-0">
            <?php _e('รวมคลิปวิดีโอล่าสุด','wdl'); ?> <span class="badge wdl-badge-sm">มาใหม่</span>
          </h2>
        </div>
        <div class="col-lg text-lg-end d-none d-lg-block">
          <a href="<?php echo esc_html(get_post_type_archive_link('video')) ?>" class="wdl-btn-secondary">
            <?php _e('ดูรวมคลิปวิดีโอทั้งหมด', 'wdl') ?>
          </a>
        </div>
      </div>
      <div class="wdl-archive-extended">
        <div id="video" class="swiper wdl-video-swiper overflow-hidden px-2 wdl-archive-swiper">
          <div class="swiper-wrapper">
            <?php while ($video->have_posts()): ?>
            <?php $video->the_post(); ?>
            <?php include get_stylesheet_directory() . '/components/cards/card-video.php' ?>
            <?php endwhile; ?>
          </div>
          <div class="swiper-navigation swiper-navigation-small mt-2">
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          </div>
          <div class="swiper-pagination position-relative"></div>
        </div>
      </div>
      <div class="text-center pt-2 d-block d-lg-none mb-4">
        <a href="<?php echo esc_html(get_post_type_archive_link('video')) ?>" class="wdl-btn-secondary ">
          <?php _e('ดูรวมคลิปวิดีโอทั้งหมด', 'wdl') ?>
        </a>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <?php $listingArgs = array(
    'post_type' => 'listing',
    'orderby' => 'meta_value',
    'posts_per_page' => '8',
  );

  $listing = new WP_Query($listingArgs);
  ?>
  <?php
  if ($listing->have_posts()): ?>
  <section class="mb-4">
    <div class="container-xl">
      <div class="row mb-2">
        <div class="col-lg">
          <h2 class="h1 wdl-localnav-heading mb-0">
            <?php _e('สถานที่จัดงานแต่งงานแนะนำ','wdl'); ?> <span class="badge wdl-badge-sm">มาใหม่</span>
          </h2>
        </div>
        <div class="col-lg text-lg-end d-none d-lg-block">
          <a href="<?php echo esc_html(get_post_type_archive_link('listing')) ?>" class="wdl-btn-secondary ">
            <?php _e('ดูรายการสถานที่ทั้งหมด', 'wdl') ?>
          </a>
        </div>
      </div>
      <div id="listing" class="wdl-listing-grid">
        <?php while ($listing->have_posts()): ?>
        <?php $listing->the_post(); ?>

        <?php include get_stylesheet_directory() . '/components/cards/card-listing-thumbnail.php' ?>

        <?php endwhile; ?>
      </div>
      <div class="text-center pt-lg-2 d-block d-lg-none mt-2 mb-4">
        <a href="<?php echo esc_html(get_post_type_archive_link('listing')) ?>" class="wdl-btn-secondary ">
          <?php _e('ดูรายการสถานที่ทั้งหมด', 'wdl') ?>
        </a>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <?php
  $postAll = new WP_Query(
    array(
      'post_type' => 'post',
      'posts_per_page' => '12',
    )
  ) ?>

  <section class="pb-5 html-lazy">
    <div class="container-xl">
      <h2 class="h1 wdl-localnav-heading mb-0">
        <?php _e('บทความล่าสุด', 'wdl')?>
      </h2>
      <div class="wdl-badge-container">
        <a href="<?php get_permalink(get_page_by_path('blog')) ?>" class="wdl-badge-sm-primary"><?php _e('ทั้งหมด', 'wdl') ?></a>
        <a href="<?php echo esc_html(get_category_link(get_cat_ID('รีวิวแต่งงาน'))) ?>" class="wdl-badge-sm-secondary"><?php echo get_category( get_cat_ID('รีวิวแต่งงาน'))->name?></a>
        <a href="<?php echo esc_html(get_category_link(get_cat_ID('สถานที่จัดงานแต่งงาน'))) ?>" class="wdl-badge-sm-secondary"><?php echo get_category( get_cat_ID('สถานที่จัดงานแต่งงาน'))->name?></a>
        <a href="<?php echo esc_html(get_category_link(get_cat_ID('ฤกษ์แต่งงาน'))) ?>" class="wdl-badge-sm-secondary"><?php echo get_category( get_cat_ID('ฤกษ์แต่งงาน'))->name?></a>
      </div>
      <?php if ($postAll->have_posts()): ?>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-2 wdl-archive wdl-archive-extended opacity-1">
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
        <a href="<?php echo esc_html(get_post_type_archive_link('post')) ?>" class="wdl-btn-secondary ">
          <?php _e('ดูบทความทั้งหมด', 'wdl') ?>
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