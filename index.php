<?php include get_stylesheet_directory() . '/components/header.php' ?>

<main>
  <?php include get_stylesheet_directory() . '/components/search.php' ?>

  <?php
  $paged = get_query_var('paged', 1);
  $postAllArg = [
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => get_option( 'posts_per_page' ),
    'paged' => $paged,
    'orderby' => 'post_date',
    'order' => 'DESC',
    //'category__not_in' => [get_term_by('slug', 'ข่าวสาร', 'category')->term_id, get_term_by('slug', 'announcement-en', 'category')->term_id]
  ];
  if(isset($_GET['keyword']) && !empty($_GET['keyword'])) {
    $postAllArg['s'] = sanitize_text_field($_GET['keyword']);
  }
  $postAll = new WP_Query($postAllArg) ?>
  <section class="py-4">
    <div class="container-xl">
      <div class="row pb-3">
        <div class="col">
          <h1 class="mb-0">
            <?php if(isset($_GET['keyword']) && !empty($_GET['keyword'])) {
              echo __('ผลการค้นหา', 'wdl') . ' : ' . esc_html(sanitize_text_field($_GET['keyword'])); 
            } else {
              _e('บทความล่าสุด', 'wdl'); 
            }
            ?>
          </h1>
          <p class="text-secondary">
            <?php _e('รวบรวมบทความให้คุณไว้ที่เดียว อัพเดทล่าสุด', 'wdl'); ?>
          </p>
          <div class="wdl-badge-container">
            <a href="#" class="wdl-badge-sm-primary"><?php _e('ทั้งหมด', 'wdl')?></a>
            <a href="<?php echo esc_html(home_url( '/blog/category/ข่าวสาร')) ?>" class="wdl-badge-sm-secondary"><?php _e('ข่าวสาร', 'wdl')?></a>
            <a href="<?php echo esc_html(home_url( '/blog/category/reviews/รีวิวแต่งงาน/')) ?>" class="wdl-badge-sm-secondary"><?php _e('รีวิวแต่งงาน', 'wdl')?></a>
            <a href="<?php echo esc_html(home_url( '/blog/category/วางแผนแต่งงาน')) ?>" class="wdl-badge-sm-secondary"><?php _e('วางแผนแต่งงาน', 'wdl')?></a>
            <a href="<?php echo esc_html(home_url( '/blog/category/ไลฟ์สไตล์')) ?>" class="wdl-badge-sm-secondary"><?php _e('ไลฟ์สไตล์', 'wdl')?></a>
          </div>
        </div>
      </div>
      <?php if ($postAll->have_posts()): ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-3 wdl-archive wdl-archive-extended opacity-1">
          <?php while ($postAll->have_posts()): ?>
            <?php $postAll->the_post(); ?>
            <div class="col">
              <?php include get_stylesheet_directory() . '/components/cards/card-post.php' ?>
            </div>
          <?php endwhile;
          wp_reset_postdata(); ?>
        </div>
        <div class="row">
          <div class="col text-center">
            <?php pagination(); ?>
          </div>
        </div>
      <?php else: ?>
      <?php include get_stylesheet_directory() . '/components/result-empty.php' ?>
      <?php endif; ?>
    </div>
  </section>

  <?php
  /* $paged = get_query_var('paged', 1);
  $postCat4 = new WP_Query(
    array(
      'post_type' => 'post',
      'post_status' => 'publish',
      'category_name' => 'ข่าวประชาสัมพันธ์',
      'posts_per_page' => '8',
      'paged' => $paged
    )
  ) ?>

  <?php if ($postCat4->have_posts()): ?>
    <section class="wdl-archive wdl-archive-extended py-4 overflow-hidden bg-gray">
      <div class="container-xl">

        <div class="row">
          <div class="col">
            <h2>
              <?php _e('ข่าวประชาสัมพันธ์', 'wdl') ?>
            </h2>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="swiper wdl-archive-swiper">
              <div class="swiper-wrapper">
                <?php while ($postCat4->have_posts()): ?>
                  <?php $postCat4->the_post(); ?>

                  <div class="swiper-slide h-auto">
                    <?php include get_stylesheet_directory() . '/components/cards/card-post.php' ?>
                  </div>

                <?php endwhile;
                wp_reset_postdata(); ?>
              </div>
              <div class="swiper-pagination"></div>
              <div class="swiper-navigation swiper-navigation-small">
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
              </div>
            </div>
          </div>
        </div>
        <!-- <div class="row">
          <div class="col">
            <?php pagination(); ?>
          </div>
        </div> -->
      </div>
    </section>
  <?php endif;  */?>
  
  <?php
  $paged = get_query_var('paged', 1);
  $postCat1 = new WP_Query(
    array(
      'post_type' => 'post',
      'post_status' => 'publish',
      'category_name' => 'รีวิวแต่งงาน',
      'posts_per_page' => '8',
      'paged' => $paged
    )
  ) ?>

  <?php if ($postCat1->have_posts()): ?>
    <section class="wdl-archive wdl-archive-extended py-4 overflow-hidden bg-gray">
      <div class="container-xl">

        <div class="row">
          <div class="col">
            <h2>
              <?php _e('รีวิวแต่งงาน', 'wdl') ?>
            </h2>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="swiper wdl-archive-swiper">
              <div class="swiper-wrapper">
                <?php while ($postCat1->have_posts()): ?>
                  <?php $postCat1->the_post(); ?>

                  <div class="swiper-slide h-auto">
                    <?php include get_stylesheet_directory() . '/components/cards/card-post.php' ?>
                  </div>

                <?php endwhile;
                wp_reset_postdata(); ?>
              </div>
              <div class="swiper-pagination"></div>
              <div class="swiper-navigation swiper-navigation-small">
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
              </div>
            </div>
          </div>
        </div>
        <!-- <div class="row">
          <div class="col">
            <?php pagination(); ?>
          </div>
        </div> -->
      </div>
    </section>
  <?php endif; ?>

  <?php
  $paged = get_query_var('paged', 1);
  $postCat2 = new WP_Query(
    array(
      'post_type' => 'post',
      'post_status' => 'publish',
      'category_name' => 'เตรียมตัวแต่งงาน',
      'posts_per_page' => '8',
      'paged' => $paged
    )
  ) ?>

  <?php if ($postCat2->have_posts()): ?>
    <section class="wdl-archive wdl-archive-extended pb-4 overflow-hidden bg-gray">
      <div class="container-xl">

        <div class="row">
          <div class="col">
            <h2>
              <?php _e('เตรียมตัวแต่งงาน', 'wdl') ?>
            </h2>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="swiper wdl-archive-swiper">
              <div class="swiper-wrapper">
                <?php while ($postCat2->have_posts()): ?>
                  <?php $postCat2->the_post(); ?>

                  <div class="swiper-slide h-auto">
                    <?php include get_stylesheet_directory() . '/components/cards/card-post.php' ?>
                  </div>

                <?php endwhile;
                wp_reset_postdata(); ?>
              </div>
              <div class="swiper-pagination"></div>
              <div class="swiper-navigation swiper-navigation-small">
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
              </div>
            </div>
          </div>
        </div>
        <!-- <div class="row">
          <div class="col">
            <?php pagination(); ?>
          </div>
        </div> -->
      </div>
    </section>
  <?php endif; ?>

  <?php
  $paged = get_query_var('paged', 1);
  $postCat3 = new WP_Query(
    array(
      'post_type' => 'post',
      'post_status' => 'publish',
      'category_name' => 'ไลฟ์สไตล์',
      'posts_per_page' => '8',
      'paged' => $paged
    )
  ) ?>

  <?php if ($postCat3->have_posts()): ?>
    <section class="wdl-archive wdl-archive-extended pb-4 overflow-hidden bg-gray">
      <div class="container-xl">

        <div class="row">
          <div class="col">
            <h2>
              <?php _e('ไลฟ์สไตล์', 'wdl') ?>
            </h2>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="swiper wdl-archive-swiper">
              <div class="swiper-wrapper">
                <?php while ($postCat3->have_posts()): ?>
                  <?php $postCat3->the_post(); ?>

                  <div class="swiper-slide h-auto">
                    <?php include get_stylesheet_directory() . '/components/cards/card-post.php' ?>
                  </div>

                <?php endwhile;
                wp_reset_postdata(); ?>
              </div>
              <div class="swiper-pagination"></div>
              <div class="swiper-navigation swiper-navigation-small">
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
              </div>
            </div>
          </div>
        </div>
        <!-- <div class="row">
          <div class="col">
            <?php pagination(); ?>
          </div>
        </div> -->
      </div>
    </section>
  <?php endif; ?>


  <?php
  $announcement = new WP_Query(
    array(
      'post_type' => 'post',
      'post_status' => 'publish',
      'posts_per_page' => '8',
      'category_name' => 'ข่าวสาร,announcement-en',
    )
  ) ?>
  <?php if($announcement->have_posts()) { ?>
  <section class="pb-5 html-lazy wdl-archive wdl-archive-extended">
    <div class="container-xl">

      <div class="row mb-2">
        <div class="col-lg">
          <h2 class="h1 wdl-localnav-heading mb-0">
            <?php _e('ข่าวประชาสัมพันธ์', 'wdl')?>
          </h2>
        </div>
        <div class="col-lg text-lg-end d-none d-lg-block">
          <a href="<?php echo home_url( '/blog/category/ข่าวสาร' ) ?>" class="wdl-btn-secondary"
            data-dlev="buttonClick"
            data-dlcomp="button - front page - listing"
            data-dltgt="Listing">
            <?php _e('ดูข่าวประชาสัมพันธ์ทั้งหมด', 'wdl') ?>
          </a>
        </div>
      </div>
      <?php if ($announcement->have_posts()): ?>
      <div class="swiper wdl-archive-swiper">
        <div class="swiper-wrapper">
          <?php while ($announcement->have_posts()): ?>
          <?php $announcement->the_post(); ?>
          <?php include get_stylesheet_directory() . '/components/cards/card-post.php' ?>
          <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <div class="swiper-navigation swiper-naivgation-small">
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>
        </div>
        <div class="swiper-pagination"></div>
      </div>
      <?php endif; ?>
    </div>
  </section>
  <?php } ?>
</main>

<?php include get_stylesheet_directory() . '/components/footer.php' ?>