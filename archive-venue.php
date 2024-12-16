<?php include get_stylesheet_directory().'/components/header.php' ?>

<main>
  <?php include get_stylesheet_directory().'/components/search.php' ?>
  <section class="wdl-archive wdl-archive-extended pb-5">

    <?php include get_stylesheet_directory().'/queries/query-venue.php' ?>
    <div class="container-xl">
      <div class="row">
        <div class="col">
          <h1 class="mb-0">
            <?php echo(get_option('wdl_options', 'โปรโมชั่นแต่งงาน & แพ็กเกจแต่งงาน')['word-venue-title']); ?>
          </h1>
          <p class="text-secondary mb-2">
            <?php echo(get_option('wdl_options', 'รวมโปรโมชั่น และ แพ็กเกจแต่งงาน จากสถานที่จัดงานแต่งงานชั้นนำทุกรูปแบบ อัพเดทล่าสุด')['word-venue-desc']); ?>
          </p>
        </div>
      </div>
      <?php include get_stylesheet_directory().'/components/filters/filter-venue.php' ?>
    </div>
    
    <?php if (have_posts()): ?>
    <div class="container-xxl container-archive wdl-archive-infinite-scroll">
      <div class="wdl-archive-grid
        <?php if($_GET['order'] || $_GET['orderby'] || $_GET['key']) {

        } else {
          echo 'row-cols-archive-randomized';
        } ?> wdl-archive-infinite-scroll-wrapper" id="wdl-archive-infinite-scroll-wrapper">
          <?php while (have_posts()): ?>
          <?php the_post(); ?>
            <?php include get_stylesheet_directory().'/components/cards/card-venue.php' ?>
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
      $empty_type = 'venue';
      include get_stylesheet_directory().'/components/result-empty.php';
    ?>
    <?php endif; ?>

  </section>
  <?php include get_stylesheet_directory().'/components/compare-bar.php' ?>
</main>
<?php include get_stylesheet_directory().'/components/form-general.php' ?>
<?php include get_stylesheet_directory().'/components/footer.php' ?>