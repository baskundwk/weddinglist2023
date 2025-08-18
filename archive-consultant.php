<?php include get_stylesheet_directory().'/components/header.php' ?>

<main>
  <?php include get_stylesheet_directory().'/queries/query-consultant.php' ?>
  <?php if (have_posts()): ?>
  <section class="pt-4 pb-5">
    <div class="container-xl wdl-archive-infinite-scroll">
      <div class="row mb-2">
        <div class="col">
          <h1 class="mb-0">
            <?php _e('ที่ปรึกษาการจัดงาน','wdl'); ?>
          </h1>
          <p class="text-secondary mb-4">
            <?php _e('รวบรวมที่ปรึกษาการจัดงานไว้ให้คุณที่เดียว','wdl'); ?>
          </p>
        </div>
      </div>
      <div class="wdl-consultant-grid wdl-archive-infinite-scroll-wrapper" id="wdl-archive-infinite-scroll-wrapper">
        <?php while (have_posts()): ?>
          <?php the_post(); ?>
          <?php include get_stylesheet_directory().'/components/cards/card-consultant.php' ?>
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
    $empty_type = 'consultant';
    include get_stylesheet_directory().'/components/result-empty.php';
  ?>
  <?php endif; ?>
  
</main>
<?php include get_stylesheet_directory().'/components/modal-lineqr.php' ?>
<?php include get_stylesheet_directory().'/components/footer.php' ?>