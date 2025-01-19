<?php include get_stylesheet_directory().'/components/header.php' ?>

<main>
  <?php include get_stylesheet_directory().'/components/search.php' ?>
  <?php include get_stylesheet_directory().'/queries/query-promotion.php' ?>
  <section>
    <div class="container-xl">
      <div class="row">
        <div class="col-xl-8">
          <h1 class="mb-0">
            <?php echo(get_option('wdl_options', 'โปรโมชั่นแต่งงาน & แพ็กเกจแต่งงาน')['word-promotion-title']); ?>
          </h1>
          <p class="text-secondary mb-2">
            <?php echo(get_option('wdl_options', 'รวมโปรโมชั่น และ แพ็กเกจแต่งงาน จากสถานที่จัดงานแต่งงานชั้นนำทุกรูปแบบ อัพเดทล่าสุด')['word-promotion-desc']); ?>
          </p>
        </div>
        <div class="col-xl-4">
          <?php include get_stylesheet_directory().'/components/filters/filter-promotion.php' ?>
        </div>
      </div>
    </div>
  </section>
  <?php if (have_posts()): ?>
  <section class="wdl-archive wdl-archive-extended pb-5 m-0">
    <div class="container-xxl container-archive wdl-archive-infinite-scroll">
      <div class="wdl-archive-grid 
        <?php if(empty($_GET['order']) && empty($_GET['orderby']) || empty($_GET['key'])) {
          echo 'row-cols-archive-randomized';
        } ?>  wdl-archive-infinite-scroll-wrapper" id="wdl-archive-infinite-scroll-wrapper">
        <?php while (have_posts()): ?>
          <?php the_post();
          $hotDeal = get_field('HotDeal');
          ?>
          <?php include get_stylesheet_directory().'/components/cards/card-promotion.php' ?>
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
    $empty_type = 'promotion';
    include get_stylesheet_directory().'/components/result-empty.php';
  ?>
  <?php endif; ?>
  <?php include get_stylesheet_directory().'/components/compare-bar.php' ?>
  
</main>
<?php include get_stylesheet_directory().'/components/form-lead.php' ?>
<?php include get_stylesheet_directory().'/components/footer.php' ?>