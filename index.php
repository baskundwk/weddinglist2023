<?php include get_stylesheet_directory().'/components/header.php' ?>

<main>
  <?php include get_stylesheet_directory().'/components/search.php' ?>

  <section class="pb-4">
    <div class="container">
      <div class="row pb-3">
        <div class="col">
          <h1 class="mb-0">
            <?php _e('บทความล่าสุด', 'wdl') ?>
          </h1>
          <p class="text-secondary">
            <?php _e('รวบรวมบทความให้คุณไว้ที่เดียว', 'wdl') ?>
          </p>
          <div class="wdl-badge-container">
            <a href="#" class="wdl-badge-sm-primary">ทั้งหมด</a>
            <a href="<?php echo esc_html(get_category_link(get_cat_ID('รีวิวแต่งงาน'))) ?>" class="wdl-badge-sm-secondary">รีวิวแต่งงาน</a>
            <a href="<?php echo esc_html(get_category_link(get_cat_ID('เตรียมตัวแต่งงาน'))) ?>" class="wdl-badge-sm-secondary">เตรียมตัวแต่งงาน</a>
            <a href="<?php echo esc_html(get_category_link(get_cat_ID('ไลฟ์สไตล์'))) ?>" class="wdl-badge-sm-secondary">ไลฟ์สไตล์</a>
          </div>
        </div>
      </div>

      <?php if (have_posts()): ?>
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-2 wdl-archive wdl-archive-extended opacity-1">
        <?php while (have_posts()): ?>
        <?php the_post(); ?>
        <div class="col"><?php include get_stylesheet_directory().'/components/cards/card-post.php' ?></div>
        <?php endwhile;
        wp_reset_postdata(); ?>
      </div>
      <div class="row">
        <div class="col text-center">
          <?php pagination(); ?>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </section>

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
    <div class="container">

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
              <?php include get_stylesheet_directory().'/components/cards/card-post.php' ?>
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
    <div class="container">

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
              <?php include get_stylesheet_directory().'/components/cards/card-post.php' ?>
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
    <div class="container">

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
              <?php include get_stylesheet_directory().'/components/cards/card-post.php' ?>
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
</main>

<?php include get_stylesheet_directory().'/components/footer.php' ?>