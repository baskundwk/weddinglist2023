<?php include get_stylesheet_directory().'/components/header.php' ?>

<main>
  <?php include get_stylesheet_directory().'/components/search.php' ?>
  <?php include get_stylesheet_directory().'/queries/query-listing.php' ?>
  <section>
    <div class="container-xl">
      <div class="row">
        <div class="col">
          <h1 class="mb-0">
            <?php _e('สถานที่จัดงานแต่งงานแนะนำ','wdl'); ?>
          </h1>
          <p class="text-secondary mb-2">
            <?php _e('รวมสถานที่จัดงานแต่งงานแนะนำ อัพเดทล่าสุด','wdl'); ?>
          </p>
        </div>
      </div>
    </div>
  </section>
  <?php if (have_posts()): ?>
  <section class="wdl-archive wdl-archive-extended pb-5 m-0">
    <div class="container wdl-archive-infinite-scroll">
      <div class="wdl-listing-grid wdl-archive-infinite-scroll-wrapper" id="wdl-archive-infinite-scroll-wrapper">
        <?php while (have_posts()): ?>
          <?php the_post();
          ?>
          <?php include get_stylesheet_directory().'/components/cards/card-listing-thumbnail.php' ?>
        <?php endwhile;
        wp_reset_postdata(); ?>
      </div>
      <div class="row">
        <div class="col">
          <?php wp_pagenavi(); ?>
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
  
</main>
<?php include get_stylesheet_directory().'/components/form-general.php' ?>
<?php include get_stylesheet_directory().'/components/footer.php' ?>