<?php include get_stylesheet_directory().'/components/header.php' ?>

<main>
  <?php include get_stylesheet_directory().'/queries/query-wedding-fair.php' ?>
  <section class="pt-4">
    <div class="container-xl">
      <h1 class="mb-0">
        <?php _e('Wedding Fair & Events', 'wdl'); ?>
      </h1>
      <p class="text-secondary mb-4">
        <?php _e('รวม Wedding Fair & Events จากสถานที่จัดงานแต่งงานชั้นนำทุกรูปแบบ อัพเดทล่าสุด', 'wdl'); ?>
      </p>
      <?php include get_stylesheet_directory().'/components/filters/filter-wedding-fair.php' ?>
    </div>
  </section>
  <?php if (have_posts()): ?>
  <section class="wdl-archive wdl-archive-extended pb-5 m-0">
    <div class="container-xxl container-archive wdl-archive-infinite-scroll">
      <div class="wdl-archive-grid 
        <?php if ($_GET['order'] || $_GET['orderby'] || $_GET['key']) {

        } else {
          echo 'row-cols-archive-randomized';
        } ?> wdl-archive-infinite-scroll-wrapper" id="wdl-archive-infinite-scroll-wrapper">
        <?php while (have_posts()): ?>
        <?php the_post();
            $hotDeal = get_field('HotDeal');
            ?>

        <?php include get_stylesheet_directory().'/components/cards/card-weddingfair.php' ?>
        <?php endwhile;
          wp_reset_postdata(); ?>
      </div>
      <div class="row">
        <div class="col">
          <?php pagination(); ?>
        </div>
      </div>

    </div>
  </section>
  <?php else: ?>
  <?php 
    $empty_type = 'wedding-fair';
    include get_stylesheet_directory().'/components/result-empty.php';
  ?>
  <?php endif; ?>

</main>
<?php include get_stylesheet_directory().'/components/footer.php' ?>