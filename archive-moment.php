<?php include get_stylesheet_directory().'/components/header.php' ?>

<main>
  <?php include get_stylesheet_directory().'/components/search.php' ?>
  <section class="wdl-archive wdl-archive-extended pb-5 m-0">

    <?php include get_stylesheet_directory().'/queries/query-moment.php' ?>
    <div class="container-xl">
      <div class="row">
        <div class="col">
          <h1 class="mb-0">
            <?php _e('รวม Moment ประสบการณ์ราคาพิเศษ','wdl'); ?>
          </h1>
          <p class="text-secondary mb-2">
            <?php _e('รวม Moment ประสบการณ์ราคาพิเศษทุกรูปแบบ อัพเดทล่าสุด','wdl'); ?>
          </p>
        </div>
      </div>
    </div>
    <?php $momentSets = get_terms([
      'taxonomy' => 'moment-set',
      'hide_empty' => true,
      'posts_per_page' => 10,
    ])?>
    <div class="container-xl mb-2 pb-1">
      <div class="swiper wdl-hero-swiper">
        <div class="swiper-wrapper">
          <?php foreach($momentSets as $momentSet) {?>
            <div class="swiper-slide">
              <?php include get_stylesheet_directory( ).'/components/cards/card-moment-set.php' ?>
            </div>
          <?php } ?>

        </div>
        <div class="swiper-navigation swiper-navigation-small">
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>
        </div>
      </div>
    </div>
    <?php if (have_posts()): ?>
    <div class="container-xxl wdl-archive-infinite-scroll">
      <div class="wdl-archive-grid-2
        <?php if($_GET['order'] || $_GET['orderby'] || $_GET['key']) {

        } else {
          echo 'row-cols-archive-randomized';
        } ?> wdl-archive-infinite-scroll-wrapper" id="wdl-archive-infinite-scroll-wrapper">
          <?php while (have_posts()): ?>
          <?php the_post(); ?>
            <?php include get_stylesheet_directory().'/components/cards/card-moment.php' ?>
          <?php endwhile;
          wp_reset_postdata(); ?>
      </div>
      <div class="row">
        <div class="col">
          <?php pagination(); ?>
        </div>
      </div>
    </div>
    <?php else: ?>
    <?php 
      $empty_type = 'moment';
      include get_stylesheet_directory().'/components/result-empty.php';
    ?>
    <?php endif; ?>

  </section>
  <?php include get_stylesheet_directory().'/components/compare-bar.php' ?>
</main>
<?php include get_stylesheet_directory().'/components/form-lead.php' ?>
<?php include get_stylesheet_directory().'/components/footer.php' ?>